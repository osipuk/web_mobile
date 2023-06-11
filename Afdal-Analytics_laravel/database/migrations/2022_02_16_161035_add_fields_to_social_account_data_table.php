<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSocialAccountDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('social_account_data', function (Blueprint $table) {
            $table->renameColumn('number_tweets', 'total_tweets');
            $table->integer('new_followers')->nullable()->default(0)->change();
            $table->integer('new_tweets')->nullable()->default(0)->after('number_tweets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_account_data', function (Blueprint $table) {
            //
        });
    }
}
