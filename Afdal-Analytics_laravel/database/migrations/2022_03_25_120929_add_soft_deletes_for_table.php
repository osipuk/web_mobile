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
        Schema::table('companies', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('social_accounts', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('page_data', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('page_likes', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('page_followers', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('dashboards', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('social_account_data', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('social_accounts', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('page_data', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('page_likes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('page_followers', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('dashboards', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('social_account_data', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
};
