<?php

namespace App\Console\Commands;

use App\Classes\IntercomAPI;
use App\Services\MailchimpMarketingTracker;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ActiveCampaitngController;

class SubscriptionTrialEndEventTracking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:track_trial_end_event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Track `trial_end` event to intercom, mailchimp or other systems';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $companies = Company::where('trial_ends_at', "<", Carbon::now())
            ->whereRaw('(trial_ends_event_track_at < trial_ends_at OR trial_ends_event_track_at IS NULL)')
            ->get();
        $intercom = new IntercomAPI();
        $mailchimp = new MailchimpMarketingTracker();
        $ActiveCampaitng = new ActiveCampaitngController();

        foreach ($companies as $company) {
            $user = $company->owner;
            if (is_null($user)) {
                continue;
            }
            Log::info("`Plan trial ends` Event Tracking; UserID = {$user->id}, email = {$user->email}" );
            $intercom->planTrialEnds($user->id, $company->trial_ends_at);
            $ActiveCampaitng->EventTrackingCreation('Plan Trial Ends');
            $ActiveCampaitng->EventTrackingAPI('Plan Trial Ends','',$user->email);
            // $intercom->EventTrackingAPI('SubscriptionTrialEndEventTracking','abc');
            $mailchimp->subscriptionPlanTrialEndsEvent($user->email, $company->trial_ends_at);
            Company::where('id', $company->id)->update(["trial_ends_event_track_at" => Carbon::now()]);
        }

    }

}
