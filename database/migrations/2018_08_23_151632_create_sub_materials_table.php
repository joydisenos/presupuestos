<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('presupuestopartida_id');
            $table->integer('presupuesto_id');
            $table->integer('material_id');
            $table->float('cantidad');
            $table->float('cantidad_partida')->default(1);
            $table->string('formula');
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
        Schema::dropIfExists('sub_materials');
    }
}
