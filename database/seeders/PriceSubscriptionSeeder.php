<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PriceSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

    	foreach (range(1,5) as $index) {
	        DB::table('price_subscriptions')->insert([
	            'price' => $faker->randomFloat(2, 0, 100000), //Se crean precios flotantes entre 0 y 100.000 pesos colombianos
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null)
	        ]);
	    }
    }
}
