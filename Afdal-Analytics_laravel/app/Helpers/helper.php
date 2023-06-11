<?php 

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

    function makeDBConnection($database_name='')
    {
        config([
            'database.connections.tenant.database' => $database_name,
        ]);

        DB::purge('tenant');

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();
    }

    function pp($arr, $die="true")
    {
            echo '<pre>';
            print_r($arr);
            echo '</pre>';
            if($die == 'true')
            {
                die();
            }
    }
    function _print_r($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }


    //date final format function start here for view time
    function customFrontendDateChange($date){
        return date('d/m/Y h:i A',strtotime($date));
    }
    //date final format function End here for view time

    // submit Date time format in DB Start

    function customBackendDateChange($date){
        return date('Y-m-d h:i:s',strtotime($date));
    }

    //Submit DAte time format in DB End

    function getUniqqueId(){
        $number = mt_rand(1000000000, 9999999999); 
        return "OMPINV".$number;
    }

    /** genrate unic count */
    function getUniqqueCounterId(){
        $number = mt_rand(10000, 99999); 
        return $number;
    }

    /** Get user name */
    function getuserName($id){
        $name = User::select('name')->where('id',$id)->get();
        return $name['0']['name'];
    }

    function get_message_from_validator_object($validator_object)
    {
        $array = json_decode(json_encode($validator_object),1);
        $message = '';
        $message_array = [];
        $i = 0;
        foreach ($array as $key => $value) {
            foreach ($value as $k => $val) {
                if(!in_array($val,$message_array)){
                    $message_array[] = $val;
                    $tilde    = $i == 0 ? '':" ";
                    $message .= $tilde.$val;
                    $i++;
                }
            }
        }
        return $message;
    }


    function generateStringLogToken()
    {
        $number =(Str::random(15));
        return $number.mt_rand(10000, 99999);
    }

    function generateStringSortToken()
    {
        $var = Str::random(5);
        return $var;
    }

    if (!function_exists('tenant')) {
        /**
         * Get shop by subdomain
         *
         * @param null $subdomain
         * @return \App\Shop
         */
    
        function shop($subdomain = null)
        {
            $subdomain = $subdomain ?: request()->route('subdomain');
            $tenant = \App\Models\User::where('company', $subdomain)->first();
            if (!$tenant) {
                return new \App\Models\User;
            }
            return $tenant;
        }
    }
    
    if (!function_exists('domain')) {
        /**
         * Get current domain
         *
         * @param null $subdomain
         * @return \App\Shop
         */
    
        function domain()
        {
            $subdomain = request()->route('subdomain');
            return $subdomain;
        }
    }
    
    if (!function_exists('domain_route')) {
        /**
         * Generate the URL to a named route.
         * This is a modified version of Laravel's route() function
         * Pass subdomain value automatically
         *
         * @param  array|string $name
         * @param  mixed $parameters
         * @param  bool $absolute
         * @return string
         */
        function domain_route($name, $parameters = [], $absolute = true)
        {
            $parameters['subdomain'] = request()->route('subdomain');
            return app('url')->route($name, $parameters, $absolute);
        }
    }
    if (!function_exists('checkLangaugeGlobaly()')) {
        function checkLangaugeGlobaly(){
            $get_locale = NULL;

            if( null !== session()->get('locale') ){
                if(session()->get('locale') == 'en'){
                    $get_locale = 'en';
                }
                else{
                    $get_locale = 'ar';
                }
            }
            else{
                $get_locale = 'ar';
            }
            app()->setLocale($get_locale);
            return $get_locale;
        }
    }
