<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_groups', function (Blueprint $table) {
			$table->id();
			$table->string('name',50)->default('Generic Support Group');
			$table->time('timing');
			$table->enum('day', ['Monday', 'Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']);
			$table->text('description')->nullable(true);
			$table->unsignedInteger('fee')->default(0);
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
        Schema::dropIfExists('support_groups');
    }
}
