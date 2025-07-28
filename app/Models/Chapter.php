<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'chapter_number',
        'titles',
        'description',
        'course_id',
    ];

    protected $with = ['course', 'assignments'];

    // Relasi dengan Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi one-to-many dengan Assignment
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function getTotalMaterialsAttribute()
    {
        return $this->materials->count();
    }

    // Relasi one-to-many dengan Material
    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    // Relasi one-to-many dengan Quiz
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    // Relasi one-to-many dengan ReviewChapter
    public function reviewChapters()
    {
        return $this->hasMany(ReviewChapter::class);
    }

    public function getTitleWithCourseAttribute()
    {
        return $this->titles.' ('.$this->course->course_name.')';
    }
}
