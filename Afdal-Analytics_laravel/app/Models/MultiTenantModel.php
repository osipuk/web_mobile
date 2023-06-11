<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class MultiTenantModel extends Model
{
    protected $connection ='';
    protected $table = 'tenant_user';

    public function __construct()
    {
        $this->connection = Auth::User()->database_name;
    }

    public static function getTenantUser()
    {
        return MultiTenantModel::get();
    }
}
