<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'admin',
            'last_name' => 'test',
            'email' => 'admin@mailinator.com',
            'password' => Hash::make('74108520'),
            'mobile_no' => 1234567890,
            'status'=>config('site.user_status.approved'),
        ])->assignRole(config('site.roles.admin'));
    }
}
