<?php

namespace App\Http\Requests\Admin\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'label' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'image_url' => ['nullable', 'url'],
            'col_span' => ['nullable', 'string'],
            'row_span' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Judul Berita',
            'label' => 'Label Kategori',
            'description' => 'Deskripsi Singkat',
            'content' => 'Isi Konten Berita',
            'image_file' => 'File Gambar Cover',
            'image_url' => 'URL Gambar',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'image' => ':attribute harus berupa file gambar.',
            'mimes' => ':attribute harus berformat :values.',
        ];
    }
}
