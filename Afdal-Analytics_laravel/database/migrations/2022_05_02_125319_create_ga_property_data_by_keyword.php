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
        Schema::create('ga_property_data_by_keyword', function (Blueprint $table) {
            $table->id();
            $table->string('keyword')->nullable()->default(null);
            $table->integer('sessions')->nullable()->default(null);
            $table->integer('screenPageViews')->nullable()->default(null);
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
        Schema::dropIfExists('ga_property_data_by_keyword');
    }
};
