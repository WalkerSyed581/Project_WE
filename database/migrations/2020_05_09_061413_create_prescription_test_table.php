<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_test', function (Blueprint $table) {
			$table->id();
			$table->unsignedInteger('prescription_id');
			$table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade')->onUpdate('cascade');

			$table->unsignedInteger('lab_test_id');
			$table->foreign('lab_test_id')->references('id')->on('lab_tests')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('prescription_test');
    }
}
