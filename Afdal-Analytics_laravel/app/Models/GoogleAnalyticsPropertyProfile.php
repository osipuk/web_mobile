<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoogleAnalyticsPropertyProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'property_id',
        'profile_id',
        'name'
    ];

    protected $table = 'google_analytics_property_profiles';

    public function property()
    {
        return $this->belongsTo(GoogleAnalyticsProperty::class);
    }
}
