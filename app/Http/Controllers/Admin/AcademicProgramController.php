<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AcademicProgram\StoreAcademicProgramRequest;
use App\Http\Requests\Admin\AcademicProgram\UpdateAcademicProgramRequest;
use App\Models\AcademicProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AcademicProgramController extends Controller
{
    public function index(Request $request): View
    {
        $query = AcademicProgram::latest();

        if ($request->filled('degree')) {
            $query->where('degree', $request->degree);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('faculty', 'like', "%{$search}%");
            });
        }

        $programs = $query->paginate(10)->withQueryString();

        return view('admin.programs.index', compact('programs'));
    }

    public function create(): View
    {
        return view('admin.programs.create');
    }

    public function store(StoreAcademicProgramRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('academic_programs', 'public');
            $validated['image'] = $path;
        }
        unset($validated['image_file']);

        $validated['slug'] = Str::slug($validated['degree'] . ' ' . $validated['name'] . '-' . Str::random(4));
        $validated['is_active'] = $request->has('is_active');

        AcademicProgram::create($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program Studi baru berhasil ditambahkan.');
    }

    public function edit(AcademicProgram $program): View
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(UpdateAcademicProgramRequest $request, AcademicProgram $program): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image_file')) {
            if ($program->image && !filter_var($program->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($program->image);
            }
            $path = $request->file('image_file')->store('academic_programs', 'public');
            $validated['image'] = $path;
        }
        unset($validated['image_file']);

        $validated['is_active'] = $request->has('is_active');

        $program->update($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function destroy(AcademicProgram $program): RedirectResponse
    {
        if ($program->image && !filter_var($program->image, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($program->image);
        }

        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program Studi berhasil dihapus.');
    }
}
