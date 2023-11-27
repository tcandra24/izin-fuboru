<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'dashboard.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'izin-keluar.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'transaction-izin-keluar.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'pengguna.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'pengguna.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'pengguna.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'pengguna.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'permissions.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'log-approval.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'roles.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.delete', 'guard_name' => 'web']);
    }
}
