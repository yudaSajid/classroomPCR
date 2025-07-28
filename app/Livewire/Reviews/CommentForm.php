<?php

namespace App\Livewire\Reviews;

use App\Models\CourseReview;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentForm extends Component implements HasForms
{
    use InteractsWithForms;

    public $courseID;

    public ?array $data = [];

    public $hasReviewed = false;

    public $message = '';

    public function mount($courseID): void
    {
        $this->courseID = $courseID;
        $this->checkIfUserHasReviewed();
        $this->form->fill();
    }

    public function checkIfUserHasReviewed(): void
    {
        // Cek apakah user sudah pernah memberikan review
        $existingReview = CourseReview::where('user_id', Auth::id())
            ->where('course_id', $this->courseID)
            ->first();

        if ($existingReview) {
            $this->hasReviewed = true;
            $this->message = 'You have already reviewed this course.';
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')->default(Auth::id()),
                Hidden::make('course_id')
                    ->default($this->courseID),
                Group::make()->schema([
                    Select::make('rating')
                        ->required()
                        ->options([
                            5 => '⭐⭐⭐⭐⭐',
                            4 => '⭐⭐⭐⭐',
                            3 => '⭐⭐⭐',
                            2 => '⭐⭐',
                            1 => '⭐',
                        ])
                        ->default(5),
                    Textarea::make('comment')
                        ->required()
                        ->columnSpan(5),
                ])->columns(6),
                // ...
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        CourseReview::create($this->form->getState());
        $this->hasReviewed = true; // Menyembunyikan form setelah submit
        $this->message = 'Your comment has been successfully submitted.';
    }

    public function render()
    {
        return view('livewire.reviews.comment-form');
    }
}
