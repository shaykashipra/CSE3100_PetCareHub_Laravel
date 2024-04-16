<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $doctors = [
            ['doctor_name' => 'Dr. Mohammad Mamunur Rashid', 'gender' => 'Male', 'age' => 45, 'experience' => 20, 'specialization' => 'Cardiology','email' => 'trivia1@gmail.com', 'password' => Hash::make('Ss1#Ss1#')],
            ['doctor_name' => 'Dr. Arifur Rabbi Ta', 'gender' => 'Male', 'age' => 40, 'experience' => 15, 'specialization' => 'Neurology','email' => 'trivia2@gmail.com', 'password' => Hash::make('Ss1#Ss1#')],
            ['doctor_name' => 'Dr. Sagir Uddin Ahmed', 'gender' => 'Male', 'age' => 50, 'experience' => 25, 'specialization' => 'Pediatrics','email' => 'trivia3@gmail.com', 'password' => Hash::make('Ss1#Ss1#')],
            ['doctor_name' => 'Dr. Md. Mahbubul Alam Bhuiyan', 'gender' => 'Male', 'age' => 48, 'experience' => 22, 'specialization' => 'Orthopedics','email' => 'trivia7@gmail.com', 'password' => Hash::make('Ss1#Ss1#')],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }

//    $doctorsToUpdate = [
//             1 => ['email' => 'trivia1@gmail.com', 'password' => Hash::make('Ss1#Ss1#')],
//             2 => ['email' => 'trivia2@gmail.com', 'password' => Hash::make('Ss1#Ss1#')],
//             3 => ['email' => 'trivia3@gmail.com', 'password' => Hash::make('Ss1#Ss1#')],
//             4 => ['email' => 'trivia7@gmail.com', 'password' => Hash::make('Ss1#Ss1#')],
//         ];

//         foreach ($doctorsToUpdate as $id => $data) {
//             // Find doctor record by ID
//             $doctor = Doctor::find($id);

//             if ($doctor) {
//                 // Update email and password
//                 $email = $data['email'];
//                 $password = Hash::make($data['password']);

//                 // Update doctor record with email and password
//                 $doctor->update(['email' => $email, 'password' => $password]);
//             }
//         }


     }

    // php artisan db:seed --class=DoctorSeeder
}
