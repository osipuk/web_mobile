<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewConnectionAra extends Mailable
{
    use Queueable, SerializesModels;

    protected $full_name;
    protected $provider_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($full_name, $provider_name)
    {
        $this->full_name = $full_name;
        $this->provider_name = $provider_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new_connection_added_ar')
            ->subject('Successful connection ' . $this->provider_name . ' on Afdal Analytics.com')
            ->with([
                'full_name' => $this->full_name,
                'provider_name' => $this->provider_name,
            ]);
    }
}
