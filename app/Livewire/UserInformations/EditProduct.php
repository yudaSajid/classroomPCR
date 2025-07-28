<?php

namespace App\Livewire\UserInformations;

use App\Models\UserInformation;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditProduct extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $record;

    public function mount(): void
    {
        $this->record = UserInformation::firstOrNew(['user_id' => auth()->id()]);
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Group::make()->schema([

                        Forms\Components\TextInput::make('phone_number')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('gender')
                            ->required()
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                            ]),
                    ])->columns(2),
                    Fieldset::make('Birth Information')->schema([
                        Forms\Components\DatePicker::make('birth_date')
                            ->required()
                            ->label('Date'),
                        Forms\Components\TextInput::make('birth_place')
                            ->required()
                            ->maxLength(255)
                            ->label('Place'),
                    ]),
                    Fieldset::make('Address Information')->schema([
                        Forms\Components\Textarea::make('current_address')
                            ->required()
                            ->maxLength(255)
                            ->label('Current'),
                        Forms\Components\Textarea::make('hometown_address')
                            ->required()
                            ->maxLength(255)
                            ->label('Hometown'),
                    ]),
                    Fieldset::make('Additional Information')->schema([
                        Forms\Components\TextInput::make('province')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('postal_code')
                            ->required()
                            ->maxLength(255),
                    ])->columns(3),

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
            $this->record = UserInformation::create($data);
        } else {
            $this->record->update($data);
        }
    }

    public function render(): View
    {
        return view('livewire.user-informations.edit-product');
    }
}
