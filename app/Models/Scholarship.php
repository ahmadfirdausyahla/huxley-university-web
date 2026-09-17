<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Scholarship extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'provider',
        'coverage_type',
        'amount',
        'deadline',
        'description',
        'requirements',
        'link',
        'image',
        'is_active',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=800&auto=format&fit=crop';
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    public function getCoverageTypeLabelAttribute(): string
    {
        return match ($this->coverage_type) {
            'full' => 'Beasiswa Penuh',
            'partial' => 'Beasiswa Sebagian',
            'living_allowance' => 'Tunjangan Hidup',
            default => 'Beasiswa',
        };
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($scholarship) {
            if (!$scholarship->slug && $scholarship->title) {
                $scholarship->slug = Str::slug($scholarship->title);
            }
        });
    }
}
