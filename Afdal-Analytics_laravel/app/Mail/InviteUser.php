<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteUser extends Mailable
{
    use Queueable, SerializesModels;

    protected  $first_name;
    protected  $company_name;
    protected  $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name, $company_name, $token)
    {
        $this->first_name = $first_name;
        $this->company_name = $company_name;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@afdalanalytics.com', 'Afdal Analytics')
            ->subject('You have been invited to ' . $this->company_name . ' on Afdal Analytics.com')
            ->view('emails.invitation_member_ar')
            ->with([
                'first_name' => $this->first_name,
                'company_name' => $this->company_name,
                'token' => $this->token,
            ]);
    }
}
