<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;

class CouponCheckController extends Controller
{
    public function __invoke(CheckCouponRequest $request): JsonResponse
    {
        $coupon = Coupon::query()
            ->active()
            ->where('name', strtoupper(trim($request->string('code'))))
            ->first();

        if (! $coupon) {
            return response()->json(['valid' => false]);
        }

        return response()->json(['valid' => true, 'value' => $coupon->value]);
    }
}
