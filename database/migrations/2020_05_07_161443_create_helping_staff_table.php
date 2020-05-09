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
			$table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->enum('gender', ['m', 'f','n'])->default('n');
			$table->string('address',100)->nullable(true);
			$table->string('phone',11)->nullable(true);
			$table->string('cnic',15)->nullable(true);
			$table->unsignedInteger('age')->default(0);
			$table->dateTime('joining_date', 0);
			$table->unsignedInteger('salary');
			/*
				WARD_STAFF = 'ws'
				LAB_STAFF = 'ls'
				RECEPTIONIST = 'rc'
				NONE = 'n'
			*/
			$table->enum('role', ['ws', 'ls','rc','n'])->default('n'); 
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
        Schema::dropIfExists('helping_staff');
    }
}
