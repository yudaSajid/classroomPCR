<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class CourseDetail extends Component
{
    public $course;

    public function canView(): bool
    {
        $course = $this->course; // Assuming you have a 'course' property

        // Check if the user can view the course
        return Gate::check('view-course', $course);
    }

    public function render()
    {
        return view('livewire.courses.course-detail');
    }
}
