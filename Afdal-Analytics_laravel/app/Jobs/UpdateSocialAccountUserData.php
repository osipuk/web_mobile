<?php

namespace App\Jobs;

use App\Models\SocialAccount;
use App\Models\CronChecker;

use App\Services\Social\SocialAccountService;
use App\Services\Social\SocialService;
use Dompdf\Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateSocialAccountUserData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 2;
    public SocialAccount $socialAccount;
    private SocialService $socialAccountService;
    public $set_date=null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SocialAccount $socialAccount,$set_date=null)
    {
        $this->socialAccount = $socialAccount;
        $this->socialAccountService = SocialAccountService::factory($this->socialAccount);
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
        $this->socialAccountService->log("Start job update");

        try {
           // DB::beginTransaction();
            if($this->set_date){
                $this->socialAccountService->updateUserData($this->set_date);
               // $this->socialAccountService->CreateJobsForEachFacebookPostsForEachPage();

            }else{
                $this->socialAccountService->updateUserData();
               // $this->socialAccountService->CreateJobsForEachFacebookPostsForEachPage();

            }
            
        } catch (\Throwable $exception) {
          //  DB::rollBack();
            $this->socialAccountService->log("Error job. Exception. " . $exception->getMessage());
            $handled = $this->socialAccountService->handleErrors($exception);
            if (!$handled) {
                throw $exception;
            }
        } finally {
            $this->socialAccountService->log("Finish job update");
           // DB::commit();
        }
    }

    /**
     * Calculate the number of seconds to wait before retrying the job.
     *
     * @return int
     */
    public function backoff(): int
    {
        if (env("APP_ENV") == "local") {
            return 5;
        }
        return 180;
    }
}