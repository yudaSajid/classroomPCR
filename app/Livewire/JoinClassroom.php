<?php

namespace App\Livewire;

use App\Models\Classroom;
use App\Models\ClassroomUser;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Attributes\On;

class JoinClassroom extends Component implements HasForms
{
    use InteractsWithForms;

    public $showJoinModal = false;
    public $classCode = '';
    public $search = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('classCode')
                    ->label('Class Code')
                    ->required()
                    ->length(6)
                    ->placeholder('Enter 6-character class code')
                    ->helperText('Enter the class code provided by your teacher')
            ]);
    }

    public function joinClassroom()
    {
        $data = $this->form->getState();

        $classroom = Classroom::where('class_code', $data['classCode'])->first();

        if (!$classroom) {
            Notification::make()
                ->title('Class not found')
                ->danger()
                ->send();
            return;
        }

        // Check if user is already in classroom
        $exists = ClassroomUser::where('classroom_id', $classroom->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($exists) {
            Notification::make()
                ->title('You are already in this class')
                ->warning()
                ->send();
            return;
        }

        // Join classroom
        ClassroomUser::create([
            'classroom_id' => $classroom->id,
            'user_id' => Auth::id()
        ]);

        $this->showJoinModal = false;
        $this->form->fill();

        Notification::make()
            ->title('Successfully joined classroom')
            ->success()
            ->send();

        $this->dispatch('classroom-list-updated');
        $this->dispatch('$refresh');
    }
    public function joinWithCode(string $code)
    {
        $this->classCode = $code;
        $this->form->fill(['classCode' => $code]);
        $this->joinClassroom();
    }

    public function getAvailableClassrooms()
    {
        return Classroom::query()
            ->where('class_name', 'like', "%{$this->search}%")
            ->whereDoesntHave('classroomUsers', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();
    }

    #[On('join-classroom-refresh')]
    public function render()
    {
        return view('livewire.join-classroom', [
            'availableClassrooms' => $this->getAvailableClassrooms()
        ]);
    }
}
