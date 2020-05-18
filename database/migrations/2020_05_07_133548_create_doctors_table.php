<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
			$table->id();
			$table->dateTime('joining_date', 0);
			$table->unsignedInteger('salary');
			$table->string('specialization',100)->nullable(true);
			$table->unsignedInteger('fee')->default(0);
			$table->time('starting_time',0);
			$table->time('end_time', 0);
			$table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
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
        Schema::dropIfExists('doctors');
    }
}
