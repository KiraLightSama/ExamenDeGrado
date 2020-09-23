<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('imagen');
            $table->float('calorias');
            $table->float('carbohidratos');
            $table->float('proteinas');
            $table->float('grasas');
            $table->string('informacion', 255);
            $table->integer('cantidad');
            $table->string('medida');

            $table->integer('clasificacion_id', false, true);
            $table->foreign('clasificacion_id')
                ->references('id')
                ->on('clasificaciones')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('categoria_id', false, true);
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onUpdate('cascade')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alimentos');
    }
}
