<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Administrator;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'admin@school.com'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@school.com',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        // Fix #9 — also create the Administrator profile record
        Administrator::updateOrCreate(
            ['email' => 'admin@school.com'],
            [
                'name'    => 'Administrator',
                'email'   => 'admin@school.com',
                'phone'   => '0600000000',
                'role'    => 'admin',
                'image'   => 'default.jpg',
                'user_id' => $user->id,
            ]
        );

        $this->command->info('Admin created: admin@school.com / admin123');
    }
}
