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
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null);
            $table->integer('social_account_id')->nullable()->default(null);
            $table->integer('page_id')->nullable()->default(null);
            $table->date('date_from')->nullable()->default(null);
            $table->date('date_to')->nullable()->default(null);
            $table->integer('company_id')->nullable()->default(null);
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
        Schema::dropIfExists('dashboards');
    }
};
