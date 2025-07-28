<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'color',
        'description',
        'medal_image',
        'points',
    ];

    protected $with = ['users'];

    // Relasi many-to-many dengan User melalui UserMedal
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_medals')
            ->withTimestamps();
    }

    // Relasi one-to-many dengan UserMedal
    public function userMedals()
    {
        return $this->hasMany(UserMedal::class);
    }
}
