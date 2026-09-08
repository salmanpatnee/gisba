<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequestRequest;
use App\Models\Coupon;
use App\Models\DiscountRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class DiscountRequestController extends Controller
{
    /**
     * Course field => display name for the courses covered by this form.
     *
     * @var array<string, string>
     */
    private const COURSES = [
        'pmp_discount_percentage' => 'PMP',
        'crisc_discount_percentage' => 'CRISC',
        'prince2_discount_percentage' => 'PRINCE2',
    ];

    /**
     * Course field => named route to that course's page, where checkout happens.
     *
     * @var array<string, string>
     */
    private const COURSE_ROUTES = [
        'pmp_discount_percentage' => 'pmp',
        'crisc_discount_percentage' => 'crisc-course',
        'prince2_discount_percentage' => 'prince2',
    ];

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

        $coupons = [];

        foreach (self::COURSES as $field => $courseName) {
            $percentage = $validated[$field] ?? null;

            if ($percentage === null) {
                continue;
            }

            $coupon = Coupon::query()->firstOrCreate(
                ['name' => 'DISACP'.$percentage],
                ['value' => $percentage, 'expires_at' => null],
            );

            $coupons[] = [
                'course' => $courseName,
                'code' => $coupon->name,
                'percentage' => $percentage,
                'checkout_url' => route(self::COURSE_ROUTES[$field]),
            ];
        }

        $message = count($coupons) > 0
            ? 'Thank you, '.e($discountRequest->name).'! Your requested discount code(s) are as follows.'
            : 'Thank you, '.e($discountRequest->name).'! Your request has been received.';

        return response()->json([
            'success' => true,
            'message' => $message,
            'coupons' => $coupons,
        ]);
    }
}
