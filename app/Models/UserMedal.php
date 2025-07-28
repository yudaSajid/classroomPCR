<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMedal extends Model
{
    protected $fillable = [
        'user_id',
        'medal_id',
        'awarded_date',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Medal
    public function medal()
    {
        return $this->belongsTo(Medal::class);
    }
}
