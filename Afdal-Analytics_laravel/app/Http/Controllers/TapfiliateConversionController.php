<?php

namespace App\Http\Controllers;

use App\Models\TapfiliateConversion;
use Illuminate\Http\Request;
use DB;
use Auth; 

class TapfiliateConversionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        



                $curl = curl_init();

                curl_setopt_array($curl, [
                  CURLOPT_URL => "https://api.tapfiliate.com/1.6/conversions/19064395/",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "DELETE",
                  CURLOPT_HTTPHEADER => [
                    "X-API-Key:0b78bd667348f09f1544fb2204ed476bdb278d8c",
                    "content-type: application/json"
                  ],

                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                  echo "cURL Error #:" . $err;
                } else {

                    DB::table('tapfiliate_conversions')->where([['user_id', Auth::id()], ['subscription_id', $d->external_id]])->update(['subscription_status'=>0]);
                    dd($response);

                }







/*
        $given_subscription_id = NULL;
        $get_tapfilliate_id_of_subscription = [];

        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.tapfiliate.com/1.6/conversions/",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => [
            "X-API-Key:0b78bd667348f09f1544fb2204ed476bdb278d8c",
            "content-type: application/json"
          ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = (json_decode($response));

          foreach($data as $d){
            //if($d->external_id == $given_subscription_id){
                $get_tapfilliate_id_of_subscription[] = (array)$d;
            //}
          } //endforeach


          dd($get_tapfilliate_id_of_subscription);


          if($get_tapfilliate_id_of_subscription != NULL){
            foreach($get_tapfilliate_id_of_subscription as $single_unsubscribe_tapfiliate){



                    DB::table('tapfiliate_conversions')->where([['user_id', Auth::id()], ['subscription_id', $single_unsubscribe_tapfiliate['external_id']]])->update(['tapfiliate_id'=>$single_unsubscribe_tapfiliate['id']]);
                


            }
          }


        }




*/


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TapfiliateConversion  $tapfiliateConversion
     * @return \Illuminate\Http\Response
     */
    public function show(TapfiliateConversion $tapfiliateConversion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TapfiliateConversion  $tapfiliateConversion
     * @return \Illuminate\Http\Response
     */
    public function edit(TapfiliateConversion $tapfiliateConversion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TapfiliateConversion  $tapfiliateConversion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TapfiliateConversion $tapfiliateConversion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TapfiliateConversion  $tapfiliateConversion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TapfiliateConversion $tapfiliateConversion)
    {
        //
    }
}
