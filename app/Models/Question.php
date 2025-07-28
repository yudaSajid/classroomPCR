<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_image',
    ];

    // Relasi dengan Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relasi one-to-many dengan Answer
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Menambahkan relasi untuk jawaban yang benar
    public function correctAnswer()
    {
        return $this->hasOne(Answer::class)->where('is_correct', true);
    }
}
