<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsOnlineInfoToPageDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_data', function (Blueprint $table) {
            $table->integer('total_day_online')->nullable()->default(null);
            $table->integer('top_hour_online')->nullable()->default(null);
            $table->integer('total_hour_online')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_data', function (Blueprint $table) {
            //
        });
    }
}
