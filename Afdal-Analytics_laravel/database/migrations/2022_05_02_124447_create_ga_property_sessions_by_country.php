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
        Schema::create('ga_property_sessions_by_country', function (Blueprint $table) {
            $table->id();
            $table->string('country')->nullable()->default(null);
            $table->integer('value')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->integer('property_id')->nullable()->default(null);
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
        Schema::dropIfExists('ga_property_sessions_by_country');
    }
};
