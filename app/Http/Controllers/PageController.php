<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function nis2(): View
    {
        return view('pages.nis2-implementation-toolkit');
    }

    public function training(): View
    {
        return view('pages.training-course-development');
    }

    public function successStories(): View
    {
        return view('pages.success-stories');
    }

    public function contactUs(): View
    {
        return view('pages.contact-us');
    }

    public function privacyPolicy(): View
    {
        return view('pages.privacy-policy');
    }

    public function digitalDeliveryPolicy(): View
    {
        return view('pages.digital-delivery-policy');
    }

    public function digitalRefundPolicy(): View
    {
        return view('pages.digital-refund-policy');
    }

    public function termsOfUse(): View
    {
        return view('pages.terms-of-use');
    }
}
