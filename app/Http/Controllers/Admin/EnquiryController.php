<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    public function index(): View
    {
        $enquiries = Enquiry::query()->latest()->paginate(15);

        return view('admin.enquiries.index', [
            'enquiries' => $enquiries,
        ]);
    }
}
