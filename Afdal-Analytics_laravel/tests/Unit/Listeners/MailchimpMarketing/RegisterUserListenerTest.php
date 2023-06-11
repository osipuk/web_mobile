<?php

namespace Tests\Unit\Listeners\MailchimpMarketing;

use App\Events\UserRegisteredEvent;
use App\Listeners\MailchimpMarketing\RegisterUserListener;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RegisterUserListenerTest extends TestCase
{
    /**
     * @return void
     */
    public function test_register_user_listener_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            UserRegisteredEvent::class,
            RegisterUserListener::class
        );
    }
}
