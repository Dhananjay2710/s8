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
    public static function stageChange($serviceRequestId, $stageName, $serviceTicketId, $serviceProviderId, $serviceProviderEmail, $serviceProviderName) {
        // Base URL
        $base_url = 'https://bank.ariticapp.com/ma/tickets/updateTicketStage';
        // Construct the full URL with query parameters
        $url = sprintf('%s?serviceRequestid=%d&stage_name=%s&ticket_id=%s&service_provider_id=%s&service_provider_email=%s&service_provider_name=%s', $base_url, $serviceRequestId, urlencode($stageName), $serviceTicketId, $serviceProviderId, $serviceProviderEmail, urlencode($serviceProviderName));
        $response = CurlCall::handleCurlCall($url, "POST", "", "");
        return $response;
    }
}
