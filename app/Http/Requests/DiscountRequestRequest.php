<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DiscountRequestRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:150'],
            'discount_percentage' => ['required', 'integer', 'min:1', 'max:99'],
            'consent' => ['required', 'accepted'],
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
            'discount_percentage.required' => 'Please enter the discount percentage you are requesting.',
            'discount_percentage.integer' => 'Discount percentage must be a whole number.',
            'discount_percentage.min' => 'Discount percentage must be at least 1%.',
            'discount_percentage.max' => 'Discount percentage cannot exceed 99%.',
            'consent.required' => 'Please consent to the use of your information before submitting.',
            'consent.accepted' => 'Please consent to the use of your information before submitting.',
        ];
    }
}
