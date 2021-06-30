<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('products');

       DB::table('Product')->insert([
           'name' => $faker->sentence,
           'price' => $faker->numberBetween(1, 500),
           'currency' => $faker->shuffleArray(['USD', 'PLN'])
       ]);
    }
}
