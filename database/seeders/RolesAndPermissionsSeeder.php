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

        // 2. Permissions
        $permissions = [
            'create_ticket',
            'view_all_tickets',
            'assign_ticket',
            'manage_users',
            'manage_roles',
            'manage_permissions',
            'close_ticket',
            'reply_ticket',
        ];

        foreach ($permissions as $perm) {
            Permission::create([
                'name' => $perm
            ]);
        }

        // 3. Assign permissions to roles
        $adminRole->permissions()->attach(Permission::pluck('id')->toArray()); // all perms
        $supportRole->permissions()->attach([
            Permission::where('name', 'view_all_tickets')->first()->id,
            Permission::where('name', 'assign_ticket')->first()->id,
            Permission::where('name', 'close_ticket')->first()->id,
            Permission::where('name', 'reply_ticket')->first()->id,
        ]);
        $userRole->permissions()->attach([
            Permission::where('name', 'create_ticket')->first()->id,
        ]);
    }
}
