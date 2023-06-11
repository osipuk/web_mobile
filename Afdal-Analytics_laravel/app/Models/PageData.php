<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageData extends Model
{
    use HasFactory;

    protected $table = 'page_data';

    protected $fillable = ['page_impressions_unique','page_impressions','page_impressions_paid_unique',
        'page_impressions_organic_unique','page_impressions_viral_unique','page_impressions_nonviral_unique',
        'page_posts_impressions_unique','page_posts_impressions_paid_unique','page_posts_impressions_organic_unique',
        'page_posts_impressions_viral_unique','page_posts_impressions_nonviral_unique','post_impressions_fan_unique',
        'page_post_engagements','page_cta_clicks_logged_in_by_city_unique',
        'page_call_phone_clicks_logged_in_by_city_unique','page_get_directions_clicks_logged_in_by_city_unique',
        'page_website_clicks_logged_in_by_city_unique','page_engaged_users','page_impressions_paid',
        'page_impressions_organic','page_fans', 'date', 'total_day_online', 'top_hour_online', 'total_hour_online',
        'page_reach', 'page_views', 'page_id', 'total_followers'];

    public function page() {
        return $this->belongsTo(Page::class);
    }
}
