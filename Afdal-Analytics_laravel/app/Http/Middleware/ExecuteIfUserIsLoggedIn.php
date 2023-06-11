<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Jobs\UpdateSocialAccountUserData;
use App\Jobs\FacebookEachPagePosts;
use App\Models\SocialAccount;
use App\Models\User;
use App\Models\Page;
use App\Classes\FacebookAPI;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ExecuteIfUserIsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
{


    if (auth()->check()) {
        // Code that should be executed if user is logged in
        $user = (auth()->user());
        //dd($user);


        if ($this->checkSinceDate($user->last_cron_executed_date_time) == true) {
     

            $this->api = new FacebookAPI(90);
            $this->api->setWriteLogs(true);

            //$id = $this->options()['id'] ?? 0;
            $socialAccounts = SocialAccount::where('company_id', $user->company_id)->get();
            foreach ($socialAccounts as $socialAccount) {

                if (!$this->allowToUpdate($socialAccount)) {
                    continue;
                }

                if($socialAccount->provider_name != 'facebook'){
                    UpdateSocialAccountUserData::dispatch($socialAccount)->onQueue($socialAccount->provider_name . "Update");
                }


            }



            $socialAccounts2 = SocialAccount::where([['company_id', $user->company_id], ['provider_name', 'facebook']])->get();

            foreach ($socialAccounts2 as $socialAccount) {

                if (!$this->allowToUpdate($socialAccount)) {
                    continue;
                }


                    try {

                        $accountPages = $this->api->get_user_page($socialAccount->provider_id, $socialAccount->token);

                        if ($accountPages == false) {
                            //return false;
                        }else{

                        foreach ($accountPages->data as $page) {
                            $newPage = $this->updateOrCreatePage($page, $socialAccount->id);

                            if (!$newPage) {
                                continue;
                            }
                            $newPageId = $newPage->id;

                           // dd($page->id, $newPageId, $newPage->token);

                            FacebookEachPagePosts::dispatch($socialAccount, $page->id, $newPageId, $newPage->token)->onQueue('FacebookPostsFetch');
                   
                        }
                    }

                    } catch (Exception $exception) {

                    }
            }





            $userLastImportedId = User::find(auth()->id());

            $userLastImportedId->last_cron_executed_date_time = Carbon::now();
            $userLastImportedId->save();

        }




    }

    return $next($request);
}





    private function updateOrCreatePage($page, $socialAccountId)
    {
       // $this->log("Start update page");
        $isConnected = Page::where('page_id', $page->id)->where('social_account_id', $socialAccountId)->count();
        if (!$isConnected) {
            return false;
        }
        $newPage = Page::updateOrCreate(
            [
                'page_id' => $page->id,
                'social_account_id' => $socialAccountId
            ],
            [
                'page_id'           => $page->id,
                'name'              => $page->name,
                'token'             => $page->access_token,
                'social_account_id' => $socialAccountId,
            ]
        );
      //  $this->log("Finish update page");
        return $newPage;
    }




    private function allowToUpdate(SocialAccount $socialAccount) : bool
    {
        if (!$this->checkSinceDate($socialAccount->last_imported_at)) {
            return false;
        }

        $allowedProvider = $this->allowedProviderByOptions($socialAccount->provider_name);
        $userExists = $this->allowedIfUserExists($socialAccount->company_id);
        if (!$userExists) {
            Log::error("Unable to update social account (id={$socialAccount->id}). It's user is not exists");

        }
        return $allowedProvider && $userExists;
    }

    private function allowedIfUserExists($companyId) : bool
    {
        $user = User::where('company_id', $companyId)->first();
        return isset($user->id);
    }

    private function allowedProviderByOptions($providerName) : bool
    {
        $optionProviders = [];
        return (empty($optionProviders) || in_array($providerName, []));
    }


    protected function checkSinceDate($date) : bool
    {
        if(null == $date){
            return true;
        }
        if (!empty($date)) {
            $hoursSinceLastUpdate = Carbon::parse($date)->diffInHours(Carbon::now());
            if ($hoursSinceLastUpdate <= 24) {
                //$this->log("Finish update because of data < 24 hours");
                return false;
            }
        }
        return true;
    }


}
