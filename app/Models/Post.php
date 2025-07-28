<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Course model
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relationship with Comment model
     */
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }
}
