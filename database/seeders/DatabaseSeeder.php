<?php

namespace Database\Seeders;

use App\Http\Controllers\admin\DoctorController;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //administrador
        User::create([
            'name' => 'Marco',
            'email' => 'marco@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'ci' => '13467985 ',
            'address' => 'casa',
            'phone' => '78451296',
            'role' => 'admin'
        ]);
        //paciente
        User::create([
            'name' => 'Paciente 1',
            'email' => 'patients@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),

            'role' => 'patient'
        ]);
        //DoctorController
        User::create([
            'name' => 'Médico 1',
            'email' => 'doctor@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),

            'role' => 'doctor'
        ]);


         \App\Models\User::factory(50)->create();
    }
}
