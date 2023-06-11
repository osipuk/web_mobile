<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\SocialAccount;

use App\Models\CronChecker;

use App\Services\Social\SocialAccountService;

use App\Services\Social\SocialService;
use Illuminate\Support\Facades\Log;
use DB;
use App\Classes\FacebookAPI;

class FacebookEachPagePosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public int $tries = 2;
    public SocialAccount $socialAccount;
    private SocialService $socialAccountService;
    public $set_date=null;
    public $newPage;
    public $pageId;
    public $newPageId;
    public $pageToken;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SocialAccount $socialAccount, $pageId, $newPageId, $pageToken, $set_date=null)
    {
        $this->socialAccount = $socialAccount;
        $this->socialAccountService = SocialAccountService::factory($this->socialAccount);

        $this->pageId = $pageId;
        $this->newPageId = $newPageId;
        $this->pageToken = $pageToken;

        if(!empty($set_date)){
            $this->set_date=$set_date;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    

        try {
           // DB::beginTransaction();

           // $this->api = new FacebookAPI(90);
           // $this->api->setWriteLogs(true);

          //  $this->api->set_id();
           // $this->api->set_access_token();

            $this->socialAccountService->NewupdatePosts($this->newPageId, $this->pageId, $this->pageToken);

            
        } catch (\Throwable $exception) {
            //DB::rollBack();
            //$this->socialAccountService->log("Error fb posts job. Exception. " . $exception->getMessage());
           // $handled = $this->socialAccountService->handleErrors($exception);
            //if (!$handled) {
               // throw $exception;
            //}
        } finally {
           // $this->socialAccountService->log("Finish job update");
          //  DB::commit();
        }


    }
}
