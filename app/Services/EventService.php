<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventService
{
    /**
     * Membuat Event baru.
     */
    public function createEvent(array $data, ?UploadedFile $imageFile = null): Event
    {
        if ($imageFile) {
            $data['image'] = $imageFile->store('events', 'public');
        } elseif (!empty($data['image_url'])) {
            $data['image'] = $data['image_url'];
        }

        unset($data['image_file'], $data['image_url']);

        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $data['registration_open'] = !empty($data['registration_open']);

        return Event::create($data);
    }

    /**
     * Memperbarui Event yang sudah ada.
     */
    public function updateEvent(Event $event, array $data, ?UploadedFile $imageFile = null): Event
    {
        if ($imageFile) {
            // Hapus cover lama jika ada di storage lokal
            if ($event->image && !filter_var($event->image, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $imageFile->store('events', 'public');
        } elseif (!empty($data['image_url'])) {
            $data['image'] = $data['image_url'];
        }

        unset($data['image_file'], $data['image_url']);

        if (!empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $data['registration_open'] = !empty($data['registration_open']);

        $event->update($data);

        return $event;
    }

    /**
     * Menghapus Event beserta file cover.
     */
    public function deleteEvent(Event $event): bool
    {
        if ($event->image && !filter_var($event->image, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        return (bool) $event->delete();
    }
}
