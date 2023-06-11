<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleAdsGroup extends Model
{
    use HasFactory;

    public $fillable = ['id', 'provider_id', 'base_ad_group', 'campaign_resource_name', 'device', 'network_type', 'google_ads_account_id'];

    public function google_ads_account()
    {
        return $this->belongsTo(GoogleAdsAccount::class);
    }
}
