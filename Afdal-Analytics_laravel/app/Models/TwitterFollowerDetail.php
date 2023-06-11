<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TwitterFollowerDetail extends Model
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
        'twitter_follower_id',
        'follower_name',
        'follower_username',
        'date',
    ];

    
}
