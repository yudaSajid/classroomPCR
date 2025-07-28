<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_id',
        'chapter_id',
        'title',
        'description',
    ];

    // Relasi dengan Chapter
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi one-to-many dengan Question
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Relasi one-to-many dengan QuizAttempt
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // Contoh method untuk menandai quiz sebagai dijawab dengan benar
    public function markAsAnsweredCorrectly()
    {
        $this->correct = true;
        $this->save();

        // Trigger event 'answered_correctly'
        $this->fireModelEvent('answeredCorrectly', false);
    }

    // Relasi dengan Point
    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function hasPassedAttempt($userId)
    {
        return $this->attempts()
            ->where('user_id', $userId)
            ->where('score', 100)
            ->exists();
    }
}
