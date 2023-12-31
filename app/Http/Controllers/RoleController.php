<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);

        return view('roles.index', [ 'roles' => $roles ]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required'
        ]);

        try {
            $role = Role::create(['name' => $request->name]);

            $role->givePermissionTo($request->permissions);

            return redirect()->to('/roles');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

    public function edit($id)
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);

            $permissions = Permission::all();
            return view('roles.edit', [
                'role' => $role,
                'permissions' => $permissions
            ]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required'
        ]);

        try {
            $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permissions);

            return redirect()->to('/roles');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->to('/roles');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

}
