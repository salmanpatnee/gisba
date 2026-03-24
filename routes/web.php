<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// ── GISBA Public Pages ────────────────────────────────────────────────────────

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/nis2-implementation-toolkit', [PageController::class, 'nis2'])->name('nis2');
Route::get('/nis2-implementation-toolkit/pricing', [PageController::class, 'nis2Pricing'])->name('nis2.pricing');
Route::get('/training-course-development', [PageController::class, 'training'])->name('training');
Route::get('/success-stories', [PageController::class, 'successStories'])->name('success-stories');
Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact-us');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/digital-delivery-policy', [PageController::class, 'digitalDeliveryPolicy'])->name('digital-delivery-policy');
Route::get('/digital-refund-policy', [PageController::class, 'digitalRefundPolicy'])->name('digital-refund-policy');
Route::get('/terms-of-use', [PageController::class, 'termsOfUse'])->name('terms-of-use');
Route::get('/payment/success', [PageController::class, 'paymentSuccess'])->name('payment.success');

// ── Server Setup (auth-protected, remove after use) ───────────────────────────

Route::get('/setup/init', function () {
    $output = [];

    // Force-recreate the storage symlink
    $link = public_path('storage');
    $target = storage_path('app/public');

    $output[] = 'public_path: '.public_path();
    $output[] = 'storage target: '.$target;
    $output[] = 'link path: '.$link;
    $output[] = 'link exists: '.(file_exists($link) ? 'yes' : 'no');
    $output[] = 'is symlink: '.(is_link($link) ? 'yes' : 'no');
    $output[] = 'current target: '.(is_link($link) ? readlink($link) : 'n/a');

    if (is_link($link)) {
        unlink($link);
        $output[] = 'old symlink deleted';
    }

    if (symlink($target, $link)) {
        $output[] = 'storage:link: created successfully';
    } else {
        $output[] = 'storage:link: FAILED - '.json_encode(error_get_last());
    }

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
