<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable()->default(null);
            $table->text('text')->nullable()->default(null);
            $table->string('user')->nullable()->default(null);
            $table->float('price')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->integer('company_id')->nullable()->default(null);
            $table->integer('user_id')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     *
     */
    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }
}
