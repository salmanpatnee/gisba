<?php

use App\Http\Controllers\Admin\BlogAttachmentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Models\SiteSettings;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// ── GISBA Public Pages ────────────────────────────────────────────────────────

Route::get('/', [PageController::class, 'home'])->name('home');
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
Route::get('/video-resources', [VideoController::class, 'index'])->name('video-resources');
Route::get('/video-resources/{video}/stream', [VideoController::class, 'stream'])->name('videos.stream');
Route::post('/video-resources/{video}/view', [VideoController::class, 'recordView'])->name('videos.record-view');

Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/digital-delivery-policy', [PageController::class, 'digitalDeliveryPolicy'])->name('digital-delivery-policy');
Route::get('/digital-refund-policy', [PageController::class, 'digitalRefundPolicy'])->name('digital-refund-policy');
Route::get('/terms-of-use', [PageController::class, 'termsOfUse'])->name('terms-of-use');
Route::get('/payment/success', [PageController::class, 'paymentSuccess'])->name('payment.success');

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

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('blog', App\Http\Controllers\Admin\BlogController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::delete('blog-attachments/{attachment}', [BlogAttachmentController::class, 'destroy'])->name('blog-attachments.destroy');
    Route::resource('videos', App\Http\Controllers\Admin\VideoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('settings', [SiteSettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SiteSettingsController::class, 'update'])->name('settings.update');
});

// ── Breeze Auth ───────────────────────────────────────────────────────────────

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
