<?php

namespace Tests\Unit\Listeners\MailchimpMarketing;

use App\Events\UserUpdateEvent;
use App\Listeners\MailchimpMarketing\UpdateUserListener;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UpdateUserListenerTest extends TestCase
{
    /**
     * @return void
     */
    public function test_update_user_listener_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            UserUpdateEvent::class,
            UpdateUserListener::class
        );
    }
}
