<?php

namespace App\Livewire\Reviews;

use App\Models\CourseReview;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;

    public $courseID;

    public $comment;

    public int|string $perPage = 10;

    public function mount($courseID): void
    {
        $this->courseID = $courseID;
    }

    public function render()
    {
        // Lakukan query dan paginasi di sini
        $comments = CourseReview::where('course_id', $this->courseID)
            ->with('user') // Asumsi ada relasi user di model CourseReview
            ->latest() // Tampilkan data dari yang terbaru
            ->paginate($this->perPage);

        return view('livewire.reviews.comment', ['comments' => $comments]); // Pass comments ke view
    }
}
