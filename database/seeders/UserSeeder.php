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
            'nama_user' => 'Admin User',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'nama_user' => 'Manager User',
            'username' => 'manager',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        User::create([
            'nama_user' => 'PIC User',
            'username' => 'pic',
            'password' => Hash::make('password'),
            'role' => 'pic',
        ]);

        User::create([
            'nama_user' => 'Pelaksana User',
            'username' => 'pelaksana',
            'password' => Hash::make('password'),
            'role' => 'pelaksana',
        ]);
    }
}
