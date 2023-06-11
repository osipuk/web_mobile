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
        Schema::table('ga_property_sessions_by_channel', function (Blueprint $table) {
            $table->integer('total_users')->after('value');
            $table->renameColumn('value', 'sessions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ga_property_sessions_by_channel', function (Blueprint $table) {
            $table->dropColumn('total_users');
            $table->renameColumn('sessions', 'value');
        });
    }
};
