<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nombre');
            $table->string('genero');
            $table->date('fecha_nacimiento');
            $table->float('peso')->unsigned();
            $table->float('estatura')->unsigned();

            /**
             * calculo de energia segun los parametros de registro
            */
            $table->integer('energia_actual', false, true)->nullable();
            $table->integer('energia_objetivo', false, true)->nullable();
            $table->integer('cantidad_comidas', false, true)->nullable();

            /**
             * macronutrientes
             */
            $table->float('carbohidratos')->unsigned()->nullable();
            $table->float('grasa')->unsigned()->nullable();
            $table->float('proteina')->unsigned()->nullable();

            $table->integer('objetivo_id', false, true)->nullable();
            $table->foreign('objetivo_id')
                ->references('id')
                ->on('objetivos');

            $table->integer('ejercicio_id', false, true)->nullable();
            $table->foreign('ejercicio_id')
                ->references('id')
                ->on('ejercicios');

            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
