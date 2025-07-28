<?php

namespace App\Models;
use App\Enums\BadgeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Badge extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'color',
        'description',
        'image',
        'point_require',
        'type'
    ];
    protected $casts = [
        'point_require' => 'integer',
        'type' => BadgeType::class
    ];
    protected $with = ['users', 'userBadges'];

    // Relasi many-to-many dengan User melalui UserBadge
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')
            ->withPivot('awarded_date')
            ->withTimestamps();
    }

    // Relasi one-to-many dengan UserBadge
    public function userBadges()
    {
        return $this->hasMany(UserBadge::class);
    }
}
