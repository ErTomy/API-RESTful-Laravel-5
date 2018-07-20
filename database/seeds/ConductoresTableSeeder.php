<?php

use Illuminate\Database\Seeder;
use App\Conductor;

class ConductoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 3; $i++) {
            Conductor::create([
                'nombre' => $faker->name,
                'token'=>str_random(100)
            ]);
        }

    }



}
