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
use App\Pipeline;
use App\Stage;

class UpdateTicketStage
{

    public function __construct()
    {
        //
    }

    public function handle(UpdateTicket $event)
    {
        $pipelineData = Pipeline::all();
        $stageData = Stage::all();
        $service_request_info = $event->service_request;
        $sr_id = $service_request_info['sr_id'] ?? null;
        $stage_name = $service_request_info['stage_name'] ?? null;
        $service_ticket_id = $service_request_info['service_ticket_id'] ?? null;
        $service_provider_id = $service_request_info['service_provider_id'] ?? null;
        $service_provider_email = $service_request_info['service_provider_email'] ?? null;
        $service_provider_name = $service_request_info['service_provider_name'] ?? null;
        $ticket_pipeline_name = $service_request_info['ticket_pipeline_name'] ?? null;
        foreach($pipelineData as $pipeline){
            foreach($stageData as $stage){
                if ($stage->stage_action_key == "accept" && $stage->pipeline_id == $pipeline->id && $ticket_pipeline_name == $pipeline->pipeline_name) {
                    $orderData  = Order::where('service_ticket_id',$service_ticket_id)->where('id', '!=', $sr_id)->get();
                    foreach($orderData as $order){
                        Order::where('id',$order->id)->where('payment_status','complete')->where('status',0)->update(['payment_status'=>'','status'=>4]);
                    }
                    break;
                }
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