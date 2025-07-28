<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'challenge_id',
        'task_name',
        'task_description',
        'task_photo',
    ];

    // Relasi dengan Challenge
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}
