<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PotatoDiseaseController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ChatbotController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('public.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get(('/belanja'), [UserProfileController::class, 'index'])->name('belanja');
Route::get('/belanja/search', [UserProfileController::class, 'search'])->name('belanja.search');

Route::get('/cart', [UserProfileController::class, 'viewCart'])->name('cart');
Route::post('/cart/add/{id}', [UserProfileController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/checkout', [UserProfileController::class, 'checkout'])->name('cart.checkout');
Route::patch('/cart/update/{id}', [UserProfileController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [UserProfileController::class, 'removeFromCart'])->name('cart.remove');
// Route::get('/add-balance', [UserProfileController::class, 'showAddBalanceForm'])->name('add_balance');
// Route::post('/add-balance', [UserProfileController::class, 'addBalance'])->name('add_balance.store');
Route::post('/add_balance', [UserProfileController::class, 'addBalance'])->name('add_balance');




Route::get(('/panen'), function () {
    return view('public.crop_prediction');
})->name('panen');

Route::get(('/cek_tanaman'), function () {
    return view('public.potatodisease_prediction');
})->name('cek_tanaman');

Route::post('/cek_tanaman/hasil', [PotatoDiseaseController::class, 'detect']);

Route::get('/chatbot', function () {
    return view('public.chatbot');
})->name('chatbot');
Route::post('/chatbot', [ChatbotController::class, 'ask']);

Route::get('/chatbot/upload', function () {
    return view('public.chatbot_upload');
})->name('chatbot_upload');
Route::post('/chatbot/upload', [ChatbotController::class, 'uploads']);

 
require __DIR__.'/auth.php';
require __DIR__.'/mitra-auth.php';
