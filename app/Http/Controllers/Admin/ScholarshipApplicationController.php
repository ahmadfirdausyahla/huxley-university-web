<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Models\ScholarshipApplication;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ScholarshipApplicationController extends Controller
{
    /**
     * Tampilkan rekap seluruh kotak masuk pendaftaran/pengajuan beasiswa.
     */
    public function index(Request $request): View
    {
        $query = ScholarshipApplication::with('scholarship')->latest();

        if ($request->filled('scholarship_id')) {
            $query->where('scholarship_id', $request->scholarship_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('applicant_type')) {
            $query->where('applicant_type', $request->applicant_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('study_program', 'like', "%{$search}%");
            });
        }

        $applications = $query->paginate(15)->withQueryString();
        $scholarships = Scholarship::select('id', 'title')->orderBy('title')->get();

        $stats = [
            'total' => ScholarshipApplication::count(),
            'pending' => ScholarshipApplication::where('status', 'pending')->count(),
            'under_review' => ScholarshipApplication::where('status', 'under_review')->count(),
            'approved' => ScholarshipApplication::where('status', 'approved')->count(),
            'rejected' => ScholarshipApplication::where('status', 'rejected')->count(),
        ];

        return view('admin.scholarships.applications_index', compact('applications', 'scholarships', 'stats'));
    }

    /**
     * Tampilkan detail permohonan beasiswa.
     */
    public function show(ScholarshipApplication $application): View
    {
        $application->load('scholarship');
        return view('admin.scholarships.applications_show', compact('application'));
    }

    /**
     * Update status verifikasi pengajuan beasiswa.
     */
    public function updateStatus(Request $request, ScholarshipApplication $application): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,under_review,approved,rejected'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $application->update($validated);

        return back()->with('success', 'Status pengajuan pemohon ' . $application->name . ' berhasil diperbarui menjadi "' . $application->status_label . '".');
    }

    /**
     * Hapus berkas pengajuan beasiswa.
     */
    public function destroy(ScholarshipApplication $application): RedirectResponse
    {
        $applicantName = $application->name;
        $application->delete();

        return redirect()
            ->route('admin.scholarships.applications.index')
            ->with('success', 'Pengajuan beasiswa dari ' . $applicantName . ' berhasil dihapus.');
    }
}
