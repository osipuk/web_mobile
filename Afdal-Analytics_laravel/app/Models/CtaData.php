<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtaData extends Model
{
    use HasFactory;
    protected $fillable = ['city', 'reach', 'date', 'page_id'];

    public  function page() {
        return $this->belongsTo(Page::class);
    }
}
