<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TwitterPublicMetricesDetail extends Model
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
        'tweet_id',
        'tweet_text',
        'retweet_count',
        'reply_count',
        'like_count',
        'quote_count',
        'date',
    ];

    
}
