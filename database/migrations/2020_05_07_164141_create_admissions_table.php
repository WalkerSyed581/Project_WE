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
			$table->foreignId('ward_id')->constrained()->onDelete('cascade');
			$table->foreignId('patient_id')->constrained()->onDelete('cascade');
			$table->foreignId('helping_staff_id')->constrained()->onDelete('cascade');
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
