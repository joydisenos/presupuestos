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
            $table->string('campo4')->nullable();
            $table->float('valor4')->nullable();
            $table->string('campo5')->nullable();
            $table->float('valor5')->nullable();
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
