<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassroomCourse extends Model
{
    use SoftDeletes;

    protected $table = 'classroom_course';

    protected $fillable = [
        'classroom_id',
        'course_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi dengan Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // Relasi dengan Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
