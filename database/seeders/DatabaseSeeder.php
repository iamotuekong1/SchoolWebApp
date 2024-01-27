<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed roles and permissions
        $this->seedRolesAndPermissions();

        $adminRole = Role::where('name', 'admin')->first();
        $user = \App\Models\User::first();
        
        if ($user) {
            $user->assignRole($adminRole);
        }
    

        // Additional seeders if needed...

        // \App\Models\User::factory(10)->create();
    }

    /**
     * Seed roles and permissions.
     *
     * @return void
     */
    private function seedRolesAndPermissions()
    {
        // Role creation
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'student']);
        Role::create(['name' => 'parent']);

        // Permission creation
        Permission::create(['name' => 'admin.access']);
        Permission::create(['name' => 'user.manage']);
        Permission::create(['name' => 'user.assign_roles']);
        Permission::create(['name' => 'user.update_profile']);
        
        // Assign permissions to roles
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->givePermissionTo('admin.access', 'user.manage', 'user.assign_roles', 'user.update_profile');

        // Assign other permissions to roles as needed...
    }
}
