<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\MiniAppController;
use App\Http\Controllers\DatingZoneController;
use App\Http\Controllers\LiveZoneController;
use App\Http\Controllers\MallProductController;
use App\Http\Controllers\PageSeoController;
use App\Http\Controllers\Site\LandingPageController;
use App\Http\Controllers\SlugController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
// use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;



Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

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
Route::get('/miniapp', [MiniAppController::class, 'index'])->name('miniapp.index');
    Route::get('/miniapp/create', [MiniAppController::class, 'create'])->name('miniapp.create');
    Route::post('/miniapp/store', [MiniAppController::class, 'store'])->name('miniapp.store');
    Route::get('/miniapp/{id}/edit', [MiniAppController::class, 'edit'])->name('miniapp.edit');
    Route::put('/miniapp/{id}/update', [MiniAppController::class, 'update'])->name('miniapp.update');
    Route::delete('/miniapp/{id}/destroy', [MiniAppController::class, 'destroy'])->name('miniapp.destroy');
});

// Route::get('/miniapp/{slug}', [MiniAppController::class, 'show'])->name('miniapp.show');


Route::middleware(['auth'])->group(function () {
    Route::get('/datingzone', [DatingZoneController::class, 'index'])->name('datingzone.index');
    Route::get('/datingzone/create', [DatingZoneController::class, 'create'])->name('datingzone.create');
    Route::post('/datingzone/store', [DatingZoneController::class, 'store'])->name('datingzone.store');
    Route::get('/datingzone/{id}/edit', [DatingZoneController::class, 'edit'])->name('datingzone.edit');
    Route::post('/datingzone/{id}/update', [DatingZoneController::class, 'update'])->name('datingzone.update');
    Route::post('/datingzone/{id}/delete', [DatingZoneController::class, 'destroy'])->name('datingzone.destroy');
});

// Route::get('/datingzone/{slug}', [DatingZoneController::class, 'show'])->name('datingzone.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/livezone', [LiveZoneController::class, 'index'])->name('livezone.index');
    Route::get('/livezone/create', [LiveZoneController::class, 'create'])->name('livezone.create');
    Route::post('/livezone/store', [LiveZoneController::class, 'store'])->name('livezone.store');
    Route::get('/livezone/{id}/edit', [LiveZoneController::class, 'edit'])->name('livezone.edit');
    Route::put('/livezone/{id}/update', [LiveZoneController::class, 'update'])->name('livezone.update');
    Route::delete('/livezone/{id}/destroy', [LiveZoneController::class, 'destroy'])->name('livezone.destroy');
});

// Route::get('/livezone/{slug}', [LiveZoneController::class, 'show'])->name('livezone.show');


Route::middleware(['auth'])->group(function () {
    Route::get('/mallproducts', [MallProductController::class, 'index'])->name('mallproducts.index');
    Route::get('/mallproducts/create', [MallProductController::class, 'create'])->name('mallproducts.create');
    Route::post('/mallproducts/store', [MallProductController::class, 'store'])->name('mallproducts.store');
    Route::get('/mallproducts/{id}/edit', [MallProductController::class, 'edit'])->name('mallproducts.edit');
    Route::put('/mallproducts/{id}/update', [MallProductController::class, 'update'])->name('mallproducts.update');
    Route::delete('/mallproducts/{id}/destroy', [MallProductController::class, 'destroy'])->name('mallproducts.destroy');

});

// Route::get('/mallproducts/{slug}', [MallProductController::class, 'show'])->name('mallproducts.show');

Route::middleware(['auth'])->group(function () {

Route::get('/pageseo', [PageSeoController::class,'index'])->name('pageseo.index');
Route::get('/pageseo/create', [PageSeoController::class,'create'])->name('pageseo.create');
Route::post('/pageseo/store', [PageSeoController::class,'store'])->name('pageseo.store');
Route::get('/pageseo/{id}/edit', [PageSeoController::class,'edit'])->name('pageseo.edit');
Route::put('/pageseo/{id}/update', [PageSeoController::class,'update'])->name('pageseo.update');
Route::delete('/pageseo/{id}/destroy', [PageSeoController::class,'destroy'])->name('pageseo.destroy');

});


Route::get('/', [LandingPageController::class, 'index']);

Route::get('吴萌萌/{slug}', [SlugController::class, 'resolve'])->name('slug.resolve');