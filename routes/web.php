<?php

use App\Filament\Student\Pages\CourseDetailPage;
use App\Filament\Student\Pages\TryQuiz;
use App\Livewire\Courses\CourseDetail;
use App\Livewire\TakeQuiz;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Models\Course;

Route::get('/', function () {
    try {
		$courses = Course::where('course_publish', true)
				->inRandomOrder()
				->take(4)
				->get();
                        
        return view('welcome', compact('courses'));
    } catch (\Exception $e) {
        // If there's an error, return empty collection
        $courses = collect([]);
        return view('welcome', compact('courses'));
    }
});

Route::get('/{course:course_slug}', CourseDetail::class)->name('course.show');

Route::get('/quiz/{quiz}', TakeQuiz::class)->name('quiz.take');

Route::get('/try-quiz/{quizId}', TryQuiz::class)->name('try.quiz');

Route::get('/storage-link', function(){
	Artisan::call('storage:link');
	return "Storage link successful";
});
