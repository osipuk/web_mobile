<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_data', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id')->nullable()->default(null);
            $table->text('campaign_name')->nullable()->default(null);
            $table->integer('impressions')->nullable()->default(null);
            $table->double('ctr')->nullable()->default(null);
            $table->double('cpc')->nullable()->default(null);
            $table->double('cpp')->nullable()->default(null);
            $table->double('cpm')->nullable()->default(null);
            $table->double('spend')->nullable()->default(null);
            $table->string('account_currency')->nullable()->default(null);
            $table->integer('reach')->nullable()->default(null);
            $table->integer('clicks')->nullable()->default(null);
            $table->integer('inline_link_clicks')->nullable()->default(null);
            $table->integer('ads_account_id')->nullable()->default(null);
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
        Schema::dropIfExists('ads_data');
    }
}
