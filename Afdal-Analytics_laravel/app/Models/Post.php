<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'title',
        'likes_count',
        'comments_count',
        'shares_count',
        'created_date',
        'image',
        'impressions',
        'engaged',
        'clicks',
        'page_id',
        'post_id',
        'reach',
        'ads_account_id',
        'media_type',
        'media_type',
        'batch_number',
    ];

    public function page() {
        return $this->belongsTo(Page::class);
    }
}
