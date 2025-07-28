<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_id',
        'started_at',
        'completed_at',
        'score',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relasi one-to-many dengan UserAnswer
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class, 'attempt_id');
    }
}
