<?php

namespace App\Services\Social;

use Illuminate\Support\Str;
use App\Models\SocialAccount;

class SocialAccountService
{
    public static function factory(SocialAccount $socialAccount) : SocialService
    {
        $className = __NAMESPACE__ . "\\" . Str::studly($socialAccount->provider_name) . "Service";
        return new $className($socialAccount);
    }
}
