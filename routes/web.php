<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Gallery;

// Mengarah ke HomeController
Route::get('/', [HomeController::class, 'index'])->name('home');

// Mengirim pesan dari form Contact
Route::post('/contact/send', [HomeController::class, 'sendMessage'])->name('contact.send');

// Route fallback untuk login panel admin Filament
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

Route::get('/gallery', function () {
    // Mengambil data galeri, asumsikan ada kolom is_visible dan diurutkan dari yang terbaru
    $galleries = Gallery::where('is_visible', true)->latest()->get(); 
    
    return view('gallery', compact('galleries'));
})->name('gallery');