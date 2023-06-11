<?php

namespace App\Http\Controllers\v2;

use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Permission;
use App\Models\Seo;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client as RestClient;
use App\Classes\IntercomAPI;
use App\Http\Controllers\ActiveCampaitngController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        $request->session()->forget('process');
        $seo = Seo::where('route', $request->getRequestUri())->first();
        return view('frontend/v2/signup', compact('seo'));
    }
    public function signupSubmit(Request $request)
    {
        session(['user_email' => null]);
        session(['user_phone' => null]);
        session(['passwordless_model' => false]);
        $this->validate($request, [
            'phone' => 'required_without_all:email|sometimes|nullable|unique:users|max:20',
            'email' => 'required_without_all:phone|email|sometimes|nullable|unique:users|max:255',
            'terms' => 'required',
        ], [
            'phone.required_without_all' => __('Phone field is required when email is not available'),
            'email.required_without_all' => __('Email field is required when phone is not available'),
        ]);
        if(!empty($request['email'])){
            if(env('APP_ENV')=='local'){
                session(['user_email' => $request['email']]);
                session(['user_phone' => $request['phone']]);
            }else{
                try{
                    $url = "https://api.listclean.xyz/v1/";
                    $endpoint = 'verify/email/';
                    $api_key = env('LISTCLEAN_TOKEN');
                    $email = $request['email'];
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url . $endpoint . $email);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'X-AUTH-TOKEN: '. $api_key,
                    ));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $rr = curl_exec($ch);
                    curl_close($ch);
                    $rr = json_decode($rr, true);
                    if($rr['data']['status']=='clean' || $rr['data']['status']=='unknown'){
                        session(['user_email' => $request['email']]);
                        session(['user_phone' => $request['phone']]);
                        return response()->json([
                            'status' => true,
                        ], 200);
        
                    }else{
                        return response()->json([
                            'status' => false,
                        ], 200);
                    }
                }
                catch(Exception $e){
                    return $e->getMessage();
                }
            }
           
           
        }else{
            session(['user_email' => $request['email']]);
            session(['user_phone' => $request['phone']]);
        }
        
        return response()->json([
            'status' => true,
        ], 200);
    }
    public function verify($id, EmailVerificationRequest $request)
    {
        $request->fulfill();
        User::where('id', $id)->update([
            'email_verified' => true
        ]);

        return redirect()->to('/demo-dashboard'); // <-- change this to whatever you want
    }
    public function request()
    {
        auth()->user()->sendEmailVerificationNotification();

        return back()
            ->with('success', 'Verification link sent!');
    }
    public function signup2(Request $request)
    {
        // dd(auth()->user()->company);
        $seo = Seo::where('route', $request->getRequestUri())->first();
        return view('frontend/v2/personal-info', compact('seo'));
    }
    public function signup2SubmitUpdate(Request $request){
        $validated=$request->validate([
            'phone'=>'required|unique:users|max:20',
            'company' => 'required|string|max:50',
        ]);
        $user=User::where('id',Auth::user()->id)->first();
        $user->update([
            'phone' => $validated['phone']
        ]);
        Company::where('id',Auth::user()->company_id)->update([
            'name' => $validated['company'],
        ]);
        // if (!empty($validated['phone'])) {
        //     $token = env("TWILIO_AUTH_TOKEN");
        //     $twilio_sid = env("TWILIO_SID");
        //     $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        //     $twilio = new RestClient($twilio_sid, $token);
        //     $twilio->verify->v2->services($twilio_verify_sid)
        //         ->verifications
        //         ->create($validated['phone'], "sms");
        // }
        // if (!empty($user->email)) {
        //     UserRegisteredEvent::dispatch($user);
        //     event(new Registered($user));
        // }
        session(['passwordless_model'=>false]);
        return response()->json([
            'status' => true,
        ], 200);
    }
    public function signup2Submit(Request $request)
    {
        //   'phone' => 'required_without_all:email|sometimes|nullable|unique:users|max:20',
        session(['is_email_signup' => false]);
        session(['is_phone_signup' => false]);
        $request->request->add(['email' => session('user_email')]);
        $is_email_signup=false;
       
        if(!empty(session('user_email'))){
            $is_email_signup=true;
            session(['is_email_signup' => true]);
            $registered_by='Email';
        }
        $is_phone_signup=false;
        if(!empty(session('user_phone'))){
            $request->request->add(['phone' => session('user_phone')]);
            $is_phone_signup=true;
            session(['is_phone_signup' => true]);
            $registered_by='Phone';
        }
        
        $validated = $this->validate($request, [
            'phone' => 'required|unique:users|max:20',
            'email' => 'required_without_all:phone|sometimes|nullable|unique:users|max:255',
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'company' => 'required|string|max:50',
            'password' => 'required|min:8',
            'confirm_password' => 'same:password',
        ], [
            'phone.required_without_all' => 'Phone field is required when email is not available.',
            'email.required_without_all' => 'Email field is required when phone is not available.',
        ]);
        $user = User::create([
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'password' => bcrypt($validated['password']),
            'registered_by'=>$registered_by
        ]);
        $company = Company::create([
            'name' => $validated['company'],
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
        if (!empty($validated['phone']) && $is_phone_signup) {
            $token = env("TWILIO_AUTH_TOKEN");
            $twilio_sid = env("TWILIO_SID");
            $twilio_verify_sid = env("TWILIO_VERIFY_SID");
            $twilio = new RestClient($twilio_sid, $token);

            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($validated['phone'], "sms");

            // Use the Twilio API to send a WhatsApp message to the user
            // $twilio ->messages->create(
            //     'whatsapp:'.$validated['phone'], // The user's phone number, including the country code
            //     array(
            //         'from' => 'whatsapp:+18595497126', // Your Twilio WhatsApp-enabled phone number
            //         'body' => 'Hello, this is a test message from Afdal!' // The message body
            //     )
            // );
        }
        
        if (!empty($validated['email'])) {
            UserRegisteredEvent::dispatch($user);
            if(env('APP_ENV')=='local'){
                $user->update([
                    'email_verified'=>true,
                ]);
            }
        }
        if (!empty($validated['email'])) {
            $credentials = $request->only('email', 'password');
            //send verification email
            event(new Registered($user));
            $login = Auth::attempt($credentials);
        }else{
            $login = Auth::loginUsingId($user->id);
        }
        $ActiveCampaitng = new ActiveCampaitngController();
        $ActiveCampaitng->CreateContact($user);

        // $intercom = new IntercomAPI();
        //user register event on intercom
        // $intercom->userRegistered($user,$registered_by);
        // $intercom->EventTrackingAPI('userRegistered','abc');
        $ActiveCampaitng->EventTrackingCreation('login');
        $ActiveCampaitng->EventTrackingAPI('login','login with email',$user->email);
        session(['user_email' => null]);
        session(['user_phone' => null]);

        session(['is_phone_signup_for_modal' => $is_phone_signup]);
        session(['is_email_signup_for_modal' => $is_email_signup]);
        if (!$login) {
            return response()->json([
                'status' => false,
                'email' => !empty($validated['email']) ? true : false,
                'phone' => !empty($validated['phone']) ? true : false,
                'is_phone_signup'=>$is_phone_signup,
                'is_email_signup'=>$is_email_signup
            ], 200);
        }
       
        
        auth()->user()->company->createAsStripeCustomer();
        $request->session()->put('signUpSuccess', true);
        $request->session()->put('subdomain', strtolower($company->name));
        return response()->json([
            'status' => true,
            'email' => !empty($validated['email']) ? true : false,
            'phone' => !empty($validated['phone']) ? true : false,
            'is_phone_signup'=>$is_phone_signup,
            'is_email_signup'=>$is_email_signup
        ], 200);
    }
   
    public function signup3(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();
        return view('frontend/v2/otp', compact('seo'));
    }
    public function signup3Submit(Request $request)
    {
        $data = $request->validate([
            'otp' => 'required|string|max:6',
        ]);
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        $twilio = new RestClient($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(['code' => $data['otp'], 'to' => Auth::user()->phone]);
        if ($verification->valid) {
            User::where('id', Auth::user()->id)->update([
                'phone_verified' => true,
                'otp' => null
            ]);
            return response()->json([
                'status' => true
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Otp does not match'
            ], 200);
        }
    }
    public function resendOtp(){
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        $twilio = new RestClient($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create(auth()->user()->phone, "sms");
        return response()->json([
            'status' => true,
        ], 200);
    }

    public function login(Request $request){
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        $mess = null;
        if (Session::get('message')) {
            $mess = Session::get('message');
            Session::remove('message');
        }
        $seo = Seo::where('route', $request->getRequestUri())->first();
        return view('frontend/v2/login', compact('seo', 'mess'));
    }
    public function loginPost(Request $request){
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'phone' => 'required_without_all:email|max:20',
                'email' => 'required_without_all:phone|max:255',
                'password'=>'required',
                'remember_me' => 'nullable',
            ], [
                'phone.required_without_all' => __('Phone field is required when email is not available'),
                'email.required_without_all' => __('Email field is required when phone is not available'),
            ]);
            $remember_me = $request->remember_me;
            $auth=false;
            if(!empty($request['email'])){
                $credentials = $request->only('email', 'password');
                $auth=Auth::attempt($credentials, $remember_me);
            }
            if(!empty($request['phone'])){
                $credentials = $request->only('phone', 'password');
                if(!$auth){
                    $auth=Auth::attempt($credentials, $remember_me);
                }
            }
            
            if ($auth) {
                $user_subscribed = true;
                $userdetails = User::where('id', Auth::User()->id)->get();
                $request->session()->put('user_subscribed', true);
                $request->session()->put('process', 'login');
                $request->session()->put('role', 'Admin');
                $request->session()->put('tenant_id', $userdetails[0]->id);
                $request->session()->put('company', $userdetails[0]->company);
                $request->session()->put('database', $userdetails[0]->database_name);
                $request->session()->put('email', $userdetails[0]->email);
                $request->session()->put('long_token', $userdetails[0]->long_token);
                $request->session()->put('short_token', $userdetails[0]->short_token);

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
                return response()->json([
                    'status' => true,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message'=> __('Invalid login or password')
                ], 200);
            }
        }
        return response()->json([
            'status' => false,
            'message'=> __('Error')
        ], 200);
    }

    public function forgotPasswordNew(Request $request){
        session(['forgot_phone' => null]);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'phone' => 'required_without_all:email|max:20',
                'email' => 'required_without_all:phone|max:255',
            ], [
                'phone.required_without_all' => __('Phone field is required when email is not available'),
                'email.required_without_all' => __('Email field is required when phone is not available'),
            ]);
            $phone=false;
            $email=false;
            if(!empty($request['phone'])){
                $get_user=User::where('phone',$request['phone'])->whereNull('deleted_at')->first();
                if($get_user){
                    $phone=true;
                }
                
            }
            if(!empty($request['email'])){
                $get_user=User::where('email',$request['email'])->whereNull('deleted_at')->first();
                if($get_user){
                    $email=true;
                }
            }
            if(!$phone && !$email){
                if(!empty($request['phone'])){
                    $message= __('Invalid Phone');
                }
                if(!empty($request['email'])){
                    $message= __('Invalid Email');
                }
                if(!empty($request['phone']) && !empty($request['email'])){
                    $message= __('Invalid Email and Phone');
                }

                return response()->json([
                    'status' => false,
                    'message'=> $message
                ], 200);
            }
            if($phone){
                session(['forgot_phone' => $request['phone']]);
                $token = env("TWILIO_AUTH_TOKEN");
                $twilio_sid = env("TWILIO_SID");
                $twilio_verify_sid = env("TWILIO_VERIFY_SID");
                $twilio = new RestClient($twilio_sid, $token);
    
                $twilio->verify->v2->services($twilio_verify_sid)
                    ->verifications
                    ->create($request['phone'], "sms");

                return response()->json([
                    'status' => true,
                    'is_phone'=>true,
                    'phone'=>substr($request['phone'], 0, 6).'*** ***'
                ], 200);
            }
            if($email){
                $token = Str::random(64);
                $email = $request['email'];

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
                return response()->json([
                    'status' => true,
                    'is_phone'=>false,
                    'email'=>$request['email'],
                    'message'=>$message
                ], 200);
            }
            
        }
        return response()->json([
            'status' => false,
            'message'=> __('Error')
        ], 200);
    }
    public function forgotPasswordOtp(Request $request){
        $data = $request->validate([
            'otp' => 'required|string|max:6',
        ]);
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        $twilio = new RestClient($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(['code' => $data['otp'], 'to' => session('forgot_phone')]);
        if ($verification->valid) {
            return response()->json([
                'status' => true
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Otp does not match'
            ], 200);
        }
    }
    public function forgotPassworReset(Request $request){
        $request->validate([
            'password' => 'required|string|min:8',
            'password_confirmed' => 'required|same:password'
        ]);

        $user = User::where('phone', session('forgot_phone'))->first();
        $user->password = Hash::make($request->password);
        $user->save();
        $login = Auth::loginUsingId($user->id,$request->keep_signed_in_new);
        $user_subscribed = true;
        $userdetails = User::where('id', Auth::User()->id)->get();
        $request->session()->put('user_subscribed', true);
        $request->session()->put('process', 'login');
        $request->session()->put('role', 'Admin');
        $request->session()->put('tenant_id', $userdetails[0]->id);
        $request->session()->put('company', $userdetails[0]->company);
        $request->session()->put('database', $userdetails[0]->database_name);
        $request->session()->put('email', $userdetails[0]->email);
        $request->session()->put('long_token', $userdetails[0]->long_token);
        $request->session()->put('short_token', $userdetails[0]->short_token);
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
        return response()->json([
            'status' => true,
        ], 200);
        $message = __('Your password was changed successfully');

        return response()->json([
            'status' => true,
            'message' => $message
        ], 200);
    }
    public function resendOtpForgot(Request $request){
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        $twilio = new RestClient($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create(session('forgot_phone'), "sms");
        return response()->json([
            'status' => true,
        ], 200);
    }

    public function newPassword(Request $request, $token){
        if(Auth::check()){
            return redirect('/dashboard');
        }
        $email=null;
        $seo = Seo::where('route', 'new Password')->first();
        $get_email = DB::table('password_resets')
            ->where('token', $token)
            ->first();
        if($get_email){
            $email=$get_email->email;
        }

        return view('frontend/v2/reset-password', ['token' => $token, 'seo' => $seo,'email'=>$email]);
    }
    public function resetSubmit(Request $request){
        $request->validate([
            'password' => 'required|string|min:8',
            'password_confirmed' => 'required|same:password',
            'token' => 'required'
        ]);

        
        $updatePassword = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        if (!$updatePassword) {
            return response()->json([
                'status' => false,
                'message'=>__('Token Expired')
            ], 200);
        }

        $user = User::where('email', $updatePassword->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        $login = Auth::loginUsingId($user->id,$request->remember_me);
        $user_subscribed = true;
        $userdetails = User::where('id', Auth::User()->id)->get();
        $request->session()->put('user_subscribed', true);
        $request->session()->put('process', 'login');
        $request->session()->put('role', 'Admin');
        $request->session()->put('tenant_id', $userdetails[0]->id);
        $request->session()->put('company', $userdetails[0]->company);
        $request->session()->put('database', $userdetails[0]->database_name);
        $request->session()->put('email', $userdetails[0]->email);
        $request->session()->put('long_token', $userdetails[0]->long_token);
        $request->session()->put('short_token', $userdetails[0]->short_token);
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
        $message = __('Password Updated');

        return response()->json([
            'status' => true,
            'message'=>$message
        ], 200);
    }
}
