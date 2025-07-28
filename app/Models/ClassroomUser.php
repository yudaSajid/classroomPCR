<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassroomUser extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'classroom_id',
        'user_id',
    ];

    // Relasi dengan Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // Scope for getting teacher users
    public function scopeTeacherOnly($query)
    {
        return $query->whereHas('user.roles', function ($q) {
            $q->where('name', 'teacher_user');
        });
    }

    // Scope for getting student users
    public function scopestudentOnly($query)
    {
        return $query->whereHas('user.roles', function ($q) {
            $q->where('name', 'student_user');
        });
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
