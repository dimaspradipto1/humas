<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function login()
    {
        return view('layouts.auth.login3');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function loginproses(Request $request)
    {

        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email': 'no_unik';

        $validatedData = $request->validate([
            'login' => 'required',
             'password' => 'required'
        ]);

        if (Auth::attempt([$loginField=>$validatedData['login'], 'password'=>$validatedData['password']])) {
            Alert::success('Success', 'Anda berhasil login')->autoclose(2000)->toToast();
            return redirect(route('dashboard'));
        } else {
            Alert::error('Error', 'Username atau Password Salah')->autoclose(2000)->toToast();
            return redirect(route('login'));
        }
    }
}
