<?php

namespace App\Http\Requests\Admin\Scholarship;

use Illuminate\Foundation\Http\FormRequest;

class StoreScholarshipRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'provider' => ['nullable', 'string', 'max:255'],
            'coverage_type' => ['required', 'in:full,partial,living_allowance'],
            'amount' => ['nullable', 'string', 'max:100'],
            'deadline' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'requirements' => ['nullable', 'string'],
            'link' => ['nullable', 'url'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_url' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Nama Beasiswa', 'provider' => 'Penyelenggara',
            'coverage_type' => 'Jenis Cakupan', 'amount' => 'Nominal Beasiswa',
            'deadline' => 'Batas Pendaftaran', 'image_file' => 'File Gambar',
            'image_url' => 'URL Gambar', 'link' => 'Tautan Pendaftaran',
        ];
    }

    public function messages(): array
    {
        return ['required' => ':attribute wajib diisi.', 'max' => ':attribute tidak boleh lebih dari :max karakter.'];
    }
}
