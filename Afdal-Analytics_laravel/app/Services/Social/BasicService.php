<?php

namespace App\Services\Social;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BasicService {

    protected $api;
    protected $socialAccount;

    public function setApi($api)
    {
        $this->api = $api;
    }

    public function log(string $text)
    {
        DB::insert('insert into social_account_update_log (social_account_id, info, created_at) values (?, ?, ?)',
            [$this->socialAccount->id, $text, Carbon::now()]);
    }

    protected function checkSinceDate($date) : bool
    {
        if (!empty($date)) {
            $hoursSinceLastUpdate = Carbon::parse($date)->diffInHours(Carbon::now());
            if ($hoursSinceLastUpdate <= 24) {
                $this->log("Finish update because of data < 24 hours");
                return false;
            }
        }
        return true;
    }

    public function handleErrors(object $exception) : bool
    {
        // TODO: Implement handleErrors() method.
        return false;
    }
}
