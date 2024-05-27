<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('abouts')->insert([
            [
                'fname' => 'John',
                'lname' => 'Doe',
                'role' => 'Developer',
                'description' => 'An experienced developer specializing in full-stack development.',
                'email' => 'john.doe@example.com',
                'linkedin' => 'https://www.linkedin.com/in/johndoe',
                'image' => 'john_doe.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fname' => 'Jane',
                'lname' => 'Smith',
                'role' => 'Designer',
                'description' => 'A creative designer with a passion for user experience.',
                'email' => 'jane.smith@example.com',
                'linkedin' => 'https://www.linkedin.com/in/janesmith',
                'image' => 'jane_smith.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
            }
            //php artisan db:seed --class=AboutsTableSeeder

}
