<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'department_name',
        'department_slug',
    ];

    // Relasi one-to-many dengan Program
    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
