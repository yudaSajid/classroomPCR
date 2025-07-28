<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use BezhanSalleh\FilamentShield\Support\Utils;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel as FilamentPanel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasPanelShield, HasRoles, HasUuids, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isActive',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // public function canAccessPanel(FilamentPanel $panel): bool
    // {
    //     if ($panel->getId() === 'admin') {
    //         // return $this->hasRole(Utils::getSuperAdminName());
    //         return $this->hasRole(config('filament-shield.student_user.name', 'super_admin'));
    //     } elseif ($panel->getId() === 'student') {
    //         return $this->hasRole(config('filament-shield.student_user.name', 'student_user'));
    //     } elseif ($panel->getId() === 'teacher') {
    //         return $this->hasRole(config('filament-shield.teacher_user.name', 'teacher_user'));
    //     } else {
    //         return false;
    //     }
    // }

    public function canAccessPanel(FilamentPanel $panel): bool
    {
        // Add debugging
        Log::info('Checking panel access', [
            'panel' => $panel->getId(),
            'user' => $this->id,
            'roles' => $this->roles()->pluck('name'),
        ]);

        // Safe role checking
        if (! $this->roles) {
            return false;
        }

        if ($panel->getId() === 'admin') {
            return $this->hasRole(config('filament-shield.super_admin_role.name', 'super_admin'));
        }

        if ($panel->getId() === 'student') {
            return $this->hasRole(config('filament-shield.student_user.name', 'student_user'));
        }

        if ($panel->getId() === 'teacher') {
            return $this->hasRole([
            config('filament-shield.teacher_user.name', 'teacher_user'),
            config('filament-shield.super_admin_role.name', 'super_admin')
            ]);
        }

        return false;
    }

    protected static function booted(): void
    {
        if (config('filament-shield.student_user.enabled', false)) {
            FilamentShield::createRole(name: config('filament-shield.student_user.name', 'student_user'));
            static::created(function (User $user) {
                $user->assignRole(config('filament-shield.student_user.name', 'student_user'));
            });
            static::deleting(function (User $user) {
                $user->removeRole(config('filament-shield.student_user.name', 'student_user'));
            });
        }
        if (config('filament-shield.teacher_user.enabled', false)) {
            FilamentShield::createRole(name: config('filament-shield.teacher_user.name', 'teacher_user'));
            static::created(function (User $user) {
                $user->assignRole(config('filament-shield.teacher_user.name', 'teacher_user'));
            });
            static::deleting(function (User $user) {
                $user->removeRole(config('filament-shield.teacher_user.name', 'teacher_user'));
            });
        }
    }

    // Relasi many-to-many dengan Answer melalui UserAnswer
    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'user_answers', 'user_id', 'answer_id')
            ->withPivot('attempt_id', 'is_correct')
            ->withTimestamps();
    }

    // Relasi many-to-many dengan Assignment melalui UserAssignmentStatus
    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'user_assignment_statuses', 'user_id', 'assignment_id')
            ->withPivot('is_completed', 'score')
            ->withTimestamps();
    }

    // Relasi many-to-many dengan Badge melalui UserBadge
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
            ->withPivot('awarded_date')
            ->withTimestamps();
    }

    // Relasi many-to-many dengan Medal melalui UserMedal
    public function medals()
    {
        return $this->belongsToMany(Medal::class, 'user_medals')
            ->withTimestamps();
    }

    // Relasi one-to-many dengan QuizAttempt
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // Relasi one-to-many dengan ReviewChapter
    public function reviewChapters()
    {
        return $this->hasMany(ReviewChapter::class);
    }

    // Relasi one-to-many dengan ClassroomUser
    public function classroomUsers()
    {
        return $this->hasMany(ClassroomUser::class);
    }

    // Relasi many-to-many dengan Classroom
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_users')->withTimestamps();
    }

    // Relasi one-to-many dengan CourseCompletionReward
    public function courseCompletionRewards()
    {
        return $this->hasMany(CourseCompletionReward::class);
    }

    // Relasi one-to-many dengan UserAnswer
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }

    // Relasi one-to-many dengan UserAssignmentStatus
    // Definisikan relasi ke tabel user_assignment_statuses
    public function userAssignmentStatuses()
    {
        return $this->hasMany(UserAssignmentStatus::class, 'user_id');
    }

    // Relasi one-to-many dengan UserBadge
    public function userBadges()
    {
        return $this->hasMany(UserBadge::class);
    }

    // Relasi one-to-many dengan UserMedal
    public function userMedals()
    {
        return $this->hasMany(UserMedal::class);
    }

    // Relasi one-to-one dengan UserInformation
    public function userInformation()
    {
        return $this->hasOne(UserInformation::class);
    }

    // Relasi one-to-one dengan UserEducation
    public function userEducation()
    {
        return $this->hasOne(UserEducation::class);
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    /**
     * Menghitung total poin
     */
    public function getTotalPointsAttribute()
    {
        return $this->points()->sum('points');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'user_material_statuses')
            ->withPivot('is_completed', 'completed_at')
            ->withTimestamps();
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
