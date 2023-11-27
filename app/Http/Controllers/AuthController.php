<?php

namespace App\Http\Controllers;

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
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials, $request->remember)) {
                throw new \Exception('Login Gagal, Username/Password salah');
            }

            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            return back()->with('login-error', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
