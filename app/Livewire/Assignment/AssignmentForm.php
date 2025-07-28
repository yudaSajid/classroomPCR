<?php

namespace App\Livewire\Assignment;

use App\Models\UserAssignmentStatus;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AssignmentForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $userID;

    public $assignmentID;

    public $hasReviewed = false;

    public $message = '';

    public $score = null;
    public $notes = null;
    public $status = null;

    public function mount($assignmentID): void
    {
        $this->userID = Auth::id();
        $this->assignmentID = $assignmentID;
        $this->checkIfUserHasReviewed();
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('assignment_id')
                    ->default($this->assignmentID),
                Hidden::make('user_id')
                    ->default($this->userID),
                Hidden::make('is_completed')
                    ->default(1),
                Hidden::make('status')
                    ->default('pending'),
                TextInput::make('link')
                    ->label('Task Link')
                    ->placeholder('ex: https:://iqbalkeren.com')
                    ->required()
                    ->url()
                    ->suffixIcon('heroicon-m-globe-alt'),

                //
            ])
            ->statePath('data')
            ->model(UserAssignmentStatus::class);
    }

    public function checkIfUserHasReviewed(): void
    {
        // Cek apakah user sudah pernah memberikan review
        $existingReview = UserAssignmentStatus::where('user_id', Auth::id())
            ->where('assignment_id', $this->assignmentID)
            ->first();
        if ($existingReview) {
            $this->hasReviewed = true;
            $this->status = $existingReview->status;
            $this->score = $existingReview->score;
            $this->notes = $existingReview->notes;
            
            $this->message = match($existingReview->status) {
                'approved' => 'Your assignment has been approved',
                'rejected' => 'Your assignment needs revision',
                default => 'Waiting to be assessed',
            };
        }
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = UserAssignmentStatus::create($data);

        $this->form->model($record)->saveRelationships();
        $this->hasReviewed = true; // Menyembunyikan form setelah submit
        $this->message = 'Your assignment has been successfully submitted.';
    }

    public function render(): View
    {
        return view('livewire.assignment.assignment-form');
    }
}
