<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('act_id')->nullable()->default(null);
            $table->string('account_id')->nullable()->default(null);
            $table->string('full_name')->nullable()->default(null);
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
        Schema::dropIfExists('ads_accounts');
    }
}
