<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'provider_name',
        'provider_id',
        'full_name',
        'email',
        'token',
        'avatar',
        'refresh_token',
        'expires_at',
        'company_id',
        'delete_at',
        'disabled'
    ];

    public function page(){
        return $this->hasMany(Page::class);
    }

    public function company(){
        return $this->belongsToMany(Company::class);
    }

    public function tweet(){
        return $this->hasMany(Tweet::class);
    }

    public function ads_account(){
        return $this->hasMany(AdsAccount::class);
    }

    public function social_account_data(){
        return $this->hasMany(SocialAccountData::class);
    }

    public function google_ads_account(){
        return $this->hasMany(GoogleAdsAccount::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function google_analytics_account() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GoogleAnalyticsAccount::class);
    }
}
