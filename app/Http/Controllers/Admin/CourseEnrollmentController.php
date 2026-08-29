<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\SiteSettings;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CourseEnrollmentController extends Controller
{
    /** @var array<string, string> Course slug => human label, for the page heading. */
    private const COURSES = [
        'crisc' => 'CRISC Online Course',
        'cissp' => 'CISSP Live Online Training',
        'prince2' => 'PRINCE2 Live Online Training',
    ];

    public function index(string $course): View
    {
        $label = self::COURSES[$course] ?? throw new NotFoundHttpException;
        $settings = SiteSettings::current();

        $enrollments = CourseEnrollment::query()
            ->forCourse($course)
            ->latest()
            ->paginate(15);

        return view('admin.course-enrollments.index', [
            'label' => $label,
            'enrollments' => $enrollments,
            'seatsRemaining' => $settings->{"{$course}_seats_remaining"},
            'capacity' => $settings->{"{$course}_capacity"},
            'totalEnrolled' => $enrollments->total(),
        ]);
    }
}
