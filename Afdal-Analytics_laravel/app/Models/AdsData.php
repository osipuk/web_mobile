<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsData extends Model
{
    use HasFactory;
    protected $fillable = [
        'campaign_id', 'campaign_name', 'impressions', 'ctr', 'cpc', 'cpp', 'cpm', 'spend', 'account_currency', 'reach',
        'clicks', 'inline_link_clicks', 'ads_account_id', 'date', 'converted_product_value'
    ];
}
