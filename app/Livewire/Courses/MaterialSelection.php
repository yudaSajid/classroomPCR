<?php

namespace App\Livewire\Courses;

use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MaterialSelection extends Component
{
    public $courseID;
    public $data;
    public $userId;
    public $quizzes;
    public $assignments;
    public $materialId;
    public $currentView = null;

    public function mount($courseID)
    {
        $this->courseID = $courseID;
        $this->userId = Auth::id();
        $this->loadData();
    }

    private function loadData()
    {
        $this->data = Chapter::where('course_id', $this->courseID)
            ->with(['materials' => function ($query) {
                $query->orderBy('order_number');
            }, 'materials.userMaterialStatus' => function ($query) {
                $query->where('user_id', $this->userId);
            }])
            ->orderBy('chapter_number')
            ->get();
        $this->quizzes = $this->data->pluck('quizzes')->flatten();
        $this->assignments = $this->data->pluck('assignments')->flatten();
    }

    public function selectQuiz($quizId)
    {
        $this->currentView = 'quiz';
        $this->materialId = null;
        $this->dispatch('quizSelected', quizId: $quizId);
        $this->dispatch('scroll-to-material-info');
    }

    public function selectAssignment($assignmentId)
    {
        $this->currentView = 'assignment';
        $this->materialId = null;
        $this->dispatch('assignmentSelected', assignmentId: $assignmentId);
        $this->dispatch('scroll-to-material-info');
    }

    public function selectMaterial($materialId)
    {
        $this->currentView = 'material';
        $this->materialId = $materialId;
        $this->dispatch('materialSelected', materialId: $materialId);
        // --- Tambahkan baris ini untuk memicu scroll ---
        $this->dispatch('scroll-to-material-info');
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="w-full max-w-sm p-4 mx-auto border border-blue-300 rounded-md shadow">
          <div class="flex space-x-4 animate-pulse">
            
            <div class="flex-1 py-1 space-y-6">
              <div class="h-2 rounded bg-slate-200"></div>
              <div class="space-y-3">
                <div class="grid grid-rows-3 gap-4">
                  <div class="h-2 rounded bg-slate-200 "></div>
                  <div class="h-2 rounded bg-slate-200 "></div>
                  <div class="h-2 rounded bg-slate-200 "></div>
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
        return view('livewire.courses.material-selection');
    }
}
