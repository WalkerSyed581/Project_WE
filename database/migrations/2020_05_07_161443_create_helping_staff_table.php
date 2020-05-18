<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpingStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helping_staff', function (Blueprint $table) {
			$table->id();
			$table->dateTime('joining_date', 0);
			$table->unsignedInteger('salary');
			/*
				WARD_STAFF = 'ws'
				LAB_STAFF = 'ls'
				RECEPTIONIST = 'rc'
				NONE = 'n'
			*/
			$table->enum('role', ['ws', 'ls','rc','n'])->default('n'); 
			$table->timestamps();
			$table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('helping_staff');
    }
}
