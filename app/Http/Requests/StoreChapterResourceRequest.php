<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreChapterResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'chapter_id' => ['required', 'integer', 'exists:chapters,id'],
            'tutorial' => ['nullable', 'file', 'mimes:mp4', 'max:512000'],
            'quiz' => ['nullable', 'file', 'mimes:mp4', 'max:512000'],
            'additional_resources' => ['nullable', 'string'],
        ];
    }
}
