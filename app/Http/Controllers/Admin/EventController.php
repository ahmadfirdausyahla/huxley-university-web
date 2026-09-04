<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest('event_date')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_url' => 'nullable|url',
            'audience' => 'required|in:public,student',
            'event_date' => 'required|date',
            'start_time' => 'nullable', // DIUBAH JADI NULLABLE
            'end_time' => 'nullable',
            'location' => 'required|string|max:255',
            'quota' => 'nullable|integer|min:1',
            'registration_open' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('events', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->image_url;
        }

        unset($data['image_file'], $data['image_url']);

        $data['slug'] = Str::slug($data['title']);
        $data['registration_open'] = $request->boolean('registration_open');

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_url' => 'nullable|url',
            'audience' => 'required|in:public,student',
            'event_date' => 'required|date',
            'start_time' => 'nullable', // DIUBAH JADI NULLABLE
            'end_time' => 'nullable',
            'location' => 'required|string|max:255',
            'quota' => 'nullable|integer|min:1',
            'registration_open' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('events', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->image_url;
        }

        unset($data['image_file'], $data['image_url']);

        $data['slug'] = Str::slug($data['title']);
        $data['registration_open'] = $request->boolean('registration_open');

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }

    public function registrations(Event $event)
    {
        $registrations = $event->registrations()->latest()->paginate(20);

        return view('admin.events.registrations', compact('event', 'registrations'));
    }
}