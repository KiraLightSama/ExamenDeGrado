<?php

use Illuminate\Database\Seeder;
use App\Objetivo;

class ObjetivosTableSeeder extends Seeder
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
                'nombre' => 'muy lento',
                'valor' => '10',
                'tipo_objetivo_id' => '1'
            ],
            [
                'nombre' => 'lento',
                'valor' => '15',
                'tipo_objetivo_id' => '1'
            ],
            [
                'nombre' => 'normal',
                'valor' => '20',
                'tipo_objetivo_id' => '1'
            ],
            [
                'nombre' => 'rapido',
                'valor' => '25',
                'tipo_objetivo_id' => '1'
            ],
            [
                'nombre' => 'muy rapido',
                'valor' => '30',
                'tipo_objetivo_id' => '1'
            ],
            [
                'nombre' => 'mantener',
                'valor' => '0',
                'tipo_objetivo_id' => '2'
            ],
            [
                'nombre' => 'muy lento',
                'valor' => '10',
                'tipo_objetivo_id' => '3'
            ],
            [
                'nombre' => 'lento',
                'valor' => '12.5',
                'tipo_objetivo_id' => '3'
            ],
            [
                'nombre' => 'normal',
                'valor' => '15',
                'tipo_objetivo_id' => '3'
            ],
            [
                'nombre' => 'rapido',
                'valor' => '17.5',
                'tipo_objetivo_id' => '3'
            ],
            [
                'nombre' => 'muy rapido',
                'valor' => '20',
                'tipo_objetivo_id' => '3'
            ],
        );

        Objetivo::insert($data);
    }
}
