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
            'crisc_price' => ['required', 'numeric', 'min:0'],
            'crisc_currency' => ['required', 'in:USD,GBP,EUR'],
            'crisc_date' => ['required', 'date'],
            'crisc_end_date' => ['nullable', 'date', 'after_or_equal:crisc_date'],
            'crisc_time_start' => ['required', 'string', 'max:20'],
            'crisc_time_end' => ['required', 'string', 'max:20'],
            'crisc_timezone' => ['required', 'string', 'max:50'],
            'crisc_capacity' => ['required', 'integer', 'min:1'],
            'cissp_price' => ['required', 'numeric', 'min:0'],
            'cissp_currency' => ['required', 'in:USD,GBP,EUR'],
            'cissp_date' => ['nullable', 'date'],
            'cissp_end_date' => ['nullable', 'date', 'after_or_equal:cissp_date'],
            'cissp_time_start' => ['nullable', 'string', 'max:20'],
            'cissp_time_end' => ['nullable', 'string', 'max:20'],
            'cissp_timezone' => ['required', 'string', 'max:50'],
            'cissp_capacity' => ['required', 'integer', 'min:1'],
            'prince2_price' => ['required', 'numeric', 'min:0'],
            'prince2_currency' => ['required', 'in:USD,GBP,EUR'],
            'prince2_date' => ['nullable', 'date'],
            'prince2_end_date' => ['nullable', 'date', 'after_or_equal:prince2_date'],
            'prince2_time_start' => ['nullable', 'string', 'max:20'],
            'prince2_time_end' => ['nullable', 'string', 'max:20'],
            'prince2_timezone' => ['required', 'string', 'max:50'],
            'prince2_capacity' => ['required', 'integer', 'min:1'],
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
