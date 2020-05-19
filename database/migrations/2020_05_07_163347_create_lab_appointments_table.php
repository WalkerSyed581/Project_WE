<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_appointments', function (Blueprint $table) {
			$table->id();
			$table->unsignedInteger('patient_id');
			$table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedInteger('helping_staff_id')->nullable(true);
			$table->foreign('helping_staff_id')->references('id')->on('helping_staffs')->onDelete('SET NULL')->onUpdate('cascade');
			$table->unsignedInteger('prescription_id')->nullable(true);
			$table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedInteger('lab_test_id')->nullable(true);
			$table->foreign('lab_test_id')->references('id')->on('lab_tests')->onDelete('SET NULL')->onUpdate('cascade');
			$table->string('notes',200)->nullable(true);
			$table->boolean('cancelled')->default(false);
			$table->boolean('approved')->default(false);
			$table->dateTime('time',0);
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
        Schema::dropIfExists('lab_appointments');
    }
}
