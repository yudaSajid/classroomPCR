<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEducation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'student_id_number',
        'department_id',
        'program_id',
        'enrollment_year',
        'class_alphabet',
        'semester_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function activeBatchSemester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    // Accessor untuk menggabungkan department_name, program_name, dan period_and_semester_name
    public function getFullDetailsAttribute()
    {
        return "{$this->department->department_name} - {$this->program->program_name} - {$this->activeBatchSemester->period_and_semester_name}";
    }

    // Definisikan relasi dengan Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
