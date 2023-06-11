<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email',100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('status')->default(1);
            $table->string('password');
            $table->string('short_token')->nullable();
            $table->string('long_token')->nullable();
            $table->string('company')->nullable();
            $table->string('role')->nullable();
            $table->string('database_name')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
