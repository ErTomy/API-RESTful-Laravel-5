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

        Conductor::create(['nombre' => 'Alberto', 'apellidos'=>'Álvarez']);
        Conductor::create(['nombre' => 'Pepe', 'apellidos'=>'Perez']);
        Conductor::create(['nombre' => 'Ramón', 'apellidos'=>'Rodríguez']);

    }



}
