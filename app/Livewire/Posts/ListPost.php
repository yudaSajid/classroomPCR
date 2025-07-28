<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use App\Models\PostComment;
use Livewire\Component;
use Livewire\WithPagination;

class ListPost extends Component
{
    use WithPagination;

    public $courseID;
    public $post;
    public int|string $perPage = 10;
    public $selectedPost = null;
    public $newComment = '';

    public function mount($courseID): void
    {
        $this->courseID = $courseID;
    }

    public function toggleComments($postId)
    {
        $this->selectedPost = $this->selectedPost === $postId ? null : $postId;
    }

    public function addComment($postId)
    {
        $this->validate([
            'newComment' => 'required|min:3'
        ]);

        PostComment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'content' => $this->newComment
        ]);

        $this->newComment = '';
        $this->dispatch('comment-added')->self();
    }

    public function render()
    {
        $posts = Post::where('course_id', $this->courseID)
            ->with(['user', 'comments.user'])
            ->latest()
            ->paginate($this->perPage);

        // Make sure $posts is not null, and is a LengthAwarePaginator instance.
        if (is_null($posts)) {
            $posts = collect();  // Default to an empty collection if null
        }

        return view('livewire.posts.list-post', ['posts' => $posts]);
    }
}
