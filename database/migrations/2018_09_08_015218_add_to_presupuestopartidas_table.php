<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToPresupuestopartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuestopartidas', function (Blueprint $table) {
            $table->longText('notas')->nullable();
            $table->longText('color')->nullable();
            $table->string('nombre')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presupuestopartidas', function (Blueprint $table) {
            //
        });
    }
}
