<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Scholarship\StoreScholarshipRequest;
use App\Http\Requests\Admin\Scholarship\UpdateScholarshipRequest;
use App\Models\Scholarship;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ScholarshipController extends Controller
{
    public function index(Request $request): View
    {
        $query = Scholarship::latest();

        if ($request->filled('coverage_type')) {
            $query->where('coverage_type', $request->coverage_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('provider', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $scholarships = $query->paginate(10)->withQueryString();

        return view('admin.scholarships.index', compact('scholarships'));
    }

    public function create(): View
    {
        return view('admin.scholarships.create');
    }

    public function store(StoreScholarshipRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('scholarships', 'public');
            $validated['image'] = $path;
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }
        unset($validated['image_file'], $validated['image_url']);

        $validated['slug'] = Str::slug($validated['title'] . '-' . Str::random(4));
        $validated['is_active'] = $request->has('is_active');

        Scholarship::create($validated);

        return redirect()->route('admin.scholarships.index')
            ->with('success', 'Program Beasiswa baru berhasil ditambahkan.');
    }

    public function edit(Scholarship $scholarship): View
    {
        return view('admin.scholarships.edit', compact('scholarship'));
    }

    public function update(UpdateScholarshipRequest $request, Scholarship $scholarship): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image_file')) {
            if ($scholarship->image && !filter_var($scholarship->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($scholarship->image);
            }
            $path = $request->file('image_file')->store('scholarships', 'public');
            $validated['image'] = $path;
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }
        unset($validated['image_file'], $validated['image_url']);

        $validated['is_active'] = $request->has('is_active');

        $scholarship->update($validated);

        return redirect()->route('admin.scholarships.index')
            ->with('success', 'Program Beasiswa berhasil diperbarui.');
    }

    public function destroy(Scholarship $scholarship): RedirectResponse
    {
        if ($scholarship->image && !filter_var($scholarship->image, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($scholarship->image);
        }

        $scholarship->delete();

        return redirect()->route('admin.scholarships.index')
            ->with('success', 'Program Beasiswa berhasil dihapus.');
    }
}
