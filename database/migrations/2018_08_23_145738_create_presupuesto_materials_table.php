<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('presupuesto_id');
            $table->integer('partida_id');
            $table->integer('material_id');
            $table->integer('mano_id');
            $table->integer('indirecto_id');
            $table->float('cantidad');
            $table->string('numero');
            $table->string('formula');
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
        Schema::dropIfExists('presupuesto_materials');
    }
}
