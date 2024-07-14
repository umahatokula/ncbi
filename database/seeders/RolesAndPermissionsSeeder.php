<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // USERS
        $createuser = Permission::create(['name' => 'create user']);
        $readuser = Permission::create(['name' => 'read user']);
        $updateuser = Permission::create(['name' => 'update user']);
        $deleteuser = Permission::create(['name' => 'delete user']);

        $createstudent = Permission::create(['name' => 'create student']);
        $readstudent = Permission::create(['name' => 'read student']);
        $updatestudent = Permission::create(['name' => 'update student']);
        $deletestudent = Permission::create(['name' => 'delete student']);

        $createexamquestion = Permission::create(['name' => 'create exam question']);
        $readexamquestion = Permission::create(['name' => 'read exam question']);
        $updateexamquestion = Permission::create(['name' => 'update exam question']);
        $deleteexamquestion = Permission::create(['name' => 'delete exam question']);

        $createexamscore = Permission::create(['name' => 'create exam score']);
        $readexamscore = Permission::create(['name' => 'read exam score']);
        $updateexamscore = Permission::create(['name' => 'update exam score']);
        $deleteexamscore = Permission::create(['name' => 'delete exam score']);

        // ROLES
        $superadmin = Role::create(['name' => 'super admin'])->syncPermissions([]);

        $developerRole = Role::create(['name' => 'developer'])->syncPermissions([
            $createuser,
            $readuser,
            $updateuser,
            $deleteuser,
            $createstudent,
            $readstudent,
            $updatestudent,
            $deletestudent,
            $createexamquestion,
            $readexamquestion,
            $updateexamquestion,
            $deleteexamquestion,
            $createexamscore,
            $readexamscore,
            $updateexamscore,
            $deleteexamscore,
        ]);
        $generaloverseer = Role::create(['name' => 'generaloverseer'])->syncPermissions([
            $createstudent,
            $readstudent,
            $updatestudent,
            $deletestudent,
            $createexamquestion,
            $readexamquestion,
            $updateexamquestion,
            $deleteexamquestion,
            $createexamscore,
            $readexamscore,
            $updateexamscore,
            $deleteexamscore,
        ]);
        $coordinatorchurches = Role::create(['name' => 'director'])->syncPermissions([
            $createuser,
            $readuser,
            $updateuser,
            $deleteuser,
            $createstudent,
            $readstudent,
            $updatestudent,
            $deletestudent,
            $createexamquestion,
            $readexamquestion,
            $updateexamquestion,
            $deleteexamquestion,
            $createexamscore,
            $readexamscore,
            $updateexamscore,
            $deleteexamscore,
        ]);
        $residentpastor = Role::create(['name' => 'residentpastor'])->syncPermissions([
            $createstudent,
            $readstudent,
            $updatestudent,
            $deletestudent,
            $readexamscore,
        ]);
        $associatepastor = Role::create(['name' => 'instructor'])->syncPermissions([
            $createexamquestion,
            $readexamquestion,
            $updateexamquestion,
            $readexamscore,
        ]);

        $student = Role::create(['name' => 'student'])->syncPermissions([
            $readexamquestion,
            $readexamscore,
        ]);

        // CREATE ADMINS & USERS
        User::create([
            'name'              => 'Umaha Tokula',
            'email'             => 'umahatokula@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('12345678'),
            'remember_token'    => Str::random(10),
        ])->assignRole($superadmin);
    }
}
