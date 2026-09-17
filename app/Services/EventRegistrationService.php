<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EventRegistrationService
{
    /**
     * Mendaftarkan peserta umum.
     * Menggunakan DB transaction & pessimistic locking untuk mencegah race condition / overbooking.
     */
    public function registerPublic(Event $event, array $data): EventRegistration
    {
        return DB::transaction(function () use ($event, $data) {
            /** @var Event $lockedEvent */
            $lockedEvent = Event::where('id', $event->id)->lockForUpdate()->firstOrFail();

            if (!$lockedEvent->registration_open) {
                throw ValidationException::withMessages([
                    'registration' => 'Pendaftaran untuk event ini telah ditutup.',
                ]);
            }

            if ($lockedEvent->isMahasiswaOnly()) {
                throw ValidationException::withMessages([
                    'registration' => 'Event ini hanya diperuntukkan bagi mahasiswa.',
                ]);
            }

            if ($lockedEvent->quota && $lockedEvent->registrations()->count() >= $lockedEvent->quota) {
                throw ValidationException::withMessages([
                    'registration' => 'Kuota event sudah penuh.',
                ]);
            }

            // Cegah registrasi ganda dengan email yang sama pada event ini
            $alreadyRegistered = $lockedEvent->registrations()
                ->where('email', $data['email'])
                ->exists();

            if ($alreadyRegistered) {
                throw ValidationException::withMessages([
                    'email' => 'Email ini sudah terdaftar pada event ini.',
                ]);
            }

            return EventRegistration::create([
                'event_id' => $lockedEvent->id,
                'type' => 'public',
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'institution' => $data['institution'],
                'notes' => $data['notes'] ?? null,
            ]);
        });
    }

    /**
     * Mendaftarkan peserta mahasiswa (Wajib Nama, NIM, Jurusan).
     * Menggunakan DB transaction & pessimistic locking untuk keamanan konkurensi.
     */
    public function registerMahasiswa(Event $event, array $data): EventRegistration
    {
        return DB::transaction(function () use ($event, $data) {
            /** @var Event $lockedEvent */
            $lockedEvent = Event::where('id', $event->id)->lockForUpdate()->firstOrFail();

            if (!$lockedEvent->registration_open) {
                throw ValidationException::withMessages([
                    'registration' => 'Pendaftaran untuk event ini telah ditutup.',
                ]);
            }

            if ($lockedEvent->quota && $lockedEvent->registrations()->count() >= $lockedEvent->quota) {
                throw ValidationException::withMessages([
                    'registration' => 'Kuota event sudah penuh.',
                ]);
            }

            // Validasi keberadaan mahasiswa di database Civitas (jika data civitas mahasiswa telah diinput)
            if (\App\Models\Civitas::where('type', 'mahasiswa')->exists()) {
                $student = \App\Models\Civitas::where('nip', trim($data['nim']))
                    ->where('type', 'mahasiswa')
                    ->first();

                if (!$student) {
                    throw ValidationException::withMessages([
                        'nim' => 'NIM "' . $data['nim'] . '" tidak terdaftar di pangkalan data mahasiswa Huxley University.',
                    ]);
                }

                if (!$student->is_active) {
                    throw ValidationException::withMessages([
                        'nim' => 'Status akademik untuk NIM "' . $data['nim'] . '" sedang tidak aktif.',
                    ]);
                }
            }

            $participantEmail = $data['email'] ?? $data['campus_email'] ?? null;

            // Cegah registrasi ganda dengan NIM atau Email yang sama pada event ini
            $alreadyRegistered = $lockedEvent->registrations()
                ->where(function ($query) use ($data, $participantEmail) {
                    $query->where('nim', $data['nim']);
                    if ($participantEmail) {
                        $query->orWhere('campus_email', $participantEmail)
                              ->orWhere('email', $participantEmail);
                    }
                })
                ->exists();

            if ($alreadyRegistered) {
                throw ValidationException::withMessages([
                    'nim' => 'NIM atau Email ini sudah terdaftar pada event ini.',
                ]);
            }

            return EventRegistration::create([
                'event_id' => $lockedEvent->id,
                'type' => 'student',
                'name' => $data['name'],
                'nim' => $data['nim'],
                'email' => $participantEmail,
                'campus_email' => $participantEmail,
                'study_program' => $data['study_program'],
                'faculty' => $data['faculty'] ?? null,
                'phone' => $data['phone'],
                'notes' => $data['notes'] ?? null,
            ]);
        });
    }
}
