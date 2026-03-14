<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إنشاء الصلاحيات (Permissions)
        $permissions = [
            'manage exams',
            'view exams',
            'manage questions',
            'solve exams',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // 2. إنشاء الأدوار (Roles) وربطها بالصلاحيات
        $adminRole = Role::findOrCreate('admin');
        $adminRole->givePermissionTo(Permission::all());

        $studentRole = Role::findOrCreate('student');
        $studentRole->givePermissionTo(['view exams', 'solve exams']);

        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin@gmail.com'),
            ]
        );
        $admin->assignRole($adminRole);

        $student = User::updateOrCreate(
            ['email' => 'student@gmail.com'],
            [
                'name' => 'Student User',
                'password' => Hash::make('student@gmail.com'),
            ]
        );
        $student->assignRole($studentRole);
    }
}