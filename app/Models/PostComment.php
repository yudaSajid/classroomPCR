<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'parent_id',
    ];

    /**
     * Relationship with Post model
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Relationship with User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with parent comment (for replies)
     */
    public function parent()
    {
        return $this->belongsTo(PostComment::class, 'parent_id');
    }

    /**
     * Relationship with child comments (replies)
     */
    public function children()
    {
        return $this->hasMany(PostComment::class, 'parent_id');
    }
}
