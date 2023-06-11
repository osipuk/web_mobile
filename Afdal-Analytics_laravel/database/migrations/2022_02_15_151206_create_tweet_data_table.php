<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_data', function (Blueprint $table) {
            $table->id();
            $table->integer('tweet_id')->nullable()->default(null);
            $table->integer('reply_count')->nullable()->default(null);
            $table->integer('impression_count')->nullable()->default(null);
            $table->integer('user_profile_clicks')->nullable()->default(null);
            $table->integer('like_count')->nullable()->default(null);
            $table->integer('retweet_count')->nullable()->default(null);
            $table->integer('quote_count')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
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
        Schema::dropIfExists('tweet_data');
    }
}
