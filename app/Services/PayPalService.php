<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PayPalService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.paypal.mode') === 'live'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';
    }

    private function isFake(): bool
    {
        return (bool) config('services.paypal.fake');
    }

    private function accessToken(): string
    {
        if ($this->isFake()) {
            return 'fake-access-token';
        }

        return Cache::remember('paypal_access_token', 28800, function () {
            $response = Http::withBasicAuth(
                config('services.paypal.client_id'),
                config('services.paypal.client_secret')
            )
                ->asForm()
                ->post("{$this->baseUrl}/v1/oauth2/token", [
                    'grant_type' => 'client_credentials',
                ]);

            return $response->json('access_token');
        });
    }

    public function createOrder(string $returnUrl, string $cancelUrl): array
    {
        if ($this->isFake()) {
            $fakeOrderId = 'FAKE-'.strtoupper(substr(md5(uniqid()), 0, 12));

            return [
                'id' => $fakeOrderId,
                'status' => 'CREATED',
                'links' => [
                    [
                        'rel' => 'approve',
                        // Append token so capture handler reads it like a real PayPal return
                        'href' => $returnUrl.(str_contains($returnUrl, '?') ? '&' : '?').'token='.$fakeOrderId,
                    ],
                ],
            ];
        }

        $response = Http::withToken($this->accessToken())
            ->post("{$this->baseUrl}/v2/checkout/orders", [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => '30.00',
                    ],
                    'description' => 'GISBA Members-Only Access',
                ]],
                'application_context' => [
                    'return_url' => $returnUrl,
                    'cancel_url' => $cancelUrl,
                    'brand_name' => 'GISBA',
                    'user_action' => 'PAY_NOW',
                ],
            ]);

        return $response->json();
    }

    public function captureOrder(string $orderId): array
    {
        if ($this->isFake()) {
            return ['id' => $orderId, 'status' => 'COMPLETED'];
        }

        $response = Http::withToken($this->accessToken())
            ->post("{$this->baseUrl}/v2/checkout/orders/{$orderId}/capture");

        return $response->json();
    }
}
