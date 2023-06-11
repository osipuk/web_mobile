<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdsAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'act_id',
        'account_id',
        'name',
        'social_account_id',
    ];

    public function social_account() {
        return $this->belongsTo(SocialAccount::class);
    }
}
