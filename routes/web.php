<?php

use App\Http\Controllers\Admin\BlogAttachmentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChapterController as AdminChapterController;
use App\Http\Controllers\Admin\ChapterResourceController as AdminChapterResourceController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MemberPostController as AdminMemberPostController;
use App\Http\Controllers\Admin\PmpAttachmentController;
use App\Http\Controllers\Admin\PmpCategoryController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterResourceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MembersLoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PayPalCheckoutController;
use App\Http\Controllers\PmpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Models\SiteSettings;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// ── GISBA Public Pages ────────────────────────────────────────────────────────

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('/awareness', [PageController::class, 'awareness'])->name('awareness');
Route::get('/nis2-implementation-toolkit', [PageController::class, 'nis2'])->name('nis2-toolkit');
Route::get('/nis2-implementation-toolkit/pricing', [PageController::class, 'nis2Pricing'])->name('nis2-toolkit.pricing');
Route::get('/training-course-development', [PageController::class, 'training'])->name('training');
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
Route::get('/pmp', [PmpController::class, 'index'])->name('pmp');
Route::get('/pmp/{slug}', [PmpController::class, 'show'])->name('pmp.show');
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
Route::get('/members/email-sent', fn () => view('pages.members-email-sent'))->name('members.email-sent');
Route::get('/members/login', [MembersLoginController::class, 'showForm'])->name('members.login');
Route::post('/members/login', [MembersLoginController::class, 'login'])->name('members.login.submit');
Route::post('/members/logout', [MembersLoginController::class, 'logout'])->name('members.logout');

Route::middleware('member')->prefix('members')->name('members.')->group(function () {
    // Static resource routes MUST come before slug wildcards
    Route::get('/chapters/stream/{resource}', [ChapterResourceController::class, 'stream'])->name('chapters.stream');
    Route::get('/chapters/view/{resource}', [ChapterResourceController::class, 'view'])->name('chapters.view');
    Route::get('/chapters/download/{resource}', [ChapterResourceController::class, 'download'])->name('chapters.download');
    Route::delete('/chapters/resources/{resource}', [ChapterResourceController::class, 'destroy'])->name('chapters.resource.destroy');
    Route::post('/chapters/resources/{resource}/complete', [ChapterResourceController::class, 'markComplete'])->name('chapters.resource.complete');

    // PMP Quick Review Training — Chapters
    Route::get('/chapters', [ChapterController::class, 'index'])->name('chapters.index');
    Route::get('/chapters/{chapter:slug}', [ChapterController::class, 'show'])->name('chapters.show');
    Route::get('/chapters/{chapter:slug}/tutorials', [ChapterResourceController::class, 'tutorials'])->name('chapters.tutorials');
    Route::get('/chapters/{chapter:slug}/takeaways', [ChapterResourceController::class, 'takeaways'])->name('chapters.takeaways');
    Route::get('/chapters/{chapter:slug}/quizzes', [ChapterResourceController::class, 'quizzes'])->name('chapters.quizzes');
    Route::get('/chapters/{chapter:slug}/domain-summary', [ChapterResourceController::class, 'domainSummary'])->name('chapters.domain-summary');
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
    Route::resource('pmp', App\Http\Controllers\Admin\PmpController::class)->except('show');
    Route::resource('pmp-categories', PmpCategoryController::class)->except('show');
    Route::delete('pmp-attachments/{attachment}', [PmpAttachmentController::class, 'destroy'])->name('pmp-attachments.destroy');
    Route::resource('videos', App\Http\Controllers\Admin\VideoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('settings', [SiteSettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SiteSettingsController::class, 'update'])->name('settings.update');
    Route::resource('member-posts', AdminMemberPostController::class)->except('show');
    Route::get('members', [MemberController::class, 'index'])->name('members.index');
    Route::patch('members/{user}/revoke', [MemberController::class, 'revoke'])->name('members.revoke');
    Route::delete('members/{user}', [MemberController::class, 'destroy'])->name('members.destroy');

    // PMP Quick Review Training — Chapter CMS
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
