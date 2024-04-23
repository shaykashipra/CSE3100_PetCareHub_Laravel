<?php

namespace Database\Seeders;

use App\Models\Favourite;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Favourite::create([
                'user_id' => 15, 
                'pet_id' => 2, 
            ]);
          Favourite::create([
                'user_id' => 15, 
                'pet_id' => 3, 
            ]);
           Favourite::create([
                'user_id' => 15, 
                'pet_id' => 4, 
            ]);
    }

    //php artisan db:seed --class=FavouriteSeeder
}
