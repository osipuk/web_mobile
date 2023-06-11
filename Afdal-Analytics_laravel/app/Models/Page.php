<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'page_id',
        'name',
        'token',
        'social_account_id',
    ];

    public function social_account(){
        return $this->belongsTo(SocialAccount::class);
    }
    public function post(){
        return $this->hasMany(Post::class)->orderByDesc('created_date');
    }

    public function likeinfo(){
        return $this->hasMany(PageLike::class)->orderBy('date', 'desc');
    }

    public function data(){
        return $this->hasMany(PageData::class);
    }
    public function follower(){
        return $this->hasMany(PageFollower::class);
    }
    public function cta_data(){
        return $this->hasMany(CtaData::class);
    }
}
