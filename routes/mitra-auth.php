<?php

// use App\Http\Controllers\Mitra\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Mitra\Auth\EmailVerificationNotificationController;
// use App\Http\Controllers\Mitra\Auth\EmailVerificationPromptController;
// use App\Http\Controllers\Mitra\Auth\NewPasswordController;
// use App\Http\Controllers\Mitra\Auth\PasswordController;
// use App\Http\Controllers\Mitra\Auth\PasswordResetLinkController;
use App\Http\Controllers\Mitra\Auth\RegisteredUserController;
// use App\Http\Controllers\Mitra\Auth\VerifyEmailController;
use App\Http\Controllers\Mitra\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmingNeedsController;
use App\Models\FarmingNeed;
Route::prefix('mitra')->middleware('guest:mitra')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('mitra.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('mitra.login');

    Route::post('login', [LoginController::class, 'store']);

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    //     ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    //     ->name('password.email');

    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    //     ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController::class, 'store'])
    //     ->name('password.store');
});

Route::prefix('mitra')->middleware('auth:mitra')->group(function () {
    // Route::get('verify-email', EmailVerificationPromptController::class)
    //     ->name('verification.notice');

    // Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    //     ->middleware(['signed', 'throttle:6,1'])
    //     ->name('verification.verify');

    // Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    //     ->middleware('throttle:6,1')
    //     ->name('verification.send');

    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    //     ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::get('/dashboard', function () {
        $data = FarmingNeed::all();
        return view('mitra.dashboard', compact('data'));
    })->name('mitra.dashboard');

    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('mitra.logout');
    
    Route::get('/product', function () {
        return view('mitra.add_product');
    })->name('mitra.add_product');

    Route::post('/product', [FarmingNeedsController::class, 'store'])->name('produk.store');
    Route::get('/toko', [FarmingNeedsController::class, 'index'])->name('mitra.check_store');
    Route::get('/toko/{id}', [FarmingNeedsController::class, 'detail'])->name('farming_needs.detail');
    Route::put('/toko/{id}', [FarmingNeedsController::class, 'update'])->name('mitra.update_product');
    Route::delete('/toko/{id}', [FarmingNeedsController::class, 'destroy'])->name('mitra.delete_product');

});
