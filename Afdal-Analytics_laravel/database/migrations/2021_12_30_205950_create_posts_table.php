<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('text')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->integer('likes_count')->nullable()->default(null);
            $table->integer('comments_count')->nullable()->default(null);
            $table->string('created_time')->nullable()->default(null);
            $table->text('image')->nullable()->default(null);
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
        Schema::dropIfExists('posts');
    }
}
