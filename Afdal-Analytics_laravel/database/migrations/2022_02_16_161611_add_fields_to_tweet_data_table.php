<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTweetDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tweet_data', function (Blueprint $table) {
            $table->integer('new_reply_count')->nullable()->default(0)->after('reply_count');
            $table->integer('new_impression_count')->nullable()->default(0)->after('impression_count');
            $table->integer('new_user_profile_clicks')->nullable()->default(0)->after('user_profile_clicks');
            $table->integer('new_like_count')->nullable()->default(0)->after('like_count');
            $table->integer('new_retweet_count')->nullable()->default(0)->after('retweet_count');
            $table->integer('new_quote_count')->nullable()->default(0)->after('quote_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tweet_data', function (Blueprint $table) {
            //
        });
    }
}
