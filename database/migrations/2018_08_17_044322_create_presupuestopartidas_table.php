<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestopartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestopartidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partida_id');
            $table->integer('presupuesto_id');
            $table->string('unidad');
            $table->float('cantidad')->default(0);
            $table->float('total_materiales')->default(0);
            $table->float('indirecto')->default(0);
            $table->float('mano')->default(0);
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
        Schema::dropIfExists('presupuestopartidas');
    }
}
