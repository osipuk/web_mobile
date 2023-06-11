<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoogleAnalyticsAccount extends Model
{
    use HasFactory;
    public $fillable = ['id', 'provider_id', 'name', 'social_account_id'];

    public function properties()
    {
        return $this->hasMany(GoogleAnalyticsProperty::class);
    }

    public function social_account()
    {
        return $this->belongsTo(SocialAccount::class);
    }
}
