<?php

namespace App\Services\Social;

use App\Models\ActivityLog;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait FacebookGraphErrorHandler
{

    public function handleErrors(object $exception) : bool
    {
        if (!($exception instanceof ClientException)) {
            return false;
        }

        $response = json_decode($exception->getResponse()->getBody());
        $code = $response->error->code ?? 0;
        $subCode = $response->error->error_subcode ?? 0;
        $message = $response->error->message ?? "";

        $socialName = Str::studly($this->socialAccount->provider_name);

        if ($code == 100 && $subCode == 33) {
            $text =  $socialName . " require permission. Set up your account's permissions for the data refresh possibility";
        }

        if ($code == 190 && $subCode == 460) {
            $text = $socialName . " error of validating access token. Authorize your account for the data refresh possibility";
        }

        if ($code == 190 && $subCode == 458) {
            $text = $socialName . " error validating access token: The user has not authorized application.
             Authorize application for the data refresh possibility";
        }

        if (!empty($text)) {
            Log::warning($this->socialAccount->provider_name . " Error. Need To Notify User. Message = " . $message);
            $user = User::where('company_id', $this->socialAccount->company_id)->first();
            ActivityLog::create([
                'type' => "social_account_get_data_with_error",
                'text' => $text,
                'user' => $user->first_name . ' ' . $user->last_name,
                'date' => Carbon::now()->format('Y-m-d'),
                'company_id' => $user->company_id,
                'user_id' => $user->id
            ]);
            return true;
        }

        return false;
    }
}
