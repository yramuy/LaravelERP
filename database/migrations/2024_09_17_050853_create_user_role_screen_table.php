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
        Schema::create('user_role_screen', function (Blueprint $table) {
            $table->id();
            $table->integer('user_role_id');
            $table->integer('screen_id');
            $table->tinyInteger('can_read')->default(0);
            $table->tinyInteger('can_create')->default(0);
            $table->tinyInteger('can_update')->default(0);
            $table->tinyInteger('can_delete')->default(0);
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
        Schema::dropIfExists('user_role_screen');
    }
};
