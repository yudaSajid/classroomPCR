<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use HasUuids, SoftDeletes;

    protected $casts = [
        'teachers' => 'array',
    ];

    protected $fillable = [
        'course_name',
        'course_slug',
        'course_publish',
        'course_description',
        'course_photo',
        'created_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    // Relasi many-to-many dengan Classroom
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_course')
        ->withPivot('is_active')
        ->withTimestamps();
    }

    // Relasi one-to-many dengan Chapter
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    // Add this new relationship to access materials through chapters
    public function materials()
    {
        return $this->hasManyThrough(Material::class, Chapter::class);
    }

    public function getTotalChaptersAttribute()
    {
        return $this->chapters->count();
    }

    public function getTotalMaterialsAttribute()
    {
        return $this->chapters->sum(function ($chapter) {
            return $chapter->materials->count();
        });
    }

    // Method to get total materials completed by a user
    public function getTotalMaterialsCompletedByUser($userId)
    {
        return $this->chapters->sum(function ($chapter) use ($userId) {
            return $chapter->materials->sum(function ($material) use ($userId) {
                return $material->userMaterialStatus()
                    ->where('user_id', $userId)
                    ->where('is_completed', true)
                    ->count();
            });
        });
    }

    public function getProgressLearningByUser($userId)
    {
        // Get total materials count through chapters relationship
        $totalMaterials = $this->materials()->count();

        // If no materials exist, return 0%
        if ($totalMaterials === 0) {
            return 0;
        }

        // Count completed materials through the materials relationship
        $completedMaterials = $this->materials()
            ->whereHas('userMaterialStatus', function($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where('is_completed', true);
            })
            ->count();

        // Calculate percentage
        return round(($completedMaterials / $totalMaterials) * 100);
    }

    // Method to get the last completed material by a user
    public function getLastCompletedMaterialByUser($userId)
    {
        $lastCompletedStatus = UserMaterialStatus::whereHas('material.chapter', function ($query) {
            $query->where('course_id', $this->id);
        })
            ->where('user_id', $userId)
            ->where('is_completed', true)
            ->orderBy('completed_at', 'desc')
            ->first();

        if ($lastCompletedStatus) {
            return $lastCompletedStatus->material->material_name;
        }

        return null;
    }

    // Jika relasi many-to-many
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'course_teacher', 'course_id', 'teacher_id');
    }

    // Relasi one-to-many dengan ClassroomCourse
    public function classroomCourses()
    {
        return $this->hasMany(ClassroomCourse::class);
    }

    // Relasi one-to-many dengan CourseCompletionReward
    public function courseCompletionRewards()
    {
        return $this->hasMany(CourseCompletionReward::class);
    }

    // Relasi dengan Point
    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function getTotalPointsAttribute()
    {
        return $this->points()->sum('points');
    }

    // Relasi one-to-many dengan Project
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Relasi one-to-many dengan Challenge
    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }
}
