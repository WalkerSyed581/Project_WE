<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientSupportGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_support_group', function (Blueprint $table) {
			$table->id();
			$table->unsignedInteger('support_group_id');
			$table->foreign('support_group_id')->references('id')->on('support_groups')->onDelete('cascade')->onUpdate('cascade');

			$table->unsignedInteger('patient_id');
			$table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('patient_support_group');
    }
}
