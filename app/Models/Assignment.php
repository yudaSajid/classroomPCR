<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'chapter_id',
    ];

    // Relasi dengan Chapter
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    // Relasi many-to-many dengan User melalui UserAssignmentStatus
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_assignment_statuses', 'assignment_id', 'user_id')
            ->withPivot('is_completed', 'completed_at', 'score')
            ->withTimestamps();
    }

    // Relasi one-to-many dengan UserAssignmentStatus
    public function userAssignmentStatuses()
    {
        return $this->hasMany(UserAssignmentStatus::class);
    }

    // Definisikan relasi ke model Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
