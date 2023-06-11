<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoogleAnalyticsProperty extends Model
{
    use HasFactory;
    public $fillable = ['id', 'provider_id', 'name', 'google_analytics_account_id'];

    protected $table = 'google_analytics_properties';

    public function account()
    {
        return $this->belongsTo(GoogleAnalyticsAccount::class, 'google_analytics_account_id');
    }

    public function data()
    {
        $this->hasMany(GoogleAnalyticsPropertyData::class, 'property_id');
    }

    public function sessions_by_country()
    {
        $this->hasMany(GoogleAnalyticsPropertySessionsByCountry::class, 'property_id');
    }

    public function sessions()
    {
        $this->hasMany(GoogleAnalyticsPropertySessions::class, 'property_id');
    }

    /**
     * For Google Analytics UA version of API
     * @return void
     */
    public function profiles()
    {
        return $this->hasMany(GoogleAnalyticsPropertyProfile::class, 'property_id');
    }
}
