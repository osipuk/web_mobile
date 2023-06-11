<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use App\Services\MailchimpMarketingTracker;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MailchimpMarketingTrackerTest extends TestCase
{
    use WithFaker;

    private static bool $ready = false;

    public function setUp() : void
    {
        parent::setUp();
        if (!self::$ready) {
            $mailchimp = new MailchimpMarketingTracker();
            $mailchimp->createSimpleUser("sirenko.developer@gmail.com");
            self::$ready = true;
        }
    }

    public function testCreateMemberInMailchimp()
    {
        $mailchimp = new MailchimpMarketingTracker();

        $user = User::factory()->make();
        $user->company = Company::factory()->make(['owner_id' => $user->id]);

        $user->email = "test.afdal." . $this->faker->email;
        $user->first_name = $this->faker->firstName;
        $user->last_name = $this->faker->lastName;
        $user->role = "Developer";

        $result = $mailchimp->createMember($user);
        $this->assertObjectHasAttribute('id', $result);
    }

    public function testSubscriptionPlanCreatedEventInMailchimp()
    {
        $mailchimp = new MailchimpMarketingTracker();
        $result = $mailchimp->subscriptionPlanCreatedEvent("sirenko.developer@gmail.com", 'Trial', 0);
        $this->assertEmpty($result);
    }

    public function testSubscriptionPlanCreatedEventInMailchimpWithError()
    {
        $mailchimp = new MailchimpMarketingTracker();
        $result = $mailchimp->subscriptionPlanCreatedEvent("test.nesushestvuyuschiy@test.com", 'Trial', 0);
        $this->assertNotEmpty($result);
    }

    public function testSocialAccountCreatedEventInMailchimpWithError()
    {
        $mailchimp = new MailchimpMarketingTracker();
        $result = $mailchimp->socialAccountCreatedEvent(
            "test.nesushestvuyuschiy@test.com",
            "facebook",
            "Test Facebook",
            "sirenko.developer@gmail.com"
        );
        $this->assertNotEmpty($result);
    }

    public function testSocialAccountCreatedEventInMailchimp()
    {
        $mailchimp = new MailchimpMarketingTracker();
        $result = $mailchimp->socialAccountCreatedEvent(
            "sirenko.developer@gmail.com",
            "facebook",
            "Test Facebook",
            "sirenko.developer@gmail.com"
        );
        $this->assertEmpty($result);
    }

    public function testUpdateMemberEventInMailchimp()
    {
        $mailchimp = new MailchimpMarketingTracker();

        $user = User::factory()->make();
        $user->company = Company::factory()->make(['owner_id' => $user->id]);
        $user->email = "test.before.update.afdal" . $this->faker->email;
        $user->first_name = $this->faker->firstName;
        $user->last_name = $this->faker->lastName;
        $user->role = "Developer";
        $result1 = $mailchimp->createMember($user);

        $newUser = User::factory()->make();
        $newUser->email = "test.update.afdal." . $this->faker->email;
        $newUser->first_name = $this->faker->firstName;
        $newUser->last_name = $this->faker->lastName;

        $result2 = $mailchimp->createOrUpdateMember($user, $newUser);
        $this->assertEquals($newUser->email, $result2->email_address);
    }
}
