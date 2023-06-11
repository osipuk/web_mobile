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
            $table->string('stripe_id')->nullable()->default(null);
            $table->string('pm_type')->nullable()->default(null);
            $table->string('pm_last_four', 4)->nullable()->default(null);
            $table->timestamp('trial_ends_at')->nullable()->default(null);
            $table->boolean('paypal_method')->default(false);

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
            $table->dropColumn(['stripe_id', 'pm_type', 'pm_last_four', 'trial_ends_at', 'paypal_method']);
        });
    }
};
