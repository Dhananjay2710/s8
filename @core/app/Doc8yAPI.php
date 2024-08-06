<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\CurlCall;

/*
 * Handle all curl from this function of create from in side Doc8
 */

class Doc8yAPI extends Model
{
    /*
     * Fill the data with submitted data and store it inside Doc8
     */
    public static function createDuplicateDocumentAndRequest($phoneNumber, $formDataToSubmit) {
        // Base URL
        $base_url = 'https://app.doc8.in/api/v1/serviceapp/findandfillrequiredform';
        // Construct the full URL with query parameters
        $formDataJson = json_encode($formDataToSubmit);
        $encodedFormData = urlencode($formDataJson);
        $url = sprintf('%s?phoneNumber=%d&formSubmission=%s', $base_url, $phoneNumber, $encodedFormData);
        $response = CurlCall::handleCurlCall($url, "GET", "", "");
        return $response;
    }

    /*
    * Register service provider and customer in Doc8
    */
    public static function userRegister($userData) {
        \Log::debug("Inside the user Register");
        \Log::debug("User Data : " . print_r($userData,true));
        // Base URL
        $base_url = 'https://app.doc8.in/api/v1/customer/acceptdatafromsalesforce';
        $url = $base_url . '?';
        foreach ($userData as $key => $value) {
            $url .= $key . '=' . urlencode($value) . '&';
        }
        $url = rtrim($url, '&'); // Remove the trailing '&'
        \Log::debug("Full Url : " . $url);
        // Handle the cURL call
        $response = CurlCall::handleCurlCall($url, "GET", "", "");
        \Log::debug("Response of register user in Doc8 : " . $response);
        return $response;
    }
}
