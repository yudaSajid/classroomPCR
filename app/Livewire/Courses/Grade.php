<?php

namespace App\Livewire\Courses;

use App\Models\Point;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Grade extends Component
{
    public $grades;

    public $points;

    public $courseID;

    public $topPoints;

    public $user;

    public function mount($courseID)
    {
        $this->user = Auth::id();
        $this->courseID = $courseID;
        $this->topPoints =
          Point::where('course_id', $this->courseID)
              ->where('user_id', $this->user)
              ->sum('points');
        if ($this->topPoints > 1000) {
            $this->grades = 'A';
        } elseif ($this->topPoints > 500) {
            $this->grades = 'B';
        } elseif ($this->topPoints > 300) {
            $this->grades = 'C';
        } else {
            $this->grades = '-';
        }
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="w-full max-w-sm p-4 mx-auto border border-blue-300 rounded-md shadow">
          <div class="flex space-x-4 animate-pulse">
            <div class="w-10 h-10 rounded-full bg-slate-200"></div>
            <div class="flex-1 py-1 space-y-6">
              <div class="h-2 rounded bg-slate-200"></div>
              <div class="space-y-3">
                <div class="grid grid-cols-3 gap-4">
                  <div class="h-2 col-span-2 rounded bg-slate-200"></div>
                  <div class="h-2 col-span-1 rounded bg-slate-200"></div>
                </div>
                <div class="h-2 rounded bg-slate-200"></div>
              </div>
            </div>
          </div>
        </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.courses.grade');
    }
}
