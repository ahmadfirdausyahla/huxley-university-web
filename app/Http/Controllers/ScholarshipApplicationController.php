<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\ScholarshipApplication;
use App\Models\AcademicProgram;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ScholarshipApplicationController extends Controller
{
    /**
     * Tampilkan formulir pengajuan beasiswa.
     */
    public function create(Scholarship $scholarship): View
    {
        abort_if(!$scholarship->is_active, 404, 'Program beasiswa tidak aktif atau sudah ditutup.');

        $programs = AcademicProgram::active()->orderBy('name')->get();

        return view('scholarships.apply', compact('scholarship', 'programs'));
    }

    /**
     * Simpan formulir pengajuan beasiswa.
     */
    public function store(Request $request, Scholarship $scholarship): RedirectResponse
    {
        abort_if(!$scholarship->is_active, 404, 'Program beasiswa tidak aktif atau sudah ditutup.');

        $validated = $request->validate([
            'applicant_type' => ['required', 'string', 'in:student,prospective_student,general'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:25'],
            'nim' => ['nullable', 'string', 'max:50'],
            'current_institution' => ['nullable', 'string', 'max:255'],
            'study_program' => ['nullable', 'string', 'max:255'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:14'],
            'gpa' => ['nullable', 'numeric', 'min:0', 'max:4.00'],
            'achievements' => ['nullable', 'string', 'max:1500'],
            'motivation_letter' => ['required', 'string', 'min:50', 'max:3000'],
            'document_url' => ['nullable', 'url', 'max:500'],
        ], [
            'motivation_letter.min' => 'Surat motivasi minimal 50 karakter.',
            'document_url.url' => 'Tautan berkas harus berupa URL yang valid (misal: Google Drive/Dropbox).',
        ]);

        $scholarship->applications()->create($validated);

        return redirect()
            ->route('scholarships.index')
            ->with('success', 'Pengajuan beasiswa ' . $scholarship->title . ' berhasil dikirim! Tim akademik akan meninjau berkas Anda.');
    }
}
