<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoogleAdsAccountData extends Model
{
    use HasFactory;

    public $fillable = ['id', 'google_ads_account_id', 'clicks', 'conversions', 'ctr', 'impressions', 'date'];

    public function google_ads_account()
    {
        return $this->belongsTo(GoogleAdsAccount::class);
    }
}
