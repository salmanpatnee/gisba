<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(EnquiryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $enquiry = Enquiry::query()->create([
                'name' => $validated['name'],
                'organization' => $validated['organization'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'service' => $validated['service'] ?? null,
                'heard_from' => $validated['heard_from'],
                'message' => $validated['message'],
            ]);
        } catch (\Throwable $e) {
            Log::error('Enquiry save failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            return response()->json([
                'success' => false,
                'message' => 'We could not send your message right now. Please try again in a moment.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you, '.e($enquiry->name).'! Your enquiry has been sent. We will get back to you within one business day.',
        ]);
    }
}
