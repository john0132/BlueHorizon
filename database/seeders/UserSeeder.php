<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure required roles exist
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $superAdminRole = Role::firstOrCreate(['name' => 'super admin', 'guard_name' => 'web']);

        // Give super admin role all permissions in the system
        $allPermissions = Permission::all();
        if ($allPermissions->isNotEmpty()) {
            $superAdminRole->syncPermissions($allPermissions);
        }

        // Create or update the specified Super Admin user
        $superAdminUser = User::updateOrCreate(
            ['email' => 'john.osama.baky@gmail.com'],
            [
                'name' => 'John Osama',
                // If the model uses the 'hashed' cast, this will be hashed automatically
                'password' => '123456',
            ]
        );

        // Assign super admin role to the specified user
        $superAdminUser->syncRoles([$superAdminRole->name]);

        // Assign admin role to all other users
        User::where('id', '!=', $superAdminUser->id)->each(function (User $user) use ($adminRole) {
            $user->syncRoles([$adminRole->name]);
        });
    }
}
