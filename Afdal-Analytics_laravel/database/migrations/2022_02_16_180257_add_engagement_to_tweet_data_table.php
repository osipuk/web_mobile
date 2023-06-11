<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEngagementToTweetDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tweet_data', function (Blueprint $table) {
            $table->integer('engagement_count')->nullable()->default(0)->after('quote_count');
            $table->integer('new_engagement_count')->nullable()->default(0)->after('quote_count');
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
            $table->dropColumn(['engagement_count', 'new_engagement_count']);
        });
    }
}
