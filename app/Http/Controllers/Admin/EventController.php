<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Event\StoreEventRequest;
use App\Http\Requests\Admin\Event\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    public function __construct(
        protected EventService $eventService
    ) {}

    public function index(): View
    {
        $events = Event::latest('event_date')->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $this->eventService->createEvent(
            $request->validated(),
            $request->file('image_file')
        );

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $this->eventService->updateEvent(
            $event,
            $request->validated(),
            $request->file('image_file')
        );

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->eventService->deleteEvent($event);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }

    public function registrations(Event $event): View
    {
        $registrations = $event->registrations()->latest()->paginate(20);

        return view('admin.events.registrations', compact('event', 'registrations'));
    }

    public function allRegistrations(\Illuminate\Http\Request $request): View
    {
        $query = \App\Models\EventRegistration::with('event')->latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('campus_email', 'like', "%{$search}%");
            });
        }

        $registrations = $query->paginate(20)->withQueryString();
        $events = Event::select('id', 'title')->orderBy('title')->get();

        return view('admin.events.all_registrations', compact('registrations', 'events'));
    }
}