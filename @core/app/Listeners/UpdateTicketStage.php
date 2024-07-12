<?php

namespace App\Listeners;

use App\Events\SupportMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\SupportMail;
use App\SupportTicket;
use Illuminate\Support\Facades\Mail;
use App\Events\UpdateTicket;
use App\AriticApi;

class UpdateTicketStage
{

    public function __construct()
    {
        //
    }

    public function handle(UpdateTicket $event)
    {
        $service_request_info = $event->service_request;
        $sr_id = $service_request_info['sr_id'] ?? null;
        $stage_name = $service_request_info['stage_name'] ?? null;
        $curlCallResponse = AriticApi::stageChange($sr_id, $stage_name);
        $decodedResponse = json_decode($curlCallResponse, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            \Log::debug("Curl Call Response: " . print_r($decodedResponse, true));
        } else {
            \Log::error("Failed to decode curl call response: " . json_last_error_msg());
        }
    }
}