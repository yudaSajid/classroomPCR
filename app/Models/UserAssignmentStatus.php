<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAssignmentStatus extends Model
{
    protected $fillable = [
        'assignment_id',
        'user_id',
        'is_completed',
        'completed_at',
        'score',
        'link',
        'status',
        'notes',
    ];
    protected $with = ['assignment.chapter.course.classrooms'];
    // Relasi dengan Assignment
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
