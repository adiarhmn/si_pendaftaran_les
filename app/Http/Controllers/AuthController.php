<?php

namespace App\Http\Controllers;

use App\Models\AkunModel;
use App\Models\PesertaModel;
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

            // Redirect based on user level
            if (Auth::user()->level == 'admin') {
                return redirect()->intended('/admin/dashboard')->with('success', 'Berhasil login');
            } elseif (Auth::user()->level == 'petugas') {
                return redirect()->intended('/petugas/dashboard')->with('success', 'Berhasil login');
            } elseif (Auth::user()->level == 'peserta') {
                return redirect()->intended('/peserta/dashboard')->with('success', 'Berhasil login');
            }
        }
        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout');
    }

    // Register for Peserta
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|alpha_num|unique:akun,username',
            'password' => 'required',
            'nama_peserta' => 'required',
            'telp' => 'required|numeric|unique:peserta,telp',
            'alamat' => 'required',
        ]);

        // Create Akun
        $user = new AkunModel();
        $user->username = $request->username;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->level = 'peserta';
        $user->save();

        // Create Peserta
        $peserta = new PesertaModel();
        $peserta->id_akun = $user->id_akun;
        $peserta->nama_peserta = $request->nama_peserta;
        $peserta->telp = $request->telp;
        $peserta->alamat = $request->alamat;
        $peserta->save();

        return redirect('/login')->with('success', 'Berhasil register');
    }
}
