<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TenantTwitterDetail extends Model
{
    protected $connection ='tenant';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'tenant_id',
        'tenant_twitter_id',
        'twitter_name',
        'twitter_nickname',
        'avatar',
        'total_followers',
        'total_tweets',
        'favorites',
    ];

    
}
