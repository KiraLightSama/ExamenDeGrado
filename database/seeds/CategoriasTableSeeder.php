<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriasTableSeeder extends Seeder
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
                'nombre' => 'Carnes'
            ],
            [
                'nombre' => 'Bebidas'
            ],
            [
                'nombre' => 'Frutas'
            ],
            [
                'nombre' => 'Frutos Secos'
            ],
            [
                'nombre' => 'Leches'
            ],
            [
                'nombre' => 'Tuberculos'
            ],
            [
                'nombre' => 'Ensaladas'
            ],
            [
                'nombre' => 'Guarnicion'
            ],
            [
                'nombre' => 'Panes y otros'
            ],
            [
                'nombre' => 'Semillas'
            ],
            [
                'nombre' => 'Chocolates y Dulces'
            ]
        );

        Categoria::insert($data);
    }
}
