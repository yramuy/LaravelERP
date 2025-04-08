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
        Schema::table('leave_entitlements', function (Blueprint $table) {
            $table->decimal('used_leaves')->after('no_of_leaves');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_entitlements', function (Blueprint $table) {
            $table->dropColumn('used_leaves');
        });
    }
};
