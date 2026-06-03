<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class CertificateController extends Controller
{
    public function show(): View
    {
        $user = auth()->user();

        abort_unless($user->hasCompletedTraining(), Response::HTTP_FORBIDDEN);

        $certificate = $user->issueCertificate();

        return view('pages.members.certificate', compact('user', 'certificate'));
    }
}
