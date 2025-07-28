<?php

namespace App\Livewire\Posts;

use App\Models\PostComment;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreatePostComment extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ])
            ->statePath('data')
            ->model(PostComment::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = PostComment::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.posts.create-post-comment');
    }
}
