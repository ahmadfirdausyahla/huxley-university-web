<?php

namespace App\Http\Requests\EventRegistration;

use Illuminate\Foundation\Http\FormRequest;

class RegisterMahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'nim' => ['required', 'string', 'min:5', 'max:30'],
            'study_program' => ['required', 'string', 'max:150'], // Jurusan / Program Studi
            'campus_email' => ['required', 'email', 'max:150'],
            'faculty' => ['nullable', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Lengkap Mahasiswa',
            'nim' => 'Nomor Induk Mahasiswa (NIM)',
            'study_program' => 'Jurusan / Program Studi',
            'campus_email' => 'Email Kampus Mahasiswa',
            'faculty' => 'Fakultas',
            'phone' => 'Nomor WhatsApp / Telepon',
            'notes' => 'Catatan Tambahan',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'email' => ':attribute harus berupa alamat email yang valid.',
            'min' => ':attribute minimal terdiri dari :min karakter.',
            'max' => ':attribute tidak boleh melebihi :max karakter.',
        ];
    }
}
