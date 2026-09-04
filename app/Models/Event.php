<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'audience',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'quota',
        'registration_open',
    ];

    protected $casts = [
        'event_date' => 'date',
        'registration_open' => 'boolean',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function getAudienceLabelAttribute()
    {
        return $this->audience === 'public'
            ? 'Untuk Umum'
            : 'Mahasiswa';
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('storage/assets/template.jpg');
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (!$event->slug) {
                $event->slug = Str::slug($event->title);
            }
        });

        static::updating(function ($event) {
            if (!$event->slug) {
                $event->slug = Str::slug($event->title);
            }
        });
    }
}