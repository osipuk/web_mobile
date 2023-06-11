<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class ActiveCampaitngController extends Controller
{

    public function createContacts()
    {
        $users = User::all();

        foreach ($users as $user) {
            $contact = [
                'email' => $user->email,
                'first_name' => $user->name,
            ];
            ActiveCampaign::api('contact/sync', $contact);
        }
    }

    public function getContacts()
    {
        $users = ActiveCampaign::api('contact/list', ['ids' => 'all']);
    }

    public function searchContacts($searchTerm)
    {
        $contacts = ActiveCampaign::api('contact/search', ['search' => $searchTerm]);
        // You can then use the $contacts object to access the list of contacts that match the search term
    }

    public function CreateContact($user)
    {
        $curl = curl_init();
        $current_time_and_date = date("Y-m-d H:i:s");
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://afdalanalytics.api-us1.com/api/3/contacts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(['contact' => [
                'name' => $user->name,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
            'fieldValues' => [
              [
                "field" => 1,
                "value" => $current_time_and_date
              ],
              [
                "field" => 2,
                "value" => $user->timezone
              ],
              [
                "field" => 3,
                "value" => $user->trial_ends_at
              ],
              [
                "field" => 4,
                "value" => $user->status
              ],
              [
                "field" => 5,
                "value" => "trial"
              ],
              [
                "field" => 11,
                "value" => $user->email_verified
              ],
              [
                "field" => 12,
                "value" => $user->password
              ],
              [
                "field" => 13,
                "value" => $user->short_token
              ],
              [
                "field" => 14,
                "value" => $user->long_token
              ],
              
              [
                "field" => 15,
                "value" => $user->company_id
              ],
              [
                "field" => 16,
                "value" => $user->role
              ],
              [
                "field" => 17,
                "value" => $user->database_name
              ],
              [
                "field" => 18,
                "value" => $user->provider
              ],
              [
                "field" => 19,
                "value" => $user->provider_id
              ],
              [
                "field" => 20,
                "value" => $user->lead_id
              ],
              [
                "field" => 21,
                "value" => $user->google_id
              ],
              [
                "field" => 22,
                "value" => $user->linkedin_id
              ],
              [
                "field" => 23,
                "value" => $user->apple_id
              ],
              [
                "field" => 24,
                "value" => $user->stripe_id
              ],
              [
                "field" => 25,
                "value" => $user->city
              ],
              [
                "field" => 15,
                "value" => $user->country
              ],
              [
                "field" => 27,
                "value" => $user->address
              ],
              [
                "field" => 28,
                "value" => $user->website
              ],
              [
                "field" => 29,
                "value" => $user->postal_code
              ],
              [
                "field" => 30,
                "value" => $user->image
              ],
              [
                "field" => 31,
                "value" => $user->gift_ends_at
              ],
              [
                "field" => 32,
                "value" => $user->gift
              ],
              [
                "field" => 33,
                "value" => $user->disabled
              ],
              [
                "field" => 34,
                "value" => $user->phone_verified
              ],
              [
                "field" => 35,
                "value" => $user->otp
              ],
              [
                "field" => 36,
                "value" => $user->intercom_external_id
              ],
              [
                "field" => 37,
                "value" => $user->intercom_id
              ],
              [
                "field" => 38,
                "value" => $user->registered_by
              ],
              [
                "field" => 39,
                "value" => $user->is_sent_registered_event
              ],
              [
                "field" => 40,
                "value" => $user->paypal_method
              ]
            ]
              ],]),
            CURLOPT_HTTPHEADER => [
                "Api-Token: 0ae36eda7f10ccb6fa2dc2305d8f4c1128524bd32f9eb495a196dcbf1c8d95c329e6b3a4",
                "accept: application/json",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //   dd("cURL Error #:" . $err);
        } else {
            //   dd($response);
        }
    }

    public function AllActivities(){
    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => "https://afdalanalytics.api-us1.com/api/3/activities?include=activities%20to%20include&emails=false",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Api-Token: 0ae36eda7f10ccb6fa2dc2305d8f4c1128524bd32f9eb495a196dcbf1c8d95c329e6b3a4",
        "accept: application/json"
    ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    return;
    if ($err) {
    // echo "cURL Error #:" . $err;
    } else {
    // echo $response;
    }
        }


        public function TrackEvent(){

            $curl = curl_init();

            curl_setopt_array($curl, [
              CURLOPT_URL => "https://trackcmp.net/event",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "",
              CURLOPT_HTTPHEADER => [
                "Content-Type: application/x-www-form-urlencoded",
                "accept: application/json"
              ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            return;
            if ($err) {
            //   echo "cURL Error #:" . $err;
            } else {
            //   echo $response;
            }

        }



        public function CreateEvent(){
            $curl = curl_init();
            curl_setopt_array($curl, [
            CURLOPT_URL => "https://afdalanalytics.api-us1.com/api/3/eventTrackingEvents",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => [
                "Api-Token: 0ae36eda7f10ccb6fa2dc2305d8f4c1128524bd32f9eb495a196dcbf1c8d95c329e6b3a4",
                "accept: application/json",
                "content-type: application/json"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            return;
            if ($err) {
            // echo "cURL Error #:" . $err;
            } else {
            // echo $response;
            }
        }

        public function sitetrackingStatus(){
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://afdalanalytics.api-us1.com/api/3/siteTracking",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Api-Token: 0ae36eda7f10ccb6fa2dc2305d8f4c1128524bd32f9eb495a196dcbf1c8d95c329e6b3a4",
            "accept: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return;
            if ($err) {
            // echo "cURL Error #:" . $err;
            } else {
            // echo $response;
            }
        }


        public function EventTrackingCreation($eventname){
            $curl = curl_init();
            $data = array(
              'eventTrackingEvent' => array(
                  'name'=>$eventname
              )
          );
          
            curl_setopt_array($curl, [
              CURLOPT_URL => "https://afdalanalytics.api-us1.com/api/3/eventTrackingEvents",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => json_encode($data),
              CURLOPT_HTTPHEADER => [
                "Api-Token: 0ae36eda7f10ccb6fa2dc2305d8f4c1128524bd32f9eb495a196dcbf1c8d95c329e6b3a4",
                "accept: application/json",
                "content-type: application/json"
              ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            return;
            if ($err) {
            //   echo "cURL Error #:" . $err;
            } else {
            //   echo $response;
            }
        }

        //Event Tracking API 
        public function EventTrackingAPI($event, $eventdata,$email) {
          Log::info('This is a message from event tracking AC');
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
                    "email" => $email,
                )),
            ));
    


            /// pushing development
            $result = curl_exec($curl);
            return;
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


        public function UpdateContactAC($data,$user) {
          $contact_id="";
          $mail=$user->email;
          $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://afdalanalytics.api-us1.com/api/3/contacts?email=$mail",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    "Api-Token: 0ae36eda7f10ccb6fa2dc2305d8f4c1128524bd32f9eb495a196dcbf1c8d95c329e6b3a4",
                    "accept: application/json",
                ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
               echo("cURL Error #:" . $err);
            } else {
                $result = json_decode($response, true);
                if (!empty($result['contacts'][0]['id'])) {
                    $contact_id = $result['contacts'][0]['id'];
                    echo $contact_id;
                }
            }
            curl_setopt_array($curl, [
              CURLOPT_URL => "https://afdalanalytics.api-us1.com/api/3/contacts/$contact_id",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "PUT",
                      CURLOPT_POSTFIELDS => json_encode(['contact' => [
                              
                                    'first_name'=> $data['first_name'],
                                    'last_name'=> $data['last_name'],
                                    'phone' => $data['phone'],
                                'fieldValues' => [
                                  [
                                    "field" => 2,
                                    "value" => $data['timezone']
                                  ],
                                  [
                                    "field" => 5,
                                    "value" => "test if update is working using data"
                                  ],
                                  [
                                    "field" => 16,
                                    "value" => 'test role'
                                  ],
                                  [
                                    "field" => 25,
                                    "value" => $data['city']
                                  ],
                                  [
                                    "field" => 26,
                                    "value" => $data['country']
                                  ],
                                  [
                                    "field" => 27,
                                    "value" => $data['address']
                                  ],
                                  [
                                    "field" => 28,
                                    "value" => $data['website']
                                  ],
                                  [
                                    "field" => 29,
                                    "value" => $data['postal_code']
                                  ],
                                ]
                                  ],]),
              CURLOPT_HTTPHEADER => [
                "Api-Token: 0ae36eda7f10ccb6fa2dc2305d8f4c1128524bd32f9eb495a196dcbf1c8d95c329e6b3a4",
                "accept: application/json",
                "content-type: application/json"
              ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              echo $response;
            }
        }        

    public function SyncContactAC() {
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://afdalanalytics.api-us1.com/api/3/contact/sync",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_HTTPHEADER => [
        "Api-Token: 0ae36eda7f10ccb6fa2dc2305d8f4c1128524bd32f9eb495a196dcbf1c8d95c329e6b3a4",
        "accept: application/json",
        "content-type: application/json"
      ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
}



}
