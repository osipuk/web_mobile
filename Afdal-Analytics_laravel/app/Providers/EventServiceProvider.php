<?php

namespace App\Providers;

use App\Events\SocialAccountConnectedEvent;
use App\Events\SubscriptionPlanCreatedEvent;
use App\Events\UserRegisteredEvent;
use App\Events\UserUpdateEvent;
use App\Listeners\MailchimpMarketing\RegisterUserListener;
use App\Listeners\MailchimpMarketing\SendSocialAccountCreationListener;
use App\Listeners\MailchimpMarketing\SendSubscriptionPlanListener;
use App\Listeners\MailchimpMarketing\UpdateUserListener;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserRegisteredEvent::class => [
          RegisterUserListener::class
        ],
        SubscriptionPlanCreatedEvent::class => [
          SendSubscriptionPlanListener::class
        ],
        SocialAccountConnectedEvent::class => [
          SendSocialAccountCreationListener::class
        ],
        UserUpdateEvent::class => [
          UpdateUserListener::class
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\Apple\AppleExtendSocialite::class.'@handle',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
