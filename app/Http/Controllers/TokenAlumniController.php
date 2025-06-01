<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\TokenAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TokenAlumniController extends Controller
{
    public function showForm()
    {
        return view('alumni.request-token-alumni');
    }

    public function requestToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        // Ambil data alumni berdasarkan email
        $alumni = Alumni::where('email', $email)->first();

        if (!$alumni) {
            return response()->json(['message' => 'Email tidak terdaftar'], 404);
        }

        // Buat token random 12 digit
        $token = '';
        for ($i = 0; $i < 12; $i++) {
            $token .= rand(0, 9);
        }

        // Simpan token dengan alumni_id yang valid
        TokenAlumni::create([
            'alumni_id' => $alumni->alumni_id,  // wajib diisi supaya tidak null
            'email' => $email,
            'token' => $token,
            'expires_at' => Carbon::now()->addMonths(1),
        ]);

        // $link = url('/login-by-token?token=' . $token);

        return response()->json([
            'message' => 'Token berhasil dibuat, cek email kamu!',
            'token' => $token,
        ]);
    }
}
