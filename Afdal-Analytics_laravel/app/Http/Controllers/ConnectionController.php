<?php

namespace App\Http\Controllers;

use App\Helpers\UserPlanHelper;
use App\Http\Controllers\Controller;
use App\Mail\InviteUser;
use App\Models\Invite;
use App\Models\SocialAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ConnectionController extends Controller
{
    public function getUserConnections($connections_name){
        $social_accounts = SocialAccount::with('page', 'ads_account')
            ->where('provider_name',$connections_name)
            ->where('company_id', Auth::user()->company->id)
            ->where('disabled', false)
            ->get()->toArray();

        return response()->json([
            'social_accounts' => $social_accounts
        ]);
    }

    public function searchUserConnections(Request $request)
    {
        $social_accounts = SocialAccount::with('page', 'ads_account', 'google_analytics_account.properties.profiles', 'google_ads_account')
            ->where('company_id', Auth::user()->company_id)
            ->where('disabled', false)
            ->where('provider_name', $request->data['provider_name']);
        if(!empty($request->data['search']) && $request->data['search']){
            $social_accounts->where('full_name', 'LIKE', '%' . $request->data['search'] . '%');
        }
        if($request->data['date'] == 'week'){
            $social_accounts->where('created_at', '>=', Carbon::now()->subDays(7) );
        }else if($request->data['date'] == 'month'){
            $social_accounts->where('created_at', '>=', Carbon::now()->subMonth() );
        }else if($request->data['date'] == '6month'){
            $social_accounts->where('created_at', '>=', Carbon::now()->subMonths(6) );
        }
        else if($request->data['date'] == 'year'){
            $social_accounts->where('created_at', '>=', Carbon::now()->subYear());
        }
        $social_accounts = $social_accounts->get()->toArray();

        return response()->json([
            'social_accounts' => $social_accounts
        ]);
    }

    public function countConnectionsCheck(){
        $status = Auth::user()->company->social_account()->count() < UserPlanHelper::subscription_info()->connections ?  true : false;
        return response()->json([
            'status' => $status
        ]);
    }
}
