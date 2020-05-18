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
			$table->foreignId('patient_id')->constrained()->onDelete('cascade');
			$table->foreignId('doctor_appointment_id')->constrained()->onDelete('cascade')->nullable(true)->unique();
			$table->foreignId('lab_appointment_id')->constrained()->onDelete('cascade')->nullable(true)->unique();
			$table->foreignId('admission_id')->constrained()->onDelete('cascade')->nullable(true)->unique();
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
