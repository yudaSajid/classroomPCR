<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $fillable = [
        'attempt_id',
        'question_id',
        'answer_id',
        'is_correct',
    ];

    // Relasi dengan QuizAttempt
    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'attempt_id');
    }

    // Relasi dengan Question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relasi dengan Answer
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
