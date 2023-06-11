<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'show',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_url'
    ];

    public function blog()
    {
        return $this->hasMany(Blog::class);
    }
}
