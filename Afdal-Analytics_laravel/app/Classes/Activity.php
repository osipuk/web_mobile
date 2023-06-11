<?php

namespace App\Classes;

use App\Mail\InviteUser;
use App\Mail\NewConnectionAra;
use App\Mail\PaymentSuccessfulAra;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Activity
{
    public function addActivity($type, $text, $plan_info = null) {
        $user = Auth::user();
        $full_name = $user->first_name . ' ' . $user->last_name;
        $activity = ActivityLog::create([
            'type' => $type,
            'text' => $text,
            'user'=> $full_name,
            'date' => Carbon::now()->format('Y-m-d'),
            'price' => $plan_info?->price,
            'company_id' => $user->company_id,
            'user_id' => $user->id
        ]);
        if(!empty($user->email)){
            switch ($type) {
                case 'add_connection':
                    Mail::to($user->email)->send(new NewConnectionAra($full_name, $text));
                    break;
                case 'subscribe':
                case 'change_plan':
                    Mail::to($user->email)->send(new PaymentSuccessfulAra($plan_info));
                    break;
            }
        }
    }
}
