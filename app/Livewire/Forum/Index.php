<?php

namespace App\Livewire\Forum;

use Livewire\Component;

class Index extends Component
{
    public $courseID;

    public function mount($courseID)
    {
        $this->courseID = $courseID;
    }

    public function render()
    {
        return view('livewire.forum.index');
    }
}
