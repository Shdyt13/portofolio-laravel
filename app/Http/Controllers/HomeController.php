<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Certificate;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Service;

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

        // Jika profil belum diisi di Admin, berikan data kosong default
        if (!$profile) {
            $profile = (object) [
                'name' => 'Nama Belum Diatur',
                'title' => 'Profesi Belum Diatur',
                'about' => 'Deskripsi belum diatur. Silakan isi melalui panel Admin.',
                'avatar' => null,
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Message::create($request->all());

        return redirect('/#contact')
            ->with('success', 'Pesan Anda berhasil dikirim!');
    }
}