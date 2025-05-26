<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Roles
        $adminRole = Role::where('name', 'Administrateur')->first();
        $supportRole = Role::where('name', 'Support')->first();
        $userRole = Role::where('name', 'Utilisateur')->first();

        // 2. Define Permissions
        $permissions = [
            // User
            'create_ticket',
            'reply_ticket',

            // Admin Ticket
            'view_all_tickets',
            'assign_ticket',
            'close_ticket',

            // User Management
            'manage_users',
            'manage_roles',
            'manage_permissions',

            // Profiles (optional, if needed)
            'view_profile',
            'update_profile',
            'update_password',

            // Dashboards
            'view_admin_dashboard',
            'view_support_dashboard',
        ];

        // 3. Create Permissions and store in collection
        $permissionIds = [];
        foreach ($permissions as $perm) {
            $permission = Permission::firstOrCreate(['name' => $perm]);
            $permissionIds[$perm] = $permission->id;
        }

        // 4. Assign permissions
        $adminRole->permissions()->sync(array_values($permissionIds)); // All permissions

        $supportRole->permissions()->sync([
            $permissionIds['view_all_tickets'],
            $permissionIds['reply_ticket'],
            $permissionIds['close_ticket'],
            $permissionIds['view_profile'],
            $permissionIds['update_profile'],
            $permissionIds['update_password'],
            $permissionIds['view_support_dashboard'],
        ]);
        
        $userRole->permissions()->sync([
            $permissionIds['view_all_tickets'],
            $permissionIds['create_ticket'],
            $permissionIds['reply_ticket'],
            $permissionIds['view_profile'],
            $permissionIds['update_profile'],
            $permissionIds['update_password'],
        ]);

    }
}
