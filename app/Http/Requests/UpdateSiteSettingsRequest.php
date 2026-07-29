<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'success_stories_region' => ['required', 'in:eu,me'],
            'website_mode' => ['required', 'in:b2b,b2pmp'],
            'regular_price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['required', 'numeric', 'min:0'],
            'membership_price' => ['required', 'numeric', 'min:1'],
            'membership_regular_price' => ['required', 'numeric', 'gte:membership_price'],
            'membership_currency' => ['required', 'in:USD,GBP,EUR'],
            'toolkit_zip' => ['nullable', 'file', 'mimes:zip', 'max:51200'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'membership_price.min' => 'The membership price must be at least 1 — this is the amount PayPal charges.',
            'membership_regular_price.gte' => 'The "was" price cannot be lower than the price members actually pay.',
        ];
    }
}
