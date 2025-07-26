<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
    ['email' => 'admin@example.com'],
    [
        'name' => 'Super Admin',
        'password' => Hash::make('password'),
        'role' => 'superadmin', // Change to superadmin
        'is_approved' => true,    // Make sure the superadmin is approved
    ]
);
    }
}