<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
			$table->id();
			$table->unsignedInteger('patient_id');
			$table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedInteger('doctor_appointment_id')->nullable(true)->default(null)->unique();
			$table->foreign('doctor_appointment_id')->references('id')->on('doctor_appointments')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedInteger('lab_appointment_id')->nullable(true)->default(null)->unique();
			$table->foreign('lab_appointment_id')->references('id')->on('lab_appointments')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedInteger('admission_id')->nullable(true)->default(null)->unique();
			$table->foreign('admission_id')->references('id')->on('admissions')->onDelete('cascade')->onUpdate('cascade');
			
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
        Schema::dropIfExists('bills');
    }
}
