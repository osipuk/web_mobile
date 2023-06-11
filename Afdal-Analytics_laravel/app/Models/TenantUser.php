<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TenantUser extends Model
{
    protected $connection ='tenant';
    // protected $table = 'tenant_user';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'company',
        'role',
        'database_name',
        'provider', 
        'provider_id',
        'street_address',
        'city',
        'postal_code',
        'country',
        'timezone',
        'website_url',
        'status',
    ];

    
}
