<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Enkripsi password
            'role_id' => 1,
            'company_id' => 1, // Pastikan perusahaan dengan ID 1 ada
        ]);

        User::create([
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
            'company_id' => 2,
        ]);

        User::create([
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
            'company_id' => 3,
        ]);
    }
}
