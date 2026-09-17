<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Civitas\StoreCivitasRequest;
use App\Http\Requests\Admin\Civitas\UpdateCivitasRequest;
use App\Models\Civitas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CivitasController extends Controller
{
    public function index(Request $request): View
    {
        $query = Civitas::latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $civitas = $query->paginate(10)->withQueryString();

        return view('admin.civitas.index', compact('civitas'));
    }

    public function create(): View
    {
        return view('admin.civitas.create');
    }

    public function store(StoreCivitasRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('civitas', 'public');
            $validated['image'] = $path;
        }
        unset($validated['image_file']);

        $validated['is_active'] = $request->has('is_active');

        Civitas::create($validated);

        return redirect()->route('admin.civitas.index')
            ->with('success', 'Data civitas / mahasiswa / staff berhasil ditambahkan.');
    }

    public function edit(Civitas $civita): View
    {
        return view('admin.civitas.edit', ['item' => $civita]);
    }

    public function update(UpdateCivitasRequest $request, Civitas $civita): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image_file')) {
            if ($civita->image && !filter_var($civita->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($civita->image);
            }
            $path = $request->file('image_file')->store('civitas', 'public');
            $validated['image'] = $path;
        }
        unset($validated['image_file']);

        $validated['is_active'] = $request->has('is_active');

        $civita->update($validated);

        return redirect()->route('admin.civitas.index')
            ->with('success', 'Data civitas berhasil diperbarui.');
    }

    public function destroy(Civitas $civita): RedirectResponse
    {
        if ($civita->image && !filter_var($civita->image, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($civita->image);
        }

        $civita->delete();

        return redirect()->route('admin.civitas.index')
            ->with('success', 'Data civitas berhasil dihapus.');
    }
}
