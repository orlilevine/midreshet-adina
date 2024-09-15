<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiurController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SeriesController;


Route::get('/', function () {return view('welcome');});

Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

Route::get('/home', function () {return view('home');})->name('home');


Route::get('/about', function () {return view('about');})->name('about');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/shiurim', [ShiurController::class, 'index'])->name('shiurs.index');

Route::get('/purchase/{shiur_id}', [PurchaseController::class, 'create'])->name('purchase');


Route::get('/gallery', function () {return view('gallery');})->name('gallery');

Route::get('/contact', function () {return view('contact');})->name('contact');

Route::get('/shiurim/mrs-shira-smiles', [ShiurController::class, 'mrsShiraSmiles'])->name('shiurs.smiles');
Route::get('/shiurim/mrs-dina-schoonmaker', [ShiurController::class, 'mrsDinaSchoonmaker'])->name('shiurs.schoonmaker');
Route::get('/shiurim/rabbi-avi-slansky', [ShiurController::class, 'rabbiAviSlansky'])->name('shiurs.slansky');

Route::get('/series/{id}', [SeriesController::class, 'showSeries'])->name('series.show');


require __DIR__.'/auth.php';
