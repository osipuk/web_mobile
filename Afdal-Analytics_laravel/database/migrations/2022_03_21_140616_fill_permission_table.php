<?php

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::table('permissions')->insert([
            ['name' => 'Manage payments permission', 'code' => 'manage_payments'],
            ['name' => 'Manage users permission', 'code' => 'manage_users'],
            ['name' => 'Manage connections permission', 'code' => 'manage_connections']
        ]);

        $users = User::get();
        $permissions = Permission::get();
        $users->map(function($user) use ($permissions){
            foreach ($permissions as $permission){
                DB::table('user_permission')->insert(['user_id' => $user->getKey(), 'permission_id' => $permission->getKey()]);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
