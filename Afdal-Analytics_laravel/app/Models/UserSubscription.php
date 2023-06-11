<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserSubscription extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'plan_name',
        'plan_amount',
        'plan_duration',
        'expiry_date',
        'is_trial',
        'subscription_status',
    ];
    
    public static function getTrialSubscription($user_id)
    {
        return UserSubscription::where('user_id',$user_id)->where('is_trial',1)->first();
    }

    public static function getPaidSubscription($user_id)
    {
        return UserSubscription::where('user_id',$user_id)->where('is_trial',0)->where('subscription_status','active')->first();
    }

}
