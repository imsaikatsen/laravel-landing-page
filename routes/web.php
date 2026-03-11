<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DatingZoneController;
use App\Http\Controllers\LiveZoneController;
use App\Http\Controllers\MallProductController;
use App\Http\Controllers\MiniAppController;
use App\Http\Controllers\PageSeoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\LandingPageController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SlugController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::prefix('admin')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/dashboard', function () {
        return view('dashboard-home');
    })->middleware(['auth'])->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
        Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
        Route::get('/slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
        Route::post('/slider/{id}/update', [SliderController::class, 'update'])->name('slider.update');
        Route::post('/slider/{id}/delete', [SliderController::class, 'destroy'])->name('slider.destroy');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');

        Route::get('/miniapp', [MiniAppController::class, 'index'])->name('miniapp.index');
        Route::get('/miniapp/create', [MiniAppController::class, 'create'])->name('miniapp.create');
        Route::post('/miniapp/store', [MiniAppController::class, 'store'])->name('miniapp.store');
        Route::get('/miniapp/{id}/edit', [MiniAppController::class, 'edit'])->name('miniapp.edit');
        Route::put('/miniapp/{id}/update', [MiniAppController::class, 'update'])->name('miniapp.update');
        Route::delete('/miniapp/{id}/destroy', [MiniAppController::class, 'destroy'])->name('miniapp.destroy');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/datingzone', [DatingZoneController::class, 'index'])->name('datingzone.index');
        Route::get('/datingzone/create', [DatingZoneController::class, 'create'])->name('datingzone.create');
        Route::post('/datingzone/store', [DatingZoneController::class, 'store'])->name('datingzone.store');
        Route::get('/datingzone/{id}/edit', [DatingZoneController::class, 'edit'])->name('datingzone.edit');
        Route::post('/datingzone/{id}/update', [DatingZoneController::class, 'update'])->name('datingzone.update');
        Route::delete('/datingzone/{id}/delete', [DatingZoneController::class, 'destroy'])->name('datingzone.destroy');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/livezone', [LiveZoneController::class, 'index'])->name('livezone.index');
        Route::get('/livezone/create', [LiveZoneController::class, 'create'])->name('livezone.create');
        Route::post('/livezone/store', [LiveZoneController::class, 'store'])->name('livezone.store');
        Route::get('/livezone/{id}/edit', [LiveZoneController::class, 'edit'])->name('livezone.edit');
        Route::put('/livezone/{id}/update', [LiveZoneController::class, 'update'])->name('livezone.update');
        Route::delete('/livezone/{id}/destroy', [LiveZoneController::class, 'destroy'])->name('livezone.destroy');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/mallproducts', [MallProductController::class, 'index'])->name('mallproducts.index');
        Route::get('/mallproducts/create', [MallProductController::class, 'create'])->name('mallproducts.create');
        Route::post('/mallproducts/store', [MallProductController::class, 'store'])->name('mallproducts.store');
        Route::get('/mallproducts/{id}/edit', [MallProductController::class, 'edit'])->name('mallproducts.edit');
        Route::put('/mallproducts/{id}/update', [MallProductController::class, 'update'])->name('mallproducts.update');
        Route::delete('/mallproducts/{id}/destroy', [MallProductController::class, 'destroy'])->name('mallproducts.destroy');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/pageseo', [PageSeoController::class, 'index'])->name('pageseo.index');
        Route::get('/pageseo/create', [PageSeoController::class, 'create'])->name('pageseo.create');
        Route::post('/pageseo/store', [PageSeoController::class, 'store'])->name('pageseo.store');
        Route::get('/pageseo/{id}/edit', [PageSeoController::class, 'edit'])->name('pageseo.edit');
        Route::put('/pageseo/{id}/update', [PageSeoController::class, 'update'])->name('pageseo.update');
        Route::delete('/pageseo/{id}/destroy', [PageSeoController::class, 'destroy'])->name('pageseo.destroy');
    });
});

Route::get('/', [LandingPageController::class, 'index']);

Route::get('{categorySlug}/{slug}', [SlugController::class, 'resolveWithCategory'])->name('content.show');
Route::get('{slug}', [SlugController::class, 'resolve'])->name('content.show.simple');
Route::get('吴萌萌/{slug}', [SlugController::class, 'resolve'])->name('slug.resolve');
