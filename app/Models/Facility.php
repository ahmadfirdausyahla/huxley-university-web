<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'location',
        'capacity',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'capacity' => 'integer',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=800&auto=format&fit=crop';
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'laboratorium' => 'Laboratorium',
            'olahraga' => 'Fasilitas Olahraga',
            'perpustakaan' => 'Perpustakaan',
            'aula' => 'Aula & Gedung Serbaguna',
            'kantin' => 'Kantin & Cafetaria',
            default => 'Fasilitas Lainnya',
        };
    }

    public function getCategoryIconAttribute(): string
    {
        return match ($this->category) {
            'laboratorium' => 'fa-flask',
            'olahraga' => 'fa-dumbbell',
            'perpustakaan' => 'fa-book',
            'aula' => 'fa-building',
            'kantin' => 'fa-utensils',
            default => 'fa-building-columns',
        };
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($facility) {
            if (!$facility->slug && $facility->name) {
                $facility->slug = Str::slug($facility->name);
            }
        });
    }
}
