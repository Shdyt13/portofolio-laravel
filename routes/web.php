<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Mengarah ke HomeController
Route::get('/', [HomeController::class, 'index'])->name('home');

// Mengirim pesan dari form Contact
Route::post('/contact', [HomeController::class, 'sendMessage'])
    ->name('contact.send');

// Route fallback untuk login panel admin Filament
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');