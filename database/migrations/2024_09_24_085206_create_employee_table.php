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
        Schema::create('employee', function (Blueprint $table) {
            $table->emp_number();
            $table->integer('employee_id');
            $table->string('first_name')->default(null);
            $table->string('last_name');
            $table->string('email');
            $table->integer('mobile_number');
            $table->tinyInteger('gender');
            $table->date('dob');
            $table->integer('position');
            $table->string('profile_pic');
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('employee');
    }
};
