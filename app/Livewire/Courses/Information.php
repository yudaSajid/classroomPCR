<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;

class Information extends Component
{
    public $total_materials;

    public $courseID;

    public $total_chapters;

    public function mount($courseID)
    {
        $this->courseID = $courseID;
        $this->total_materials = Course::findOrFail($courseID)->total_materials;
        $this->total_chapters = Course::findOrFail($courseID)->total_chapters;
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
        return view('livewire.courses.information');
    }
}
