<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\SiteSettings;
use Illuminate\View\View;

class CourseEnrollmentController extends Controller
{
    public function index(): View
    {
        $settings = SiteSettings::current();

        $enrollments = CourseEnrollment::query()
            ->forCourse('crisc')
            ->latest()
            ->paginate(15);

        return view('admin.crisc-enrollments.index', [
            'enrollments' => $enrollments,
            'seatsRemaining' => $settings->crisc_seats_remaining,
            'capacity' => $settings->crisc_capacity,
        ]);
    }
}
