<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->enum('gender', ['m', 'f','n'])->default('n');
			$table->string('address',100)->nullable(true);
			$table->string('phone',11)->nullable(true);
			$table->string('cnic',15)->nullable(true);
			$table->string('age');
			$table->enum('role',['p','d','hs','sgc','n','a'])->default('n');
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
        Schema::dropIfExists('users');
    }
}
