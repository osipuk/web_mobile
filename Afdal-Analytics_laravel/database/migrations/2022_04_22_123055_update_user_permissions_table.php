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
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('ar_name');
        });

        $permissions = \App\Models\Permission::get();
        foreach ($permissions as $permission){
            switch ($permission->code) {
                case 'manage_payments':
                    $permission->name = 'Manage payments';
                    $permission->ar_name = 'إدارة المدفوعات';
                    $permission->save();
                    break;
                case 'manage_users':
                    $permission->name = 'Manage users';
                    $permission->ar_name = 'ادارة المستخدمين';
                    $permission->save();
                    break;
                case 'manage_connections':
                    $permission->name = 'Manage connections';
                    $permission->ar_name = 'إدارة الروابط';
                    $permission->save();
                    break;
                default:
                    break;
            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('ar_name');
        });
    }
};
