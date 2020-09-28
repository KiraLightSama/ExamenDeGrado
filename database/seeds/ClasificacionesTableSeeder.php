<?php

use Illuminate\Database\Seeder;
use App\Clasificacion;

class ClasificacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'nombre' => 'Proteinas'
            ],
            [
                'nombre' => 'Carbohidratos'
            ],
            [
                'nombre' => 'Grasas'
            ],
            [
                'nombre' => 'Lacteos y otros'
            ],
            [
                'nombre' => 'Frutas'
            ]
        );

        Clasificacion::insert($data);
    }
}
