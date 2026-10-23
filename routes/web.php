<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MediaRegistrationController;
use App\Http\Controllers\CsrStemEdufunRegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Visitor Feedback
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('feedback.form');
});

Route::get('/form', [FeedbackController::class, 'index'])
    ->name('feedback.form');

Route::post('/form', [FeedbackController::class, 'store'])
    ->name('feedback.store');

/*
|--------------------------------------------------------------------------
| Visitor Feedback Success
|--------------------------------------------------------------------------
*/

Route::get('/success', [FeedbackController::class, 'success'])
    ->name('feedback.success');

/*
|--------------------------------------------------------------------------
| Media Registration
|--------------------------------------------------------------------------
*/

Route::get('/media', [MediaRegistrationController::class, 'create'])
    ->name('media.form');

Route::post('/media', [MediaRegistrationController::class, 'store'])
    ->name('media.store');

/*
|--------------------------------------------------------------------------
| CSR STEM EDUFUN
|--------------------------------------------------------------------------
*/

Route::get('/edufun', [CsrStemEdufunRegistrationController::class, 'create'])
    ->name('csr-stem-edufun.create');

Route::post('/edufun', [CsrStemEdufunRegistrationController::class, 'store'])
    ->name('csr-stem-edufun.store');

Route::get('/edufun/success', function (\Illuminate\Http\Request $request) {
    if (!$request->session()->pull('edufun_registration_success')) {
        return redirect()->route('csr-stem-edufun.create');
    }

    return view('csr-stem-edufun.success');
})->name('csr-stem-edufun.success');