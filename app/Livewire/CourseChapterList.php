<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Quiz;

class CourseChapterList extends Component
{
    public $course;
    public $expandedChapters = [];

    public function mount($course)
    {
        $this->course = Course::with([
            'chapters.materials' => function ($query) {
                $query->orderBy('order_number', 'asc');
            },
            'chapters.quizzes',
            'chapters.assignments'
        ])->findOrFail($course);
    }

    public function toggleChapter($chapterId)
    {
        if (in_array($chapterId, $this->expandedChapters)) {
            $this->expandedChapters = array_diff($this->expandedChapters, [$chapterId]);
        } else {
            $this->expandedChapters[] = $chapterId;
        }
    }

    public function deleteQuiz($quizId)
    {
        $quiz = Quiz::find($quizId);
        
        if ($quiz && ($quiz->chapter->course_id === $this->course->id)) {
            $quiz->delete();
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Quiz deleted successfully!'
            ]);
        }
    }

    #[On('materialStatusUpdated')]
    public function refreshCourseData()
    {
        Log::debug('CourseChapterList: materialStatusUpdated event received. Refreshing course data.');
        $this->course = Course::with([
            'chapters.materials' => function ($query) {
                $query->orderBy('order_number', 'asc');
            },
            'chapters.quizzes',
            'chapters.assignments'
        ])->findOrFail($this->course->id);
    }

    public function render()
    {
        return view('livewire.course-chapter-list');
    }
}