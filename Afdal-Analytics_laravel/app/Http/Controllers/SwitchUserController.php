<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Page;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Auth;

class SwitchUserController extends Controller
{
    public function switch($template, $id)
    {

        $dashboard = Dashboard::where('company_id', Auth::user()->company_id)
            ->where('name', $template)
            ->firstOrFail();

        if ($template == 'twitter-overview'){
            $social_account = SocialAccount::findOrFail($id);
            $dashboard->social_account_id = $social_account->id;
        }
        else{
            $page = Page::findOrFail($id);

            $dashboard->page_id = $page->id;
            $dashboard->social_account_id = $page->social_account_id;
        }

        $dashboard->save();

        return redirect('/dashboard/'.$template);
    }
}
