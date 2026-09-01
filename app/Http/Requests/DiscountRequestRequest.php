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
            'consent' => ['required', 'accepted'],
            'pmp_discount_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'crisc_discount_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'prince2_discount_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
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
            'pmp_discount_percentage.numeric' => 'PMP discount percentage must be a number.',
            'pmp_discount_percentage.min' => 'PMP discount percentage cannot be negative.',
            'pmp_discount_percentage.max' => 'PMP discount percentage cannot exceed 100.',
            'crisc_discount_percentage.numeric' => 'CRISC discount percentage must be a number.',
            'crisc_discount_percentage.min' => 'CRISC discount percentage cannot be negative.',
            'crisc_discount_percentage.max' => 'CRISC discount percentage cannot exceed 100.',
            'prince2_discount_percentage.numeric' => 'PRINCE2 discount percentage must be a number.',
            'prince2_discount_percentage.min' => 'PRINCE2 discount percentage cannot be negative.',
            'prince2_discount_percentage.max' => 'PRINCE2 discount percentage cannot exceed 100.',
        ];
    }
}
