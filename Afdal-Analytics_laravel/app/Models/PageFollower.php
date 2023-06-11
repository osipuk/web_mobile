<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageFollower extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'page_followers';

    protected $fillable = ['country', 'number_followers', 'page_id'];

    public function page() {
        return $this->belongsTo(Page::class);
    }
}
