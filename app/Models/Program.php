<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'program_name',
        'program_slug',
        'department_id',
    ];

    protected $with = ['department'];

    // Relasi dengan Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relasi one-to-many dengan Classroom
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function getProgramWithDepartmentNameAttribute()
    {
        return "{$this->program_name} ({$this->department->department_name})";
    }

    public function userEducations()
    {
        return $this->hasMany(UserEducation::class);
    }
}
