<?php

namespace App\Filament\Teacher\Pages;

use Filament\Pages\Page;
use App\Models\Course;
use Livewire\Attributes\Computed;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class CoursePage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected ?string $heading = 'Course';
    protected static ?string $navigationLabel = 'Course';
    protected static ?string $navigationGroup = 'Management';
    protected static bool $breadcrumbs = false;

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.teacher.pages.course-page';

    public $selectedStatus = 'all';
    public $searchQuery = '';
    public $myCourses = [];
    public $allCourses = [];

    protected function getViewData(): array
    {
        return [
            'myCourses' => $this->getMyCourses(),
            'allCourses' => $this->getAllCourses(),
        ];
    }

    public function updatedSelectedStatus()
    {
        $this->dispatch('$refresh');
        $this->myCourses = $this->getMyCourses();
        $this->allCourses = $this->getAllCourses();
    }

    public function updatedSearchQuery()
    {
        $this->dispatch('$refresh');
        $this->myCourses = $this->getMyCourses();
        $this->allCourses = $this->getAllCourses();
    }

    public function getSelectedStatusOptions()
    {
        return [
            'all' => 'All',
            'published' => 'Published',
            'draft' => 'Draft',
        ];
    }
    public function mount()
    {
        $this->myCourses = $this->getMyCourses();
        $this->allCourses = $this->getAllCourses();
    }

    #[Computed]
    protected function getMyCourses()
    {
        return Course::with(['teachers' => function ($query) {
            $query->where('teacher_id', auth()->id());
        }])
            ->whereHas('teachers', function ($query) {
                $query->where('teacher_id', auth()->id());
            })
            ->when($this->selectedStatus !== 'all', function ($query) {
                $query->where('course_publish', $this->selectedStatus === 'published');
            })
            ->when($this->searchQuery, function ($query) {
                $query->where('course_name', 'like', '%' . $this->searchQuery . '%');
            })
            ->withCount('chapters')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    #[Computed]
    protected function getAllCourses()
    {
        return Course::with('teachers')
            ->whereDoesntHave('teachers', function ($query) {
                $query->where('teacher_id', auth()->id());
            })
            ->when($this->selectedStatus !== 'all', function ($query) {
                $query->where('course_publish', $this->selectedStatus === 'published');
            })
            ->when($this->searchQuery, function ($query) {
                $query->where('course_name', 'like', '%' . $this->searchQuery . '%');
            })
            ->withCount('chapters')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get all courses
        // return Course::with('teachers')  // Eager load teachers relationship
        //     ->when($this->selectedStatus !== 'all', function ($query) {
        //         $query->where('course_publish', $this->selectedStatus === 'published');
        //     })
        //     ->when($this->searchQuery, function ($query) {
        //         $query->where('course_name', 'like', '%' . $this->searchQuery . '%');
        //     })
        //     ->withCount('chapters')
        //     ->orderBy('created_at', 'desc')
        //     ->get();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createCourse')
                ->label('Create Course')
                ->icon('heroicon-o-plus')
                ->url(route('filament.teacher.resources.courses.create')),

            Action::make('manageCourses')
                ->label('Manage Courses')
                ->icon('heroicon-o-cog')
                ->url(route('filament.teacher.resources.courses.index'))
                ->color('gray'),
        ];
    }
}
