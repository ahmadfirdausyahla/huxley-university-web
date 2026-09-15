<?php

namespace App\Http\Requests\EventRegistration;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPublicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'institution' => ['required', 'string', 'max:150'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Lengkap',
            'email' => 'Alamat Email',
            'phone' => 'Nomor WhatsApp / Telepon',
            'institution' => 'Asal Institusi / Instansi',
            'notes' => 'Catatan Tambahan',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'email' => ':attribute harus berupa alamat email yang valid.',
            'max' => ':attribute tidak boleh melebihi :max karakter.',
        ];
    }
}
