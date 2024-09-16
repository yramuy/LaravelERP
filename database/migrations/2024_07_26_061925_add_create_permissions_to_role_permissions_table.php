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
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->integer('can_read')->default(0)->after('permission_id');
            $table->integer('can_create')->default(0)->after('can_read');
            $table->integer('can_update')->default(0)->after('can_create');
            $table->integer('can_delete')->default(0)->after('can_update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropColumn(['can_read','can_create','can_update','can_delete']);
        });
    }
};
