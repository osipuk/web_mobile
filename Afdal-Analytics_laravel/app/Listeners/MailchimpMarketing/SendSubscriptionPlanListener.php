<?php

namespace App\Listeners\MailchimpMarketing;

use App\Events\SubscriptionPlanCreatedEvent;
use App\Services\MailchimpMarketingTracker;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSubscriptionPlanListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\SubscriptionPlanCreatedEvent  $event
     * @return void
     */
    public function handle(SubscriptionPlanCreatedEvent $event)
    {
        $marketingTracker = new MailchimpMarketingTracker();
        $result = $marketingTracker->subscriptionPlanCreatedEvent($event->user->email, $event->planName, $event->planPrice);
        if (!empty($result)) {
            throw new \Exception("Mailchimp Error. Subscription Plan Sending: "
                . PHP_EOL . "event = " . var_export([$event->user->email, $event->planName, $event->planPrice], 1)
                . PHP_EOL . "result = " . var_export($result, 1)
            );
        }
    }
}
