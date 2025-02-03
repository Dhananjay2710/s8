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
use App\Order;

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
        $service_ticket_id = $service_request_info['service_ticket_id'] ?? null;
        $service_provider_id = $service_request_info['service_provider_id'] ?? null;
        $service_provider_email = $service_request_info['service_provider_email'] ?? null;
        $service_provider_name = $service_request_info['service_provider_name'] ?? null;
        if ($stage_name == "Accepted by Service Provider") {
            $orderData  = Order::where('service_ticket_id',$service_ticket_id)->where('id', '!=', $sr_id)->get();
            foreach($orderData as $order){
                Order::where('id',$order->id)->where('payment_status','complete')->where('status',0)->update(['payment_status'=>'','status'=>4]);
                // Order::where('id',$order->id)->delete();
            }
        }
        $curlCallResponse = AriticApi::stageChange($sr_id, $stage_name, $service_ticket_id, $service_provider_id, $service_provider_email, $service_provider_name);
        $decodedResponse = json_decode($curlCallResponse, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            \Log::debug("Curl Call Response: " . print_r($decodedResponse, true));
        } else {
            \Log::error("Failed to decode curl call response: " . json_last_error_msg());
        }
    }
}