<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semester extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'semester_name',
        'semester_description',
        'semester_start',
        'semester_end',
        'period_id',
    ];

    protected $with = ['period'];

    // Relasi dengan Period
    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    // Relasi one-to-many dengan Classroom
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    // Accessor untuk menggabungkan period_name dan semester_name
    public function getPeriodAndSemesterNameAttribute()
    {
        return "{$this->period->period_name} - {$this->semester_name}";
    }

    public function userEducations()
    {
        return $this->hasMany(UserEducation::class);
    }
}
