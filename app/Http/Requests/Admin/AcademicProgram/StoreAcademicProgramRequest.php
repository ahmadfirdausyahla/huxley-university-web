<?php

namespace App\Http\Requests\Admin\AcademicProgram;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcademicProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'in:D3,S1,S2,S3'],
            'faculty' => ['required', 'string', 'max:255'],
            'accreditation' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'career_prospects' => ['nullable', 'string'],
            'duration_years' => ['nullable', 'string', 'max:100'],
            'tuition_fee' => ['nullable', 'string', 'max:100'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
