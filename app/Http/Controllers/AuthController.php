<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|string',
        ]);

        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard.index');
            } elseif ($user->role == 'user') {
                return redirect()->route('user.home.index');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        }
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi data permintaan
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Jika validasi gagal, arahkan kembali dengan kesalahan
        if ($validator->fails()) {
            return redirect()->route('register-view')
                ->withErrors($validator)
                ->withInput();
        }

        // Buat susunan data pengguna
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ];

        // Buat pengguna
        User::create($data);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi Berhasil');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.home.index');
    }
}
