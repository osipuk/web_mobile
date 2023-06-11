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
        Schema::create('google_analytics_property_data', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->integer('new_users');
            $table->integer('returning_users');
            $table->integer('conversions');
            $table->integer('total_users');
            $table->integer('average_session_duration');
            $table->float('bounce_rate');
            $table->integer('screen_page_views_per_session');
            $table->date('date');
            $table->softDeletes();
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
        Schema::dropIfExists('google_analytics_property_data');
    }
};
