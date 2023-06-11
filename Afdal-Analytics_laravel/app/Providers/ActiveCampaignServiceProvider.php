<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ActiveCampaign\Client as ActiveCampaign;
class ActiveCampaignServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ActiveCampaign', function ($app) {
            return new ActiveCampaign('https://afdalanalytics.api-us1.com', '0ae36eda7f10ccb6fa2dc2305d8f4c1128524bd32f9eb495a196dcbf1c8d95c329e6b3a4');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
