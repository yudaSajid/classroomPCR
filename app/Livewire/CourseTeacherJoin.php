<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CourseTeacherJoin extends Component
{
    public $course;

    public function mount($course)
    {
        $this->course = Course::find($course);
    }

    public function joinAsCourseTeacher()
    {
        try {
            if ($this->course->teachers()->where('teacher_id', Auth::id())->exists()) {
                Notification::make()
                    ->warning()
                    ->title('Already Teaching')
                    ->body('You are already teaching this course.')
                    ->send();
                return;
            }

            $this->course->teachers()->attach(Auth::id(), [
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Notification::make()
                ->success()
                ->title('Success')
                ->body('You are now teaching this course.')
                ->send();

            $this->dispatch('teacher-joined');

        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Error')
                ->body('Failed to join as teacher.')
                ->send();
        }
    }

    public function render()
    {
        $isTeaching = $this->course->teachers()->where('teacher_id', Auth::id())->exists();

        return view('livewire.course-teacher-join', [
            'isTeaching' => $isTeaching
        ]);
    }
}