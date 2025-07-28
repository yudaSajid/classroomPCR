<?php

namespace App\Filament\Teacher\Pages;

use App\Models\Classroom;
use App\Models\Program;
use App\Models\ClassroomUser;
use App\Models\ClassroomCourse;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Toggle;

class ClassroomPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Class';
    protected static ?string $navigationGroup = 'Management';
    protected ?string $heading = 'Class';
    // tidak menampilkan heading
    protected static bool $breadcrumbs = false;

    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.teacher.pages.classroom-page';

    public $selectedClassroom = null;
    public $showCoursesModal = false;
    public $showStudentsModal = false;
    public $selectedClassroomForStudents = null;
    public $showCreateModal = false;
    public $class_name;
    public $class_alphabet;
    public $enrollment_year;
    public $program_id;
    public $class_description;

    // Add form model binding
    protected static string $model = Classroom::class;

    // Add form configuration
    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->model(Classroom::class);
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Split::make([
                Section::make()->schema([
                    TextInput::make('class_name')
                        ->required()
                        ->unique('classrooms', 'class_name')
                        ->maxLength(255)
                        ->placeholder('Ex: 20 TI A')
                        ->rules([
                            'required',
                            'regex:/^[0-9]{2} [A-Z]{2,3} [A-Z]$/',
                        ])
                        ->helperText('Format harus seperti "20 TI A", dimana "20" adalah tahun, "TI" adalah kode program, dan "A" adalah kode kelas.'),

                    RichEditor::make('class_description')
                        ->required()
                        ->placeholder('Enter class description')
                        ->maxLength(500)
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'bulletList',
                            'orderedList',
                        ]),
                ]),
                Group::make()->schema([
                    Section::make('Education Information')->schema([
                        Select::make('enrollment_year')
                            ->label('Year')
                            ->options(function () {
                                $currentYear = date('Y');
                                return collect(range($currentYear - 10, $currentYear))
                                    ->mapWithKeys(fn($year) => [$year => $year])
                                    ->toArray();
                            })
                            ->required()
                            ->placeholder('Select year'),

                        Select::make('class_alphabet')
                            ->label('Class')
                            ->required()
                            ->options([
                                'A' => 'A',
                                'B' => 'B',
                                'C' => 'C',
                                'D' => 'D',
                                'E' => 'E',
                                'F' => 'F',
                                'G' => 'G',
                                'S' => 'S',
                            ])
                            ->placeholder('Select class'),

                        Select::make('program_id')
                            ->relationship('program', 'program_name')
                            ->required()
                            ->placeholder('Select prodi')
                            ->preload()
                            ->searchable(),
                    ]),


                ]),
            ])->columnSpanFull(),
        ];
    }

    public function createClassroom()
    {
        try {
            DB::beginTransaction();

            $data = $this->form->getState();


            // Create classroom
            $classroom = Classroom::create($data);



            // Create classroom user entry for teacher
            ClassroomUser::create([
                'classroom_id' => $classroom->id,
                'user_id' => Auth::id(),
            ]);

            DB::commit();

            Notification::make()
                ->title('Classroom created successfully')
                ->success()
                ->send();

            $this->showCreateModal = false;
            $this->form->fill();
        } catch (\Exception $e) {
            DB::rollBack();

            Notification::make()
                ->title('Error creating classroom')
                ->danger()
                ->body('An error occurred while creating the classroom: ' . $e->getMessage())
                ->send();
        }
    }

    public function getClassrooms()
    {
        return Classroom::whereHas('classroomUsers', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['program', 'courses', 'classroomUsers.user'])->get();
    }

    #[On('classroom-list-updated')]
    public function refreshClassrooms()
    {
        // This method will be called when classroom-list-updated event is dispatched
        $this->getClassrooms();
        $this->dispatch('join-classroom-refresh')->to('join-classroom');
    }

    public function getStudentCount($classroomId)
    {
        return ClassroomUser::where('classroom_id', $classroomId)
            ->studentOnly()
            ->count();
    }

    public function showCourses($classroomId)
    {
        $this->selectedClassroom = Classroom::with(['courses' => function ($query) {
            $query->select([
                'courses.id',
                'courses.course_name',
                'courses.course_slug',
                'courses.course_publish'
            ])
                ->orderBy('course_name');
        }])->find($classroomId);

        $this->showCoursesModal = true;
    }
    public function showStudents($classroomId)
    {
        $this->selectedClassroomForStudents = Classroom::with(['classroomUsers' => function ($query) {
            $query->studentOnly()->with('user:id,name');
        }])->find($classroomId);

        $this->showStudentsModal = true;
    }
}
