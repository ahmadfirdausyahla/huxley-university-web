<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegistration\RegisterMahasiswaRequest;
use App\Http\Requests\EventRegistration\RegisterPublicRequest;
use App\Models\Event;
use App\Services\EventRegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventRegistrationController extends Controller
{
    public function __construct(
        protected EventRegistrationService $registrationService
    ) {}

    /**
     * Tampilkan form registrasi umum.
     */
    public function publicForm(Event $event): View|RedirectResponse
    {
        if ($event->isMahasiswaOnly()) {
            return redirect()->route('events.register.student', $event)
                ->with('info', 'Kegiatan ini dikhususkan bagi mahasiswa Huxley University.');
        }

        if (!$event->registration_open) {
            return redirect()->route('events.show', $event)
                ->with('error', 'Pendaftaran untuk kegiatan ini saat ini sedang ditutup.');
        }

        $viewName = view()->exists('events.register.public') ? 'events.register.public' : 'events.register-public';
        return view($viewName, compact('event'));
    }

    /**
     * Tampilkan form registrasi mahasiswa.
     */
    public function studentForm(Event $event): View|RedirectResponse
    {
        if (!$event->registration_open) {
            return redirect()->route('events.show', $event)
                ->with('error', 'Pendaftaran untuk kegiatan ini saat ini sedang ditutup.');
        }

        $departments = \App\Models\AcademicProgram::active()->orderBy('name')->get();

        $viewName = view()->exists('events.register.student') ? 'events.register.student' : 'events.register-student';
        return view($viewName, compact('event', 'departments'));
    }

    /**
     * Simpan pendaftaran peserta umum.
     */
    public function storePublic(RegisterPublicRequest $request, Event $event): JsonResponse|RedirectResponse
    {
        $registration = $this->registrationService->registerPublic($event, $request->validated());

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil dikirim.',
                'registration_id' => $registration->id,
            ], 201);
        }

        return redirect()
            ->route('events.show', $event)
            ->with('success', 'Pendaftaran berhasil dikirim.');
    }

    /**
     * Simpan pendaftaran mahasiswa (wajib NIM, Nama, Jurusan).
     */
    public function storeStudent(RegisterMahasiswaRequest $request, Event $event): JsonResponse|RedirectResponse
    {
        $registration = $this->registrationService->registerMahasiswa($event, $request->validated());

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran mahasiswa berhasil dikirim.',
                'registration_id' => $registration->id,
            ], 201);
        }

        return redirect()
            ->route('events.show', $event)
            ->with('success', 'Pendaftaran mahasiswa berhasil dikirim.');
    }
}