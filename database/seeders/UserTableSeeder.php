<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create user seeder
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
    }
}
