<?php

namespace App\Providers;

use App\Models\Company;
use Lang;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use View;
use Illuminate\Support\ServiceProvider;
use App\Support\GoogleMyBusiness;
use Google_Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GoogleMyBusiness',function($app){
            //return new GoogleMyBusiness;
            $client = new Google_Client(config('google'));
            return new GoogleMyBusiness($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $locale = Lang::getLocale();

        Cashier::useCustomerModel(Company::class);

        if(isset($locale) && !empty($locale)){
            $languageId = $locale;
            //print_r($languageId); exit;
        }else{
            $languageId = 'ar';
        }

        view()->composer('tenant.home_screen', function ($view){
            if(auth()->user()->essentials()){
                $minDateFrom = date('Y/m/d', strtotime('-12 months'));
            }elseif (auth()->user()->plus()){
                $minDateFrom = date('Y/m/d', strtotime('-24 months'));
            }else{
                $minDateFrom = date('Y/m/d', strtotime('-6 months'));
            }
            $view->with('minDateFrom', $minDateFrom);
        });

        View::share('locale', $languageId);
    }
}
