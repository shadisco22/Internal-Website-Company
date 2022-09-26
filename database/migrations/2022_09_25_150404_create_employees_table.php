<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id');
            $table->foreignId('dep_id');
            $table->string('title');
            $table->string('role');
            $table->string('duties');
            $table->string('salary');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('hire_date');
            $table->timestamp('retire_date')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
