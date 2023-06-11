<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function template(Request $request){
        if (
            !auth()->user()->company->subscriptions()->first()
            && !auth()->user()->company->onTrial()
            && auth()->user()->email !== 'demo@afdal.com'
            && !auth()->user()->gift
        ) {
            return redirect('/dashboard/no-subscription');
        }

        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('frontend/v2/templates/template', [
            'user_dashboard_types' => Auth::user()->company->dashboard->pluck('name')->toArray(),
            'seo' => $seo
        ]);
    }
}
