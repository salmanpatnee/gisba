<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Mail\ContactMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(EnquiryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            Mail::to(config('mail.enquiry_recipient', 'support@gisba.net'))
                ->send(new ContactMail(
                    name: $validated['name'],
                    email: $validated['email'],
                    phone: $validated['phone'] ?? '',
                    organization: $validated['organization'] ?? '',
                    service: $validated['service'] ?? '',
                    heardFrom: $validated['heard_from'],
                    message: $validated['message'],
                ));
        } catch (\Throwable) {
            return response()->json([
                'success' => false,
                'message' => 'We could not send your message right now. Please email us directly at <a href="mailto:support@gisba.net">support@gisba.net</a>.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you, '.e($validated['name']).'! Your enquiry has been sent. We will get back to you within one business day.',
        ]);
    }
}
