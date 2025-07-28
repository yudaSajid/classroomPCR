<?php

namespace App\Filament\Teacher\Pages;

use App\Models\Classroom;
use App\Models\UserMaterialStatus;
use App\Models\QuizAttempt;
use App\Models\Point;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class ClassroomDetailPage extends Page
{
    use HasPageShield;
    
    protected static string $view = 'filament.teacher.pages.classroom-detail-page';
    
    public $classroom;
    public $studentStats = [];
    
    protected static bool $shouldRegisterNavigation = false;

    public function mount($id)
    {
        $this->classroom = Classroom::with([
            'program',
            'courses.chapters.materials',
            'classroomUsers.user'
        ])->findOrFail($id);

        $this->loadStatistics();
    }

    protected function loadStatistics() 
    {
        // Get all students in this classroom
        $students = $this->classroom->classroomUsers()
            ->studentOnly()
            ->with('user')
            ->get();

        foreach ($students as $classroomUser) {
            $student = $classroomUser->user;
            
            // Get material completion statistics
            $materialStats = UserMaterialStatus::whereHas('material.chapter.course', function ($query) {
                $query->whereIn('id', $this->classroom->courses->pluck('id'));
            })
            ->where('user_id', $student->id)
            ->select(
                DB::raw('COUNT(*) as total_materials'),
                DB::raw('SUM(CASE WHEN is_completed = 1 THEN 1 ELSE 0 END) as completed_materials')
            )
            ->first();

            // Get quiz attempt statistics
            $quizStats = QuizAttempt::whereHas('quiz.chapter.course', function ($query) {
                $query->whereIn('id', $this->classroom->courses->pluck('id'));
            })
            ->where('user_id', $student->id)
            ->select(
                DB::raw('COUNT(*) as total_attempts'),
                DB::raw('AVG(score) as average_score')
            )
            ->first();

            // Get total points
            $totalPoints = Point::where('user_id', $student->id)
                ->whereIn('course_id', $this->classroom->courses->pluck('id'))
                ->sum('points');

            $this->studentStats[] = [
                'student' => $student,
                'material_completion' => [
                    'total' => $materialStats->total_materials ?? 0,
                    'completed' => $materialStats->completed_materials ?? 0,
                    'percentage' => $materialStats->total_materials > 0 
                        ? round(($materialStats->completed_materials / $materialStats->total_materials) * 100, 1)
                        : 0,
                ],
                'quiz_performance' => [
                    'attempts' => $quizStats->total_attempts ?? 0,
                    'average_score' => round($quizStats->average_score ?? 0, 1),
                ],
                'total_points' => $totalPoints,
            ];
        }
    }
}