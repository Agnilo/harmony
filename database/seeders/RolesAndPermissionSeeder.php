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
            'create-leaveRequest', 'edit-leaveRequest', 'delete-leaveRequest',
            'approve-leaveRequest',

        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        function findOrCreateRole($roleName)
        {
            $role = Role::where('name', $roleName)->first();

            if (!$role) {
                $role = Role::create(['name' => $roleName]);
            }

            return $role;
        }

        $superUserRole = findOrCreateRole('SuperUser');
        $adminRole = findOrCreateRole('Admin');
        $userRole = findOrCreateRole('User');

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'approve-leaveRequest',
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
            'approve-leaveRequest',
            'create-leaveRequest',
            'edit-leaveRequest',
            'delete-leaveRequest',
        ]);

        $userRole->givePermissionTo([
            'create-leaveRequest',
            'edit-leaveRequest',
            'delete-leaveRequest',
        ]);
    }
}
