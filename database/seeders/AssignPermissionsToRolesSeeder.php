<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AssignPermissionsToRolesSeeder extends Seeder
{
    public function run()
    {
        // Retrieve roles
        $adminRole = Role::findByName('admin');
        $teacherRole = Role::findByName('teacher');
        $studentRole = Role::findByName('student');
        $parentRole = Role::findByName('parent');

        // Existing permissions
        $existingPermissions = [
            'Admin_Access',
            'Manage_User',
            'Manage_School',
            'Manage_Class',
            'Manage_Exam',
            'Manage_Subject',
            'Manage_Result',
            'View_Result',
            'View_Info',
            'Manage_Permission',
            'Manage_Notice',
        ];

        // Assign existing permissions to roles
        $adminRole->givePermissionTo($existingPermissions);

        $teacherRole->givePermissionTo([
            'Manage_Class',
            'Manage_Result',
            'View_Result',
        ]);

        $studentRole->givePermissionTo([
            'View_Info',
            'View_Result',
        ]);

        $parentRole->givePermissionTo([
            'View_Info',
            'View_Result',
        ]);
    }
}
