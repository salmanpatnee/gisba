<?php

use App\Enums\WebsiteMode;
use App\Http\Controllers\Admin\BlogAttachmentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChapterController as AdminChapterController;
use App\Http\Controllers\Admin\ChapterResourceController as AdminChapterResourceController;
use App\Http\Controllers\Admin\CourseEnrollmentController;
use App\Http\Controllers\Admin\CriscAttachmentController;
use App\Http\Controllers\Admin\CriscCategoryController;
use App\Http\Controllers\Admin\CriscController as AdminCriscController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MemberPostController as AdminMemberPostController;
use App\Http\Controllers\Admin\PmpAttachmentController;
use App\Http\Controllers\Admin\PmpCategoryController;
use App\Http\Controllers\Admin\PmpController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\UserActivityController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterResourceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CriscCheckoutController;
use App\Http\Controllers\CriscController;
use App\Http\Controllers\MemberAccountController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MembersLoginController;
use App\Http\Controllers\MembersPasswordResetController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PayPalCheckoutController;
use App\Http\Controllers\PmpController as PublicPmpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Models\SiteSettings;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// ── GISBA Public Pages ────────────────────────────────────────────────────────

// Site root: renders Home (B2B mode) or the PMP index (B2PMP mode) depending on SiteSettings::current()->website_mode.
Route::get('/', function () {
    if (SiteSettings::current()->website_mode === WebsiteMode::B2PMP->value) {
        return app(PublicPmpController::class)->index();
    }

    return app(PageController::class)->home();
})->name('home');
Route::get('/home', [PageController::class, 'home'])->name('home.legacy');
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('/awareness', [PageController::class, 'awareness'])->name('awareness');
Route::get('/nis2-implementation-toolkit', [PageController::class, 'nis2'])->name('nis2-toolkit');
Route::get('/nis2-implementation-toolkit/pricing', [PageController::class, 'nis2Pricing'])->name('nis2-toolkit.pricing');
Route::get('/training-course-development', [PageController::class, 'training'])->name('training');
Route::get('/crisc-course', [PageController::class, 'crisc'])->name('crisc-course');
Route::get('/crisc-course/pricing', [PageController::class, 'criscPricing'])->name('crisc-course.pricing');
Route::post('/crisc-course/checkout', [CriscCheckoutController::class, 'create'])->name('crisc-course.checkout');
Route::get('/crisc-course/paypal/return', [CriscCheckoutController::class, 'capture'])->name('crisc-course.paypal.return');
Route::get('/crisc-course/paypal/cancel', [CriscCheckoutController::class, 'cancel'])->name('crisc-course.paypal.cancel');
Route::get('/crisc-course/enrolled', fn () => view('pages.crisc-course-enrolled', [
    'enrollmentName' => session('enrollment_name'),
    'enrollmentEmail' => session('enrollment_email'),
]))->name('crisc-course.enrolled');
Route::get('/success-stories', function () {
    $region = SiteSettings::current()->success_stories_region;

    return redirect()->route('success-stories.'.$region);
})->name('success-stories');
Route::get('/success-stories/eu', [PageController::class, 'successStoriesEu'])->name('success-stories.eu');
Route::get('/success-stories/me', [PageController::class, 'successStoriesMe'])->name('success-stories.me');
Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact-us');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/nis2', [BlogController::class, 'index'])->name('nis2');
Route::get('/nis2/{slug}', [BlogController::class, 'show'])->name('nis2.show');
Route::get('/crisc/{slug}', [CriscController::class, 'show'])->name('crisc.show');
// PMP index always redirects to '/' (avoids duplicate-content URLs). In B2PMP mode, '/' itself renders the PMP index (see root route above).
Route::get('/pmp', fn () => redirect()->route('home'))->name('pmp');
Route::get('/pmp/{slug}', function (string $slug) {
    if (SiteSettings::current()->website_mode === WebsiteMode::B2PMP->value) {
        return app(PublicPmpController::class)->show($slug);
    }

    return redirect()->route('home');
})->name('pmp.show');
Route::get('/video-resources', [VideoController::class, 'index'])->name('video-resources');
Route::get('/video-resources/{video}/stream', [VideoController::class, 'stream'])->name('videos.stream');
Route::post('/video-resources/{video}/view', [VideoController::class, 'recordView'])->name('videos.record-view');

Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/digital-delivery-policy', [PageController::class, 'digitalDeliveryPolicy'])->name('digital-delivery-policy');
Route::get('/digital-refund-policy', [PageController::class, 'digitalRefundPolicy'])->name('digital-refund-policy');
Route::get('/terms-of-use', [PageController::class, 'termsOfUse'])->name('terms-of-use');
Route::get('/payment/success', [PageController::class, 'paymentSuccess'])->name('payment.success');

// ── Members ───────────────────────────────────────────────────────────────────

Route::get('/members', [MembersController::class, 'paywall'])->name('members.paywall');
Route::post('/members/checkout', [PayPalCheckoutController::class, 'create'])->name('members.checkout');
Route::get('/members/paypal/return', [PayPalCheckoutController::class, 'capture'])->name('members.paypal.return');
Route::get('/members/paypal/cancel', [PayPalCheckoutController::class, 'cancel'])->name('members.paypal.cancel');
Route::get('/members/email-sent', fn () => view('pages.members-email-sent', [
    'memberEmail' => session('member_email'),
    'plainPassword' => session('plain_password'),
    'expiresAt' => session('member_expires_at'),
]))->name('members.email-sent');
Route::get('/members/login', [MembersLoginController::class, 'showForm'])->name('members.login');
Route::post('/members/login', [MembersLoginController::class, 'login'])->name('members.login.submit');
Route::post('/members/logout', [MembersLoginController::class, 'logout'])->name('members.logout');
Route::get('/members/forgot-password', [MembersPasswordResetController::class, 'showForgotForm'])->name('members.password.request');
Route::post('/members/forgot-password', [MembersPasswordResetController::class, 'sendResetLink'])->name('members.password.email');
Route::get('/members/reset-password/{token}', [MembersPasswordResetController::class, 'showResetForm'])->name('members.password.reset');
Route::post('/members/reset-password', [MembersPasswordResetController::class, 'resetPassword'])->name('members.password.update');

Route::middleware('member')->prefix('members')->name('members.')->group(function () {
    Route::get('/account', [MemberAccountController::class, 'edit'])->name('account.edit');
    Route::put('/account/password', [MemberAccountController::class, 'updatePassword'])->name('account.password');

    // Static resource routes MUST come before slug wildcards
    Route::get('/chapters/stream/{resource}', [ChapterResourceController::class, 'stream'])->name('chapters.stream');
    Route::get('/chapters/view/{resource}', [ChapterResourceController::class, 'view'])->name('chapters.view');
    Route::get('/chapters/download/{resource}', [ChapterResourceController::class, 'download'])->name('chapters.download');
    Route::delete('/chapters/resources/{resource}', [ChapterResourceController::class, 'destroy'])->name('chapters.resource.destroy');
    Route::post('/chapters/resources/{resource}/complete', [ChapterResourceController::class, 'markComplete'])->name('chapters.resource.complete');

    // PMP Comprehensive Training Aligned with PMBOK 8th Edition — Chapters
    Route::get('/chapters', [ChapterController::class, 'index'])->name('chapters.index');
    Route::get('/chapters/{chapter:slug}', [ChapterController::class, 'show'])->name('chapters.show');
    Route::get('/chapters/{chapter:slug}/tutorials', [ChapterResourceController::class, 'tutorials'])->name('chapters.tutorials');
    Route::get('/chapters/{chapter:slug}/quizzes', [ChapterResourceController::class, 'quizzes'])->name('chapters.quizzes');
    Route::get('/chapters/{chapter:slug}/additional-resources', [ChapterResourceController::class, 'additionalResources'])->name('chapters.additional-resources');

    // Training completion certificate
    Route::get('/certificate', [CertificateController::class, 'show'])->name('certificate');
});

// ── Server Setup (auth-protected, remove after use) ───────────────────────────

Route::get('/setup/init', function () {
    $output = [];

    $output[] = 'public_path: '.public_path();
    $output[] = 'storage target: '.storage_path('app/public');

    Artisan::call('storage:link', ['--force' => true]);
    $output[] = 'storage:link: '.trim(Artisan::output());

    Artisan::call('config:clear');
    $output[] = 'config:clear: '.trim(Artisan::output());

    Artisan::call('cache:clear');
    $output[] = 'cache:clear: '.trim(Artisan::output());

    Artisan::call('view:clear');
    $output[] = 'view:clear: '.trim(Artisan::output());

    return response('<pre>'.implode("\n", $output).'</pre>');
})->middleware('auth')->name('setup.init');

// ── Admin ─────────────────────────────────────────────────────────────────────

Route::middleware(['auth', 'redirect-if-member'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('blog', App\Http\Controllers\Admin\BlogController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::delete('blog-attachments/{attachment}', [BlogAttachmentController::class, 'destroy'])->name('blog-attachments.destroy');
    Route::resource('pmp', PmpController::class)->except('show');
    Route::resource('pmp-categories', PmpCategoryController::class)->except('show');
    Route::delete('pmp-attachments/{attachment}', [PmpAttachmentController::class, 'destroy'])->name('pmp-attachments.destroy');
    Route::resource('crisc', AdminCriscController::class)->except('show');
    Route::resource('crisc-categories', CriscCategoryController::class)->except('show');
    Route::delete('crisc-attachments/{attachment}', [CriscAttachmentController::class, 'destroy'])->name('crisc-attachments.destroy');
    Route::get('crisc-enrollments', [CourseEnrollmentController::class, 'index'])->name('crisc-enrollments.index');
    Route::resource('videos', App\Http\Controllers\Admin\VideoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('settings', [SiteSettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SiteSettingsController::class, 'update'])->name('settings.update');
    Route::resource('member-posts', AdminMemberPostController::class)->except('show');
    Route::get('members', [MemberController::class, 'index'])->name('members.index');
    Route::patch('members/{user}/revoke', [MemberController::class, 'revoke'])->name('members.revoke');
    Route::delete('members/{user}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::get('user-activity', [UserActivityController::class, 'index'])->name('user-activity.index');
    Route::get('user-activity/{userSession}', [UserActivityController::class, 'show'])->name('user-activity.show');

    // PMP Comprehensive Training Aligned with PMBOK 8th Edition — Chapter CMS
    Route::resource('chapters', AdminChapterController::class);
    Route::get('/chapters/{chapter}/resources/create', [AdminChapterResourceController::class, 'create'])->name('chapters.resources.create');
    Route::post('/chapters/resources', [AdminChapterResourceController::class, 'store'])->name('chapters.resources.store');
    Route::delete('/chapters/resources/{resource}', [AdminChapterResourceController::class, 'destroy'])->name('chapters.resources.destroy');
});

// ── Breeze Auth ───────────────────────────────────────────────────────────────

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'redirect-if-member'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
