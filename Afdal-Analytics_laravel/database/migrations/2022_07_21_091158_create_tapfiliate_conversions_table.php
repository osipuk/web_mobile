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
        Schema::create('tapfiliate_conversions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('subscription_id');
            $table->string('tapfiliate_id')->nullable();
            $table->string('amount');
            $table->string('customer_id');
            $table->integer('subscription_status')->default(1)->comment('1=active, 0=inactive');
            $table->string('cancelled_on')->nullable();
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
        Schema::dropIfExists('tapfiliate_conversions');
    }
};
