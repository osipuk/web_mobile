<?php

namespace App\Listeners\MailchimpMarketing;

use App\Events\UserRegisteredEvent;
use App\Services\MailchimpMarketingTracker;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Classes\IntercomAPI;
class RegisterUserListener implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegisteredEvent  $event
     * @return void
     */
    public function handle(UserRegisteredEvent $event)
    {
        $marketingTracker = new MailchimpMarketingTracker();
        $marketingTracker->createMember($event->user);
        $marketingTracker->userRegisteredEvent($event->user);
    }
}
