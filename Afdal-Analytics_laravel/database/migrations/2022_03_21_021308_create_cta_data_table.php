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
        Schema::create('cta_data', function (Blueprint $table) {
            $table->id();
            $table->string('city')->nullable()->default(null);
            $table->integer('reach')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->bigInteger('page_id')->nullable()->default(null);
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
        Schema::dropIfExists('cta_data');
    }
};
