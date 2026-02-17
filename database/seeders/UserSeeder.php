<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;                  
use Illuminate\Support\Facades\Hash;  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'seoexpert@huixin.com',
            'password' => Hash::make('$$Huixin#Global@2026#!'),
            'email_verified_at' => now(),
        ]);
    }
}