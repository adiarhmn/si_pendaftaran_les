<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        // Validate the form data
        $request->validate([
            'username' => 'required|alpha_num',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->level == 'admin') {
                return redirect()->intended('/admin')->with('success', 'Berhasil login');
            } else {
                return redirect()->intended('/');
            }
            return redirect()->intended('/');
        }
        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout');
    }
}
