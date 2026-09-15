<?php

namespace App\Http\Requests\Admin\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'in:public,mahasiswa'],
            'audience' => ['nullable', 'in:public,student'],
            'description' => ['nullable', 'string', 'max:1000'],
            'content' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_url' => ['nullable', 'url'],
            'event_date' => ['required', 'date'],
            'start_time' => ['nullable'],
            'end_time' => ['nullable'],
            'location' => ['required', 'string', 'max:255'],
            'quota' => ['nullable', 'integer', 'min:1'],
            'registration_open' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Judul Event',
            'category' => 'Kategori Event',
            'audience' => 'Target Audience',
            'description' => 'Deskripsi Singkat',
            'content' => 'Detail Konten Event',
            'image_file' => 'File Gambar Cover',
            'image_url' => 'URL Gambar',
            'event_date' => 'Tanggal Pelaksanaan',
            'location' => 'Lokasi Event',
            'quota' => 'Kuota Peserta',
            'registration_open' => 'Status Pendaftaran',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'image' => ':attribute harus berupa file gambar.',
            'mimes' => ':attribute harus berformat :values.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'integer' => ':attribute harus berupa bilangan bulat.',
            'min' => ':attribute minimal bernilai :min.',
        ];
    }
}
