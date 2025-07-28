<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMaterialStatus extends Model
{
    protected $fillable = [
        'user_id',
        'material_id',
        'is_completed',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'is_completed' => 'boolean',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
