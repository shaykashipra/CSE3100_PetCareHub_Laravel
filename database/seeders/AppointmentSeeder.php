<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('appointments')->insert([
            [
                'user_id' => 1, 
                'pet_name' => 'Shipra',
                'contact' => '01626052742',
                'doctor_id' => 1, 
                'date' => Carbon::today()->toDateString(),
                'time' => '10:00:00',
                'symptoms' => 'Coughing and sneezing',
                'category' => 'dog',
                'room_id' => '12345',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records as needed
        ]);
    }
    //php artisan db:seed --class=AppointmentSeeder

}
