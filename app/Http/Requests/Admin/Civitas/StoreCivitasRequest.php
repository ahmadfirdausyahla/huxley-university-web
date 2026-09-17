<?php

namespace App\Http\Requests\Admin\Civitas;

use Illuminate\Foundation\Http\FormRequest;

class StoreCivitasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:50', 'unique:civitas,nip'],
            'role' => ['required', 'string', 'max:100'],
            'type' => ['required', 'in:mahasiswa,dosen,tendik,pimpinan'],
            'department' => ['nullable', 'string', 'max:150'],
            'faculty' => ['nullable', 'string', 'max:150'],
            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'bio' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Lengkap',
            'nip' => 'NIM / NIP',
            'role' => 'Peran / Jabatan',
            'type' => 'Kategori Civitas',
            'department' => 'Program Studi / Jurusan',
            'faculty' => 'Fakultas',
            'email' => 'Email Kampus',
            'phone' => 'Nomor WhatsApp / Telepon',
        ];
    }
}
