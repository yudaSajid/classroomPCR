<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class Classroom extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $activeNavigationIcon = 'heroicon-s-academic-cap';

    protected static ?string $navigationGroup = 'Courses';
    protected static ?string $navigationLabel = 'Courses';


    protected static string $view = 'filament.student.pages.classroom';

    // hilangkan heading
    protected ?string $heading = '';

    use WithPagination;

    public $activeTab = 'tab1';

    public $courses;

    public function mount()
    {
        $this->fetchCourses();
    }

    public function updatedActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->fetchCourses();
    }

    #[Computed()]
    protected function fetchCourses()
    {
        // Fetch the currently logged-in user
        $user = Auth::user();

        // Fetch classrooms related to the user
        $classrooms = $user->classrooms;

        // Fetch courses related to these classrooms
        $courses = collect(); // Using Laravel's collection to merge courses

        foreach ($classrooms as $classroom) {
            $courses = $courses->merge($classroom->courses);
        }

        // Compute the total and completed material counts for each course
        $coursesWithMaterialStatus = $courses->map(function ($course) use ($user) {
            $totalMaterialCount = $course->chapters->flatMap(function ($chapter) {
                return $chapter->materials;
            })->count();

            $completedMaterialCount = $course->chapters->flatMap(function ($chapter) use ($user) {
                return $chapter->materials->filter(function ($material) use ($user) {
                    return $user->materials->contains($material);
                });
            })->count();

            $course->total_material_count = $totalMaterialCount;
            $course->completed_material_count = $completedMaterialCount;
            $course->percentage_completed = $totalMaterialCount > 0 ? ($completedMaterialCount / $totalMaterialCount) * 100 : 0;

            return $course;
        });

        // Set the courses property with filtered and unique courses
        $this->courses = $coursesWithMaterialStatus->unique('id')->where('course_publish', 1);
    }
}
