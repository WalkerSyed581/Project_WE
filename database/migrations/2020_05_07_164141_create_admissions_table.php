<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
			$table->id();
			$table->unsignedInteger('ward_id');
			$table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade')->onUpdate('cascade');

			$table->unsignedInteger('patient_id')->unique();
			$table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');

			$table->unsignedInteger('helping_staff_id');
			$table->foreign('helping_staff_id')->references('id')->on('helping_staffs')->onDelete('cascade')->onUpdate('cascade');

			$table->dateTime('from_date', 0);
			$table->unsignedInteger('number_of_days')->default(1);
			$table->boolean('discharged')->default(false);
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
        Schema::dropIfExists('admissions');
    }
}
