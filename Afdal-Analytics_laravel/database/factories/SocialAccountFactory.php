<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SocialAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provider_name' => 'facebook',
            'provider_id' => '265417892230407',
            'full_name' => 'Salahdeen Swessi',
            'email' => 'yuseph.breik@gmail.com',
            'token' => '',
        ];
    }
}
