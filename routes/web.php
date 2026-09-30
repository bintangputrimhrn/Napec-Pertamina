<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MediaRegistrationController;
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