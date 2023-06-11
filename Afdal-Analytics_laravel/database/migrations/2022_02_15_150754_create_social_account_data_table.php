<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialAccountDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_account_data', function (Blueprint $table) {
            $table->id();
            $table->integer('followers')->nullable()->default(null);
            $table->integer('new_followers')->nullable()->default(null);
            $table->integer('number_tweets')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->integer('social_account_id')->nullable()->default(null);
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
        Schema::dropIfExists('social_account_data');
    }
}
