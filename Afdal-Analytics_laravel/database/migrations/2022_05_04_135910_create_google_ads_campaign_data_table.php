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
        Schema::create('google_ads_campaign_data', function (Blueprint $table) {
            $table->id();
            $table->integer('google_ads_campaign_id')->nullable()->default(null);
            $table->integer('clicks')->nullable()->default(null);
            $table->double('conversions')->nullable()->default(null);
            $table->double('ctr')->nullable()->default(null);
            $table->double('cost')->nullable()->default(null);
            $table->integer('impressions')->nullable()->default(null);
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
        Schema::dropIfExists('google_ads_campaign_data');
    }
};
