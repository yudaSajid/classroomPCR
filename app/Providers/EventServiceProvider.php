<?php

namespace App\Providers;

use App\Models\Quiz;
use App\Observers\QuizObserver;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Quiz::observe(QuizObserver::class);
    }
}
