<?php

namespace App\Livewire\Teacher;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $classroomCount;
    public $courseCount;
    public $assignmentCount;
    public $studentCount;

    public function mount()
    {
        $teacherId = Auth::id();
        $this->classroomCount = Classroom::whereHas('teachers', function ($query) use ($teacherId) {
            $query->where('users.id', $teacherId);
        })->count();
        $this->courseCount = Course::where('created_by', $teacherId)->count();
        $this->assignmentCount = Assignment::whereHas('chapter.course', function ($query) use ($teacherId) {
            $query->where('created_by', $teacherId);
        })->count();
        $this->studentCount = User::whereHas('classroomUsers', function ($query) use ($teacherId) {
            $query->whereIn('classroom_id', Classroom::whereHas('teachers', function ($query) use ($teacherId) {
                $query->where('users.id', $teacherId);
            })->pluck('id'));
        })->count();
    }

    public function render()
    {
        return view('livewire.teacher.dashboard');
    }
}
