<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequestRequest;
use App\Mail\DiscountRequestMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DiscountRequestController extends Controller
{
    public function send(DiscountRequestRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            Mail::mailer('mailtrap-sdk')
                ->to(config('mail.enquiry_recipient'))
                ->send(new DiscountRequestMail(
                    name: $validated['name'],
                    email: $validated['email'],
                    discountPercentage: (int) $validated['discount_percentage'],
                ));
        } catch (\Throwable $e) {
            Log::error('DiscountRequestMail failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            return response()->json([
                'success' => false,
                'message' => 'We could not send your request right now. Please try again in a moment.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you, '.e($validated['name']).'! Your discount request has been sent. We will get back to you shortly.',
        ]);
    }
}
