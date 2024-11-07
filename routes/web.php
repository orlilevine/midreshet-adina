<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiurController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\Auth\RegisteredUserController;



Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

Route::get('/home',[HomeController::class, 'index'])->name('home');


Route::get('/about', function () {return view('navbar.about');})->name('about');

Route::get('/series/{seriesId}/shiur/{shiurId}', [ShiurController::class, 'show'])->name('shiur.show');

Route::get('/schedule', function () {return view('navbar.schedule');})->name('schedule');

Route::get('/contact', function () {return view('navbar.contact');})->name('contact');
Route::post('/contact', [ContactController::class, 'submitMessage'])->name('contact.submit');

Route::get('/speakers/{speakerId}', [SpeakerController::class, 'showSpeaker'])->name('speakers.show');

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

    Route::get('/admin/shiur-stats', [AdminController::class, 'showShiurStats'])->name('admin.shiurStats');
    Route::get('/admin/shiur-stats/{shiur_id}', [AdminController::class, 'getShiurStats']);

    Route::get('admin/shiur/edit', [AdminController::class, 'editShiur'])->name('admin.shiur.edit');
    Route::post('admin/shiur/update/{shiur}', [AdminController::class, 'updateShiur'])->name('admin.shiur.update');
    Route::get('admin/shiur/edit/{shiur}', [AdminController::class, 'editShiurForm'])->name('admin.shiur.editForm');

    Route::get('admin/series/edit', [AdminController::class, 'editSeries'])->name('admin.series.edit');
    Route::put('/admin/series/update/{id}', [AdminController::class, 'updateSeries'])->name('admin.series.update');
    Route::get('admin/series/edit/{series}', [AdminController::class, 'editSeriesForm'])->name('admin.series.editForm');

    Route::get('/admin/messages', [AdminController::class, 'showMessages'])->name('admin.messages');


});

Route::get('/purchased-series', [UserController::class, 'purchases'])->name('user.purchases');
Route::get('/user/series/{id}', [UserController::class, 'showSeries'])->name('user.series.show');

Route::get('/payment/success/{shiurId}', [PaymentController::class, 'paymentSuccess'])->name('payments.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payments.cancel');
Route::get('/payment/success/series/{seriesId}', [PaymentController::class, 'paymentSuccessSeries'])->name('payments.success.series');
Route::get('/purchase/shiur/{shiurId}', [PaymentController::class, 'createCheckoutSessionForShiur'])->name('payment.createSession.shiur');
Route::get('/purchase/series/{seriesId}', [PaymentController::class, 'createCheckoutSessionForSeries'])->name('payment.createSession.series');

Route::post('/payment/zelle/series', [PaymentController::class, 'handleZellePaymentSeries'])->name('payment.zelle.series');
Route::post('/payment/check/series', [PaymentController::class, 'handleCheckPaymentSeries'])->name('payment.check.series');

Route::post('/payment/zelle/shiur', [PaymentController::class, 'handleZellePaymentShiur'])->name('payment.zelle.shiur');
Route::post('/payment/check/shiur', [PaymentController::class, 'handleCheckPaymentShiur'])->name('payment.check.shiur');


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

/*Route::get('/user/join-daily', [DailyController::class, 'joinDailyMeeting'])->name('user.series.join');*/
Route::get('/daily-meeting/{id}', [DailyController::class, 'joinDailyMeeting'])->name('daily.meeting');

Route::get('/mission', function () {return view('navbar.mission');})->name('mission');

require __DIR__.'/auth.php';
