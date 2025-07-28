<?php

namespace App\Observers;

use App\Models\Point;
use App\Models\PointSetting;
use App\Models\Quiz;

class QuizObserver
{
    /**
     * Handle the Quiz "created" event.
     */
    public function answeredCorrectly(Quiz $quiz)
    {
        // Dapatkan pengaturan poin untuk model Quiz dan event answeredCorrectly
        $pointSetting = PointSetting::where('model_name', 'Quiz')
            ->where('event', 'answeredCorrectly')
            ->first();

        if ($pointSetting) {
            Point::create([
                'user_id' => $quiz->user_id,
                'points' => $pointSetting->points,
                'reason' => 'Quiz answered correctly',
            ]);
        }
    }

    public function created(Quiz $quiz): void
    {
        //
    }

    /**
     * Handle the Quiz "updated" event.
     */
    public function updated(Quiz $quiz): void
    {
        //
    }

    /**
     * Handle the Quiz "deleted" event.
     */
    public function deleted(Quiz $quiz): void
    {
        //
    }

    /**
     * Handle the Quiz "restored" event.
     */
    public function restored(Quiz $quiz): void
    {
        //
    }

    /**
     * Handle the Quiz "force deleted" event.
     */
    public function forceDeleted(Quiz $quiz): void
    {
        //
    }
}
