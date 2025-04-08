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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('leave_type');
            $table->decimal('length_hours');
            $table->decimal('length_days');
            $table->date('leave_date');
            $table->integer('emp_number');
            $table->integer('duration_type');
            $table->integer('session_type');
            $table->text('comment');
            $table->integer('leave_status');
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
        Schema::dropIfExists('leaves');
    }
};
