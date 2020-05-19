<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_appointments', function (Blueprint $table) {
			$table->id();
			$table->string('notes',200)->nullable(true);
			$table->boolean('cancelled')->default(false);
			$table->boolean('approved')->default(false);
			$table->dateTime('time',0);
			$table->timestamps();
			$table->unsignedInteger('patient_id')->unique();
			$table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedInteger('doctor_id')->unique();
			$table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_appointments');
    }
}
