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
        Schema::create('google_ads_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('provider_id')->nullable()->default(null);
            $table->text('name')->nullable()->default(null);
            $table->string('device')->nullable()->default(null);
            $table->string('network_type')->nullable()->default(null);
            $table->integer('google_ads_account_id')->nullable()->default(null);
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
        Schema::dropIfExists('google_ads_campaigns');
    }
};
