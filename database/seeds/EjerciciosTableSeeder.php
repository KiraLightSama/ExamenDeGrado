<?php

use Illuminate\Database\Seeder;
use App\Ejercicio;

class EjerciciosTableSeeder extends Seeder
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
                'nombre' => 'Sedentario',
                'valor' => '1.2'
            ],
            [
                'nombre' => 'Ligero',
                'valor' => '1.4'
            ],
            [
                'nombre' => 'Moderado',
                'valor' => '1.6'
            ],
            [
                'nombre' => 'Alto',
                'valor' => '1.8'
            ],
            [
                'nombre' => 'Atleta',
                'valor' => '2'
            ]
        );

        Ejercicio::insert($data);
    }
}
