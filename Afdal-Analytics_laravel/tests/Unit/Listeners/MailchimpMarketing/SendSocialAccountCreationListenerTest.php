<?php

namespace Tests\Unit\Listeners\MailchimpMarketing;

use App\Events\SocialAccountConnectedEvent;
use App\Listeners\MailchimpMarketing\SendSocialAccountCreationListener;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SendSocialAccountCreationListenerTest extends TestCase
{
    /**
     * @return void
     */
    public function test_social_account_creation_listener_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            SocialAccountConnectedEvent::class,
            SendSocialAccountCreationListener::class
        );
    }
}
