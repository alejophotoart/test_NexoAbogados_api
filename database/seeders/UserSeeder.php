<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); //se utiliza la libreria faker

    	foreach (range(1,10) as $index) { //seeder que rellena y crea informacion del usuario
	        DB::table('users')->insert([
	            'name' => $faker->name, 
	            'email' => $faker->email,
	            'password' => Hash::make(Str::random(8)), //password cifrados
	            'active' => $faker->boolean(),
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null), //fechas de creacion y modificacion entre los ultimos 5 años
                'updated_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null)
	        ]);
	    }
    }
}
