<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('status')->default('Reservada');
             //Reservada, Confirmada, Atendida, Cancelada

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->dropColumn('status');
                 //Reservada, Confirmada, Atendida, Cancelada

            });
        });
    }
}
