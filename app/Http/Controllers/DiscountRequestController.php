<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequestRequest;
use App\Models\DiscountRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class DiscountRequestController extends Controller
{
    public function store(DiscountRequestRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $discountRequest = DiscountRequest::query()->create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'consent' => true,
                'pmp_discount_percentage' => $validated['pmp_discount_percentage'] ?? null,
                'crisc_discount_percentage' => $validated['crisc_discount_percentage'] ?? null,
                'prince2_discount_percentage' => $validated['prince2_discount_percentage'] ?? null,
            ]);
        } catch (\Throwable $e) {
            Log::error('DiscountRequest save failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            return response()->json([
                'success' => false,
                'message' => 'We could not submit your request right now. Please try again in a moment.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you, '.e($discountRequest->name).'! Your Pay-What-You-Can-Afford request has been received. Our team will review it and get back to you shortly.',
        ]);
    }
}
