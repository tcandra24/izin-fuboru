<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\User;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('profile.change-password.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirm' => 'required|min:8|same:password',
        ], [
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Minimal Panjang Password 8 Karakter',
            'password_confirm.required' => 'Konfirmasi Password wajib diisi',
            'password_confirm.min' => 'Minimal Panjang Konfirmasi Password 8 Karakter',
            'password_confirm.same' => 'Password Harus Sama',
        ]);

        try {
            $id = Auth::user()->id;
            User::where('id', $id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->to('/profile/change-password')->with('success', 'Password Berhasil Diupdate');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }
}
