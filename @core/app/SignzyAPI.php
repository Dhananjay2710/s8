<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\CurlCall;

class SignzyAPI extends Model
{
    /*
     * Fetch data from Signzy API based on endpoint name
     */
    public static function fetchData($name, $data)
    {
        $headers = [
            "Authorization: " . getenv('SIGNZY_ACCESS_TOKEN'),
            "Content-Type: application/json"
        ];

        $SignzyAPI = [
            ["name" => "FetchPAN", "method" => "POST", "url" => "https://api.signzy.app/api/v3/panv2-fetch/no-cache"],
            ["name" => "getOkycOtp", "method" => "POST", "url" => "https://api.signzy.app/api/v3/getOkycOtp"],
            ["name" => "fetchOkycData", "method" => "POST", "url" => "https://api.signzy.app/api/v3/fetchOkycData"],
            ["name" => "bankaccountverification", "method" => "POST", "url" => "https://api.signzy.app/api/v3/bankaccountverification/bankaccountverifications"]
        ];

        \Log::debug("Make $name API Start");
        // Find the API details from $SignzyAPI based on $name
        $apiDetails = array_values(array_filter($SignzyAPI, function($api) use ($name) {
            return $api['name'] === $name;
        }))[0] ?? null;

        if (!$apiDetails) {
            \Log::error("API '$name' not found in SignzyAPI configuration.");
            return null;
        }

        $url = $apiDetails['url'];
        $method = $apiDetails['method'];
        $response = CurlCall::handleCurlCall($url, $method, $data, $headers);
        \Log::debug("Response : " . print_r($response,true));
        \Log::debug("Make $name API End with Success");
        return $response;
    }
}
