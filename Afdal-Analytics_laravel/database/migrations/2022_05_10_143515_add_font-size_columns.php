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
        Schema::table('blogs', function (Blueprint $table) {
            $table->integer('h2_size')->default(null);
            $table->integer('h3_size')->default(null);
            $table->integer('h4_size')->default(null);
            $table->integer('text_size')->default(null);
        });

        Schema::table('guides', function (Blueprint $table) {
            $table->integer('h2_size')->default(null);
            $table->integer('h3_size')->default(null);
            $table->integer('h4_size')->default(null);
            $table->integer('text_size')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guides', function (Blueprint $table) {
            $table->dropColumn('h2_size');
            $table->dropColumn('h3_size');
            $table->dropColumn('h4_size');
            $table->dropColumn('text_size');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('h2_size');
            $table->dropColumn('h3_size');
            $table->dropColumn('h4_size');
            $table->dropColumn('text_size');
        });
    }
};
