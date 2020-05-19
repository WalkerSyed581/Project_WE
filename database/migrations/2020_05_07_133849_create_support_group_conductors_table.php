<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportGroupConductorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_group_conductors', function (Blueprint $table) {
			$table->id();
			$table->unsignedInteger('user_id')->unique();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');			$table->dateTime('joining_date', 0);
			$table->unsignedInteger('salary');
			$table->rememberToken();
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
        Schema::dropIfExists('support_group_conductors');
    }
}
