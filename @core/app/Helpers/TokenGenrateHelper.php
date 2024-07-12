<?php

namespace App\Helpers;

use App\User;
/*
 * this class will contain token genrate method
*/
class TokenGenrateHelper{
    /*
    * Genrate Token 
    */
    public static function genrateToken($serviceProviderId) {
        $secretKey = 'TechnocraftsData';
        $userData = User::where('id', $serviceProviderId)->first();
        $dataToCreateToken = $serviceProviderId . '|' . $userData->email . '|' . $secretKey;
        $finalToken = hash('sha256', $dataToCreateToken);
        \Log::debug("Final Token : " . $finalToken);
        return $finalToken;
    }
}
