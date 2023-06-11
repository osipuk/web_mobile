<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdddReachToPageDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_data', function (Blueprint $table) {
            $table->integer('page_reach')->nullable()->default(null);
            $table->integer('page_views')->nullable()->default(null);
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
            $table->dropColumn(['page_reach', 'page_views']);
        });
    }
}
