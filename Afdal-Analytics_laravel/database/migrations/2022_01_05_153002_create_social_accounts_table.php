<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('provider_name')->nullable()->default(null);
            $table->string('provider_id')->nullable()->default(null);
            $table->string('full_name')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('token')->nullable()->default(null);
            $table->string('avatar')->nullable()->default(null);
            $table->string('refresh_token')->nullable()->default(null);
            $table->date('expires_at')->nullable()->default(null);
            $table->date('delete_at')->nullable()->default(null);
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
        Schema::dropIfExists('social_accounts');
    }
}
