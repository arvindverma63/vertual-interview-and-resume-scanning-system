<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home'); // better to call it 'home' instead of 'index'

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/testimonial', [PageController::class, 'testimonials'])->name('testimonial');
Route::get('/quote', [PageController::class, 'quote'])->name('quote');
Route::get('/feature', [PageController::class, 'feature'])->name('feature');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/service', [PageController::class, 'service'])->name('service');
Route::get('/feature',[PageController::class,'feature'])->name('feature');
Route::get('/careers',[PageController::class,'careers'])->name('careers');
