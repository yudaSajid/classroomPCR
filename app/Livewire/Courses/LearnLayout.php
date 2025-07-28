<?php

namespace App\Livewire\Courses;

use App\Models\Chapter;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LearnLayout extends Component
{
    public $courseID;

    public $data;

    public $userId;

    public $selectedMaterial;

    public function mount($courseID)
    {
        $this->courseID = $courseID;
        $this->userId = Auth::id();
        $this->data = Chapter::where('course_id', $this->courseID)
            ->with(['materials' => function ($query) {
                $query->orderBy('order_number');
            }, 'materials.userMaterialStatus' => function ($query) {
                $query->where('user_id', $this->userId);
            }])
            ->orderBy('chapter_number')
            ->get();
    }

    public function materialSelected($materialId)
    {
        $this->selectedMaterial = Material::find($materialId);
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
        return view('livewire.courses.learn-layout');
    }
}
