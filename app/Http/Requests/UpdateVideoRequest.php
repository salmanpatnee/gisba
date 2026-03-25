<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'video' => ['nullable', 'file', 'mimes:mp4,webm,ogg', 'max:512000'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'video.mimes' => 'Only MP4, WebM, and OGG video formats are supported.',
            'video.max' => 'The video file must not exceed 500 MB.',
        ];
    }
}
