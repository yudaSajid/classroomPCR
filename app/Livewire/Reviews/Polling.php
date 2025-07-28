<?php

namespace App\Livewire\Reviews;

use App\Models\CourseReview;
use Livewire\Component;

class Polling extends Component
{
    public $percentage;

    public $star_count;

    public $courseID;

    public function mount($courseID, $star_count)
    {
        $this->courseID = $courseID;
        $this->star_count = $star_count;
        // Hitung total jumlah ulasan untuk course tertentu
        $totalReviews = CourseReview::where('course_id', $this->courseID)->count();

        if ($totalReviews > 0) {
            // Hitung jumlah ulasan berdasarkan star_count tertentu
            $starReviewsCount = CourseReview::where('course_id', $this->courseID)
                ->where('rating', $this->star_count)
                ->count();

            // Hitung persentase
            $this->percentage = ($starReviewsCount / $totalReviews) * 100;
        } else {
            // Jika tidak ada ulasan, set persentase ke 0
            $this->percentage = 0;
        }
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="flex justify-start items-center content-center flex-row px-6 border border-blue-300 shadow rounded-md p-2 max-w-sm w-full mx-auto">
            <div class="basis-1/5 animate-pulse">
                <div class="rounded-full bg-slate-200 h-2 w-h-2"></div>
            </div>
            <div class="basis-4/5">
                <div class="h-2 bg-slate-200 rounded"></div>
                <div class="space-y-3">
                    <div class="h-2 bg-slate-200 rounded"></div>
                    <div class="h-2 bg-slate-200 rounded"></div>
                </div>
            </div>
        </div>
    HTML;
    }

    public function render()
    {
        return view('livewire.reviews.polling');
    }
}
