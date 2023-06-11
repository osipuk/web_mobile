<?php

namespace App\Http\Controllers;

use App\Events\UserRegisteredEvent;
use App\Helpers\UserPlanHelper;
use App\Http\Requests\PasswordResetRequest;
use App\Models\Company;
use App\Models\Permission;
use App\Models\Plans;
use App\Models\Seo;
use App\Models\SocialAccount;
use App\Models\SocialAccountData;
use App\Models\Tweet;
use App\Models\TweetData;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\MultiTenantModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\TenantsMigrateCommand;
use App\Models\User;
use App\Models\Tenant;
use App\Models\TenantUser;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Redirect;
use App\Classes\IntercomAPI;
use App\Http\Controllers\ActiveCampaitngController;
//use Socialite;
use Twitter;
use Cookie;
use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\registrationMail;


class LoginController extends Controller
{
    //
    /**
     * Signup Function.
     * Vikash Rai
     * @return Response
     */
    public function register(Request $request)
    {
        if (Auth::check()) {
            //            if (env('APP_ENV') === 'production'){
            //                return redirect()->route('dashboard', ['subdomain' => Session::get('subdomain')]);
            //            }
            return redirect('/dashboard');
        }

        $request->validate([
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'email' => "required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users",
            'password' => 'required|min:8',
            'confirm_password' => 'same:password',
            'company' => 'required|max:255',
            'working_as' => 'required',
            'terms' => 'required',
        ]);


        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->working_as,
        ];

        $user = User::create($data);

        $company = Company::create([
            'name' => $request->company,
            'owner_id' => $user->id,
            'trial_ends_at' => now()->addDays(14)
        ]);

        UserRegisteredEvent::dispatch($user);

        $user->update([
            'company_id' => $company->id
        ]);

        if ($company->owner_id === $user->getKey()) {
            $permissions = Permission::get();
            $permissions->map(function ($permission) use ($user) {
                $user->permissions()->attach($permission);
            });
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            auth()->user()->company->createAsStripeCustomer();
            $request->session()->put('signUpSuccess', true);
            $request->session()->put('subdomain', strtolower($company->name));
            return redirect('/signup/step-2');
        } else {
            return back()->with('error', 'Invalid Login Credentials.');
        }
    }

    public function registerWithService(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        $data = [];

        if ($request->isMethod('post')) {
            $validation_array = [
                'password' => 'required|min:8',
                'company' => 'required|max:255',
                'working_as' => 'required',
                'terms' => 'required'
            ];

            $validation_attributes = [
                'password' => __('password'),
                'company' => __('company'),
                'working_as' => __('working_as'),
                'terms' => 'Afdal Analytics Terms',
            ];

            $validator = Validator::make($request->all(), $validation_array, [], $validation_attributes);
            $validation_message = get_message_from_validator_object($validator->errors());

            if ($validator->fails()) {
                return back()->with('error', $validation_message);
            } else {
                $service = $request->session()->get('service');
                $data = [
                    'first_name' => $request->session()->get('first_name'),
                    'last_name' => $request->session()->get('last_name'),
                    'email' => $request->session()->get('email'),
                    'password' => bcrypt($request->password),
                    //                    'company'     => $request->company,
                    'role' => $request->working_as,
                    'short_token' => $request->session()->get('short_token'),
                    'long_token' => $request->session()->get('long_token'),
                    $service . '_id' => $request->session()->get($service . '_id')
                ];

                $user = User::create($data);

                $company = Company::create([
                    'name' => $request->company,
                    'owner_id' => $user->id,
                    'trial_ends_at' => now()->addDays(14)
                ]);

                $user->update([
                    'company_id' => $company->id
                ]);

                if ($company->owner_id === $user->getKey()) {
                    $permissions = Permission::get();
                    $permissions->map(function ($permission) use ($user) {
                        $user->permissions()->attach($permission);
                    });
                }

                $credentials = [
                    'email' => $request->session()->get('email'),
                    'password' => $request->password
                ];

                //                $userName = 'tenant_user_database_'.$user_id;  // Your Database name to be created

                if (Auth::attempt($credentials)) {
                    $request->session()->put('subdomain', strtolower($company));
                    $request->session()->put('company', $request->company);
                    //                    $request->session()->put('tenant_id',$res->id);
                    $request->session()->put('role', 'Admin');
                    //                    $request->session()->put('database',$userName);
                    //                    UserSubscription::insert($insert_array);

                    auth()->user()->company->createAsStripeCustomer();

                    return redirect('signup/step-2');
                } else {
                    return back()->with('error', 'Invalid Login Credentials.');
                }
            }
        }
    }

    public function serviceAuth($req, $service, $user)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        $req->session()->forget('process');
        $existingUser = User::where('email', $user->email)->whereNull($service . '_id')->first();

        if (User::where($service . '_id', $user->id)->first()) {
            $userdetails = User::where($service . '_id', $user->id)->get();

            if ($userdetails) {
                Auth::loginUsingId($userdetails[0]->id);

                $req->session()->put('user_subscribed', true);
                $req->session()->put('process', 'login');
                $req->session()->put('role', 'Admin');
                $req->session()->put('tenant_id', $userdetails[0]->id);
                $req->session()->put('company', $userdetails[0]->company);
                $req->session()->put('database', $userdetails[0]->database_name);
                $req->session()->put('email', $userdetails[0]->email);
                $req->session()->put('long_token', $userdetails[0]->long_token);
                $req->session()->put('short_token', $userdetails[0]->short_token);

                return view('tenant.components.auth_sdk');
            }
        } elseif ($existingUser) {
            User::where('email', $user->email)->update(array($service . '_id' => $user->id,'email_verified'=>true));

            $userdetails = User::where($service . '_id', $user->id)->get();

            if ($userdetails) {
                Auth::loginUsingId($userdetails[0]->id);

                $req->session()->put('user_subscribed', true);
                $req->session()->put('process', 'login');
                $req->session()->put('role', 'Admin');
                $req->session()->put('tenant_id', $userdetails[0]->id);
                $req->session()->put('company', $userdetails[0]->company);
                $req->session()->put('database', $userdetails[0]->database_name);
                $req->session()->put('email', $userdetails[0]->email);
                $req->session()->put('long_token', $userdetails[0]->long_token);
                $req->session()->put('short_token', $userdetails[0]->short_token);

                return view('tenant.components.auth_sdk');
            }
        } else {
            $long_token = generateStringLogToken();
            $short_token = generateStringSortToken();
            $req->session()->put('process', 'signup');
            if ($service == 'google') {
                $req->session()->put('first_name', $user->user['given_name']);
                $req->session()->put('last_name', $user->user['family_name']);
                $first_name = $user->user['given_name'];
                $last_name = $user->user['family_name'];
                $ActiveCampaitng = new ActiveCampaitngController();
                $ActiveCampaitng->CreateContact($user);
                $ActiveCampaitng->EventTrackingCreation('loginWithGoogle');
                $ActiveCampaitng->EventTrackingAPI('loginWithGoogle','',$user->email);
            } elseif ($service == 'linkedin') {
                $req->session()->put('first_name', $user->user['firstName']['localized']['en_US']);
                $req->session()->put('last_name', $user->user['lastName']['localized']['en_US']);
                $first_name = $user->user['firstName']['localized']['en_US'];
                $last_name = $user->user['lastName']['localized']['en_US'];
                $ActiveCampaitng = new ActiveCampaitngController();
                $ActiveCampaitng->CreateContact($user);
                $ActiveCampaitng->EventTrackingCreation('loginWithLinkedIn');
                $ActiveCampaitng->EventTrackingAPI('loginWithLinkedIn','',$user->email);
            }
            $req->session()->put('email', $user->email);
            $req->session()->put('long_token', $long_token);
            $req->session()->put('short_token', $short_token);
            $req->session()->put('service', $service);
            $req->session()->put($service . '_id', $user->id);
            

            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $user->email,
                'role' => 'Other',
                'short_token' => $short_token,
                'long_token' => $long_token,
                $service . '_id' => $user->id,
                'email_verified' => true,
                'registered_by'=>ucfirst($service)
            ];

            $user = User::create($data);

            $company = Company::create([
                'name' => $first_name . ' ' . $last_name,
                'owner_id' => $user->id,
                'trial_ends_at' => now()->addDays(14)
            ]);

            $user->update([
                'company_id' => $company->id
            ]);

            if ($company->owner_id === $user->getKey()) {
                $permissions = Permission::get();
                $permissions->map(function ($permission) use ($user) {
                    $user->permissions()->attach($permission);
                });
            }
            // $intercom = new IntercomAPI();
            // $intercom->userRegistered($user,$service);

            session(['passwordless_model'=>true]);
            session(['registration_event_intercom'=>true]);
            session(['registration_by'=>$service]);

            
            Auth::loginUsingId($user->id);
            $req->session()->put('subdomain', strtolower($company));
            $req->session()->put('company', $req->company);
            $req->session()->put('role', 'Admin');
            auth()->user()->company->createAsStripeCustomer();

            return view('tenant.components.auth_sdk');
        }
    }

    public function loginWithGoogle(Request $request)
    {
        if (Auth::check()) {
            //            if (env('APP_ENV') === 'production'){
            //                return redirect()->route('dashboard', ['subdomain' => Session::get('subdomain')]);
            //            }
            return redirect('/dashboard');
        }
        $user = Socialite::driver('google')->user();
        return $this->serviceAuth($request, 'google', $user);
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithLinkedIn(Request $request)
    {
        if (Auth::check()) {
            $ActiveCampaitng = new ActiveCampaitngController();
            $ActiveCampaitng->CreateContact($user);
            $ActiveCampaitng->EventTrackingCreation('loginWithLinkedIn');
            $ActiveCampaitng->EventTrackingAPI('loginWithLinkedIn','',$user->email);
    
            //            if (env('APP_ENV') === 'production'){
            //                return redirect()->route('dashboard', ['subdomain' => Session::get('subdomain')]);
            //            }
            return redirect('/dashboard');
        }
        $user = Socialite::driver('linkedin')->user();
        return $this->serviceAuth($request, 'linkedin', $user);
    }

    public function linkedInRedirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function loginWithApple(Request $request)
    {
        if (Auth::check()) {
            //            if (env('APP_ENV') === 'production'){
            //                return redirect()->route('dashboard', ['subdomain' => Session::get('subdomain')]);
            //            }
            return redirect('/dashboard');
        }
        $user = Socialite::driver('apple')->user();
        return $this->serviceAuth($request, 'apple', $user);
    }

    public function appleRedirect()
    {
        return Socialite::driver("apple")
            ->scopes(["name", "email"])
            ->redirect();
    }

    public function getSessionProcess(Request $request)
    {
        $res = [
            'process' => $request->session()->get('process'),
        ];
       
        return response()->json($res);
    }

    public function signup3(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('frontend/signup3', compact('seo'));
    }

    public function signup4(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('frontend/signup4', compact('seo'));
    }

    public function signup5(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('frontend/signup5', [
            'usersCount' => Auth::user()->company->user()->count(),
            'subscriptionPlanUsersCount' => UserPlanHelper::subscription_info()->users,
            'seo' => $seo
        ]);
    }

    public function tenantRedirect(Request $request)
    {
        $request->session()->put('process', 'login');
        $company = session()->get('company');
        return redirect()->route('tenant.facebookpage', ['subdomain' => $company]);
    }

    /**
     * Login Function.
     * Vikash Rai
     * @return Response
     */
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
       
        
        $data = [];
        if ($request->isMethod('post')) {
            if(is_numeric($request->email)){
                $validation_array = [
                    'email' => 'required',
                    'password' => 'required',
                    // 'terms'         => 'required'
                ];
    
                $validation_attributes = [
                    'email' => __('email'),
                    'password' => __('password'),
                    // 'terms'         => 'Afdal Analytics Terms'
                ];
                if(substr($request->email, 0, 2)=="00"){
                    $request->email = '+' . substr($request->email, 2);
                }
                $request->request->add(['phone' => $request->email]);
                $credentials = $request->only('phone', 'password');
            } 
            else {
                $validation_array = [
                    'email' => 'required|email',
                    'password' => 'required',
                    // 'terms'         => 'required'
                ];
    
                $validation_attributes = [
                    'email' => __('email'),
                    'password' => __('password'),
                    // 'terms'         => 'Afdal Analytics Terms'
                ];
                $credentials = $request->only('email', 'password');
            }
            

            $validator = Validator::make($request->all(), $validation_array, [], $validation_attributes);
            $validation_message = get_message_from_validator_object($validator->errors());

            if ($validator->fails()) {
                return back()->with('error', $validation_message);
            } else {
                $remember_me = !empty($request->terms) && $request->terms == 'on' ? true : false;
                // $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials, $remember_me)) {
                    //                    $trial_subscription = UserSubscription::getTrialSubscription(Auth::User()->id);
                    //                    $paid_subscription  = UserSubscription::getPaidSubscription(Auth::User()->id);
                    $user_subscribed = true;
                    $userdetails = User::where('id', Auth::User()->id)->get();
                    // print_r($userdetails->id);die;
                    //                    if(empty($paid_subscription) && empty($trial_subscription)){
                    //                        $user_subscribed    = false;
                    //                    }else{
                    //                        if(empty($paid_subscription) && !empty($trial_subscription)){
                    //
                    //                            $expire = strtotime($trial_subscription->expiry_date);
                    //                            $today  = strtotime("today midnight");
                    //
                    //                            if($today >= $expire){
                    //                                $user_subscribed  = false;
                    //                            }
                    //                        }
                    //                    }

                    //                    if($user_subscribed == true){
                    //                    $request->session()->put('subdomain', strtolower(Auth::user()->company->name));
                    $request->session()->put('user_subscribed', true);
                    $request->session()->put('process', 'login');
                    $request->session()->put('role', 'Admin');
                    $request->session()->put('tenant_id', $userdetails[0]->id);
                    $request->session()->put('company', $userdetails[0]->company);
                    $request->session()->put('database', $userdetails[0]->database_name);
                    $request->session()->put('email', $userdetails[0]->email);
                    $request->session()->put('long_token', $userdetails[0]->long_token);
                    $request->session()->put('short_token', $userdetails[0]->short_token);
                    // return redirect()->route('tenant.twitterperformance', ['subdomain' => $userdetails->company]);

                    $user = Auth::user();

                    if ($user->gift) {
                        if (!$user->gift_ends_at) {
                            $user->gift_ends_at = date('Y-m-d', strtotime('+1 year'));
                            $user->save();

                            $permissions = Permission::get();
                            $permissions->map(function ($permission) use ($user) {
                                $user->permissions()->attach($permission);
                            });
                        } elseif ($user->gift_ends_at < date('Y-m-d')) {
                            $user->gift = false;
                            $user->save();
                        }
                    }

                    //                    if (env('APP_ENV') === 'production'){
                    //                        return redirect()->route('dashboard', ['subdomain' => Session::get('subdomain')]);
                    //                    }
                    return redirect('/dashboard');
                } else {
                    return back()->with('error', __('Invalid login or password'));
                }
            }
        }
    }

    public function logout(Request $request)
    {
        
        $ActiveCampaitng = new ActiveCampaitngController();
        $ActiveCampaitng->EventTrackingCreation('Logout');
        $ActiveCampaitng->EventTrackingAPI('Logout','',Auth::user()->email);
        Auth::logout();
        return redirect()->to(env('APP_URL') . 'login');
    }

    /**
     * Redirect the user to the Twitter authentication page.
     *
     * @return Response
     */
    public function redirectToTwitter($provider)
    {
        return Socialite::driver('twitter')->redirect();
    }


    /**
     * Obtain the user information from Twitter.
     * Vikash Rai
     * @return Response
     */
    //    public function handleProviderCallback(Request $request)
    //    {
    //         $provider = "twitter";
    //        $oauth_token = $_GET['oauth_token'];
    //        $oauth_verifier = $_GET['oauth_verifier'];
    //        $tokens = $this->access_token($oauth_token, $oauth_verifier);
    //        $user = Socialite::driver('twitter')->userFromTokenAndSecret($tokens->oauth_token, $tokens->oauth_token_secret);
    //        $connection = new TwitterOAuth(env('TTWITTER_API_KEY'), env('TWITTER_API_SECRET_KEY'),$tokens->oauth_token, $tokens->oauth_token_secret);
    //        $connection->setApiVersion('2');
    //        $followers = $connection->get('users/' . $user->id . '/followers');
    //        $all_tweets = $connection->get('users/' . $user->id . '/tweets');
    //
    //        $is_connect = SocialAccount::where('provider_name', 'twitter')->where('provider_id', $user->id)->where('user_id', Auth::id())->first();
    //        if($is_connect){
    //            return response()->json([
    //                'message' => 'This twitter account is already connected'
    //            ], 200);
    //        }elseif(!empty($all_tweets->meta->result_count) && $all_tweets->meta->result_count == 0){
    //            return response()->json([
    //                'message' => 'This twitter account is empty'
    //            ], 200);
    //        }
    //        $social_account = SocialAccount::updateOrCreate(
    //            [
    //                'provider_name' => 'twitter',
    //                'provider_id'   => $user->id,
    //                'user_id' => Auth::id()
    //            ],
    //            [
    //                'user_id' => Auth::id(),
    //                'provider_name' => 'twitter',
    //                'provider_id'   => $user->id,
    //                'full_name'     => $user->name,
    //                'email'         => !empty($user->email) ? $user->email : '',
    //                'avatar'        => $user->avatar,
    //                'token'         => $user->token,
    //                'refresh_token' => $user->tokenSecret,
    //                'expires_at'    => Carbon::now()->addDay(59),
    //            ]
    //        );
    //        DB::table('social_account_user')->updateOrInsert(
    //            [
    //                'user_id'           => Auth::id(),
    //                'social_account_id' => $social_account->id,
    //            ],
    //            [
    //                'user_id'           => Auth::id(),
    //                'social_account_id' => $social_account->id,
    //            ]
    //        );
    //        SocialAccountData::create([
    //            'social_account_id' => $social_account->id,
    //            'followers' => !empty($followers->meta->result_count) ? $followers->meta->result_count : null,
    //            'number_tweets' => !empty($all_tweets->meta->result_count) ? $all_tweets->meta->result_count : null,
    //            'date' => Carbon::now()->format('Y-m-d')
    //        ]);
    //        $tweets_created_last_30_days = $connection->get('users/' . $user->id . '/tweets', ['start_time' => Carbon::now()->subDays(30)->format(\DateTime::RFC3339), 'end_time'=> Carbon::now()->format(\DateTime::RFC3339)]);
    //        foreach ($tweets_created_last_30_days->data as $tweet){
    //            $tweet_data = $connection->get('tweets/' . $tweet->id,  ["tweet.fields" => "public_metrics,organic_metrics,created_at"]);
    //            $new_tweet = Tweet::create([
    //                'tweet_id' => !empty($tweet_data->data->id) ? $tweet_data->data->id : null,
    //                'text' => !empty($tweet_data->data->text) ? $tweet_data->data->text : null,
    //                'created' => !empty($tweet_data->data->created_at) ? date("Y-m-d", strtotime($tweet_data->data->created_at)) : null,
    //                'social_account_id' => $social_account->id,
    //            ]);
    //            TweetData::create([
    //                'tweet_id' => $new_tweet->id,
    //                'reply_count' => !empty($tweet_data->data->organic_metrics->reply_count) ? $tweet_data->data->organic_metrics->reply_count : 0,
    //                'impression_count' => !empty($tweet_data->data->organic_metrics->impression_count) ? $tweet_data->data->organic_metrics->impression_count : 0,
    //                'user_profile_clicks' => !empty($tweet_data->data->organic_metrics->user_profile_clicks) ? $tweet_data->data->organic_metrics->user_profile_clicks : 0,
    //                'like_count' => !empty($tweet_data->data->organic_metrics->like_count) ? $tweet_data->data->organic_metrics->like_count : 0,
    //                'retweet_count' => !empty($tweet_data->data->organic_metrics->retweet_count) ? $tweet_data->data->organic_metrics->retweet_count : 0,
    //                'quote_count' => !empty($tweet_data->data->public_metrics->quote_count) ? $tweet_data->data->public_metrics->quote_count : 0,
    //                'date' => Carbon::now()->format('Y-m-d')
    //            ]);
    //        }
    //        Session::put('twitter_connection', 'success');
    //        return view('tenant.twitter-sdk');
    //    }

    public function handleProviderCallbackWithToken(Request $request)
    {

        $oauth_verifier = $request->oauth_verifier;
        $token = session()->get('oauth_token');
        // print_r($token);die;

        if (
            empty($oauth_verifier) ||
            empty(session()->get('oauth_token')) ||
            empty(session()->get('oauth_token_secret'))
        ) {
            // something's missing, go and login again
            return redirect()->route('signup/step-2');
        }
        return redirect()->route('signup/step-3');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'first_name' => $user->name,
            'email' => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }

    public function forgetSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(64);
        $email = $request->get('email');

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        str_ends_with(env('APP_URL'), '/') ? $link = env('APP_URL') . 'new-password/' . $token : $link = env('APP_URL') . '/new-password/' . $token;

        Mail::send('emails.reset_password_ar', ['link' => $link], function ($message) use ($email) {
            $message->subject('Password reset');
            $message->to($email);
            $message->from('support@afdalanalytics.com', config('mail.from.name'));
        });
        $message = __('Check your email for a reset password');

        return back()->with('success', $message);
    }

    public function resetSubmit(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
            'password_confirmed' => 'required|same:password',
            'token' => 'required'
        ]);

        if ($request->get('password_confirmed') === 'false') {
            return back()->with('error', 'Password don`t match');
        }
        $updatePassword = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        if (!$updatePassword) {
            return back()->with('error', 'Invalid token');
        }

        $user = User::where('email', $updatePassword->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        $message = __('Your password was changed successfully');

        return redirect('/login')->with(['message' => $message]);
    }

    private function updateUser($user, $provider)
    {
        $company = session()->get('company');
        $email = session()->get('email');
        $authUser = User::where('email', $email)->first();
        $data = ['provider' => $provider, 'provider_id' => $user->id];
        $where = ['email' => $email];
        $res = User::where($where)->update($data);
        $authUsers = User::where('email', $email)->first();
        return $res;
    }

    private function access_token($oauth_token, $oauth_verifier)
    {

        $config = config('services')['twitter'];

        $connection = new TwitterOAuth($config['client_id'], $config['client_secret']);

        $tokens = $connection->oauth("oauth/access_token", ["oauth_verifier" => $oauth_verifier, "oauth_token" => $oauth_token]);

        return (object)$tokens;
    }

    /**
     * Twitter webhook for account activity api.
     * Vikash Rai
     * @return Response
     */
    public function twitterWebhook(Request $request)
    {
        // print_r("hello");die;
        $token = $_GET['crc_token'];
        echo $this->get_challenge_response($token);
    }

    /**
     * Creates a HMAC SHA-256 hash created from the app TOKEN and
     * your app Consumer Secret.
     * @param token  the token provided by the incoming GET request
     * @return string
     */

    private function get_challenge_response($token)
    {
        $APP_CONSUMER_SECRET = 'BZnhpxPikQMUqoEJmZGeXPrEcYbpUgYbCa1PfONXEnmWfacnuH';
        $hash = hash_hmac('sha256', $token, $APP_CONSUMER_SECRET, true);
        $response = array(
            'response_token' => 'sha256=' . base64_encode($hash)
        );
        return json_encode($response);
    }
}
