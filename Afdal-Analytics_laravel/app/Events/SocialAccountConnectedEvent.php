<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SocialAccountConnectedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $user;

    /**
     * Social account name (like Facebook, Instagram, ....)
     *
     * @var string
     */
    public $socialAccountType;

    /**
     * @var string
     */
    public $socialAccountName = '';

    /**
     * @var string
     */
    public $socialAccountEmail = '';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, string $socialAccountType, string $socialAccountName = '', string $socialAccountEmail = '')
    {
        $this->user = $user;
        $this->socialAccountType = $socialAccountType;
        $this->socialAccountName = $socialAccountName;
        $this->socialAccountEmail = $socialAccountEmail;
    }
}
