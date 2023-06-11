<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToPageLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_likes', function (Blueprint $table) {
            $table->integer('paid_likes')->nullable()->default(null);
            $table->integer('unpaid_likes')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_likes', function (Blueprint $table) {
            $table->dropColumn('paid_likes', 'unpaid_likes');
        });
    }
}
