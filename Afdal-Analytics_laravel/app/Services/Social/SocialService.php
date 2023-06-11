<?php
namespace App\Services\Social;

use App\Models\SocialAccount;

interface SocialService {
    public function updateUserData();
    public function callback();
    //public function delete();
    public function log(string $text);

    /**
     * @param object $exception
     * @return bool
     * true = handled , false = not handled
     */
    public function handleErrors(object $exception) : bool;
}
