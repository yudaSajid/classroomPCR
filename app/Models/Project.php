<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        'course_id',
        'project_name',
        'project_description',
        'project_slug',
        'project_publish',
        'project_photo',
    ];

    protected $casts = [
        'project_publish' => 'boolean',
    ];

    // Relasi dengan Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi one-to-many dengan ProjectSubmission
    public function submissions()
    {
        return $this->hasMany(ProjectSubmission::class);
    }
}
