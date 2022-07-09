<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('description');

            /* fks pecialty*/
            $table->foreignId('specialty_id')->constrained('specialties');

            /* fks doctor */
            $table->foreignId('doctor_id')->constrained('users');

            /* fks pacientes */
            $table->foreignId('patient_id')->constrained('users');

            $table->date('scheduled_date');
            $table->time('scheduled_time');

            $table->string('type');
            $table->string('status')->default('Reservada'); //Reservada, Confirmada, Atendida, Cancelada
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
        Schema::dropIfExists('appointments');
    }
}
