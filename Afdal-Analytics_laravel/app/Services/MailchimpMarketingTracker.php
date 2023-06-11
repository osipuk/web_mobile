<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use MailchimpMarketing\ApiClient;
use function config;

class MailchimpMarketingTracker
{
    /**
     * Mailchimp Audience ID
     *
     * @var string
     */
    private $listId = "";

    public function __construct()
    {
        $this->listId = config('services.mailchimp.list_id');
    }

    /**
     * @param User $user
     * @return false|mixed|string
     */
    public function createMember(User $user)
    {
        try {
            $client = $this->client();
            if (is_null($client)) {
                return throw new \Exception("Wrong client connection");
            }

            $res= $client->lists->addListMember(
                $this->listId,
                [
                    "email_address" => $user->email,
                    "status" => "subscribed",
                    "merge_fields" => [
                        "NAME" => implode(" ", [$user->first_name, $user->last_name]),
                        "FNAME" => $user->first_name,
                        "LNAME" => $user->last_name,
                        "MMERGE7"=>$user->phone,
                        "ROLE" => $user->role,
                        "COMPANY" => $user->company->name
                    ]
                ],
                true
            );
            Log::info($res);
            return $res;
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function createOrUpdateMember(User $oldUser, User $user)
    {
        try {
            $client = $this->client();
            if (is_null($client)) {
                return throw new \Exception("Wrong client connection");
            }

            return $client->lists->setListMember(
                $this->listId,
                md5(strtolower($oldUser->email)),
                [
                    "email_address" => $user->email,
                    "status_if_new" => "subscribed"
                ],
                true
            );
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
            return $exception->getMessage();
        }
    }


    /**
     * @param string $email
     * @param string $planName
     * @param $planPrice
     * @return false|string|void
     */
    public function subscriptionPlanCreatedEvent(string $email, string $planName, $planPrice) {
        return $this->createListMemberEvent(
            $email,
            'plan',
            [
                'plan_name' => $planName,
                'plan_price' => "$planPrice"
            ]
        );
    }


    public function userRegisteredEvent(User $user) {
        return $this->createListMemberEvent(
            $user->email,
            'Registration',
            [
                'name' => implode(" ", [$user->first_name, $user->last_name]),
                'email' => $user->email,
                "role" => $user->role,
                "phone"=>$user->phone,
                "company" => $user->company->name
            ]
        );
    }

    /**
     * @param string $email
     * @param string $socialAccountType
     * @param string $socialAccountName
     * @param string $socialAccountEmail
     * @return false|string|void
     */
    public function socialAccountCreatedEvent(
        string $email,
        string $socialAccountType,
        string $socialAccountName = '',
        string $socialAccountEmail = ''
    ) {
        return $this->createListMemberEvent(
            $email,
            'connection',
            [
                'social_account_type' => $socialAccountType,
                'social_account_name' => $socialAccountName,
                'social_account_email' => $socialAccountEmail
            ]
        );
    }

    public function subscriptionPlanTrialEndsEvent($email, $endsAt) {
        Log::info("Subscription `plan trial ends` Mailchimp event tracking");
        if (empty($email)) {
            Log::info("Error Event Tracking `plan trial ends` to Mailchimp. Empty Email");
            return false;
        }
        $response = $this->createListMemberEvent(
            $email,
            'plan_trial_ends',
            [
                'ends_at' => "$endsAt"
            ]
        );
        Log::info("Subscription `plan trial ends` Mailchimp event tracking. Response = " . print_r($response, 1));
        return $response;
    }

    /**
     * @return \MailchimpMarketing\ApiClient|void
     */
    private function client()
    {
        if (!$this->checkConfig()) {
            return null;
        }

        $mailchimp = new ApiClient();
        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.api_key'),
            'server' => config('services.mailchimp.server'),
        ]);
        return $mailchimp;
    }

    /**
     * @return bool
     */
    private function checkConfig() : bool
    {
        $config = config('services.mailchimp');
        foreach ($config as $value) {
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param string $email
     * @param string $eventName
     * @param array $properties
     * @return false|string|void
     */
    private function createListMemberEvent(string $email, string $eventName, array $properties = [])
    {
        try {
            $client = $this->client();
            if (is_null($client)) {
                return throw new \Exception("Wrong client connection");
            }

            $test=$client->lists->createListMemberEvent(
                $this->listId,
                md5(strtolower($email)),
                [
                    'name' => $eventName,
                    'properties' => $properties
                ]
            );
            Log::info($test);
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function createSimpleUser($email)
    {
        try {
            $client = $this->client();
            if (is_null($client)) {
                return throw new \Exception("Wrong client connection");
            }

            return $client->lists->setListMember(
                $this->listId,
                md5(strtolower($email)),
                [
                    "email_address" => $email,
                    "status_if_new" => "subscribed"
                ],
                true
            );
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
            return $exception->getMessage();
        }
    }

}
