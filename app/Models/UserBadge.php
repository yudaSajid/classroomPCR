<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    protected $fillable = [
        'user_id',
        'badge_id',
        'awarded_date',
        'is_claimed',
    ];

    protected $casts = [
        'is_claimed' => 'boolean',
        'awarded_date' => 'datetime',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Badge
    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
}
