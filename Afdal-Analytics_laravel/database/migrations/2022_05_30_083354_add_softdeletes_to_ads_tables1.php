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
        Schema::table('google_ads_accounts', function (Blueprint $table) {
            $table->softDeletes();
        });

//        Schema::table('google_ads_data', function (Blueprint $table) {
//            $table->softDeletes();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('google_ads_accounts', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

//        Schema::table('google_ads_data', function (Blueprint $table) {
//            $table->dropColumn('deleted_at');
//        });
    }
};
