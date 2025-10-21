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
            'name' => 'Super Admin',
            'email' => 'superadmin@dkp.com',
            'password' => Hash::make('12345'),
            'role' => 'super_admin',
        ]);

        User::create([
            'name' => 'Admin Biasa',
            'email' => 'admin@dkp.com',
            'password' => Hash::make('12345'),
            'role' => 'admin',
        ]);
    }
}
