<?php


namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class IntercomAPI
{
    private $apiURL = 'https://api.intercom.io/';
    // https://api.intercom.io/users
    private $headers = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer dG9rOmIwZGVkZWFiX2JmZDFfNDMxMV85ZTFhX2VhY2ViMjY5ZGQ5ODoxOjA=',
        'Accept' => 'application/json',
    ];

    public function addConnection($connection) {
        $postInput = [
            'event_name' => 'New Connection',
            'created_at' => Carbon::now()->timestamp,
            'user_id' => Auth::user()->id,
            'metadata' => [
                'Connection' => $connection
            ]
        ];
        Http::withHeaders($this->headers)->post($this->apiURL . 'events', $postInput);
    }


    public function EventTrackingAPI($event, $eventdata) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://trackcmp.net/event");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
        "actid" => "254549829",
        "key" => "5346b81a6de4d52be0cc65407fdb98ecc21d992f",
        "event" => $event,
        "eventdata" => $eventdata,
        "visit" => json_encode(array(
                // If you have an email address, assign it here.
                "email" => "",
            )),
        ));
    
        $result = curl_exec($curl);
        if ($result !== false) {
            $result = json_decode($result);
            if ($result->success) {
                echo 'Success! ';
            } else {
                echo 'Error! ';
            }
    
            echo $result->message;
        } else {
            echo 'cURL failed to run: ', curl_error($curl);
        }
    }

    public function changePlan($plan) {
        $postInput = [
            'event_name' => 'New Plan',
            'created_at' => Carbon::now()->timestamp,
            'user_id' => Auth::user()->id,
            'metadata' => [
                'Plan' => $plan
            ]
        ];
        Http::withHeaders($this->headers)->post($this->apiURL . 'events', $postInput);
    }


    public function planTrialEnds($userId, $endDate) {
        Log::info("Subscription `plan trial ends` Intercom event tracking");
        $postInput = [
            'event_name' => 'Plan Trial Ends',
            'created_at' => Carbon::now()->timestamp,
            'user_id' => $userId,
            'metadata' => [
                'Plan Trial Ends at' => $endDate
            ]
        ];
        Http::withHeaders($this->headers)->post($this->apiURL . 'events', $postInput);
    }
    public function userRegistered($user,$registered_by,$external_id=null) {
        Log::info("user registered Intercom event tracking");
        $postInput = [
            'event_name' => 'Registration',
            'user_id' =>$user->id,
            'created_at' => Carbon::now()->timestamp,
            'metadata' => [
                'registered_by' => $user->registered_by,
            ]
        ];
        $repnse=Http::withHeaders($this->headers)->post($this->apiURL . 'events', $postInput);
        Log::info($repnse);
    }
    public function addPhoneNumber($user){
        Log::info("Adding user phone after email");
        $postInput = [
            'role' => 'user',
            'external_id' =>$user->id,
            'phone' => $user->phone,
        ];
        $repnse=Http::withHeaders($this->headers)->put($this->apiURL . 'contacts/'.$user->id, $postInput);
        Log::info($repnse);
    }
    public function updatePhoneNumber($user,$external_id){
        Log::info("Adding user phone after phone");
        $postInput = [
            'role' => 'user',
            'external_id' =>$external_id,
            'phone' => $user->phone,
            
        ];
        $repnse=Http::withHeaders($this->headers)->put($this->apiURL . 'contacts/'.$user->id, $postInput);
        Log::info($repnse);
    }

    public function createUser($user){
        Log::info("creating contact in case signup with email/phone");
        $postInput = [
            'role' => 'user',
            'external_id'=>$user->id.Carbon::now()->timestamp,
            'name' => implode(" ", [$user->first_name, $user->last_name]),
            'email' => $user->email,
            'phone' => $user->phone,
            'signed_up_at'=>Carbon::now()->timestamp
        ];
        $repnse=Http::withHeaders($this->headers)->post($this->apiURL . 'contacts', $postInput);
        Log::info($repnse);
        // return $repnse;
        $reponse_all=json_decode($repnse,true);
        $external_id=$reponse_all['external_id'];
        $user_intercom_id=$reponse_all['id'];
        $user->update([
            'intercom_external_id'=>$external_id,
            'intercom_id'=>$user_intercom_id,
        ]);

        $company_reponse=$this->createCompany($user->company);
        $company_reponse_all=json_decode($company_reponse,true);
        $company_reponse_id=$company_reponse_all['id'];
        $user->company->update([
            'intercom_id'=>$company_reponse_id
        ]);
        $attach_reponse=$this->attachCompany($user_intercom_id,$company_reponse_id);
        // $this->userRegistered($user,'Phone',$external_id);
    }
    public function createCompany($company){
        Log::info("creating company");
        $postInput = [
            'name' => $company->name,
            'company_id' => $company->id,
            'remote_created_at'=>Carbon::now()->timestamp
        ];
        $repnse=Http::withHeaders($this->headers)->post($this->apiURL . 'companies', $postInput);
        Log::info($repnse);
        return $repnse;
    }
    public function attachCompany($user_intercom_id,$company_reponse_id){
        Log::info("attach company");
        $postInput = [
            'id' => $company_reponse_id
        ];
        $repnse=Http::withHeaders($this->headers)->post($this->apiURL . 'contacts/'.$user_intercom_id.'/companies', $postInput);
        Log::info($repnse);
        return $repnse;
    }
    

}
