<?php

namespace App\Models;

use App\Helpers\UserPlanHelper;
use App\Services\Social\GoogleAnalyticsService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Billable;

class Company extends Model
{
    use HasFactory, Billable, SoftDeletes;
    protected $fillable = ['name', 'owner_id', 'pm_type', 'stripe_id', 'pm_last_four', 'trial_ends_at', 'paypal_method', 'paypal_default','intercom_id'];

    protected $dates = [

        'trial_ends_at'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function dashboard()
    {
        return $this->hasMany(Dashboard::class);
    }

    public function social_account()
    {
        return $this->belongsToMany(SocialAccount::class)->where('disabled', false);
    }

    public function social_accounts()
    {
        return $this->hasMany(SocialAccount::class)->where('disabled', false);
    }

    public function social_account_facebook()
    {
        return $this->belongsToMany(SocialAccount::class)
            ->where('disabled', false)
            ->where('provider_name', 'facebook');
    }

    public function social_account_twitter()
    {
        return $this->belongsToMany(SocialAccount::class)
            ->where('disabled', false)
            ->where('provider_name', 'twitter');
    }

    public function social_account_instagram()
    {
        return $this->belongsToMany(SocialAccount::class)
            ->where('disabled', false)
            ->where('provider_name', 'instagram');
    }

    public function social_account_facebook_ads()
    {
        return $this->belongsToMany(SocialAccount::class)
            ->where('disabled', false)
            ->where('provider_name', 'facebookAds');
    }

    public function social_account_google_ads()
    {
        return $this->hasMany(SocialAccount::class)
            ->where('disabled', false)
            ->where('provider_name', 'googleAds');
    }

    public function social_account_google_analytics()
    {
        return $this->belongsToMany(SocialAccount::class)
            ->where('disabled', false)
            ->where('provider_name', GoogleAnalyticsService::PROVIDER_NAME);
    }

    public function social_account_google_analytics_ua()
    {
        return $this->belongsToMany(SocialAccount::class)
            ->where('disabled', false)
            ->where('provider_name', 'google-analytics-ua');
    }

    public function pages()
    {
        return $this->hasManyThrough(Page::class, SocialAccount::class);
    }
}
