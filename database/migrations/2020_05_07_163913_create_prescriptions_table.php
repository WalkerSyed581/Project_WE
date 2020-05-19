<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
			$table->id();
			$table->unsignedInteger('doctor_appointment_id');
			$table->foreign('doctor_appointment_id')->references('id')->on('doctor_appointments')->onDelete('cascade')->onUpdate('cascade');

			$table->string('condition',200);
			$table->string('notes',400)->nullable(true);
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
        Schema::dropIfExists('prescriptions');
    }
}
