<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoogleAdsAccount extends Model
{
    use HasFactory;

    public $fillable = ['id', 'provider_id', 'name', 'is_manager', 'currency_code', 'social_account_id'];

    public function social_account()
    {
        return $this->belongsTo(SocialAccount::class);
    }

    public function account_data()
    {
        return $this->hasMany(GoogleAdsAccountData::class);
    }

}
