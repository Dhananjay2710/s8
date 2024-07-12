<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurlCall extends Model
{
    /*
     * Curl Call code 
     */
    public static function handleCurlCall($url, $method, $data, $headers) {
        \Log::debug("URL : " . $url . "\n Method : " . $method . "\n Data : " . print_r($data,true) . "\n Headers : " . print_r($headers,true));
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ];

        if (!empty($headers) || !empty($data)) {
            $options[CURLOPT_HTTPHEADER] = $headers;
            $options[CURLOPT_POSTFIELDS] = $data;
        }

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        
        if (curl_errno($curl)) {
            \Log::debug("Inside if error occurs");
            $error = curl_error($curl);
            curl_close($curl);
            return $error;
        } else {
            curl_close($curl);
            return $response;
        }
    }
}
