<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePost extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $courseID;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')->default(Auth::id()),
                Hidden::make('course_id')
                    ->default($this->courseID),
                RichEditor::make('content')
                    ->label('What are you thinking about right now?'),
            ])
            ->statePath('data')
            ->model(Post::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Post::create($data);

        $this->form->model($record)->saveRelationships();
        // Reset form setelah berhasil menyimpan
        $this->reset('data');
        $this->form->fill();

        // Tampilkan notifikasi berhasil
        Notification::make()
            ->title('Success')
            ->body('Post has been created successfully!')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.posts.create-post');
    }
}
