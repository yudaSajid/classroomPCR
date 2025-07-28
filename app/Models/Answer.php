<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question_id',
        'text',
        'is_correct',
        'reasons',
    ];

    // Relasi dengan Question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relasi many-to-many dengan User melalui UserAnswer (attempt_id)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_answers', 'answer_id', 'user_id')
            ->withPivot('attempt_id', 'is_correct')
            ->withTimestamps();
    }
}
