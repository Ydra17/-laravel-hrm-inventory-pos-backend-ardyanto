<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Company::create([
            'name' => 'Ardyanto Company',
            'email' => 'ardyantobaso@gmail.com',
            'phone' => '085217555887',
            'website' => 'google.com',
            'logo' => 'https://www.google.com/logos/doodles/2024/celebrating-rendang-6753651837110275.4-ldrk.png',
            'address' => 'Jl. maju mundur',
            'status' => 'active',
            'total_users' => 10,
            'clock_in_time' => '09:00:00',
            'clock_out_time' => '18:00:00',
            'early_clock_in_time' => 15,
            'allow_clock_out_till' => 15,
            'self_clocking' => 1,
        ]);
    }
}
