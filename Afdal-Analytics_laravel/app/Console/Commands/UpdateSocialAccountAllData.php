<?php

namespace App\Console\Commands;

use App\Jobs\UpdateSocialAccountUserData;
use App\Jobs\FacebookEachPagePosts;
use App\Models\SocialAccount;
use App\Models\CronChecker;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Page;
use App\Classes\FacebookAPI;

class UpdateSocialAccountAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social_account:update {--provider=*} {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update social account data from network services';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->api = new FacebookAPI(90);
        $this->api->setWriteLogs(true);

        $id = $this->options()['id'] ?? 0;
        $socialAccounts = ($id > 0) ? SocialAccount::where('id', $id)->get() : SocialAccount::get();
        foreach ($socialAccounts as $socialAccount) {

            if (!$this->allowToUpdate($socialAccount)) {
                continue;
            }

            if($socialAccount->provider_name != 'facebook'){
                UpdateSocialAccountUserData::dispatch($socialAccount)->onQueue($socialAccount->provider_name . "Update");
            }


        }



        $socialAccounts2 = ($id > 0) ? SocialAccount::where([['id', $id], ['provider_name', 'facebook']])->get() : SocialAccount::where('provider_name', 'facebook')->get();

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

        //dd($socialAccounts->count(), $countme);
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
        $optionProviders = $this->options()['provider'];
        return (empty($optionProviders) || in_array($providerName, $this->options()['provider']));
    }

}
