<?php

namespace App\Models;

use App\Enums\EventCategory;
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
        'category',
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
        'category' => EventCategory::class,
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function isMahasiswaOnly(): bool
    {
        return $this->category === EventCategory::MAHASISWA || $this->audience === 'student';
    }

    public function isPublic(): bool
    {
        return $this->category === EventCategory::PUBLIC || $this->audience === 'public';
    }

    public function getCategoryLabelAttribute(): string
    {
        return $this->isMahasiswaOnly() ? 'Khusus Mahasiswa' : 'Umum (Public)';
    }

    public function getAudienceLabelAttribute(): string
    {
        return $this->isMahasiswaOnly() ? 'Mahasiswa' : 'Untuk Umum';
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

        static::saving(function ($event) {
            // Sinkronisasi otomatis category dan audience
            if ($event->category instanceof EventCategory) {
                $categoryVal = $event->category->value;
            } else {
                $categoryVal = (string) $event->category;
            }

            if ($categoryVal === 'mahasiswa') {
                $event->audience = 'student';
            } elseif ($categoryVal === 'public') {
                $event->audience = 'public';
            } elseif ($event->audience === 'student' && empty($event->category)) {
                $event->category = EventCategory::MAHASISWA;
            } elseif ($event->audience === 'public' && empty($event->category)) {
                $event->category = EventCategory::PUBLIC;
            }

            if (!$event->slug) {
                $event->slug = Str::slug($event->title);
            }
        });
    }
}