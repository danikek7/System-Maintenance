<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'activated' => true,
        ]);

        User::create([
            'first_name' => 'Manager',
            'last_name' => 'User',
            'username' => 'manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'activated' => true,
        ]);

        User::create([
            'first_name' => 'PIC',
            'last_name' => 'User',
            'username' => 'pic',
            'email' => 'pic@example.com',
            'password' => Hash::make('password'),
            'role' => 'pic',
            'activated' => true,
        ]);

        User::create([
            'first_name' => 'Pelaksana',
            'last_name' => 'User',
            'username' => 'pelaksana',
            'email' => 'pelaksana@example.com',
            'password' => Hash::make('password'),
            'role' => 'pelaksana',
            'activated' => true,
        ]);
    }
}
