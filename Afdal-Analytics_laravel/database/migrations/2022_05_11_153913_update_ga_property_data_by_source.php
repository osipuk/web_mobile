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
        Schema::table('ga_property_data_by_source', function (Blueprint $table) {
            $table->integer('conversions')->after('new_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ga_property_data_by_source', function (Blueprint $table) {
            $table->dropColumn('conversions');
        });
    }
};
