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
			$table->foreignId('patient_id')->constrained()->onDelete('cascade');
			$table->foreignId('helping_staff_id')->constrained()->onDelete('cascade')->nullable(true);
			$table->foreignId('prescription_id')->constrained()->onDelete('cascade')->nullable(true);
			$table->foreignId('lab_test_id')->constrained()->onDelete('cascade')->nullable(true);
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
