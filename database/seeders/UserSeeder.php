<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'profile_image' => 'https://blog.postman.com/wp-content/uploads/2021/12/Intro-Super-Admin-Manage-Resources-@2x.jpg',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('12345678'),
            'shift_id' => null,
            'status' => 'enable',
            'department_id' => null,
            'designation_id' => null,
            'role_id' => 1,
            // 'warehouse_id' => null,
            'phone' => '085123456789',
            'address' => 'jalan suka maju',
            'company_id' => 1,
            'is_superadmin' => 1,
            'user_type' => 'epmployee',
            'login_enabled' => 1,
        ]);

        User::factory()->create([
            'name' => 'Ardyanto',
            'username' => 'ardyanto',
            'profile_image' => 'https://blog.postman.com/wp-content/uploads/2021/12/Intro-Super-Admin-Manage-Resources-@2x.jpg',
            'email' => 'ardyanto@mail.com',
            'password' => Hash::make('12345678'),
            'shift_id' => null,
            'status' => 'enable',
            'department_id' => null,
            'designation_id' => null,
            'role_id' => 1,
            // 'warehouse_id' => null,
            'phone' => '085123456789',
            'address' => 'jalan suka maju',
            'company_id' => 1,
            'is_superadmin' => 0,
            'user_type' => 'epmployee',
            'login_enabled' => 1,
        ]);
    }
}
