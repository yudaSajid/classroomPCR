<?php

namespace App\Livewire\Users;

use App\Models\Course;
use App\Models\Point;
use Livewire\Component;

class Completion extends Component
{
    public $userId;

    public $totalMaterialsCompleted;

    public $lastCompleted;

    public function mount($userId)
    {
        $this->userId = $userId;
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

    public function getUserCoursesInProgress()
    {
        // Ambil course yang dihubungkan melalui UserMaterialStatus
        $courses = Course::whereHas('chapters.materials.userMaterialStatus', function ($query) {
            $query->where('user_id', $this->userId)
                ->where('is_completed', false); // Mengambil course yang sedang dikerjakan
        })->with(['chapters.materials'])->get();

        // Loop untuk menghitung progress completion
        $courses->each(function ($course) {
            // Total semua materi dalam course
            $totalMaterials = $course->chapters->pluck('materials')->collapse()->count();

            // Total materi yang telah diselesaikan oleh user
            $completedMaterials = $course->chapters->pluck('materials')->collapse()->filter(function ($material) {
                return $material->userMaterialStatus()
                    ->where('user_id', $this->userId)
                    ->where('is_completed', true)
                    ->exists();
            })->count();

            // Hitung progress dalam persentase
            $course->completion_progress = $totalMaterials > 0
                ? ($completedMaterials / $totalMaterials) * 100
                : 0;
        });

        return $courses;
    }

    public function getUserCoursePoints($userId, $courseId)
    {
        // Ambil total poin untuk user dan course tertentu
        return Point::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->sum('points');
    }

    public function render()
    {
        $coursesInProgress = $this->getUserCoursesInProgress();
        $coursePoints = [];

        // Loop melalui course dan hitung poin untuk setiap course
        foreach ($coursesInProgress as $course) {
            $coursePoints[$course->id] = $this->getUserCoursePoints($this->userId, $course->id);
        }

        // Panggil getData() untuk mendapatkan data sebelum rendering view
        return view('livewire.users.completion', [
            'coursesInProgress' => $coursesInProgress,
            'coursePoints' => $coursePoints,
        ]);
    }
}
