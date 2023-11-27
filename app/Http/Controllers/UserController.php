<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserApp;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $pengguna = User::with('roles')->paginate(10);

        return view('pengguna.index', [ 'pengguna' => $pengguna ]);
    }

    public function create()
    {
        $penggunaApp = UserApp::select('kode', 'nama')->get();
        $roles = Role::all();

        return view('pengguna.create', [ 'penggunaApp' => $penggunaApp, 'roles' => $roles ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'email' => 'required|unique:pengguna_web,email',
            'password' => 'required',
            'roles' => 'required',
        ], [
            'kode.required' => 'Kode wajib diisi',
            'nama.required' => 'Nama wajib diisi',
            'jabatan.required' => 'Nama wajib diisi',
            'email.required' => 'email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'password wajib diisi',
            'roles.required' => 'Role wajib diisi',
        ]);

        try {
            $user = User::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $roles = Role::whereIn('id', $request->roles)->first();
            $user->assignRole($roles);

            return redirect()->to('/pengguna')->with('success', 'Pengguna Berhasil Disimpan');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(User $pengguna)
    {
        try {
            $penggunaApp = UserApp::select('kode', 'nama')->get();
            $roles = Role::all();

            return view('pengguna.edit', [ 'pengguna' => $pengguna, 'penggunaApp' => $penggunaApp, 'roles' => $roles ]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'email' => 'required|unique:pengguna_web,email,' . $user->id,
            'password' => 'nullable',
            'roles' => 'required',
        ], [
            'kode.required' => 'Kode wajib diisi',
            'nama.required' => 'Nama wajib diisi',
            'jabatan.required' => 'Nama wajib diisi',
            'email.required' => 'email wajib diisi',
            'password.required' => 'password wajib diisi',
            'roles.required' => 'Role wajib diisi',
        ]);

        try {
            if($request->password == '') {
                $user->update([
                    'kode' => $request->kode,
                    'nama' => $request->nama,
                    'jabatan' => $request->jabatan,
                    'email' => $request->email,
                ]);
            } else {
                $user->update([
                    'kode' => $request->kode,
                    'nama' => $request->nama,
                    'jabatan' => $request->jabatan,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }

            $roles = Role::whereIn('id', $request->roles)->first();
            $user->syncRoles($roles);

            return redirect()->to('/pengguna')->with('success', 'Pengguna Berhasil Diupdate');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pengguna = User::findOrFail($id);
            $pengguna->delete();

            return redirect()->to('/pengguna')->with('success', 'Pengguna Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()->to('/pengguna')->with('error', $e->getMessage());
        }
    }
}
