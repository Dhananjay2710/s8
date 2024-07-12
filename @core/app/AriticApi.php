<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\CurlCall;

class AriticApi extends Model
{
    /*
    * Handle all curl from this function of event lisner
    */
    public static function stageChange($serviceRequestId, $stage_name) {
        // Base URL
        $base_url = 'https://bank.ariticapp.com/ma/tickets/updateTicketStage';
        // Construct the full URL with query parameters
        $url = sprintf('%s?serviceRequestid=%d&stage_name=%s', $base_url, $serviceRequestId, urlencode($stage_name));
        $response = CurlCall::handleCurlCall($url, "POST", "", "");
        return $response;
    }
}
