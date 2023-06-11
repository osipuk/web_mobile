<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_name',
        'description',
        'image',
        'date',
        'show',
        'category_id',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_url'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tags::class);
    }
}
