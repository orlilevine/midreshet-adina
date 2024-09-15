<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiurController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SpeakerController;


Route::get('/', function () {return view('welcome');});

Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

Route::get('/home', function () {return view('home');})->name('home');


Route::get('/about', function () {return view('about');})->name('about');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/series/{seriesId}/shiur/{shiurId}', [ShiurController::class, 'show'])->name('shiur.show');

Route::get('/purchase/{shiur_id}', [PurchaseController::class, 'create'])->name('purchase');


Route::get('/gallery', function () {return view('gallery');})->name('gallery');

Route::get('/contact', function () {return view('contact');})->name('contact');

Route::get('/speakers/mrs-shira-smiles', [SpeakerController::class, 'mrsShiraSmiles'])->name('speakers.smiles');
Route::get('/speakers/mrs-dina-schoonmaker', [SpeakerController::class, 'mrsDinaSchoonmaker'])->name('speakers.schoonmaker');
Route::get('/speakers/rabbi-avi-slansky', [SpeakerController::class, 'rabbiAviSlansky'])->name('speakers.slansky');

Route::get('/series/{id}', [SeriesController::class, 'showSeries'])->name('series.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/shiurs/create', [ShiurController::class, 'create'])->name('shiur.create');
    Route::post('/admin/shiurs', [ShiurController::class, 'store'])->name('shiur.store');
    // Other admin routes
});

Route::get('/user/purchases', [UserController::class, 'purchases'])->name('user.purchases');


require __DIR__.'/auth.php';
