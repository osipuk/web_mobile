<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    /**
     * The connection name for the model.
     * 
     * @var string|null
     */
    // protected $connection = 'landlord';
    protected $table = 'users';

    protected $guarded = [];

    /**
     *
     */
    public function configure()
    {
        config([
            'database.connections.tenant.database' => $this->database_name,
        ]);

        DB::purge('tenant');

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();

        return $this;
    }

    /**
     *
     */
    public function use()
    {
        app()->forgetInstance('tenant');

        app()->instance('tenant', $this);

        return $this;
    }
}
