<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function publicForm(Event $event)
    {
        abort_if($event->audience !== 'public', 404);
        abort_if(!$event->registration_open, 404);

        return view('events.register-public', compact('event'));
    }

    public function studentForm(Event $event)
    {
        abort_if($event->audience !== 'student', 404);
        abort_if(!$event->registration_open, 404);

        return view('events.register-student', compact('event'));
    }

    public function storePublic(Request $request, Event $event)
    {
        abort_if($event->audience !== 'public', 404);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:30',
            'institution' => 'required|string|max:150',
            'notes' => 'nullable|string|max:1000',
        ]);

        if (
            $event->quota &&
            $event->registrations()->count() >= $event->quota
        ) {
            return back()
                ->withErrors([
                    'registration' => 'Kuota event sudah penuh.'
                ])
                ->withInput();
        }

        EventRegistration::create([
            'event_id' => $event->id,
            'type' => 'public',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('events.show', $event)
            ->with('success', 'Pendaftaran berhasil dikirim.');
    }

    public function storeStudent(Request $request, Event $event)
    {
        abort_if($event->audience !== 'student', 404);

        $request->validate([
            'name' => 'required|string|max:100',
            'nim' => 'required|string|max:50',
            'campus_email' => 'required|email|max:150',
            'study_program' => 'required|string|max:150',
            'faculty' => 'required|string|max:150',
            'phone' => 'required|string|max:30',
            'notes' => 'nullable|string|max:1000',
        ]);

        if (
            $event->quota &&
            $event->registrations()->count() >= $event->quota
        ) {
            return back()
                ->withErrors([
                    'registration' => 'Kuota event sudah penuh.'
                ])
                ->withInput();
        }

        EventRegistration::create([
            'event_id' => $event->id,
            'type' => 'student',
            'name' => $request->name,
            'nim' => $request->nim,
            'campus_email' => $request->campus_email,
            'study_program' => $request->study_program,
            'faculty' => $request->faculty,
            'phone' => $request->phone,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('events.show', $event)
            ->with('success', 'Pendaftaran mahasiswa berhasil dikirim.');
    }
}