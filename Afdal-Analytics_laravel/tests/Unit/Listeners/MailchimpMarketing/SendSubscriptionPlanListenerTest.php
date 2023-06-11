<?php

namespace Tests\Unit\Listeners\MailchimpMarketing;

use App\Events\SubscriptionPlanCreatedEvent;
use App\Listeners\MailchimpMarketing\SendSubscriptionPlanListener;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SendSubscriptionPlanListenerTest extends TestCase
{
    /**
     * @return void
     */
    public function test_register_user_listener_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            SubscriptionPlanCreatedEvent::class,
            SendSubscriptionPlanListener::class
        );
    }
}
