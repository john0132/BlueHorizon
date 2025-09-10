<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Determine guard name
        $guard = 'web';

        // Permissions inferred from Filament Shield config for RoleResource
        $actions = [
            'ViewAny',
            'View',
            'Create',
            'Update',
            'Delete',
        ];

        $permissionNames = [];
        foreach ($actions as $action) {
            // Using config: separator ':' and case 'pascal' => e.g., 'ViewAny:Role'
            $name = sprintf('%s:Role', $action);
            $permission = Permission::firstOrCreate([
                'name' => $name,
                'guard_name' => $guard,
            ]);
            $permissionNames[] = $permission->name;
        }

        // Ensure roles exist
        $superAdmin = Role::firstOrCreate(['name' => 'super admin', 'guard_name' => $guard]);
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => $guard]);

        // Assign RoleResource permissions to roles as baseline
        $admin->syncPermissions(array_unique(array_merge($admin->permissions->pluck('name')->all(), $permissionNames)));

        // Super admin gets everything; also ensure these are included
        $superAdmin->givePermissionTo($permissionNames);
    }
}
