<?php

namespace App\Listeners\MailchimpMarketing;

use App\Events\UserRegisteredEvent;
use App\Events\UserUpdateEvent;
use App\Services\MailchimpMarketingTracker;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserListener implements ShouldQueue
{

    /**
     * @param UserUpdateEvent $event
     * @return void
     */
    public function handle(UserUpdateEvent $event)
    {
        $marketingTracker = new MailchimpMarketingTracker();
        $result = $marketingTracker->createOrUpdateMember($event->userOld, $event->userNew);
        if (!isset($result->id)) {
            throw new \Exception("User Updating Error: "
                . PHP_EOL . "event = " . var_export([$event->userOld->email, $event->userNew->email], 1)
                . PHP_EOL . "result = " . var_export($result, 1)
            );
        }
    }
}
