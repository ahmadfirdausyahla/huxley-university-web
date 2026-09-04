<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventRegistration extends Model
{
    protected $fillable = [
        'event_id',
        'type',
        'name',
        'email',
        'phone',
        'institution',
        'nim',
        'campus_email',
        'study_program',
        'faculty',
        'notes',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}