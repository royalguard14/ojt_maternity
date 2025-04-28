<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'zear',
            'email' => 'Developer@zear.com',
            'password' => Hash::make('password'),
            'role_id' => 1, 
            'isDeleted' => false,
            'isActive' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
