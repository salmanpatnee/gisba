<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'consent' => ['required', 'accepted'],
            'pmp_discount_percentage' => ['nullable', 'integer', Rule::in([10, 20, 30, 40, 50, 60, 70, 80, 90])],
            'crisc_discount_percentage' => ['nullable', 'integer', Rule::in([10, 20, 30, 40, 50, 60, 70, 80, 90])],
            'prince2_discount_percentage' => ['nullable', 'integer', Rule::in([10, 20, 30, 40, 50, 60, 70, 80, 90])],
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
            'consent.required' => 'Please consent to the use of your information before submitting.',
            'consent.accepted' => 'Please consent to the use of your information before submitting.',
            'pmp_discount_percentage.integer' => 'Please choose a valid discount percentage for PMP.',
            'pmp_discount_percentage.in' => 'Please choose a valid discount percentage for PMP.',
            'crisc_discount_percentage.integer' => 'Please choose a valid discount percentage for CRISC.',
            'crisc_discount_percentage.in' => 'Please choose a valid discount percentage for CRISC.',
            'prince2_discount_percentage.integer' => 'Please choose a valid discount percentage for PRINCE2.',
            'prince2_discount_percentage.in' => 'Please choose a valid discount percentage for PRINCE2.',
        ];
    }
}
