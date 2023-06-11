<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_data', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->nullable()->default(null);
            $table->integer('page_impressions_unique')->nullable()->default(null);
            $table->integer('page_impressions')->nullable()->default(null);
            $table->integer('page_impressions_paid_unique')->nullable()->default(null);
            $table->integer('page_impressions_paid')->nullable()->default(null);
            $table->integer('page_impressions_organic_unique')->nullable()->default(null);
            $table->integer('page_impressions_viral_unique')->nullable()->default(null);
            $table->integer('page_impressions_nonviral_unique')->nullable()->default(null);
            $table->integer('page_impressions_organic')->nullable()->default(null);
            $table->integer('page_posts_impressions_unique')->nullable()->default(null);
            $table->integer('page_posts_impressions_paid_unique')->nullable()->default(null);
            $table->integer('page_posts_impressions_organic_unique')->nullable()->default(null);
            $table->integer('page_posts_impressions_viral_unique')->nullable()->default(null);
            $table->integer('page_posts_impressions_nonviral_unique')->nullable()->default(null);
            $table->integer('post_impressions_fan_unique')->nullable()->default(null);
            $table->integer('page_post_engagements')->nullable()->default(null);
            $table->integer('page_cta_clicks_logged_in_by_city_unique')->nullable()->default(null);
            $table->integer('page_call_phone_clicks_logged_in_by_city_unique')->nullable()->default(null);
            $table->integer('page_get_directions_clicks_logged_in_by_city_unique')->nullable()->default(null);
            $table->integer('page_website_clicks_logged_in_by_city_unique')->nullable()->default(null);
            $table->integer('page_engaged_users')->nullable()->default(null);
            $table->integer('page_fans')->nullable()->default(null);
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
        Schema::dropIfExists('page_data');
    }
}
