<?php

namespace App\Http\Controllers;

use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Guide;
use App\Models\knowledgeBase;
use App\Models\Plans;
use App\Models\Seo;
use App\Models\Tags;
use App\Nova\Knowledges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Lang;
use Illuminate\Support\Facades\Session;
use Share;
use Symfony\Component\Intl\Currencies;
use DB; 

class WebsiteController extends Controller
{


    public function index(Request $request)
    {
        return view('frontend/static_home');
    }

    public function subscription_successful(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('frontend/success_page', compact('seo'));
    }


    public function analytics_campaign(Request $request)
    {
        return view('frontend/analytics_campaign');
    }

    public function home_main(Request $request)
    {
        return view('frontend/static_home_main');
    }

    public function home_new(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        $blogs = Blog::query()
            ->with(['tag', 'category'])
            ->where('show', 1)
            ->latest()
            ->take(3)
            ->get();

        //        $blade_name = Lang::getLocale() == "en" ? "eng/homepage_en" : "homepage";
        return view("frontend/homepage", compact('blogs', 'seo'));
    }


    protected function getHardcodedPrice($currency, $plan, $type)
    {

        $hardCodedCurrencyAmount = [
            'essentials' => [
                'KWD' => 5,
                'SAR' => 60,
                'EGP' => 300,
                'DZD' => 2250,
                'BHD' => 6,
                'KMF' => 7500,
                'IQD' => 22800,
                'DJF' => 2750,
                'JOD' => 12,
                'LBP' => 23900,
                'LYD' => 75,
                'MAD' => 160,
                'OMR' => 7,
                'QAR' => 60,
                'SOS' => 8750,
                'SDG' => 8750,
                'SYP' => 39573,
                'TND' => 50,
                'AED' => 60,
                'YER' => 3938,
                'USD' => 15,
                'ILS' => 53,


            ],
            'plus' => [
                'KWD' => 4,
                'SAR' => 40,
                'EGP' => 200,
                'DZD' => 1500,
                'BHD' => 4,
                'KMF' => 5000,
                'IQD' => 1520,
                'DJF' => 1850,
                'JOD' => 8,
                'LBP' => 16000,
                'LYD' => 50,
                'MAD' => 108,
                'OMR' => 5,
                'QAR' => 40,
                'SOS' => 5900,
                'SDG' => 5900,
                'SYP' => 26382,
                'TND' => 33,
                'AED' => 40,
                'YER' => 2625,
                'USD' => 10,
                'ILS' => 175,


            ],
            'enterprise' => [
                'KWD' => 2,
                'SAR' => 20,
                'EGP' => 100,
                'DZD' => 750,
                'BHD' => 2,
                'KMF' => 2500,
                'IQD' => 7600,
                'DJF' => 925,
                'JOD' => 4,
                'LBP' => 8000,
                'LYD' => 25,
                'MAD' => 54,
                'OMR' => 3,
                'QAR' => 20,
                'SOS' => 3000,
                'SDG' => 3000,
                'SYP' => 13191,
                'TND' => 17,
                'AED' => 20,
                'YER' => 1313,
                'USD' => 5,
                'ILS' => 360
            ]
        ];

        //  dd($hardCodedCurrencyAmount[$plan][$currency], $type);
        if (array_key_exists($currency, $hardCodedCurrencyAmount[$plan])) {
            //echo "The key 'France' is exists in the cities array";
            //dd($currency, $plan, $hardCodedCurrencyAmount[$plan]);
            if ($type == 'amount') {

                return ($hardCodedCurrencyAmount[$plan][$currency]);
            } else {

                return $currency;
            }
        } else {
            // dd($currency, $type, $plan);
            // return ($hardCodedCurrencyAmount[$plan]['USD']);
            if ($type == 'amount') {
                // dd($hardCodedCurrencyAmount[$plan]['USD']);
                return ($hardCodedCurrencyAmount[$plan]['USD']);
            } else {
                return 'USD';
            }
        }
    }





    protected function getHardcodedPriceOriginal($currency, $plan, $type)
    {

        $hardCodedCurrencyAmount = [
            'essentials' => [
                'KWD' => 5,
                'SAR' => 60,
                'EGP' => 300,
                'DZD' => 2250,
                'BHD' => 6,
                'KMF' => 7500,
                'DJF' => 2750,
                'JOD' => 12,
                'LBP' => 23900,
                'MAD' => 160,
                'OMR' => 7,
                'QAR' => 60,
                'SOS' => 8750,
                'TND' => 50,
                'AED' => 60,
                'YER' => 3938,
                'USD' => 15,

            ],
            'plus' => [
                'KWD' => 20,
                'SAR' => 200,
                'EGP' => 1000,
                'DZD' => 7500,
                'BHD' => 20,
                'KMF' => 25000,
                'DJF' => 9250,
                'JOD' => 40,
                'LBP' => 80000,
                'MAD' => 540,
                'OMR' => 25,
                'QAR' => 200,
                'SOS' => 29500,
                'TND' => 165,
                'AED' => 200,
                'YER' => 13125,
                'USD' => 50,


            ],
            'enterprise' => [
                'KWD' => 40,
                'SAR' => 400,
                'EGP' => 2000,
                'DZD' => 15000,
                'BHD' => 40,
                'KMF' => 50000,
                'DJF' => 18500,
                'JOD' => 80,
                'LBP' => 160000,
                'MAD' => 1080,
                'OMR' => 60,
                'QAR' => 400,
                'SOS' => 60000,
                'TND' => 340,
                'AED' => 400,
                'YER' => 26260,
                'USD' => 100,
            ]
        ];

        //  dd($hardCodedCurrencyAmount[$plan][$currency], $type);
        if (array_key_exists($currency, $hardCodedCurrencyAmount[$plan])) {
            //echo "The key 'France' is exists in the cities array";
            //dd($currency, $plan, $hardCodedCurrencyAmount[$plan]);
            if ($type == 'amount') {

                return ($hardCodedCurrencyAmount[$plan][$currency]);
            } else {

                return $currency;
            }
        } else {
            // dd($currency, $type, $plan);
            // return ($hardCodedCurrencyAmount[$plan]['USD']);
            if ($type == 'amount') {
                // dd($hardCodedCurrencyAmount[$plan]['USD']);
                return ($hardCodedCurrencyAmount[$plan]['USD']);
            } else {
                return 'USD';
            }
        }
    }



    public function about_pricing(Request $request)
    {

        $seo = Seo::where('route', $request->getRequestUri())->first();

        // $blade_name = "about_pricing";
        $blade_name = "about_pricing_new";
        // $ip = isset($_GET['ip']) ? $_GET['ip'] : request()->ip();
        // $currency = geoip($ip)->currency;
        //if($currency == 'MRO'){
        //   $currency = 'USD';
        //}

        $currency = 'USD';

        $symbol = Currencies::getSymbol($currency);
        if (strlen($symbol) > 1) {
            $symbol = $symbol . ' ';
        }

        $prices_new = [
            'essentials' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(15)
                ->get()),
            'plus' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(50)
                ->get()),
            'enterprise' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(100)
                ->get()),
        ];

        /*

        $prices_for_frontend = [
            'essentials' => $symbol . (integer)(Currency::convert()
                    ->from($this->getHardcodedPrice($currency, 'essentials', 'name'))
                    ->to($currency)
                    ->amount($this->getHardcodedPrice($currency, 'essentials', 'amount'))  //15
                    ->get()),
            'plus' => $symbol . (integer)(Currency::convert()
                    ->from($this->getHardcodedPrice($currency, 'plus', 'name'))
                    ->to($currency)
                    ->amount($this->getHardcodedPrice($currency, 'plus', 'amount'))  //10
                    ->get()),
            'enterprise' => $symbol . (integer)(Currency::convert()
                    ->from($this->getHardcodedPrice($currency, 'enterprise', 'name'))
                    ->to($currency)
                    ->amount($this->getHardcodedPrice($currency, 'enterprise', 'amount'))  //5
                    ->get()),
        ];


        */


        $prices_for_frontend = [
            'essentials' => $symbol . (int)(Currency::convert()
                ->from($currency)
                ->to($currency)
                ->amount(15)  //15
                ->get()),
            'plus' => $symbol . (int)(Currency::convert()
                ->from($currency)
                ->to($currency)
                ->amount(50)  //10
                ->get()),
            'enterprise' => $symbol . (int)(Currency::convert()
                ->from($currency)
                ->to($currency)
                ->amount(100)  //5
                ->get()),
        ];



        //dd($prices_for_frontend);

        $prices = [
            'essentials' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(15)
                ->get()),
            'plus' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(10)
                ->get()),
            'enterprise' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(5)
                ->get()),
            'essentials_annual' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(150)
                ->get()),
            'plus_annual' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(358)
                ->get()),
            'enterprise_annual' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(733)
                ->get()),
            'essentials_old' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(299)
                ->get()),
            'plus_old' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(715)
                ->get()),
            'enterprise_old' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(1465)
                ->get()),
            'essentials_year' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(359)
                ->get()),
            'plus_year' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(859)
                ->get()),
            'enterprise_year' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(1759)
                ->get())
        ];
        // return view("frontend/$blade_name", compact(['seo', 'prices', 'prices_new', 'prices_for_frontend']));
        return view("frontend/$blade_name", compact(['seo', 'prices', 'prices_new', 'prices_for_frontend']));
    }
    public function about_pricing_test(Request $request)
    {

        $seo = Seo::where('route', $request->getRequestUri())->first();

        // $blade_name = "about_pricing";
        $blade_name = "about_pricing_new";

        $currency = 'USD';

        $symbol = Currencies::getSymbol($currency);
        if (strlen($symbol) > 1) {
            $symbol = $symbol . ' ';
        }

        $prices_new = [
            'essentials' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(15)
                ->get()),
            'plus' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(50)
                ->get()),
            'enterprise' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(100)
                ->get()),
        ];

        $prices_for_frontend = [
            'essentials' => $symbol . (int)(Currency::convert()
                ->from($currency)
                ->to($currency)
                ->amount(15)  //15
                ->get()),
            'plus' => $symbol . (int)(Currency::convert()
                ->from($currency)
                ->to($currency)
                ->amount(50)  //10
                ->get()),
            'enterprise' => $symbol . (int)(Currency::convert()
                ->from($currency)
                ->to($currency)
                ->amount(100)  //5
                ->get()),
        ];



        //dd($prices_for_frontend);

        $prices = [
            'essentials' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(15)
                ->get()),
            'plus' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(10)
                ->get()),
            'enterprise' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(5)
                ->get()),
            'essentials_annual' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(150)
                ->get()),
            'plus_annual' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(358)
                ->get()),
            'enterprise_annual' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(733)
                ->get()),
            'essentials_old' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(299)
                ->get()),
            'plus_old' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(715)
                ->get()),
            'enterprise_old' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(1465)
                ->get()),
            'essentials_year' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(359)
                ->get()),
            'plus_year' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(859)
                ->get()),
            'enterprise_year' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(1759)
                ->get())
        ];
        // return view("frontend/$blade_name", compact(['seo', 'prices', 'prices_new', 'prices_for_frontend']));
        return view("frontend/$blade_name", compact(['seo', 'prices', 'prices_new', 'prices_for_frontend']));
    }
    public function pricing_period($plan_name)
    {

        //  $ip = isset($_GET['ip']) ? $_GET['ip'] : request()->ip();
        //  $currency = geoip($ip)->currency;
        // if($currency == 'MRO'){
        $currency = '$';
        //}
        $default_payment_method = null;
        $user_company = null;
       
        if ($plan_name === 'essentials' || $plan_name === 'plus' || $plan_name === 'enterprise') {
            $plan_ident = $plan_name;

            $company = auth()->user()->company;
            $intent = $company->createSetupIntent();

            $subscription = $company->subscriptions()->where('name', '!=', 'Analytics Consulting')->get()->sortByDesc('id')->first();

            if ($subscription && ($subscription->stripe_status=='active' || $subscription->paypal_status=='active')) {
                $user_plan_name = Plans::where('identifier', $subscription->name)->get()[0]->title;
            } elseif (auth()->user()->trial()) {
                $user_plan_name = 'Trial Plan';
            } else {
                $user_plan_name = '';
            }
            if (strtolower($user_plan_name) === $plan_name . ' plan') {
                return redirect('/pricing');
            }

            $wanted_plan_name = Plans::where('identifier', $plan_name)->get()[0]->title;

            if ($plan_name === 'essentials') {
                $price_currency = '$'; //$this->getHardcodedPriceOriginal($currency, 'essentials', 'name');
                $price_month = 15; //$this->getHardcodedPriceOriginal($currency, 'essentials', 'amount');//359;
                $price_year = 3590;
                $wanted_plan_info = Config::get('constants.essentials_info');
            } elseif ($plan_name === 'plus') {
                $price_currency = '$'; //$this->getHardcodedPriceOriginal($currency, 'plus', 'name');
                $price_month = 50; //$this->getHardcodedPriceOriginal($currency, 'plus', 'amount'); //859;
                $price_year = 8590;
                $wanted_plan_info = Config::get('constants.plus_info');
            } elseif ($plan_name === 'enterprise') {
                $price_currency = '$'; //$this->getHardcodedPriceOriginal($currency, 'enterprise', 'name');
                $price_month = 100; //$this->getHardcodedPriceOriginal($currency, 'enterprise', 'amount'); //1759;
                $price_year = 17590;
                $wanted_plan_info = Config::get('constants.enterprise_info');
            }
            $company = auth()->user()->company;
            $default_payment_method = $company->defaultPaymentMethod();
            $user_company = $company;
            $payment_methods = $company->paymentMethods();
            $isPaypalDefault = $company->paypal_default;
        } else {
            return redirect('/pricing');
        }


        return view('tenant/pricing-period-new', compact(['default_payment_method','payment_methods','isPaypalDefault','intent','user_company','plan_ident', 'user_plan_name', 'wanted_plan_name', 'wanted_plan_info', 'price_month', 'price_year', 'price_currency']));
    }

    public function about_connections(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('frontend/about_connections', compact('seo'));
    }

    public function template(Request $request)
    {
        if (
            !auth()->user()->company->subscriptions()->first()
            && !auth()->user()->company->onTrial()
            && auth()->user()->email !== 'demo@afdal.com'
            && !auth()->user()->gift
        ) {
            return redirect('/dashboard/no-subscription');
        }

        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('frontend/template', [
            'user_dashboard_types' => Auth::user()->company->dashboard->pluck('name')->toArray(),
            'seo' => $seo
        ]);
    }

    public function lockedScreen(Request $request)
    {
        return view('frontend/locked-screen');
    }

    public function contact_us(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        $blade_name = Lang::getLocale() == "en" ? "eng/contact_us_eng" : "contact_us";

        return view("frontend/{$blade_name}", compact('seo'));
    }

    public function guides_one(Request $request, $url)
    {
        $guide = Guide::where('seo_url', $url)->firstOrFail();

        $seo_array = array(
            'title' => $guide->meta_title,
            'description' => $guide->meta_description,
            'keywords' => $guide->meta_keywords,
            'author' => $guide->author_name
        );

        $socialShare = Share::page(urlencode($request->url()), '')
            ->linkedin()
            ->twitter()
            ->facebook()->getRawLinks();

        $seo = new \ArrayObject($seo_array, \ArrayObject::ARRAY_AS_PROPS);

        return view('frontend/guides_one', compact('guide', 'socialShare', 'seo'));
    }

    public function resetPassword(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('frontend/reset_password', compact('seo'));
    }

    public function newPassword(Request $request, $token)
    {
        $seo = Seo::where('route', 'new Password')->first();

        return view('frontend/new_password', ['token' => $token, 'seo' => $seo]);
    }

    public function about_afdal(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        $blogs = Blog::query()
            ->with(['tag', 'category'])
            ->where('show', 1)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $blade_name = Lang::getLocale() == "en" ? "eng/about_afdal_eng" : "about_afdal";
        return view("frontend/{$blade_name}", compact('blogs', 'seo'));
    }

    public function about_dashboards(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        $blogs = Blog::query()
            ->with(['tag', 'category'])
            ->where('show', 1)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        return view('frontend/about_dashboards', compact('blogs', 'seo'));
    }

    public function dashboard_not_found(Request $request)
    {
        return view('frontend/dashboard_not_found');
    }

    public function not_found(Request $request)
    {
        return view('errors/404');
    }

    public function guides(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        $guides = Guide::orderByDesc('created_at')->get();

        foreach ($guides as $guide) {
            $guide = $guide->guideTextFormat();
        }

        return view('frontend/guides', compact('guides', 'seo'));
    }

    public function analytics_blog(Request $request, $category_seo_url = null)
    {
        $locale = Lang::getLocale();
        Carbon::setLocale($locale);

        $seo = null;
        $category = null;
        if (!empty($category_seo_url)) {
            $category = Category::where('seo_url', $category_seo_url)->where('show', 1)->first();
        }
        if (!empty($category)) {
            $seo_array = array(
                'title' => $category->meta_title,
                'description' => $category->meta_description,
                'keywords' => $category->meta_keywords,
                'author' => ''
            );
            $seo = new \ArrayObject($seo_array, \ArrayObject::ARRAY_AS_PROPS);
            $blogs = Blog::with(['category', 'tag'])
                ->where('show', 1)
                ->where('category_id', $category->id)
                ->orderBy('date', 'desc')
                ->paginate(9);
        } else {
            $blogs = Blog::with(['category', 'tag'])
                ->where('show', 1)
                ->orderBy('date', 'desc')
                ->paginate(9);
                $seo = Seo::where('route', $request->getRequestUri())->first();
        }
        $categories = Category::select('name', 'seo_url')->where('show', 1)->get();
        $guides = Guide::query()
            ->orderByDesc('created_at')
            ->take(3)
            ->get();
        foreach ($guides as $guide) {
            $guide = $guide->guideTextFormat();
        }

        return view('frontend/analytics_blog', compact(['blogs', 'categories', 'guides', 'seo', 'category']));
    }

    public function search_blog(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $blogs = Blog::query()
                ->where('title', 'like', '%' . $search . '%')
                ->paginate(9);
        } else {
            $blogs = Blog::query()
                ->paginate(9);
        }

        $categories = Category::select('name')->where('show', 1)->get();

        return view('frontend/analytics_blog', compact(['blogs', 'categories', 'search']));
    }

    public function blog($seo_url)
    {
        $blog = Blog::with(['tag', 'category'])->where('seo_url', $seo_url)->first();
        return view('frontend/blog', compact('blog'));
    }

    public function read_blog_in_minutes($content = '', $wpm = 250)
    {
        $clean_content = strlen($content);
        $time = ceil($clean_content / $wpm);
        return $time;
    }

    //    public function read_blog($content = '', $wpm = 250): array
    //    {
    //        $totalWords = str_word_count(strip_tags($content));
    //        $minutes = floor($totalWords / $wpm);
    //        $seconds = floor($totalWords % $wpm / ($wpm / 60));
    //
    //        return array(
    //            'minutes' => $minutes,
    //            'seconds' => $seconds
    //        );
    //    }

    public function blog_full(Request $request, $category_seo_url, $blog_seo_url)
    {
        $locale = Lang::getLocale();
        Carbon::setLocale($locale);
        $h2_array = [];
        $h3_array = [];
        $blog = Blog::with(['tag', 'category'])->where('seo_url', $blog_seo_url)->firstOrFail();
        $last_blogs = Blog::with(['category'])->where('id', '<>', $blog->id)->where('category_id', $blog->category_id)->orderBy('date', 'desc')->take(3)->get();
        $content = $blog->description;
        $time_to_read = $this->read_blog_in_minutes($content);

        preg_match_all('#<h2(.+?)</h2>#is', $content, $blog_titles_h2);
        preg_match_all('#<h3(.+?)</h3>#is', $content, $blog_titles_h3);

        foreach ($blog_titles_h2[1] as $item) {
            $index = strpos($item, '>');
            $h2_text = substr($item, $index + 1);
            $h2_array[] = ['text' => $h2_text, 'index' => strpos($blog->description, $h2_text . '</h2>'), 'type' => 'h2'];
        }

        foreach ($blog_titles_h3[1] as $item) {
            $index = strpos($item, '>');
            $h3_text = substr($item, $index + 1);
            $h3_array[] = ['text' => $h3_text, 'index' => strpos($blog->description, $h3_text . '</h3>'), 'type' => 'h3'];
        }
        $blog_titles = array_merge($h2_array, $h3_array);

        usort($blog_titles, function ($item1, $item2) {
            return $item1['index'] <=> $item2['index'];
        });

        $seo_array = array(
            'title' => $blog->meta_title,
            'description' => $blog->meta_description,
            'keywords' => $blog->meta_keywords,
            'author' => $blog->author_name
        );

        $socialShare = Share::page(urlencode($request->url()), '')
            ->linkedin()
            ->twitter()
            ->facebook()->getRawLinks();

        $seo = new \ArrayObject($seo_array, \ArrayObject::ARRAY_AS_PROPS);

        return view('frontend/blog_full', compact(['blog', 'blog_titles', 'last_blogs', 'time_to_read', 'socialShare', 'seo']));
    }

    //    public function dashboard_pricing(Request $request)
    //    {
    //        if (!Auth::user()) {
    //            return redirect('/signup');
    //        }
    //        return view('frontend/dashboard_pricing');
    //    }

    public function help(Request $request)
    {
        return view('frontend/help');
    }

    public function why_us(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        $guides = Guide::orderByDesc('created_at')->take(3)->get();

        $blade_name = Lang::getLocale() == 'en' ? "eng/why_us_eng" : "why_us";
        return view("frontend/$blade_name", compact('guides', 'seo'));
    }

    public function settings_change_plan(Request $request)
    {
        return view('frontend/settings_change_plan');
    }

    public function help_knowledge_base(Request $request)
    {
        return view('frontend/help_knowledge_base');
    }


    public function glossary(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        $socialShare = Share::page($request->url(), '')
            ->linkedin()
            ->twitter()
            ->facebook()->getRawLinks();

        $glossaries = knowledgeBase::select('id', 'title', 'description')->orderBy('title', 'desc')->get()->toArray();

        return view('frontend/glossary', compact('glossaries', 'socialShare', 'seo'));
    }

    public function cookie_policy(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('frontend/cookie_policy', compact('seo'));
    }

    public function success(Request $request)
    {
        return view('frontend/success_page');
    }

    public function privacy_policy(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('frontend/privacy_policy', compact('seo'));
    }

    public function dashboard(Request $request)
    {
        return view('frontend/dashboard');
    }

    public function subscribe_plan(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        // $ip = isset($_GET['ip']) ? $_GET['ip'] : request()->ip();
        //$currency = geoip($ip)->currency;
        $currency = 'USD';
        $symbol = Currencies::getSymbol($currency);
        if (strlen($symbol) > 1) {
            $symbol = $symbol . ' ';
        }

        $prices_new = [
            'essentials' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(15)
                ->get()),
            'plus' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(50)
                ->get()),
            'enterprise' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(100)
                ->get()),
        ];

        $prices_for_frontend = [
            'essentials' => $symbol . (int)(Currency::convert()
                ->from($currency)
                ->to($currency)
                ->amount(15)  //15
                ->get()),
            'plus' => $symbol . (int)(Currency::convert()
                ->from($currency)
                ->to($currency)
                ->amount(10)  //10
                ->get()),
            'enterprise' => $symbol . (int)(Currency::convert()
                ->from($currency)
                ->to($currency)
                ->amount(5)  //5
                ->get()),
        ];

        $prices = [
            'essentials' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(15)
                ->get()),
            'plus' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(10)
                ->get()),
            'enterprise' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(5)
                ->get()),
            'essentials_annual' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(150)
                ->get()),
            'plus_annual' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(358)
                ->get()),
            'enterprise_annual' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(733)
                ->get()),
            'essentials_old' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(299)
                ->get()),
            'plus_old' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(715)
                ->get()),
            'enterprise_old' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(1465)
                ->get()),
            'essentials_year' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(359)
                ->get()),
            'plus_year' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(859)
                ->get()),
            'enterprise_year' => $symbol . (int)(Currency::convert()
                ->from('USD')
                ->to($currency)
                ->amount(1759)
                ->get())
        ];

        return view('frontend/dashboard_subscribe-new', compact(['seo', 'prices', 'prices_new', 'prices_for_frontend']));
        // return view('frontend/dashboard_subscribe_new', compact(['seo', 'prices', 'prices_new', 'prices_for_frontend']));
    }

    public function subscription_plan(Request $request)
    {
        $plans = Plans::get();

        return view('frontend/subscription-plan', compact('plans'));
    }

    //    public function index(Request $request){
    //        return view('frontend/home');
    //    }

    public function signin(Request $request)
    {
        if (Auth::check()) {
            //            if (env('APP_ENV') === 'production'){
            //                return redirect()->route('dashboard', ['subdomain' => Session::get('subdomain')]);
            //            }
            return redirect('/dashboard');
        }
        $mess = null;
        if (Session::get('message')) {
            $mess = Session::get('message');
            Session::remove('message');
        }
        $seo = Seo::where('route', $request->getRequestUri())->first();
        return view('frontend/signin', compact('seo', 'mess'));
    }

    public function signup(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        $seo = Seo::where('route', $request->getRequestUri())->first();
        // return view('frontend/signup', compact('seo'));
        return view('frontend/signup-new', compact('seo'));
    }
    

    public function signupService(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        $seo = Seo::where('route', $request->getRequestUri())->first();
        return view('frontend/signup-service', compact('seo'));
    }

    public function forgotpass(Request $request)
    {
        return view('frontend/forgotpass');
    }

    public function privacypolicy(Request $request)
    {
        return view('frontend/privacypolicy');
    }

    public function termcondition(Request $request)
    {
        return view('frontend/termcondition');
    }

    public function resource(Request $request)
    {
        return view('frontend/resource');
    }

    public function contactus(Request $request)
    {
        return view('frontend/contactus');
    }

    public function subscribe(Request $request)
    {
        $postData = [];
        if ($request->input('name') && $request->input('email') && $request->input('comment') && $request->input('subject')) {
            $postData = [
                'email_address' => $request->input('email'),
                'status' => 'subscribed',
                'merge_fields' => [
                    "NAME" => $request->input('name'),
                    "MESSAGE" => $request->input('comment'),
                    "SUBJECT" => $request->input('subject')
                ]
            ];
        } else {
            $postData = [
                'email_address' => $request->input('email'),
                'status' => 'subscribed',
                'merge_fields' => [
                    "NAME" => 'NAME',
                    "MESSAGE" => 'MESSAGE',
                    "SUBJECT" => 'SUBJECT'
                ]
            ];
        }

        $list_id = env('MAILCHIMP_LIST_ID'); // MAILCHIMP_LIST_ID=c2719b990f

        $ch = curl_init('https://us5.api.mailchimp.com/3.0/lists/' . $list_id . '/members/');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: apikey ' . env('MAILCHIMP_API_KEY'), // MAILCHIMP_API_KEY=a661f4c880f21c045dea8c0a6beddd8d-us5
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        return curl_exec($ch);
    }


    public function remove_not_found_images_from_posts(){
        $pull_data = DB::table('posts')->select('id', 'image','last_cron_date')->whereNull('last_cron_date')->where('image', '!=', null)->orWhere('last_cron_date', '!=', date('Y-m-d'))->whereNotNull('image')->limit(50)->get();
        
        foreach($pull_data as $url){

            $result =  $this->url_exists($url->image) ? "Exists" : 'NotExists';
            if($result == 'NotExists'){
                DB::table('posts')->where('id', $url->id)->delete();
            }else{
                DB::table('posts')
                    ->where('id', $url->id)
                    ->update(['last_cron_date' => date('Y-m-d')]);
            }
         }
         
    }





     
    public function url_exists($url) {

        if(empty($url)){
            return false;
        }else{
         $hdrs = @get_headers($url);
          
         return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$hdrs[0]) : false;
        }
     }




}
