<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleAdsCampaign extends Model
{
    use HasFactory;

    public $fillable = ['id', 'provider_id', 'name', 'device', 'network_type', 'google_ads_account_id'];

    public function google_ads_account()
    {
        return $this->belongsTo(GoogleAdsAccount::class);
    }
}
