<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $fillable = [
        'phone_number',
        'gender',
        'birth_date',
        'birth_place',
        'current_address',
        'hometown_address',
        'province',
        'city',
        'postal_code',
        'user_id',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
