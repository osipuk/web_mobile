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
        if (Schema::hasColumn('google_analytics_property_data', 'new_users') && Schema::hasColumn('google_analytics_property_data', 'returning_users')) //check the column
        {
            Schema::table('google_analytics_property_data', function (Blueprint $table) {
                $table->dropColumn(['new_users', 'returning_users']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
