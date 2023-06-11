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
        Schema::table('ga_property_data_by_keyword', function (Blueprint $table) {
            $table->integer('page_views')->default(0)->after('screenPageViews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ga_property_data_by_keyword', function (Blueprint $table) {
            $table->dropColumn('page_views');
        });
    }
};
