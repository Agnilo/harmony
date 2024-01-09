<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    public function run()
    {

        $permissions = [
            'create-users', 'edit-users', 'delete-users',
            'create-admin', 'edit-admin', 'delete-admin',
            'create-benefit', 'edit-benefit', 'delete-benefit',
            
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $superUserRole = Role::create(['name' => 'Super User']);
        $adminRole = Role::create(['name' => 'Admin']);
        $user = Role::create(['name' => 'User']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
        ]);

        $superUserRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-admin',
            'edit-admin',
            'delete-admin',
            'create-benefit',
            'edit-benefit',
            'delete-benefit',
        ]);
    }
}