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
			$table->unsignedInteger('helping_staff_id');
			$table->unsignedInteger('prescription_id');
			$table->unsignedInteger('lab_test_id');
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
