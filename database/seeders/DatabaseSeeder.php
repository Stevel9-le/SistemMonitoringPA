<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Staff;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);

        // Create permissions
        $manageUsers = Permission::firstOrCreate(['name' => 'manage users']);
        $manageProjects = Permission::firstOrCreate(['name' => 'manage projects']);
        $manageStaff = Permission::firstOrCreate(['name' => 'manage staff']);
        $viewDashboard = Permission::firstOrCreate(['name' => 'view dashboard']);

        // Assign permissions to roles
        $adminRole->givePermissionTo([$manageUsers, $manageProjects, $manageStaff, $viewDashboard]);
        $staffRole->givePermissionTo([$manageProjects, $viewDashboard]);
        $studentRole->givePermissionTo([$viewDashboard]);

        // Create Admin Account
        $admin = User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // Create Staff Accounts
        $staff1 = User::firstOrCreate([
            'email' => 'staff@gmail.com',
        ], [
            'name' => 'Dr. John Smith',
            'password' => Hash::make('password'),
        ]);
        $staff1->assignRole('staff');

        $staff2 = User::firstOrCreate([
            'email' => 'staff2@gmail.com',
        ], [
            'name' => 'Prof. Sarah Johnson',
            'password' => Hash::make('password'),
        ]);
        $staff2->assignRole('staff');

        // Create Staff Records
        Staff::firstOrCreate([
            'email' => 'staff@gmail.com',
        ], [
            'name' => 'Dr. John Smith',
            'role' => 'Supervisor Lecturer',
            'user_id' => $staff1->id,
        ]);

        Staff::firstOrCreate([
            'email' => 'staff2@gmail.com',
        ], [
            'name' => 'Prof. Sarah Johnson',
            'role' => 'Co-Supervisor',
            'user_id' => $staff2->id,
        ]);

        // Create Sample Projects
        Project::firstOrCreate([
            'title' => 'AI-Powered Student Monitoring System',
        ], [
            'description' => 'A comprehensive system for monitoring student progress using artificial intelligence and machine learning algorithms.',
            'status' => 'in_progress',
            'start_date' => '2024-01-15',
            'end_date' => '2024-06-30',
            'assigned_staff_id' => 1,
        ]);

        Project::firstOrCreate([
            'title' => 'Web-Based Library Management',
        ], [
            'description' => 'Digital library management system with online book reservation and inventory tracking.',
            'status' => 'pending',
            'start_date' => '2024-02-01',
            'end_date' => '2024-07-15',
            'assigned_staff_id' => 2,
        ]);

        Project::firstOrCreate([
            'title' => 'Mobile Health Tracker App',
        ], [
            'description' => 'Cross-platform mobile application for tracking personal health metrics and wellness goals.',
            'status' => 'completed',
            'start_date' => '2023-09-01',
            'end_date' => '2024-01-31',
            'assigned_staff_id' => 1,
        ]);
    }
}
