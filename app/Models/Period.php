<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'period_name',
        'period_start',
        'period_end',
    ];

    // Relasi one-to-many dengan Semester
    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }
}
