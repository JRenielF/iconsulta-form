<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin', // You can specify the admin's name here
            'email' => 'admin@example.com', // You can specify the admin's email here
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // You can specify the admin's password here
        ]);

        // Assign the "admin" role to the admin user
        $admin->assignRole('admin');

        $admin->assignRole('editor');
    }
}
