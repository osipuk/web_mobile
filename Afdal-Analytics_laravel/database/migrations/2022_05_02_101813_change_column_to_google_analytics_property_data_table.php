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
        Schema::table('google_analytics_property_data', function (Blueprint $table) {
            $table->float('average_session_duration')->nullable()->default(null)->change();
            $table->float('screen_page_views_per_session')->nullable()->default(null)->change();
            $table->float('conversions')->nullable()->default(null)->change();
            $table->date('date')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('google_analytics_property_data', function (Blueprint $table) {
            //
        });
    }
};
