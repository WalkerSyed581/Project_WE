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
			$table->foreignId('patient_id')->constrained()->onDelete('cascade');
			$table->foreignId('doctor_id')->constrained()->onDelete('cascade');
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
