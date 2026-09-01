<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountRequest;
use Illuminate\View\View;

class DiscountRequestController extends Controller
{
    public function index(): View
    {
        $discountRequests = DiscountRequest::query()->latest()->paginate(15);

        return view('admin.discount-requests.index', [
            'discountRequests' => $discountRequests,
        ]);
    }
}
