<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
 Use Exception; 

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'status',
        'password',
        'short_token',
        'long_token',
        'company_id',
        'role',
        'database_name',
        'provider',
        'provider_id',
        'lead_id',
        'google_id',
        'linkedin_id',
        'apple_id',
        'stripe_id',
        'city',
        'country',
        'address',
        'phone',
        'timezone',
        'website',
        'postal_code',
        'image',
        'trial_ends_at',
        'paypal_method',
        'gift',
        'gift_ends_at',
        'disabled',
        'email_verified',
        'phone_verified',
        'otp',
        'intercom_external_id',
        'intercom_id',
        'registered_by',
        'is_sent_registered_event',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d H:00',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'trial_ends_at'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function activity() {
        return $this->hasMany(ActivityLog::class)->where('viewed', false);
    }

    public function permissions(): BelongsToMany
    {
        //return data
        return $this->belongsToMany(
            Permission::class,
            'user_permission',
            'user_id',
            'permission_id'
        );
    }

    public function essentials () {
        return Auth::user() ? ((Auth::user()->company->subscribed('essentials') && !Auth::user()->company->subscription('essentials')->onGracePeriod())
            || (Auth::user()->company->subscribed('essentials_yearly') && !Auth::user()->company->subscription('essentials_yearly')->onGracePeriod()))
            || ($this->check_paypel('essentials') || $this->check_paypel('essentials yearly')) : false;
    }

    public function plus () {
        return Auth::user() ? ((Auth::user()->company->subscribed('plus') && !Auth::user()->company->subscription('plus')->onGracePeriod())
            || (Auth::user()->company->subscribed('plus_yearly') && !Auth::user()->company->subscription('plus_yearly')->onGracePeriod()))
            || ($this->check_paypel('plus') || $this->check_paypel('plus yearly')) : false;
    }

    public function enterprise () {
        return Auth::user() ? ((Auth::user()->company->subscribed('enterprise') && !Auth::user()->company->subscription('enterprise')->onGracePeriod())
            || (Auth::user()->company->subscribed('enterprise_yearly') && !Auth::user()->company->subscription('enterprise_yearly')->onGracePeriod()))
            || ($this->check_paypel('enterprise') || $this->check_paypel('enterprise yearly')) : false;
    }

    public function trial(){
        return Auth::user() ? auth()->user()->company->onTrial() : false;
    }

    public function check_paypel($subscription_name){
        
        $company_subscription = DB::table('subscriptions')->where([['company_id', Auth::user()->company_id], ['paypal_status', 'active']])->first();
        if ($company_subscription?->paypal_plan){
            

            try {
                $provider = new PayPalClient;
                $provider->getAccessToken();

                $resp = $provider->showPlanDetails($company_subscription?->paypal_plan);
                if (!empty($resp['name']) && !empty($resp['status'])){
                    return strtolower($resp['name']) === $subscription_name && $resp['status'] === 'ACTIVE' ? true : false;
                }
            }
            catch(\InvalidArgumentException $e){
                // dd($e);
            }catch(Exception $e) {
              //exception handling
            }


        }
        return false;
    }

}
