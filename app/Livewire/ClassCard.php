<?php

namespace App\Livewire;

use Livewire\Component;

class ClassCard extends Component
{
    public $status;

    public $image;

    public $title;

    public $completedMaterials;

    public $totalMaterials;

    public $points;

    public $totalPoints;

    public $progress;

    public $route;

    public function render()
    {
        return view('livewire.class-card');
    }
}
