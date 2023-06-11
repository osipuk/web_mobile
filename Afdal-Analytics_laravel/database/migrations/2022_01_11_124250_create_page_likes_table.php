<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_likes', function (Blueprint $table) {
            $table->id();
            $table->integer('likes')->nullable()->default(null);
            $table->integer('unlikes')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->integer('page_id')->nullable()->default(null);
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
        Schema::dropIfExists('page_likes');
    }
}
