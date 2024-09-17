<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiurController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;



Route::redirect('/', '/home');

Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

Route::get('/home', function () {return view('home');})->name('home');


Route::get('/about', function () {return view('about');})->name('about');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/series/{seriesId}/shiur/{shiurId}', [ShiurController::class, 'show'])->name('shiur.show');

Route::get('/gallery', function () {return view('gallery');})->name('gallery');

Route::get('/contact', function () {return view('contact');})->name('contact');

Route::get('/speakers/mrs-shira-smiles', [SpeakerController::class, 'mrsShiraSmiles'])->name('speakers.smiles');
Route::get('/speakers/mrs-dina-schoonmaker', [SpeakerController::class, 'mrsDinaSchoonmaker'])->name('speakers.schoonmaker');
Route::get('/speakers/rabbi-avi-slansky', [SpeakerController::class, 'rabbiAviSlansky'])->name('speakers.slansky');

Route::get('/series/{id}', [SeriesController::class, 'showSeries'])->name('series.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/shiur/create', [AdminController::class, 'createShiur'])->name('admin.shiur.create');
    Route::post('/admin/shiurs', [AdminController::class, 'storeShiur'])->name('shiur.store');

    Route::get('/admin/series/create', [AdminController::class, 'createSeries'])->name('admin.series.create');
    Route::post('/admin/series/store', [AdminController::class, 'storeSeries'])->name('admin.series.store');

    Route::get('/admin/speaker/create', [AdminController::class, 'createSpeaker'])->name('admin.speaker.create');
    Route::post('/admin/speaker/store', [AdminController::class, 'storeSpeaker'])->name('admin.speaker.store');

    Route::get('/fetch-series', [AdminController::class, 'fetchSeries'])->name('fetch.series');

});


Route::get('/purchased-series', [UserController::class, 'purchases'])->name('user.purchases');
Route::get('/user/series/{id}', [UserController::class, 'showSeries'])->name('user.series.show');

Route::get('/purchase/{shiurId}', [PaymentController::class, 'createCheckoutSession'])->name('payment.createSession');
Route::get('/payment/success/{shiurId}', [PaymentController::class, 'paymentSuccess'])->name('payments.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payments.cancel');


Route::get('/admin/speaker-stats', [AdminController::class, 'getSpeakerShiurStats'])->name('admin.speakerStats');

require __DIR__.'/auth.php';
