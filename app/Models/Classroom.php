<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        'class_name',
        'class_alphabet',
        'enrollment_year',
        'program_id',
        'class_code',
        'class_description',
    ];

    // Event model untuk menghasilkan class_code acak
    protected static function booted()
    {
        static::creating(function ($classroom) {
            $classroom->class_code = Classroom::generateUniqueClassCode();
        });
    }

    // Method untuk menghasilkan kode kelas acak dengan format 4 huruf dan 2 angka
    public static function generateUniqueClassCode()
    {
        do {
            $code = self::generateRandomCode();
        } while (self::where('class_code', $code)->exists());

        return $code;
    }

    // Method untuk menghasilkan string 4 huruf dan 2 angka
    private static function generateRandomCode()
    {
        $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4);
        $numbers = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);

        return $letters.$numbers;
    }

    // Relasi dengan Program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    // Relasi dengan Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Relasi many-to-many dengan Course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'classroom_course')
            ->withPivot('is_active')
            ->withTimestamps();
    }

    // Relasi many-to-many dengan User
    public function users()
    {
        return $this->belongsToMany(User::class, 'classroom_users')->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'classroom_users','classroom_id','user_id')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'teacher_user');
            })
            ->withTimestamps();
    }

    // Relasi one-to-many dengan ClassroomUser
    public function classroomUsers()
    {
        return $this->hasMany(ClassroomUser::class);
    }
}
