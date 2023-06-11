<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoogleAnalyticsPropertySessions extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

//    protected $table = 'google_analytics_property_data';

    public function property()
    {
        return $this->belongsTo(GoogleAnalyticsProperty::class, 'property_id');
    }
}
