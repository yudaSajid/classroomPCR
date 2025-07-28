<?php

namespace App\Livewire\UserInformations;

use App\Models\Program;
use App\Models\Semester;
use App\Models\UserEducation;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditEducation extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $record;

    public function mount(): void
    {
        $this->record = UserEducation::firstOrNew(['user_id' => auth()->id()]);
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Group::make()->schema([
                        Forms\Components\TextInput::make('student_id_number')
                            ->required()
                            ->numeric()
                            ->maxLength(255),
                    ])->columns(2),
                    Fieldset::make('Academic Class')->schema([
                        Forms\Components\Select::make('department_id')
                            ->required()
                            ->relationship('department', 'department_name')
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('program_id', null)),
                        Forms\Components\Select::make('program_id')
                            ->label('Program')
                            ->options(function (callable $get) {
                                $departmentId = $get('department_id');
                                if (! $departmentId) {
                                    return Program::all()->pluck('program_name', 'id');
                                }

                                return Program::where('department_id', $departmentId)->pluck('program_name', 'id');
                            })
                            ->required(),

                        Forms\Components\Select::make('class_alphabet')
                            ->required()
                            ->options([
                                'A' => 'A',
                                'B' => 'B',
                                'C' => 'C',
                                'D' => 'D',
                                'E' => 'E',
                                'F' => 'F',
                                'G' => 'G',
                                'SW' => 'SW',
                            ]),
                    ])->columns(3),

                    Fieldset::make('Batch')->schema([
                        Forms\Components\Select::make('enrollment_year')
                            ->label('Year')
                            ->options(function () {
                                $currentYear = date('Y');

                                return collect(range($currentYear - 10, $currentYear))
                                    ->mapWithKeys(fn ($year) => [$year => $year])
                                    ->toArray();
                            })
                            ->required()
                            ->placeholder('Select year'),
                        Forms\Components\Select::make('semester_id')
                            ->searchable()
                            ->preload()
                            ->options(function () {
                                return Semester::with('period')->get()->mapWithKeys(function ($semester) {
                                    return [$semester->id => $semester->period_and_semester_name];
                                });
                            })
                            ->required()
                            ->optionsLimit(10),
                    ])->columns(2),
                ]),

            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        if (!$this->record->exists) {
            $data['user_id'] = auth()->id();
            $this->record = UserEducation::create($data);
        } else {
            $this->record->update($data);
        }
    }

    public function render(): View
    {
        return view('livewire.user-informations.edit-education');
    }
}
