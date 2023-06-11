<?php

use App\Models\Plans;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('plans')->insert(
            array(



                array(
                    'title' => 'Essentials Plan',
                    'identifier' => 'essentials',
                    'stripe_id' => 'price_1LDTZgCmgWNu3hKQWkhoMPbA',
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'title' => 'Plus Plan',
                    'identifier' => 'plus',
                    'stripe_id' => 'price_1LDTXYCmgWNu3hKQha4JM5la',
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'title' => 'Enterprise Plan',
                    'identifier' => 'enterprise',
                    'stripe_id' => 'price_1LDTZ4CmgWNu3hKQ6oJz5vC0',
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now()
                ),



                array(
                    'title' => 'Essentials Plan',
                    'identifier' => 'essentials_yearly',
                    'stripe_id' => 'price_1Ka1kkCmgWNu3hKQBeIRHrJT',
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'title' => 'Plus Plan',
                    'identifier' => 'plus_yearly',
                    'stripe_id' => 'price_1Ka1kTCmgWNu3hKQrF12K0Se',
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'title' => 'Enterprise Plan',
                    'identifier' => 'enterprise_yearly',
                    'stripe_id' => 'price_1Ka1kDCmgWNu3hKQHLcq2F0m',
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now()
                )
            )
        );
    }



    /*

                array(
                    'title' => 'Essentials Plan',
                    'identifier' => 'essentials',
                    'stripe_id' => 'price_1KU7VYCmgWNu3hKQC9agJ4fR',
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'title' => 'Plus Plan',
                    'identifier' => 'plus',
                    'stripe_id' => 'price_1KU7VjCmgWNu3hKQpIBr5hhv',
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'title' => 'Enterprise Plan',
                    'identifier' => 'enterprise',
                    'stripe_id' => 'price_1KU7WLCmgWNu3hKQY88rKeg5',
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Plans::truncate();
    }
};
