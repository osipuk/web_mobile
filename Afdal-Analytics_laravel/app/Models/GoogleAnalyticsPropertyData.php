<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoogleAnalyticsPropertyData extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        'property_id',
        'new_users',
        'returning_users',
        'conversions',
        'total_users',
        'average_session_duration',
        'bounce_rate',
        'screen_page_views_per_session',
        'date'
    ];

    protected $table = 'google_analytics_property_data';

    public function property()
    {
        return $this->belongsTo(GoogleAnalyticsProperty::class, 'property_id');
    }
}
