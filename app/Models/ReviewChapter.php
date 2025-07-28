<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewChapter extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'chapter_id',
        'rating',
        'comment',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Chapter
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
