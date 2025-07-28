<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'material_name',
        'material_type',
        'material_link',
        'pdf_link',
        'material_text',
        'chapter_id',
        'order_number',
        'duration',
        'is_code',
    ];

    protected $casts = [
        'is_code' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_material_statuses')
            ->withPivot('is_completed', 'completed_at')
            ->withTimestamps();
    }

    // Relasi dengan Chapter
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    // Define the accessor to convert duration from HH:MM:SS to minutes when retrieving from the database
    public function getDurationAttribute($value)
    {
        return Carbon::parse($value)->format('H:i:s');
    }

    // Define the mutator to convert duration from minutes to HH:MM:SS format before saving to the database
    public function setDurationAttribute($value)
    {
        $hours = intdiv($value, 60);
        $minutes = $value % 60;
        $this->attributes['duration'] = sprintf('%02d:%02d:00', $hours, $minutes);
    }

    // Accessor for formatted duration
    public function getFormattedDurationAttribute()
    {
        $value = $this->attributes['duration'];
        $time = Carbon::createFromFormat('H:i:s', $value);
        $hours = $time->hour;
        $minutes = $time->minute;

        if ($hours > 0) {
            return $hours.' hour'.($hours > 1 ? 's ' : ' ').$minutes.' minute'.($minutes != 1 ? 's' : '');
        }

        return $minutes.' minute'.($minutes != 1 ? 's' : '');
    }

    // Accessor for duration in minutes
    public function getDurationInMinutesAttribute()
    {
        $value = $this->attributes['duration'];
        if (empty($value) || !is_string($value) || !str_contains($value, ':')) {
            return 0; // Return 0 if duration is not set or invalid
        }
        $parts = explode(':', $value);
        $hours = (int) ($parts[0] ?? 0);
        $minutes = (int) ($parts[1] ?? 0);
        return ($hours * 60) + $minutes;
    }

    public function userMaterialStatus()
    {
        return $this->hasMany(UserMaterialStatus::class);
    }

    // Accessor to get the embed URL
    public function getEmbedLinkAttribute()
    {
        $link = $this->attributes['material_link'];

        return $this->convertToEmbedUrl($link);
    }

    // Method to convert standard YouTube URLs to embed URLs
    protected function convertToEmbedUrl($url)
    {
        if (strpos($url, 'youtube.com/watch') !== false) {
            return str_replace('watch?v=', 'embed/', $url);
        } elseif (strpos($url, 'youtu.be/') !== false) {
            return str_replace('youtu.be/', 'youtube.com/embed/', $url);
        }

        return $url;
    }
}
