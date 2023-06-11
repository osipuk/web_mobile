<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'page_id',
        'date',
        'likes',
        'unlikes',
        'paid_likes',
        'unpaid_likes',
    ];

    public function page() {
        return $this->belongsTo(Page::class);
    }
}
