<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Certificate;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Service;
use Illuminate\Support\Facades\Mail; // <-- Tambahkan ini
use App\Mail\ContactFormMail;

class HomeController extends Controller
{
    public function index()
    {
        // Data Proyek (Hanya yang visible)
        $projects = Project::with('skills')
                           ->where('is_visible', true)
                           ->orderBy('display_order')
                           ->get();

        // Data Keahlian (Skills)
        $skills = Skill::all();

        // Data Sertifikat
        $certificates = Certificate::all();

        // Data Services
        $services = Service::all();

        // Ambil data profil pertama dari database
        $profile = Profile::first();

        // Jika profil belum diisi di Admin, berikan data kosong default yang mencakup semua properti
        if (!$profile) {
            $profile = (object) [
                'name' => 'Sapar Hidayat. S',
                'title' => 'Informatics Engineering Student',
                'about' => 'Deskripsi belum diatur. Silakan isi melalui panel Admin.',
                'short_description' => 'Deskripsi singkat belum diatur.',
                'full_description' => 'Deskripsi lengkap belum diatur.',
                'avatar' => null,
                'photo' => null,
                'email' => null,
                'location' => null,
                'github_url' => '#',
                'linkedin_url' => '#',
                'instagram_url' => '#',
                'cv_link' => '#',
            ];
        }

        return view('welcome', compact(
            'profile',
            'projects',
            'skills',
            'certificates',
            'services'
        ));
    }

    public function sendMessage(Request $request)
    {
        // 1. Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // 2. Simpan ke database
        Message::create($validatedData);

        // 3. Kirim email notifikasi ke email Anda
        Mail::to('saparhdyt13@gmail.com')->send(new ContactFormMail($validatedData));

        // 4. Redirect kembali dengan pesan sukses
        return redirect('/#contact')
            ->with('success', 'Pesan Anda berhasil dikirim!');
    }
}