<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('layouts.auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function loginproses(Request $request)
    {

        // Validasi input
        $validatedData = $request->validate([
            'email' => 'required|email', // Validasi email
            'password' => 'required|min:6', // Validasi password
        ]);

        // Proses login
        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            // Jika login berhasil, redirect ke dashboard
            return redirect()->route('dashboard');
        } else {
            // Jika login gagal, redirect kembali ke halaman login dengan error
            return redirect()->route('login')->withErrors(['email' => 'Email atau password salah.']);
        }
    }
}
