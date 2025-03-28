<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the guard name
        $guardAdmin = 'admin';
        $guardWeb = 'web';

        Permission::firstOrCreate(['name' => 'edit articles', 'guard_name' => $guardAdmin]);
        Permission::firstOrCreate(['name' => 'delete articles', 'guard_name' => $guardAdmin]);

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => $guardAdmin]);
        $user = Role::firstOrCreate(['name' => 'user', 'guard_name' => $guardWeb]);

        $admin->syncPermissions(['edit articles', 'delete articles']);

        Permission::firstOrCreate(['name' => 'edit articles', 'guard_name' => $guardWeb]); // Ensure existence
        $user->syncPermissions(['edit articles']);
    }
}
