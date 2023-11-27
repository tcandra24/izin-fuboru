<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'kode'      => '230100001',
            'nama'      => 'Administrator',
            'jabatan'   => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('mismis'),
        ]);

        $permissions = Permission::all();
        $role = Role::where('name', 'admin')->first();
        $role->syncPermissions($permissions);
        $user->assignRole($role);
    }
}
