<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Challenge extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        'course_id',
        'challenge_name',
        'challenge_description',
        'challenge_slug',
        'challenge_publish',
        'challenge_photo',
    ];

    protected $casts = [
        'challenge_publish' => 'boolean',
    ];

    // Relasi dengan Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi one-to-many dengan Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
