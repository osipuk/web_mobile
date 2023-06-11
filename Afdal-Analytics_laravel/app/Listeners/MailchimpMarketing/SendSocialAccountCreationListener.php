<?php

namespace App\Listeners\MailchimpMarketing;

use App\Events\SocialAccountConnectedEvent;
use App\Services\MailchimpMarketingTracker;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSocialAccountCreationListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\SocialAccountConnectedEvent  $event
     * @return void
     */
    public function handle(SocialAccountConnectedEvent $event)
    {
        $marketingTracker = new MailchimpMarketingTracker();
        $marketingTracker->socialAccountCreatedEvent(
            $event->user->email,
            $event->socialAccountType,
            $event->socialAccountName,
            $event->socialAccountEmail
        );
    }
}
