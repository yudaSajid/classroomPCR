<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\UserMaterialStatus;
use App\Models\QuizAttempt;
use App\Models\Point;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClassroomStudentStats extends Component
{
    public $classroomId;
    public $studentStats = [];

    public function mount($classroomId)
    {
        $this->classroomId = $classroomId;
        $this->loadStatistics();
    }

    protected function loadStatistics()
    {
        $classroom = Classroom::with(['classroomUsers.user', 'courses.chapters.materials'])->find($this->classroomId);
        if (!$classroom) return;
        
        $students = $classroom->classroomUsers()->studentOnly()->with('user')->get();

        foreach ($students as $classroomUser) {
            $student = $classroomUser->user;
            $courseStats = [];

            foreach ($classroom->courses as $course) {
                // Get material completion for this course
                $materialStats = UserMaterialStatus::whereHas('material.chapter', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })
                ->where('user_id', $student->id)
                ->select(
                    DB::raw('COUNT(*) as total_materials'),
                    DB::raw('SUM(CASE WHEN is_completed = 1 THEN 1 ELSE 0 END) as completed_materials')
                )
                ->first();

                // Get quiz performance for this course
                $quizStats = QuizAttempt::whereHas('quiz.chapter', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })
                ->where('user_id', $student->id)
                ->select(
                    DB::raw('COUNT(*) as total_attempts'),
                    DB::raw('AVG(score) as average_score')
                )
                ->first();

                // Get points for this course
                $coursePoints = Point::where('user_id', $student->id)
                    ->where('course_id', $course->id)
                    ->sum('points');

                $courseStats[] = [
                    'name' => $course->course_name,
                    'completion' => $materialStats->total_materials > 0 
                        ? round(($materialStats->completed_materials / $materialStats->total_materials) * 100, 1)
                        : 0,
                    'quiz_average' => round($quizStats->average_score ?? 0, 1),
                    'points' => $coursePoints,
                ];
            }

            // Get material completion statistics
            $materialStats = UserMaterialStatus::whereHas('material.chapter.course', function ($query) use ($classroom) {
                $query->whereIn('id', $classroom->courses->pluck('id'));
            })
            ->where('user_id', $student->id)
            ->select(
                DB::raw('COUNT(*) as total_materials'),
                DB::raw('SUM(CASE WHEN is_completed = 1 THEN 1 ELSE 0 END) as completed_materials')
            )
            ->first();

            // Get quiz attempt statistics
            $quizStats = QuizAttempt::whereHas('quiz.chapter.course', function ($query) use ($classroom) {
                $query->whereIn('id', $classroom->courses->pluck('id'));
            })
            ->where('user_id', $student->id)
            ->select(
                DB::raw('COUNT(*) as total_attempts'),
                DB::raw('AVG(score) as average_score')
            )
            ->first();

            // Get total points
            $totalPoints = Point::where('user_id', $student->id)
                ->whereIn('course_id', $classroom->courses->pluck('id'))
                ->sum('points');

            $this->studentStats[] = [
                'student' => [
                    'name' => $student->name,
                    'initial' => Str::upper(Str::substr($student->name, 0, 1))
                ],
                'material_completion' => [
                    'total' => (int) ($materialStats->total_materials ?? 0),
                    'completed' => (int) ($materialStats->completed_materials ?? 0),
                    'percentage' => $materialStats->total_materials > 0 
                        ? (int) round(($materialStats->completed_materials / $materialStats->total_materials) * 100, 1)
                        : 0,
                ],
                'quiz_performance' => [
                    'attempts' => (int) ($quizStats->total_attempts ?? 0),
                    'average_score' => (float) round($quizStats->average_score ?? 0, 1),
                ],
                'total_points' => (int) $totalPoints,
                'courses' => $courseStats,
            ];
        }
    }

    public function getStats()
    {
        return $this->studentStats;
    }

    public function render()
    {
        return view('livewire.classroom-student-stats', [
            'stats' => $this->getStats(),
        ]);
    }
}