<?php

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\FacebookAdsController;
use App\Http\Controllers\GoogleAdsController;
use App\Http\Controllers\GoogleAnalyticsController;
use App\Http\Controllers\GoogleAnalyticsUAController;
use App\Http\Controllers\InstagramController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SwitchUserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\GMBController;
use App\Mail\InviteUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Str;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\SocialShareController;
use App\Http\Controllers\TapfiliateConversionController;
use App\Http\Controllers\v2\AuthController;
use App\Http\Controllers\v2\ConnectionController as V2ConnectionController;
use App\Models\SocialAccount;
use App\Models\User;
use App\Support\MyFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use MailchimpMarketing\ApiClient;
use App\Classes\IntercomAPI;
use App\Http\Controllers\v2\BillingController;
use App\Http\Controllers\v2\TenantController as V2TenantController;
use App\Http\Controllers\v2\UserDashboardController as V2UserDashboardController;
use App\Http\Controllers\v2\WebsiteController as V2WebsiteController;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
//  this is test to do merge
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

Route::get('test-test',function(Request $request){

  $curl = curl_init();
  
  curl_setopt_array($curl, [
    CURLOPT_URL => "https://afdalanalytics.api-us1.com/api/3/fields?limit=100",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      "Api-Token: 0ae36eda7f10ccb6fa2dc2305d8f4c1128524bd32f9eb495a196dcbf1c8d95c329e6b3a4",
      "accept: application/json"
    ],
  ]);
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }
});
Route::get('gmb', [GMBController::class, 'authRedirect']);
Route::get('gmb/callback', [GMBController::class, 'callback']);


Route::get('.well-known/pki-validation/699969F9A7435DB9E7E11D176B78020A.txt', function(){
    echo "153DFCD68E8C03E3A6E4AE3D0621DA76819FA802B41F4DE1CA987A40BC063C4F comodoca.com 6351705b70b25";
});


Route::get('/facebook-test/{token}', [FacebookController::class, 'facebook_test'])->name('fb.test');

//frontend routes
//Route::get('/', [WebsiteController::class, 'index']);
//Route::get('/home-main', [WebsiteController::class, 'home_main'])->name('home_main');
Route::get('/tapfiliate', [TapfiliateConversionController::class, 'index'])->name('tapfiliate.index');
Route::get('/', [WebsiteController::class, 'home_new'])->name('home_new');
Route::get('/privacy-policy', [WebsiteController::class, 'privacy_policy']);
Route::get('/cookie-policy', [WebsiteController::class, 'cookie_policy']);
//Route::get('/success', [WebsiteController::class, 'success']);
//Route::get('/analytics-campaign', [WebsiteController::class, 'analytics_campaign']);
//Route::get('/admin/dashboard', [SuperAdminController::class, 'index'])->name('dashboard');
//Route::get('/home', [WebsiteController::class, 'index'])->name('home');
Route::get('/contact-us', [WebsiteController::class, 'contact_us']);
Route::get('/about-afdal', [WebsiteController::class, 'about_afdal']);
Route::get('/about-connections', [WebsiteController::class, 'about_connections']);
Route::get('/about-dashboards', [WebsiteController::class, 'about_dashboards']);
Route::get('/why-us', [WebsiteController::class, 'why_us']);
Route::get('/glossary', [WebsiteController::class, 'glossary']);
Route::get('/pricing', [WebsiteController::class, 'about_pricing']);
// Route::get('/pricing-under-development', [WebsiteController::class, 'about_pricing_test']);
Route::get('/guides', [WebsiteController::class, 'guides']);
Route::get('/guides/{url}', [WebsiteController::class, 'guides_one']);
Route::get('/blog/{category_seo_url?}', [WebsiteController::class, 'analytics_blog']);
//Route::get('/blog/{seo_url}', [WebsiteController::class, 'blog']);
Route::get('/blog/{category_seo_url}/{blog_seo_url}', [WebsiteController::class, 'blog_full']);
Route::get('/not-found', [WebsiteController::class, 'not_found']);
Route::get('/dashboard/not-found', [WebsiteController::class, 'dashboard_not_found']);
//Route::get('/dashboard/pricing', [WebsiteController::class, 'dashboard_pricing']);
Route::get('/dashboard/help', [WebsiteController::class, 'help']);
Route::get('/dashboard/help_knowledge_base', [WebsiteController::class, 'help_knowledge_base']);
Route::get('/form/search-blog', [WebsiteController::class, 'search_blog'])->name('blog-search');
////
// Route::get('/login', [WebsiteController::class, 'signin'])->name('login');
// Route::get('/signup', [WebsiteController::class, 'signup'])->name('signup');

Route::get('/signup-service', [WebsiteController::class, 'signupService'])->name('signupService');
Route::get('/forgotpass', [WebsiteController::class, 'forgotpass'])->name('forgotpass');
Route::get('/product', [WebsiteController::class, 'product'])->name('product');
Route::get('/term-condition', [WebsiteController::class, 'termcondition'])->name('termcondition');
Route::get('/subscription-successful', [WebsiteController::class, 'subscription_successful']);
Route::get('/pdf/{template}/{dashboardId}', [PdfController::class, 'index']);

Route::get('/test-sub', [PlansController::class, 'test'])->name('test');

//Comented route below because we use another route "privacy-policy"
//Route::get('/privacypolicy', [WebsiteController::class, 'privacypolicy'])->name('privacypolicy');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/signup/step-2', [LoginController::class, 'signup3'])->name('signup-2');
    Route::get('/signup/step-3', [LoginController::class, 'signup4'])->name('signup-3');
    Route::get('/signup/step-4', [LoginController::class, 'signup5'])->name('signup-4');
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/dashboard/pricing/{plan_name}', [WebsiteController::class, 'pricing_period']);
    Route::get('/dashboard/subscribe-plan', [WebsiteController::class, 'subscribe_plan'])->name('subscribe-plan');
    Route::get('/subscription-plan', [WebsiteController::class, 'subscription_plan']);
    Route::get('/switch/{template}/{id}', [SwitchUserController::class, 'switch']);

    Route::get('paypal-details', [PlansController::class, 'paypalDetails'])->name('detailspaypal');



    Route::get('/payments', [PlansController::class, 'index'])->name('payments');
    Route::post('/payments', [PlansController::class, 'store'])->name('payments.store');
    Route::post('/checkout-change-default-mehtod', [PlansController::class, 'checkoutChangeDefaultMethod'])->name('checkoutChangeDefaultMethod');
    Route::post('/set-paypal', [PlansController::class, 'setPaypalMethod'])->name('setPaypalMethod');
    Route::post('/subscribe-consulting-plan', [PlansController::class, 'subscribe_consulting'])->name('subscribe.consulting');
    Route::post('/subscribe-new-plan', [PlansController::class, 'subscribe'])->name('subscribe');
    Route::post('/subscribe-new-plan-paypal', [PlansController::class, 'subscribePaypal'])->name('subscribePaypal');
    Route::post('/cancel-subscription', [PlansController::class, 'unsubscribe'])->name('unsubscribe');
    Route::post('/cancel-consulting-subscription', [PlansController::class, 'unsubscribeConsulting'])->name('unsubscribeConsulting');
    Route::post('/cancel-paypal-subscription', [PlansController::class, 'unsubscribePaypal'])->name('unsubscribePaypal');
    Route::post('/delete-payment-method', [PlansController::class, 'deletePaymentMethod'])->name('deletePaymentMethod');
    Route::post('/update-payment-method', [PlansController::class, 'updatePaymentMethod'])->name('updatePaymentMethod');
    Route::get('/invoice/{id}', [PlansController::class, 'getPaypalInvoice'])->name('getPaypalInvoice');

    Route::get('twitter/login', [TwitterController::class, 'twitterLogin']);
    Route::get('twitter/callback', [TwitterController::class, 'handleProviderCallback']);
    Route::get('facebook/login', [FacebookController::class, 'facebookLogin']);
    Route::post('facebook/callback', [FacebookController::class, 'facebookCallback']);
    Route::post('/instagram/callback', [InstagramController::class, 'instagramCallback']);
    Route::post('/facebook-ads/callback', [FacebookAdsController::class, 'facebookAdsCallback']);
    Route::get('/facebook-ads/test', [FacebookAdsController::class, 'adstest']);
    Route::get('google-analytics/login', [GoogleAnalyticsController::class, 'login']);
    Route::get('google-analytics/callback', [GoogleAnalyticsController::class, 'handleProviderCallback']);
    Route::get('google-analytics-ua/callback', [GoogleAnalyticsUAController::class, 'handleProviderCallback']);
    Route::get('google-analytics/index', [GoogleAnalyticsController::class, 'index']);
    Route::get('google-ads/login', [GoogleAdsController::class, 'login']);
    Route::get('google-ads/callback', [GoogleAdsController::class, 'callback']);
    Route::post('/connection/sync', [TenantController::class, 'removeConnection']);
    Route::get('/dashboard/template/{type}', [UserDashboardController::class, 'show']);
    Route::get('check-count-connections', [ConnectionController::class, 'countConnectionsCheck']);
    
    Route::get('/pdf-export/{template}', [PdfController::class, 'index']);
    Route::get('/switch-account/{template}/{account_id}/{page_id?}', [UserDashboardController::class, 'switchAccount']);
    Route::post('/create-dashboard', [UserDashboardController::class, 'store']);
    Route::get('/generate-pdf/{template}/{dashboardId}', [PdfController::class, 'genPdf']);
    //without subdomain
    Route::get('/dashboard/facebook-overview',[FacebookController::class, 'facebookPageOverview']);
    Route::get('/dashboard/google-ads-overview',[GoogleAdsController::class, 'googleAdsOverview']);
    Route::get('/dashboard/google-analytics-overview',[GoogleAnalyticsController::class, 'googleAnalyticsPropertyOverview']);
    Route::get('/dashboard/google-analytics-ua-overview',[GoogleAnalyticsUAController::class, 'googleAnalyticsProfileOverview']);
    Route::get('/dashboard/facebook-engagement',[FacebookController::class, 'facebookPageEngagement']);
    Route::get('/dashboard/twitter-overview', [TwitterController::class, 'twitterOverview']);
    // Route::get('/dashboard/instagram-overview',[InstagramController::class, 'instagramOverview']);
    Route::get('/dashboard/facebook-ads-overview', [FacebookAdsController::class, 'facebookAdsOverview']);
    Route::get('/dashboard/connectionsPre', [TenantController::class, 'connections'])->name('connections');
    // Route::get('/dashboard/templates', [WebsiteController::class, 'template'])->name('template');
    Route::get('/dashboard/template/{type}', [UserDashboardController::class, 'show']);
    Route::get('/dashboard', [TenantController::class, 'home_screen'])->name('dashboard');
    
    Route::post('/dashboard/update-profile', [UserProfileController::class, 'updateUserProfile'])->name('update-profile');
    Route::post('/dashboard/update-profile-new', [UserProfileController::class, 'updateUserProfileNew'])->name('update-profile-dashboard');
    Route::get('/get-auth-user',[UserProfileController::class, 'getUserInfo'])->name('get-profile-dashboard');
    Route::get('get-connects-by-provider/{connections_name}', [ConnectionController::class, 'getUserConnections']);
    Route::post('search-connects-by-provider', [ConnectionController::class, 'searchUserConnections']);
    Route::post('/google-ads-report-new', [V2ConnectionController::class, 'googleAddsReport']);
    Route::get('/check-add-members', [MemberController::class, 'checkAbilityAddUser']);
    Route::post('/add-members', [MemberController::class, 'inviteMember']);
    Route::post('/add-members-new', [MemberController::class, 'inviteMemberNew']);
    Route::get('/company-members', [MemberController::class, 'getCompanyMembers']);
    Route::get('/remove-members/{id}', [MemberController::class, 'removeMember']);
    Route::get('/view-activity/{id}', [UserProfileController::class, 'viewActivity']);
    Route::get('/view-activity-all', [UserProfileController::class, 'viewActivityAll']);
    Route::post('/dashboard/create', [UserDashboardController::class, 'storeDashboard']);
    Route::get('/dashboard/user-profile', [TenantController::class, 'user_profile'])->name('home_screen');
    // Route::get('/dashboard/user-billing', [TenantController::class, 'user_billing'])->name('user_billing');
    Route::get('/dashboard/user-billing-v1', [TenantController::class, 'user_billing_v1'])->name('user_billing_v1');
    Route::get('/dashboard/user-team', [TenantController::class, 'user_team'])->name('user_team');

    Route::get('/dashboard/change-plan', [WebsiteController::class, 'settings_change_plan']);
    Route::get('/user-permissions-manage/{userId}', [MemberController::class, 'getMemberWithPermissions']);
    Route::get('/dashboard/no-subscription', [TenantController::class, 'noSubscription']);
    Route::get('/dashboard/no-permission', [TenantController::class, 'noPermission']);
    Route::post('/update-user-permissions', [MemberController::class, 'updateMemberPermissions']);
    Route::get('/dashboard/get-activities', [TenantController::class, 'getActivityByDate']);
    //subdomain
//    Route::domain('{subdomain}.' . env('APP_DOMAIN'))->group(function () {
//        Route::get('/switch/{template}/{id}', [SwitchUserController::class, 'switch']);
//        Route::get('/subscribe-plan', [WebsiteController::class, 'subscribe_plan'])->name('subscribe-plan');
//        Route::post('/update-user-permissions', [MemberController::class, 'updateMemberPermissions']);
//        Route::get('/user-permissions-manage/{userId}', [MemberController::class, 'getMemberWithPermissions']);
//        Route::get('/user-permissions-manage/{userId}', [MemberController::class, 'getMemberWithPermissions']);
//        Route::get('/check-add-members', [MemberController::class, 'checkAbilityAddUser']);
//        Route::post('/add-members', [MemberController::class, 'inviteMember']);
//        Route::get('/company-members', [MemberController::class, 'getCompanyMembers']);
//        Route::get('/remove-members/{id}', [MemberController::class, 'removeMember']);
//        Route::get('/view-activity/{id}', [UserProfileController::class, 'viewActivity']);
//        Route::post('/dashboard/create', [UserDashboardController::class, 'storeDashboard']);
//        Route::post('/create-dashboard', [UserDashboardController::class, 'store']);
//        Route::get('/switch-account/{template}/{account_id}/{page_id?}', [UserDashboardController::class, 'switchAccount']);
//        Route::post('search-connects-by-provider', [ConnectionController::class, 'searchUserConnections']);
//
//        Route::group(['middleware' => ['subdomain'], 'prefix'=>'dashboard'], function () {
//            Route::get('/', [TenantController::class, 'home_screen'])->name('dashboard');
//            Route::get('facebook-overview',[FacebookController::class, 'facebookPageOverview'])->name('facebook-overview');
//            Route::get('facebook-engagement',[FacebookController::class, 'facebookPageEngagement'])->name('facebook-engagement');
//            Route::get('twitter-overview', [TwitterController::class, 'twitterOverview'])->name('twitter-overview');
//            Route::get('instagram-overview',[InstagramController::class, 'instagramOverview'])->name('instagram-overview');
//            Route::get('facebook-ads-overview', [FacebookAdsController::class, 'facebookAdsOverview'])->name('facebook-ads-overview');
//            Route::get('templates', [WebsiteController::class, 'template'])->name('template');
//            Route::get('connections', [TenantController::class, 'connections'])->name('connections');
//            Route::post('update-profile', [UserProfileController::class, 'updateUserProfile'])->name('update-profile');
//            Route::get('user-profile', [TenantController::class, 'user_profile'])->name('home_screen');
//            Route::get('user-billing', [TenantController::class, 'user_billing'])->name('user_billing');
//            Route::get('user-team', [TenantController::class, 'user_team'])->name('user_team');
//            Route::get('change-plan', [WebsiteController::class, 'settings_change_plan']);
//            Route::get('no-subscription', [TenantController::class, 'noSubscription']);
//            Route::get('no-permission', [TenantController::class, 'noPermission']);
//        });
//    });
});

Route::get('/company/signup', [MemberController::class, 'index']);
Route::post('/register-member', [MemberController::class, 'store']);
Route::post('/subscribe-mailchimp', [WebsiteController::class, 'subscribe']);

Route::post('/register', [LoginController::class, 'register']);
Route::post('/register-service', [LoginController::class, 'registerWithService']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/reset-password', [WebsiteController::class, 'resetPassword']);
// Route::get('/new-password/{token}', [WebsiteController::class, 'newPassword']);
// Route::post('/reset-password', [LoginController::class, 'resetSubmit'])->name('reset.password.submit');
Route::post('/forget-password', [LoginController::class, 'forgetSubmit'])->name('forget.password.submit');

Route::post('/intercom-submit-event', function(Request $request){
    if(!Auth::user()->is_sent_registered_event){
        // $intercom = new IntercomAPI();
        // $intercom->userRegistered(auth()->user(),$request->registered_by);
        $user=User::where('id',auth()->user()->id)->update([
            'is_sent_registered_event'=>true
        ]);
    }
    return response()->json([
        'status' => true,
    ], 200);
});


Route::get('/get-process', [LoginController::class, 'getSessionProcess']);

Route::get('/auth/google', [LoginController::class, 'googleRedirect'])->name('auth.google');
Route::get('/auth/google/callback', [LoginController::class, 'loginWithGoogle']);
Route::get('/auth/linkedin', [LoginController::class, 'linkedInRedirect'])->name('auth.linkedIn');
Route::get('/auth/linkedin/callback', [LoginController::class, 'loginWithLinkedIn']);
Route::get('/auth/apple', [LoginController::class, 'appleRedirect'])->name('auth.apple');
Route::post('/auth/apple/callback', [LoginController::class, 'loginWithApple']);

Route::get('/get-process', [LoginController::class, 'getSessionProcess']);

Route::get('/tenantredirect', [LoginController::class, 'tenantRedirect']);
Route::get('twitterwebhook', [LoginController::class, 'twitterWebhook'])->name('twitterwebhook');
Route::get('login/{provider}', [LoginController::class, 'redirectToTwitter']);
Route::get('{provider}/callbackwithtoken', [LoginController::class, 'handleProviderCallbackWithToken']);



Route::get('lang/{locale}', [LocalizationController::class, 'index']);
Route::get('/resource', [WebsiteController::class, 'resource'])->name('resource');
Route::get('/contactus', [WebsiteController::class, 'contactus'])->name('contactus');

//Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//});

//admin routes
//Route::get('/admin', [SuperAdminController::class, 'signIn']);
//Route::get('/sign-in', [SuperAdminController::class, 'signIn'])->name('sign-in');
//Route::post('/loging-in', [SuperAdminController::class, 'login'])->name('loging-in');
//Route::get('/dashboard',[SuperAdminController::class, 'index'])->name('dashboard');
//Route::get('/forgot-password', [SuperAdminController::class, 'forgotpassword'])->name('forgotpassword');
//Route::get('/user-management', [SuperAdminController::class, 'usermanagement'])->name('usermanagement');
//Route::get('/billing', [SuperAdminController::class, 'billing'])->name('billing');
//Route::get('/customer-support', [SuperAdminController::class, 'customersupport'])->name('customersupport');
//Route::get('/customer-message/{id}', [SuperAdminController::class, 'customermessage'])->name('customermessage');
//Route::get('/subscription', [SuperAdminController::class, 'subscription'])->name('subscription');
//Route::get('/create-subscription', [SuperAdminController::class, 'createsubscription'])->name('createsubscription');
//Route::get('/edit-subscription/{id}', [SuperAdminController::class, 'editsubscription']);
//Route::get('/newsfeed', [SuperAdminController::class, 'newsfeed'])->name('newsfeed');
//Route::get('/create-newsfeed', [SuperAdminController::class, 'createnewsfeed'])->name('createnewsfeed');
//Route::get('/edit-newsfeed/{id}', [SuperAdminController::class, 'editnewsfeed'])->name('editnewsfeed');
//Route::get('/profile', [SuperAdminController::class, 'profile'])->name('profile');
//Route::get('/payment-gateway', [SuperAdminController::class, 'payment'])->name('payment');
//Route::get('/smtp-setting', [SuperAdminController::class, 'smtpsetting'])->name('smtpsetting');
//Route::get('/website-setting', [SuperAdminController::class, 'websitesetting'])->name('websitesetting');
//Route::get('/email-template', [SuperAdminController::class, 'emailtemplate'])->name('emailtemplate');
//Route::get('/edit-email-template', [SuperAdminController::class, 'editemailtemplate'])->name('editemailtemplate');
//Route::get('/pages', [SuperAdminController::class, 'pages'])->name('pages');
//Route::get('/edit-pages', [SuperAdminController::class, 'editpages'])->name('editpages');
//Route::post('/add-subscription-plan', [SuperAdminController::class, 'addSubscriptionPlan'])->name('add-subscription-plan');
//Route::post('/update-subscription-plan', [SuperAdminController::class, 'updateSubscriptionPlan'])->name('update-subscription-plan');
//Route::post('/change-password', [SuperAdminController::class, 'changePassword'])->name('change-password');
//Route::post('/update-profile', [SuperAdminController::class, 'updateProfile'])->name('update-profile');
//Route::post('/save-smtp-setting', [SuperAdminController::class, 'saveSmtpSetting'])->name('save-smtp-setting');
//Route::post('/save-payment-gateway-setting', [SuperAdminController::class, 'savePaymentGatewaySetting'])->name('save-payment-gateway-setting');
//Route::post('/add-website-settings', [SuperAdminController::class, 'addWebsiteSettings'])->name('add-website-settings');
//Route::get('/otp-verification/{id}', [SuperAdminController::class, 'otpVerification']);
//Route::get('/delete-subscription/{id}', [SuperAdminController::class, 'deleteSubscription']);
//Route::post('/verify-otp', [SuperAdminController::class, 'verifyOtp']);
//Route::get('/currency-converter', [SuperAdminController::class, 'currencyConverter'])->name('currency-converter');
//Route::post('/currency-rate', [SuperAdminController::class, 'currencyRate']);
//Route::post('/add-newsfeeds', [SuperAdminController::class, 'addNewsFeeds']);
//Route::post('/update-newsfeeds', [SuperAdminController::class, 'updateNewsFeeds']);
//Route::post('/customer-support-reply', [SuperAdminController::class, 'customerSupportReply']);
//Route::post('/customer-support-resolved', [SuperAdminController::class, 'customerSupportResolved']);
//Route::get('/knowledge_base', [SuperAdminController::class, 'knowledgebase']);
//Route::get('/add-knowledge_base', [SuperAdminController::class, 'addknowledgebase']);
//Route::post('/submit-knowlegebase', [SuperAdminController::class, 'submitknowledgebase']);
//Route::get('/edit-knowledge_base/{id}', [SuperAdminController::class, 'editknowledgebase']);
//Route::get('/delete-knowledge_base/{id}', [SuperAdminController::class, 'deleteknowledgebase']);
//Route::get('/support', [SuperAdminController::class, 'support'])->name('support');
//Route::post('/submit-support', [SuperAdminController::class, 'submitsupport']);
//Route::get('/edit-support/{id}', [SuperAdminController::class, 'editsupport']);
//Route::get('/delete-support/{id}', [SuperAdminController::class, 'deletesupport']);
//Route::get('/aad-blog-knowledgebase/{id}', [SuperAdminController::class, 'addBlogKnowledgebase']);
//Route::get('/view-blog-knowledgebase/{id}', [SuperAdminController::class, 'viewblogknowledgebase']);
//Route::post('/submit-blog-knowledgebase', [SuperAdminController::class, 'submitblogknowledgebase']);
//
//Route::get('/glossary', [SuperAdminController::class, 'glossary']);
//Route::get('/add-glossary', [SuperAdminController::class, 'addGlossary']);
//Route::post('/submit-glossary', [SuperAdminController::class, 'submitGlossary']);
//Route::get('/edit-glossary/{id}', [SuperAdminController::class, 'editGlossary']);
//Route::get('/delete-glossary/{id}', [SuperAdminController::class, 'deleteGlossary']);
//
//Route::get('/guides', [SuperAdminController::class, 'guides']);
//Route::get('/add-guides', [SuperAdminController::class, 'addGuides']);
//Route::post('/submit-guides', [SuperAdminController::class, 'submitGuides']);
//Route::get('/edit-guides/{id}', [SuperAdminController::class, 'editGuides']);
//Route::get('/delete-guides/{id}', [SuperAdminController::class, 'deleteGuides']);
//Route::get('/contact-info', [SuperAdminController::class, 'contactInfo']);
//
//Route::get('/blog', [SuperAdminController::class, 'blog']);
//Route::get('/add-blog', [SuperAdminController::class, 'addBlog']);
//Route::post('/submit-blog', [SuperAdminController::class, 'submitBlog']);
//Route::get('/edit-blog/{id}', [SuperAdminController::class, 'editBlog']);
//Route::get('/delete-blog/{id}', [SuperAdminController::class, 'deleteBlog']);
//Route::post('/delete-newsfeed', [SuperAdminController::class, 'deleteNewsFeed']);

//Route::get('logout-admin', function () {
//    auth()->logout();
//    Session()->flush();
//
//    return Redirect::to('/sign-in');
//})->name('logout-admin');

Route::get('/connections', [TenantController::class, 'connections'])->name('connections');
Route::get('update/name', [GoogleAdsController::class, 'changeProviderName']);
Route::get('test/update', [GoogleAdsController::class, 'testUpdateAds']);





// signup version 2
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup-new', [AuthController::class, 'signupSubmit'])->name('signupSubmit');

Route::get('/signup-step-2-new', [AuthController::class, 'signup2'])->name('signup-new-step-2');
Route::post('/signup-step-2-new', [AuthController::class, 'signup2Submit'])->name('signupSubmit-new-step-2');
Route::post('/signup-step-2-new-update', [AuthController::class, 'signup2SubmitUpdate'])->name('signupSubmit-new-step-2-update');

Route::get('/signup-step-3-new', [AuthController::class, 'signup3'])->name('signup-new-step-3');
Route::post('/signup-step-3-new', [AuthController::class, 'signup3Submit'])->name('signupSubmit-new-step-3');


Route::post('/resend-otp', [AuthController::class, 'resendOtp'])
->middleware('auth');

Route::post('/verify-email/request', [AuthController::class, 'request'])
->middleware('auth')
->name('verification.request');
Route::get('/verify-email/{id}/{hash}', [AuthController::class, 'verify'])
->middleware(['auth', 'signed']) // <-- don't remove "signed"
->name('verification.verify');

Route::get('/demo-dashboard', [TenantController::class, 'demoDashboard'])->name('demoDashboard');

Route::get('/get-connections',[V2ConnectionController::class,'getConnections'])->name('get-connections');

Route::get('/count-connections', [V2ConnectionController::class, 'countConnections']);
Route::get('/count-members', [MemberController::class, 'countMemebers']);
Route::get('/check-dashboards', [V2ConnectionController::class, 'checkConnections']);
Route::get('/get-add-user-html', [MemberController::class, 'getAddUserHtml']);

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('login-new',[AuthController::class,'loginPost']);

Route::post('/forgot-password-new',[AuthController::class,'forgotPasswordNew']);
Route::post('/forgot-password-otp',[AuthController::class,'forgotPasswordOtp']);
Route::post('/forgot-password-reset-phone',[AuthController::class,'forgotPassworReset']);
Route::post('/resend-otp-forgot', [AuthController::class, 'resendOtpForgot']);

// email forgot
Route::get('/new-password/{token}', [AuthController::class, 'newPassword']);
Route::post('/reset-password-new', [AuthController::class, 'resetSubmit'])->name('reset.password.submit');

Route::get('list-contacts', 'ActiveCampaitngController@getContacts');

Route::group(['middleware' => ['auth']], function () {
  Route::get('/dashboard/templates', [V2WebsiteController::class, 'template'])->name('templatev2');
  Route::get('/v2/dashboard/template/{type}', [V2UserDashboardController::class, 'show']);
  Route::post('v2/dashboard/create', [V2UserDashboardController::class, 'storeDashboard']);

  Route::get('/dashboard/connections', [V2TenantController::class, 'connections'])->name('connections');

  Route::post('/v2/search-connects-by-provider', [V2ConnectionController::class, 'searchUserConnections']);

  Route::post('v2/connection/sync', [V2TenantController::class, 'removeConnection']);

  Route::get('get-report-html/{provider}',[V2ConnectionController::class,'getReportsHtml']);

  Route::get('/dashboard/user-billing', [BillingController::class, 'user_billing'])->name('user_billing');

  Route::get('/dashboard/user-profilev2', [BillingController::class, 'user_profile'])->name('home_screen');

  Route::get('/dashboard/user-teamV2', [BillingController::class, 'user_team'])->name('user_teamV2');


  Route::get('/dashboard/instagram-overview',[InstagramController::class, 'instagramOverviewV2']);


  Route::get('pdf-test',function(){
    $pdf = App::make('snappy.pdf.wrapper');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->inline();
  });
});
























