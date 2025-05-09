<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Level;
use App\Models\Alumni;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required', // ini bisa nama atau nim
            'password' => 'required',
        ]);

        // Cek ke tabel Admin (berdasarkan nama)
        $admin = Admin::where('nama', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('id', $admin->admin_id);
            Session::put('level', 'Admin');
            Session::put('nama', $admin->nama);

            return view('admin.index');
        }

        // Cek ke tabel Alumni (berdasarkan nim)
        $alumni = Alumni::where('nim', $request->username)->first();
        if ($alumni && Hash::check($request->password, $alumni->password)) {
            Session::put('id', $alumni->alumni_id);
            Session::put('level', 'Alumni');
            Session::put('nama', $alumni->nama);

            return view('alumni.index');
        }

        // Kalau gagal semua
        return back()->withErrors(['username' => 'Username/NIM atau password salah!'])->withInput();
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}