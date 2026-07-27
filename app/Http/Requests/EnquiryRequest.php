<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'organization' => ['nullable', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:25', 'regex:/^\+?[\d\s\-().]{7,20}$/'],
            'service' => ['nullable', 'string', 'in:nis2,training,consulting,project-management,other'],
            'heard_from' => ['required', 'string', 'in:linkedin,google,diac,visionary-alpha,other'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Full name is required.',
            'name.min' => 'Full name must be at least 2 characters.',
            'name.max' => 'Full name must not exceed 100 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'phone.regex' => 'Please enter a valid phone number.',
            'message.required' => 'Message is required.',
            'message.min' => 'Message must be at least 10 characters.',
            'heard_from.required' => 'Please let us know how you heard about us.',
            'heard_from.in' => 'Please select a valid option for how you heard about us.',
            'message.max' => 'Message must not exceed 3000 characters.',
        ];
    }
}
