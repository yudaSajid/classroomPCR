<?php

namespace App\Livewire\Reviews;

use App\Models\CourseReview;
use Livewire\Component;

class AvgRate extends Component
{
    public $percentage;

    public $courseID;

    public $averageRating;

    public $totalRatings;

    public function mount($courseID)
    {
        $this->courseID = $courseID;

        // Hitung rata-rata rating
        $this->averageRating = CourseReview::where('course_id', $this->courseID)->avg('rating');
        $this->totalRatings = CourseReview::where('course_id', $this->courseID)->count();
    }

    public function render()
    {
        return view('livewire.reviews.avg-rate');
    }
}
