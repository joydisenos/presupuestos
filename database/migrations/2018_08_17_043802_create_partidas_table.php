<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre');
            $table->integer('mano_id')->default(0);
            $table->integer('indirecto_id')->default(0);
            $table->float('cantidad')->default(1);
            $table->string('campo1');
            $table->float('valor1');
            $table->string('campo2');
            $table->float('valor2');
            $table->string('campo3');
            $table->float('valor3');
            $table->float('total')->default(0);
            $table->float('total_materiales')->default(0);
            $table->integer('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidas');
    }
}
