<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Civitas extends Model
{
    protected $fillable = [
        'name',
        'nip',
        'role',
        'type',
        'department',
        'faculty',
        'email',
        'phone',
        'bio',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=1d4ed8&color=ffffff&size=200&bold=true';
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'pimpinan' => 'Pimpinan',
            'dosen' => 'Dosen',
            'tendik' => 'Tenaga Kependidikan',
            'mahasiswa' => 'Mahasiswa',
            default => 'Civitas',
        };
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
