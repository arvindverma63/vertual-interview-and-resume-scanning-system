<?php

use App\Http\Controllers\CareerController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home'); // better to call it 'home' instead of 'index'

use App\Http\Controllers\VideoAnswerController;

Route::post('/video-answers', [VideoAnswerController::class, 'store'])->name('video-answers.store');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/testimonial', [PageController::class, 'testimonials'])->name('testimonial');
Route::get('/quote', [PageController::class, 'quote'])->name('quote');
Route::get('/feature', [PageController::class, 'feature'])->name('feature');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/service', [PageController::class, 'service'])->name('service');
Route::get('/feature', [PageController::class, 'feature'])->name('feature');
Route::get('/careers', [PageController::class, 'careers'])->name('careers');
Route::post('/career/store', [CareerController::class, 'store'])->name('career.store');
Route::get('/interview', [PageController::class, 'interview'])->name('interview');

use App\Http\Controllers\InterviewController;

// Route to display the form
Route::get('/interview-form', function () {
    return view('interview_form');
})->name('interview-form');

// Route to handle form submission
Route::post('/send-interview-invitation', [InterviewController::class, 'sendInvitation'])->name('send-interview-invitation');
Route::get('/career/response', [CareerController::class, 'index'])->name('career.index');
