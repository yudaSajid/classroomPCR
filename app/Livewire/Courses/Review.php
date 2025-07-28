<?php

namespace App\Livewire\Courses;

use Livewire\Component;

class Review extends Component
{
    public $courseID;

    public function mount($courseID)
    {
        $this->courseID = $courseID;
    }

    public function render()
    {
        return view('livewire.courses.review');
    }
}
