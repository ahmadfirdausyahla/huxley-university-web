<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScholarshipApplication extends Model
{
    protected $fillable = [
        'scholarship_id',
        'applicant_type',
        'name',
        'email',
        'phone',
        'nim',
        'current_institution',
        'study_program',
        'semester',
        'gpa',
        'achievements',
        'motivation_letter',
        'document_url',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'semester' => 'integer',
        'gpa' => 'float',
    ];

    public function scholarship(): BelongsTo
    {
        return $this->belongsTo(Scholarship::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Verifikasi',
            'under_review' => 'Sedang Diseleksi',
            'approved' => 'Diterima / Lolos',
            'rejected' => 'Tidak Lolos',
            default => ucfirst($this->status),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
            'under_review' => 'bg-blue-50 text-blue-700 border-blue-200',
            'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
            default => 'bg-slate-100 text-slate-700 border-slate-200',
        };
    }
}
