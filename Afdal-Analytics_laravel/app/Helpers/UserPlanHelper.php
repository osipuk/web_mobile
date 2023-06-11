<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class UserPlanHelper
{
    public static function subscription_info() {
        $user = Auth::user();

        if ($user->enterprise() || $user->email == 'demo@afdal.com' || $user->gift)
            return Config::get('constants.enterprise_info');
        elseif ($user->plus())
            return Config::get('constants.plus_info');
        elseif ($user->essentials() || $user->trial())
            return Config::get('constants.essentials_info');
        else
            return Config::get('constants.no_subscription');
    }
}
