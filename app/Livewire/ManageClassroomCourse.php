<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\ClassroomCourse;
use Livewire\Attributes\Locked;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Attributes\On;

class ManageClassroomCourse extends Component implements HasForms
{
    use InteractsWithForms;
    
    #[Locked]
    public $classroomId;
    
    public ?array $data = [];
    
    public function mount($classroomId)
    {
        $this->classroomId = $classroomId;
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('course_id')
                    ->label('Select Course')
                    ->options(function () {
                        return Course::whereNotIn('id', function($query) {
                            $query->select('course_id')
                                ->from('classroom_course')
                                ->where('classroom_id', $this->classroomId);
                        })
                        ->where('created_by', auth()->id()) // Add this line to filter by logged-in user
                        ->pluck('course_name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                Toggle::make('is_active')
                    ->label('Active in Classroom')
                    ->default(true)
                    ->helperText('Course will be immediately available to students if active'),
            ])
            ->statePath('data');
    }

    public function addCourse(): void
    {
        $data = $this->form->getState();

        ClassroomCourse::create([
            'classroom_id' => $this->classroomId,
            'course_id' => $data['course_id'],
            'is_active' => $data['is_active'],
        ]);

        $this->form->fill();

        Notification::make()
            ->success()
            ->title('Course Added')
            ->body('The course has been successfully added to this classroom.')
            ->send();

        $this->dispatch('course-added');
    }

    public function render()
    {
        $assignedCourses = Course::select('courses.*')
            ->join('classroom_course', 'courses.id', '=', 'classroom_course.course_id')
            ->where('classroom_course.classroom_id', $this->classroomId)
            ->with(['classrooms' => function($query) {
                $query->where('classroom_id', $this->classroomId);
            }])
            ->orderBy('courses.course_name')
            ->get();

        return view('livewire.manage-classroom-course', [
            'assignedCourses' => $assignedCourses
        ]);
    }

    public function toggleCourseStatus($courseId)
    {
        try {
            $classroomCourse = ClassroomCourse::where([
                'classroom_id' => $this->classroomId,
                'course_id' => $courseId
            ])->first();

            if (!$classroomCourse) {
                throw new \Exception('Course not found in this classroom');
            }

            $classroomCourse->is_active = !$classroomCourse->is_active;
            $classroomCourse->save();

            $status = $classroomCourse->is_active ? 'activated' : 'deactivated';

            Notification::make()
                ->success()
                ->title('Course Updated')
                ->body("Course has been {$status} successfully.")
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Error')
                ->body('Failed to update course status.')
                ->send();
        }
    }
}

