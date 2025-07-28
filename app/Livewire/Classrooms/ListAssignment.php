<?php

namespace App\Livewire\Classrooms;

use App\Models\Assignment;
use App\Models\Chapter;
use App\Models\ClassroomCourse;
use App\Models\User;
use Livewire\Component;

class ListAssignment extends Component
{
    public $classroomId;

    public function mount($classroomId)
    {
        $this->classroomId = $classroomId;
    }

    public function getStudentsInClassroom()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'student_user');
        })
            ->whereHas('classroomUsers', function ($query) {
                $query->where('classroom_id', $this->classroomId);
            })
            ->with([
                'assignments' => function ($query) {
                    $query->whereIn('chapter_id', function ($subQuery) {
                        $subQuery->select('chapter_id')
                            ->from('classroom_course')
                            ->where('classroom_id', $this->classroomId);
                    });
                },
                'userAssignmentStatuses', // Tambahkan ini untuk memuat relasi
            ])
            ->get();
    }

    public function getAssignmentsInClassroom()
    {
        // Ambil semua courses yang terkait dengan classroom
        $courses = ClassroomCourse::where('classroom_id', $this->classroomId)
            ->with('course') // Pastikan ada relasi course di ClassroomCourse
            ->get();

        // Ambil assignments untuk setiap course
        $assignmentsByCourse = [];
        foreach ($courses as $course) {
            $chapterIds = Chapter::where('course_id', $course->course_id)->pluck('id');
            $assignmentsByCourse[] = [
                'course_name' => $course->course->course_name, // Ambil nama course
                'assignments' => Assignment::whereIn('chapter_id', $chapterIds)->get(),
            ];
        }

        return $assignmentsByCourse; // Kembalikan assignments yang di-group per course
    }

    private function getCoursesInClassroom()
    {
        // Ambil course_id dari classroom_course berdasarkan classroom_id
        return ClassroomCourse::where('classroom_id', $this->classroomId)->pluck('course_id');
    }

    public function render()
    {
        $students = $this->getStudentsInClassroom();
        $assignments = $this->getAssignmentsInClassroom();

        // Kirim data ke view
        return view('livewire.classrooms.list-assignment', compact('students', 'assignments'));
    }
}
