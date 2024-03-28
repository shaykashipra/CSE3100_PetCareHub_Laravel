<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{   
  
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('users')->insert([
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'john@example.com',
            'is_admin' => 0, 
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => '1234567890',
            'street' => '123 Main St',
            'city' => 'City',
            'province' => 'State',
            'postal_code' => '12345',
            'image' => 'user.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
