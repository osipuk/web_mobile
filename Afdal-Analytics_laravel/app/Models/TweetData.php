<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetData extends Model
{
    use HasFactory;
    protected $fillable = ['tweet_id', 'reply_count', 'impression_count', 'user_profile_clicks', 'like_count', 'retweet_count',
        'quote_count', 'date',  'new_reply_count', 'new_impression_count', 'new_user_profile_clicks', 'new_like_count',
        'new_retweet_count', 'new_quote_count'];

    public function tweet(){
        return $this->belongsTo(Tweet::class);
    }
}
