<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;
    protected $fillable = ['tweet_id', 'text', 'created', 'social_account_id'];

    public function social_account(){
        return $this->belongsTo(SocialAccount::class);
    }
    public function tweet_data(){
        return $this->hasMany(TweetData::class);
    }
}
