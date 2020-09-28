<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //$this->call(UsersTableSeeder::class);

        $this->call(TipoObjetivosTableSeeder::class);
        $this->call(ObjetivosTableSeeder::class);
        $this->call(EjerciciosTableSeeder::class);
        $this->call(ClasificacionesTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(AlimentosTableSeeder::class);

        Model::reguard();
    }
}
