<?php

namespace App\Livewire\Courses;

use App\Models\Point as Points;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Point extends Component
{
    public $points;

    public $courseID;

    public $topPoints;

    public $user;

    public function mount($courseID)
    {
        $this->user = Auth::id();
        $this->courseID = $courseID;
        $this->topPoints = $this->formatPoints(
            Points::where('course_id', $this->courseID)
                ->where('user_id', $this->user)
                ->sum('points')
        );

    }

    private function formatPoints($points)
    {
        if ($points < 1000) {
            return $points;
        } elseif ($points < 1000000) {
            return number_format($points / 1000, 0).'K';
        } elseif ($points < 1000000000) {
            return number_format($points / 1000000, 0).'M';
        } else {
            return number_format($points / 1000000000, 0).'B';
        }
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="border border-blue-300 shadow rounded-md p-4 max-w-sm w-full mx-auto">
          <div class="animate-pulse flex space-x-4">
            <div class="rounded-full bg-slate-200 h-10 w-10"></div>
            <div class="flex-1 space-y-6 py-1">
              <div class="h-2 bg-slate-200 rounded"></div>
              <div class="space-y-3">
                <div class="grid grid-cols-3 gap-4">
                  <div class="h-2 bg-slate-200 rounded col-span-2"></div>
                  <div class="h-2 bg-slate-200 rounded col-span-1"></div>
                </div>
                <div class="h-2 bg-slate-200 rounded"></div>
              </div>
            </div>
          </div>
        </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.courses.point');
    }
}
