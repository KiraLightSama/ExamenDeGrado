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
                'nombre' => 'Carnes',
                'distribucion' => 'A,C'
            ],
            [
                'nombre' => 'Bebidas',
                'distribucion' => 'D'
            ],
            [
                'nombre' => 'Frutas',
                'distribucion' => 'D,A,C,MM,MT'
            ],
            [
                'nombre' => 'Frutos Secos',
                'distribucion' => 'MM,MT'
            ],
            [
                'nombre' => 'Leches',
                'distribucion' => 'D'
            ],
            [
                'nombre' => 'Tuberculos',
                'distribucion' => 'A,C'
            ],
            [
                'nombre' => 'Ensaladas',
                'distribucion' => 'A,C'
            ],
            [
                'nombre' => 'Guarnicion',
                'distribucion' => 'A,C'
            ],
            [
                'nombre' => 'Panes y otros',
                'distribucion' => 'D'
            ],
            [
                'nombre' => 'Semillas',
                'distribucion' => 'MM,MT'
            ],
            [
                'nombre' => 'Chocolates y Dulces',
                'distribucion' => 'MM,MT'
            ]
        );

        Categoria::insert($data);
    }
}
