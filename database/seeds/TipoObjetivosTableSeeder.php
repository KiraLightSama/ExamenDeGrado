<?php

use Illuminate\Database\Seeder;
use App\TipoObjetivo;

class TipoObjetivosTableSeeder extends Seeder
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
                'nombre' => 'Reducir Grasa'
            ],
            [
                'nombre' => 'Mantener Peso'
            ],
            [
                'nombre' => 'Construir Musculo'
            ]
        );

        TipoObjetivo::insert($data);
    }
}
