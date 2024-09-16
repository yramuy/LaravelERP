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
        Schema::table('menu_items', function (Blueprint $table) {
            $table->integer('parent_id')->default(0)->after('permission_id');
            $table->integer('level')->default(0)->after('permission_id');
            $table->integer('is_active')->default(1)->after('permission_id');
            $table->string('url')->after('permission_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn(['parent_id','level','is_active']);
        });
    }
};
