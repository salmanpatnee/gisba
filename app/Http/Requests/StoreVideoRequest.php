<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
            'video' => ['required', 'file', 'mimes:mp4,webm,ogg', 'max:512000'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'video.required' => 'Please select a video file to upload.',
            'video.mimes' => 'Only MP4, WebM, and OGG video formats are supported.',
            'video.max' => 'The video file must not exceed 500 MB.',
        ];
    }
}
