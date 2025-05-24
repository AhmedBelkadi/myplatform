<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // 🔹 Créer les rôles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $supporter = Role::firstOrCreate(['name' => 'supporter']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // 🔐 Créer les permissions
        $permissions = [
            'manage users',
            'manage roles',
            'manage permissions',
            'view posts',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 🔗 Attribuer permissions
        $admin->syncPermissions($permissions);
        $supporter->syncPermissions(['view posts']);
        // Le rôle user n’a pas besoin de permissions ici

        // 👤 Créer l'admin
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
            ]
        );
        $adminUser->assignRole('admin');

        // 👤 Créer le supporter
        $supportUser = User::firstOrCreate(
            ['email' => 'supporter@gmail.com'],
            [
                'name' => 'Support User',
                'password' => Hash::make('support123'),
            ]
        );
        $supportUser->assignRole('supporter');

        // 👤 Créer l'utilisateur simple
        $basicUser = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Basic User',
                'password' => Hash::make('user123'),
            ]
        );
        $basicUser->assignRole('user');
    }
}
