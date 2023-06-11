<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessfulAra extends Mailable
{
    use Queueable, SerializesModels;

    protected $subscription_info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscription_info)
    {
        $this->subscription_info = $subscription_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@afdalanalytics.com', 'Afdal Analytics')
            ->view('emails.payment_successful_ar')
            ->subject('Successful payment on Afdal Analytics.com')
            ->with([
                'subscription_info' =>$this->subscription_info,
            ]);
    }
}
