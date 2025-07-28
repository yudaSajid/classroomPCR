<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'giver_id',
        'points',
        'reason',
        'quiz_id',
        'course_id',
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relasi dengan Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
