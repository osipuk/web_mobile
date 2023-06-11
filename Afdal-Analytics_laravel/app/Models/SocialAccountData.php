<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAccountData extends Model
{
    use HasFactory;

    protected $fillable = ['followers', 'new_followers', 'total_tweets', 'new_tweets', 'date', 'social_account_id'];

    public function social_account(){
        return $this->belongsTo(SocialAccount::class);
    }
}
