<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; // Asumsi model Anda bernama Message

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi data yang dikirim user
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // 2. Simpan ke database (agar masuk ke panel admin Filament)
        Message::create($validated);

        // 3. (Opsional) Jika Anda ingin mengirim notifikasi ke email pribadi, logika Mail bisa diletakkan di sini nanti.

        // 4. Kembalikan user ke halaman depan dengan pesan sukses
        return redirect('/#contact')->with('success', 'Pesan Anda berhasil dikirim! Saya akan segera merespons ke email Anda.');
    }
}