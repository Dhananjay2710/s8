<?php

namespace App\Http\Controllers\Api;

use App\ExtraService;
use App\Helpers\ServiceCalculationHelper;
use App\Notifications\TicketNotificationSeller;
use App\Actions\Media\MediaHelper;
use App\Country;
use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Order;
use App\OrderAdditional;
use App\ServiceArea;
use App\ServiceCity;
use App\SupportTicket;
use App\SupportTicketMessage;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Auth;
use App\PayoutRequest;
use App\AmountSettings;
use App\SellerVerify;
use App\Accountdeactive;
use App\Service;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\OrderCompleteDecline;
use Modules\Subscription\Entities\SellerSubscription;
use Modules\Subscription\Entities\Subscription;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Entities\WalletHistory;
use App\Day;
use App\Schedule;
use Illuminate\Support\Facades\Validator;
use App\Helpers\TokenGenrateHelper;
use App\Penalty;

class SellerController extends Controller
{
    public function depositFromBalance(Request $request){
        //balance calculate
        $buyer_id = auth('sanctum')->id();
        $get_sum = Order::where(['status'=>2,'seller_id'=>$buyer_id]);
        $complete_order_balance_with_tax = $get_sum->sum('total');
        $complete_order_tax = $get_sum->sum('tax');
        $complete_order_balance_without_tax = $complete_order_balance_with_tax - $complete_order_tax;
        $admin_commission_amount = $get_sum->sum('commission_amount');
        $remaning_balance = $complete_order_balance_without_tax-$admin_commission_amount;
        $total_earnings = PayoutRequest::where('seller_id',$buyer_id)->where('payment_type','Withdraw')->sum('amount');
        $total_penalties = PayoutRequest::where('seller_id',$buyer_id)->where('payment_type','Penalty')->sum('amount');
        $remaning_balance = $remaning_balance - ($total_earnings + $total_penalties);

        if($request->amount <= $remaning_balance){
            PayoutRequest::create([
                'seller_id' => $buyer_id,
                'amount' => $request->amount,
                'payment_type' => 'Withdraw',
                'payment_gateway' => __('Nothing'),
                'seller_note' => __('Deposit to wallet'),
                'status' => 1,
            ]);
            if(empty($buyer)){
                Wallet::create([
                    'buyer_id' => $buyer_id,
                    'balance' => 0,
                    'status' => 0,
                ]);
            }
            $deposit = WalletHistory::create([
                'buyer_id' => $buyer_id,
                'amount' => $total,
                'payment_gateway' => 'current_balance',
                'payment_status' => 'pending',
                'status' => 1,
            ]);

            $deposit_details = WalletHistory::find($deposit->id);
            WalletHistory::where('id', $deposit->id)->update([
                'payment_status' => 'complete',
                'transaction_id' => 'deposit from current balance',
                'status' => 1,
            ]);

            $get_balance_from_wallet = Wallet::where('buyer_id',$deposit_details->buyer_id)->first();
            Wallet::where('buyer_id', $deposit_details->buyer_id)
                ->update([
                    'balance' => $get_balance_from_wallet->balance + $deposit_details->amount,
                ]);
            return response(['msg' =>__('Your deposit successfully completed.')],200);
        }

        return response(['msg' =>__('Your current balance is less the deposit amount. Please enter a valid amount.')],200);

    }

    public function renewSubscription(Request $request){

        if ($request->subscription_id) {
            $seller_id = Auth::guard('sanctum')->user()->id;
            $seller_email = Auth::guard('sanctum')->user()->email;
            $seller_name = Auth::guard('sanctum')->user()->name;
            $subscription_details = Subscription::where('id', $request->subscription_id)->first();
            $seller_subscription = SellerSubscription::where('subscription_id', $request->subscription_id)->where('seller_id', $seller_id)->first();
            $wallet_balance = Wallet::select('balance')->where('buyer_id', $seller_id)->first();

            if ($wallet_balance->balance >= $subscription_details->price) {
                if ($subscription_details->type == 'monthly') {
                    $expire_date = Carbon::now()->addDays(30);
                    $connect = $subscription_details->connect;
                } elseif ($subscription_details->type == 'yearly') {
                    $expire_date = Carbon::now()->addDays(365);
                    $connect = $subscription_details->connect;
                } elseif ($subscription_details->type == 'lifetime') {
                    $expire_date = Carbon::now()->addDays(3650);
                    $connect = 1000000;
                }

                SellerSubscription::where('subscription_id', $subscription_details->id)->update([
                    'payment_status' => 'complete',
                    'payment_gateway' => 'wallet',
                    'expire_date' => $expire_date,
                    'connect' => ($seller_subscription->connect + $connect),
                    'price' => $subscription_details->price,
                    'status' => 1,
                ]);

                Wallet::where('buyer_id', $seller_id)->update([
                    'balance' => $wallet_balance->balance - $subscription_details->price,
                ]);

                //Send order email to admin and seller
                try {
                    $connect = $subscription_details->type =='lifetime' ? __("No Limit") : $connect;
                    $message = get_static_option('renew_subscription_seller_message') ?? '';
                    $message = str_replace(["@type","@price","@connect"],[$subscription_details->type,float_amount_with_currency_symbol($subscription_details->price),$connect],$message);
                    Mail::to($seller_email)->send(new BasicMail([
                        'subject' =>get_static_option('renew_subscription_email_subject') ?? __('Renew Subscription'),
                        'message' => $message
                    ]));


                    $message = get_static_option('buy_subscription_admin_message') ?? '';
                    $message = str_replace(["@type","@price","@connect","@seller_name","@seller_email"],[$subscription_details->type,float_amount_with_currency_symbol($subscription_details->price),$connect,$seller_name,$seller_email],$message);
                    Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                        'subject' =>get_static_option('renew_subscription_email_subject') ?? __('Renew Subscription'),
                        'message' => $message
                    ]));

                } catch (\Exception $e) {

                }
                return response([
                   'msg' =>  __('Your subscription renewed successfully')
                ]);
            }
            return response([
                'msg' =>  __('Your wallet balance is not sufficient to renew this subscription')
            ],422);


        }
    }

    public function dashboardInfo(){
        
        $total_earnings = 0;
        $seller_id = Auth::guard('sanctum')->user()->id;
        $pending_order = Order::where(['status'=>0,'seller_id'=>$seller_id])->count();
        $complete_order = Order::where(['status'=>2,'seller_id'=>$seller_id])->count();
        
        //
        $get_sum = Order::where(['status'=>2,'seller_id'=>$seller_id]);
        $complete_order_balance_with_tax = $get_sum->sum('total');
        $complete_order_tax = $get_sum->sum('tax');
        $complete_order_balance_without_tax = $complete_order_balance_with_tax - $complete_order_tax;
        $admin_commission_amount = $get_sum->sum('commission_amount');
        $remaning_balance = $complete_order_balance_without_tax-$admin_commission_amount;
        
        //
        
        $total_earnings = PayoutRequest::where('seller_id',$seller_id)->where('payment_type', 'Withdraw')->sum('amount');
        $total_penalties = PayoutRequest::where('seller_id',$seller_id)->where('payment_type', 'Penalty')->sum('amount');     
        $remaning_balance -= ($total_earnings + $total_penalties);
        
        return response()->success([
            'pending_order' => $pending_order ?? null, 
            'completed_order' => $complete_order ?? null, 
            'total_withdrawn_money' => $total_earnings, 
            'remaining_balance' => $remaning_balance,
            'seller_id' => $seller_id
        ]);

    }
    
    public function chartData(Request $request){
         //get last 12 months order
        $chart_data = [];
        $month_list = [];
        $monthly_order_list = [];

        for($i=11; $i>=0;$i--){
            $chart_data[] = [
                "monthName" => Carbon::today()->startOfMonth()->subMonth($i)->format('M'),
                "totalOrder" => Order::where('seller_id',auth('sanctum')->id())->whereYear('created_at',Carbon::now()->year)
                ->whereMonth('created_at',Carbon::now()->subMonth($i))
                ->count()
            ];
        }
        
         return response()->success([
            'chart_data' => $chart_data ?? null, 
        ]);
        
    }

    public function recentOrders(Request $request){
        
        $total_earnings = 0;
        $seller_id = Auth::guard('sanctum')->user()->id;
        $item = 5;
        if($request->has('item')){
            $item = $request->item;
        }
        $recent_order = Order::select('id','name','status','email','total')->where('seller_id',$seller_id)->latest()->take($item)->get()->transform(function($info){
            $info->order_status = $this->orderStatusText($info->status);
            $info->total = number_format($info->total,2,'.','');
            return $info;
        });
        
        return response()->success([
            'recent_orders' => $recent_order ?? __('No service request found')
        ]);

    }
    
    public function ticketStatusChange(Request $request)
    {
         if(!$request->has('id')){
            return response()->error(['message' => __('no support ticket found')]);
        }
        
        $all_tickets = SupportTicket::where('id',$request->id)->update(['status' => $request->status]);
        
        return response()->success([
            'message' => __('Ticket Status Changed'),
        ]);
    }

    public function myOrders(Request $request,$id=null)
    {
         $uesr_info = auth('sanctum')->user()->id;
        $my_orders = Order::query();
        

        if(isset(request()->payment_status) && in_array(request()->payment_status,["0","1"])){
            //0=pending, 1=complete
            $my_orders->where("payment_status",request()->payment_status === "0" ? "pending" : "complete");
        }
        if(isset(request()->status) && in_array(request()->payment_status,[0,1,2,3,4])){
            //0=pending, 1=active, 2=completed, 3=delivered, 4=cancelled
            $my_orders->where("status",request()->status);
        }
        
        $uesr_info = auth('sanctum')->user()->id;
        $my_orders = $my_orders->where('seller_id',$uesr_info)->orderBy('id','desc')->paginate(10)->through(function ($item) {
           $item->payment_status =  !empty($item->payment_status) ? $item->payment_status : 'pending';
           $item->date = null;
           
            if($item->date !== "No Date Created"){
                
                try{
                    $item->date = \Carbon\Carbon::parse($item->date);
                }
                catch(\Exception $e){
                    
                };
            }
            
            return $item;
       });
   
        return response()->success([
            'my_orders' => $my_orders,
            'user_id' => $uesr_info,
        ]);
    }
    
    public function singleOrder(Request $request){
        
        if(empty($request->id)){
            return response()->error(['message' => __('no service request found')]);
        }
        
        $orderInfo = Order::with('service')->where('id',$request->id)->first();
        $orderInfo->payment_status = !empty($orderInfo->payment_status) ? $orderInfo->payment_status : 'pending';
        $orderInfo->total = amount_with_currency_symbol($orderInfo->total);
        $orderInfo->tax = amount_with_currency_symbol($orderInfo->tax);
        $orderInfo->sub_total = amount_with_currency_symbol($orderInfo->sub_total);
        $orderInfo->extra_service = amount_with_currency_symbol($orderInfo->extra_service);
        $orderInfo->package_fee = amount_with_currency_symbol($orderInfo->package_fee);

        $orderInfo->date = null;
        if($orderInfo->date !== "No Date Created"){
            
            try{
                $orderInfo->date = \Carbon\Carbon::parse($orderInfo->date);
            }
            catch(\Exception $e){
                
            };
        }
        
        //append buyer infomation 
        $orderInfo->buyer_details = $orderInfo->buyer ?? null; 
        
        
        if(is_null($orderInfo)){
            return response()->success([
                'message'=>__('Service Request Not Found')
            ]);
        }
        
        return response()->success([
                'orderInfo'=> $orderInfo
        ]);
    }
    
    public function allTickets()
    {
        $all_tickets = SupportTicket::select('id','title','description','subject','priority','status')
        ->where('seller_id',auth('sanctum')->id())->orderBy('id','Desc')
        ->paginate(10)
        ->withQueryString();
        
        return response()->success([ 
            'seller_id'=> auth('sanctum')->id(),
            'tickets' =>$all_tickets,
        ]);
    }
    
    public function viewTickets(Request $request,$id= null)
    {
        $all_messages = SupportTicketMessage::where(['support_ticket_id'=>$id])->get()->transform(function($item){
            $item->attachment = !empty($item->attachment) ? asset('assets/uploads/ticket/'.$item->attachment) : null;
            return $item;
        });
        $q = $request->q ?? '';
        return response()->success([
            'ticket_id'=>$id,
            'all_messages' =>$all_messages,
            'q' =>$q,
        ]);
    }
    
    public function sendMessage(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
            'file' => 'nullable|mimes:jpg,png,jpeg,gif',
        ]);

        $ticket_info = SupportTicketMessage::create([
            'support_ticket_id' => $request->ticket_id,
            'type' => $request->user_type,
            'message' => $request->message,
        ]);
        
        if ($request->hasFile('file')){
            
            $uploaded_file = $request->file;
            $file_extension = $uploaded_file->extension();
            $file_name =  pathinfo($uploaded_file->getClientOriginalName(),PATHINFO_FILENAME).time().'.'.$file_extension;
            $uploaded_file->move('assets/uploads/ticket',$file_name);
            $ticket_info->attachment = $file_name;
            $ticket_info->save();
        }

        return response()->success([
            'message'=>__('Message Send Success'),
            'ticket_id'=>$request->ticket_id,
            'user_type' =>$request->user_type,
            'ticket_info' => $ticket_info,
        ]);
    } 
    
     public function paymentRequestDetails($id)
    {
        if(empty($id)){
            return response()->error([
                'message'=> __('id field is required'),
            ]);  
        }
        
        $payout_details = PayoutRequest::where('id',$id)->first();     
        $payout_details->payment_receipt = get_attachment_image_by_id($payout_details->payment_receipt) ?? null;     
        $payout_details->status = $this->payoutStatusText($payout_details->status);
        
        
         return response()->success([
            'payout_details'=> $payout_details,
        ]);  
    }
    
    public function createPaymentRequest(Request $request)
    {
        $request->validate([
                'amount' => 'required',
                'seller_note' => 'required',
                'payment_gateway' => 'required|string|max:191',
             ],[
                 'amount.required' => __('Amount required'),
                 'amount.numeric' => __('Amount must be numeric'),
                 'payment_gateway.required' =>  __('Payment Gateway required'),
             ]);

            $seller_id = Auth::guard('sanctum')->user()->id;

            $complete_order_balance_with_tax = Order::where(['status'=>2,'seller_id'=>$seller_id])->sum('total');
            $complete_order_tax = Order::where(['status'=>2,'seller_id'=>$seller_id])->sum('tax');
            $complete_order_balance_without_tax = $complete_order_balance_with_tax - $complete_order_tax;
            $admin_commission_amount = Order::where(['status'=>2,'seller_id'=>$seller_id])->sum('commission_amount');
            $remaning_balance = $complete_order_balance_without_tax-$admin_commission_amount;
            $total_earnings = PayoutRequest::where('seller_id',$seller_id)->where('payment_type', 'Withdraw')->sum('amount');
            $total_penalties = PayoutRequest::where('seller_id',$seller_id)->where('payment_type', 'Penalty')->sum('amount');
            $available_balance = $remaning_balance - ($total_earnings + $total_penalties);
            if($request->amount<=0 || $request->amount >$available_balance){
                return response()->error(['message' => __('Enter a valid amount')]); 
            }  
             
            $min_amount = AmountSettings::select('min_amount')->first();
            $max_amount = AmountSettings::select('max_amount')->first();
            if($request->amount < $min_amount->min_amount){
                $msg = sprintf(__('Withdraw amount not less than %s'),float_amount_with_currency_symbol($min_amount->min_amount));
                return response()->error(['message' => $msg]); 
            } 
            if($request->amount > $max_amount->max_amount){
                $msg = sprintf(__('Withdraw amount must less or equal to %s'),float_amount_with_currency_symbol($max_amount->max_amount));
                return response()->error(['message' => $msg]); 
            }

            $payout_info = PayoutRequest::create([
                'seller_id' => Auth::guard('sanctum')->user()->id,
                'payment_type' => 'Withdraw',
                'amount' => $request->amount,
                'payment_gateway' => $request->payment_gateway,
                'seller_note' => $request->seller_note,
                'status' => 0,
            ]);

            $last_payout_request_id = DB::getPdo()->lastInsertId();
            try {
                $message_body = __('Hello,<br> admin new payout request is just created. Please check , thanks').'</br>'.'<span class="verify-code">'.__('Payout Request ID: ').$last_payout_request_id.'</span>';
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => __('New Payout Request'),
                    'message' => $message_body
                ]));
            } catch (\Exception $e) {
               
            }
       
        return response()->success([
            'message'=>__('Payout request success'),
            'payout_info'=>$payout_info
        ]);
    }
    
    
    public function profileVerify(Request $request){
        $user = Auth::guard('sanctum')->user()->id;
        
            $request->validate([
                'national_id' => 'required|mimes:jpg,jpeg,png|max:200000',
                'address' => 'nullable|mimes:jpg,jpeg,png|max:200000',
            ]);

            $old_image = SellerVerify::select('national_id','address')->where('seller_id',$user)->first();
          
            if($request->file('national_id')){
                MediaHelper::insert_media_image($request,'web','national_id');
                $national_image_id = DB::getPdo()->lastInsertId();
            }
            if($request->file('address')){
                MediaHelper::insert_media_image($request,'web','address');
                $address_image_id = DB::getPdo()->lastInsertId();
            }
            if(is_null($old_image)){
                SellerVerify::create([
                    'seller_id' => $user,
                    'national_id' => $national_image_id ?? optional($old_image)->national_id,
                    'address' => $address_image_id ?? optional($old_image)->address,
                ]);
            }else{
                SellerVerify::where('seller_id', $user)
                ->update([
                    'seller_id' => $user,
                    'national_id' => $national_image_id ?? optional($old_image)->national_id,
                    'address' => $address_image_id ?? optional($old_image)->address,
                ]);
            }

            try {
                $message_body = __('You have a new request for seller verification');
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => __('New Seller Verification Request'),
                    'message' => $message_body
                ]));
            } catch (\Exception $e) {
                //
            }
            
            return response()->success([
                'message'=>__('Verify Info Update Success---')
            ]);
    }
    
    public function profileInfo(){
        
        $user_id = auth('sanctum')->id();
        
        $user = User::with('country','city','area')->with('sellerVerify')
        ->select('id','name','email','phone','address','about','country_id','service_city','service_area','post_code','image','country_code')
        ->where('id',$user_id)->first();
        
        $profile_image =  get_attachment_image_by_id($user->image);

        return response()->success([
            'user_details' => $user,
            'profile_image' => $profile_image,
        ]);
    }

    public function profileDeactivate(Request $request){
        
        $request->validate([
                'reason' => 'required',
                'description' => 'required|max:20',
            ]);
            Accountdeactive::create([
                'user_id' => Auth::guard('sanctum')->user()->id,
                'reason' => $request['reason'],
                'description' => $request['description'],
                'status' => 0,
                'account_status' => 0,
            ]);
            
            Service::where('seller_id',Auth::guard('sanctum')->user()->id)->update(['status'=>0]);


        return response()->success([
            'message' => __('Your Account Successfully Deactive')
        ]);
    }
    
    public function profileEdit(Request $request)
    {
        $user = auth('sanctum')->user();
        $user_id = auth('sanctum')->user()->id;

        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|max:191|email|unique:users,email,'.$user_id,
            'phone' => 'required|max:191',
            'service_area' => 'required|max:191',
            'address' => 'required|max:191',
        ]);

        if($request->file('file')){
            MediaHelper::insert_media_image($request,'web');
            $last_image_id = DB::getPdo()->lastInsertId();
        }
        $old_image = User::select('image')->where('id',$user_id)->first();
        $user_update = User::where('id',$user_id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => $last_image_id ?? $old_image->image,
                'service_city' => $request->service_city ?? $user->service_city,
                'service_area' => $request->service_area ?? $user->service_area,
                'country_id' => $request->country_id ?? $user->country_id,
                'post_code' => $request->post_code,
                'country_code' => $request->country_code,
                'address' => $request->address,
                'about' => $request->about,
                'state' => $request->service_city,
            ]);

        if($user_update){
            return response()->success([
                'message' =>__('Profile Updated Success'),
            ]);
        }
    }
    
    public function paymentHistory($id=null)
    {
        $seller_id = auth('sanctum')->user()->id;
        $all_history = $all_payout_request = PayoutRequest::where('seller_id',$seller_id)->paginate(10);
        return response()->success([
            'payment_history' => $all_history
        ]);
    }
    
    private function orderStatusText($order_status_id)
    {
        $status_text = __('Pending');
        //0=pending, 1=active, 2=completed, 3=delivered, 4=cancelled
        
        switch($order_status_id){
            case(1):
                $status_text = __('Active');
                break;
            case(2):
                $status_text = __('Completed');
                break;
            case(3):
                $status_text = __('Delivered');
                break;
            case(4):
                $status_text = __('Cancelled');
                break;
            default: 
                break;
        }
        
        return $status_text;
    }
    
    private function payoutStatusText($order_status_id)
    {
        $status_text = __('Pending');
        //0=pending, 1=active, 2=completed, 3=delivered, 4=cancelled
        
        switch($order_status_id){
            case(1):
                $status_text = __('Completed');
                break;
            case(2):
                $status_text = __('Cancelled');
                break;
            default: 
                break;
        }
        
        return $status_text;
    }

    /* Extra Service Request */
    public function extraService(Request $request){
        $user_id = auth('sanctum')->user()->id;
        $request->validate([
            'order_id' => 'required|integer',
            'title' => 'required|max:191',
            'quantity' => 'required|integer|gte:0',
            'price' => 'required',
        ]);

        //todo: get order details from database
        $orderDetails = Order::where('seller_id',$user_id)->where('id',$request->order_id)->first();
        //todo: check order payment status paid or completed
        if ($orderDetails->payment_status === 'complete'){
            //todo: if order status is completed then save data in new database table , update order table total price and admin commission etc
            $commission_charge = $orderDetails->commission_charge;
            $commission_type = $orderDetails->commission_type;

            //todo: add new additional service in database
            $additional_service_cost =  $request->price * $request->quantity;
            //todo calculate admin commission
            $commission_amount = ServiceCalculationHelper::calculateCommission($commission_type,$commission_charge,$additional_service_cost,$orderDetails->seller_id);;
            //todo get sub total
            $sub_total = $additional_service_cost;
            //todo calculate tax
            $service_details_for_book = Service::select('id','service_city_id')->where('id',$orderDetails->service_id)->first();
            $service_country =  optional(optional($service_details_for_book->serviceCity)->countryy)->id;
            //todo: update tax amount
            $tax =  ServiceCalculationHelper::calculateTax($additional_service_cost,$service_country);

            $total = $additional_service_cost + $tax;

            //todo get total

            ExtraService::create([
                'order_id' => $orderDetails->id,
                'title' => $request->title,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'tax' => $tax,
                'commission_amount' => $commission_amount,
                'sub_total' => $sub_total,
                'total' => $total,
                'payment_status' => 'pending',
                'status' => 0
            ]);

            try {
                //send mail to seller
                $seller_details = User::select('name','email')->find($orderDetails->seller_id);
                $message = '<p>';
                $message .= __('Hello').' '.$seller_details->name.','."<br>";
                $message .= __('your have added extra service in your service request #').$orderDetails->id;
                $message .= '</p>';
                Mail::to($seller_details->email)->send(new BasicMail([
                    'subject' => __('Extra service added in your service request #').$orderDetails->id,
                    'message' => $message
                ]));

                $buyer_details = User::select('name','email')->find($orderDetails->buyer_id);
                //send mail to buyer
                $message = '<p>';
                $message .= __('Hello').' '.$buyer_details->name.','."<br>";
                $message .= __('service provider added extra service in your service request #').$orderDetails->id;
                $message .= '</p>';
                Mail::to($buyer_details->email)->send(new BasicMail([
                    'subject' => __('Extra service added in your service request #').$orderDetails->id,
                    'message' => $message
                ]));
            }catch (\Exception $e){
                //handle error
            }
            return response()->success([
                'extra_service' => $request->all(),
            ]);

        }else{
            $commission_charge = $orderDetails->commission_charge;
            $commission_type = $orderDetails->commission_type;

            //todo: add new additional service in database
            $additional_service_cost =  $request->price * $request->quantity;
            OrderAdditional::create([
                'order_id' => $orderDetails->id,
                'title' => $request->title,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ]);

            //todo: update extra_service [extra service price * quantity]
            $orderDetails->extra_service += $additional_service_cost;


            //todo: update commission
            $orderDetails->commission_amount += ServiceCalculationHelper::calculateCommission($commission_type,$commission_charge,$additional_service_cost,$orderDetails->seller_id); //$commission_amount;
            //todo: update sub_total []
            $orderDetails->sub_total += $additional_service_cost;
            $new_sub_total =  $orderDetails->sub_total  + $additional_service_cost;

            //todo: calculate tax []
            $total = 0;
            $tax_amount =0;

            $service_details_for_book = Service::select('id','service_city_id')->where('id',$orderDetails->service_id)->first();
            $service_country =  optional(optional($service_details_for_book?->serviceCity)->countryy)->id;

            //todo: update tax amount
            $orderDetails->tax +=  ServiceCalculationHelper::calculateTax($new_sub_total,$service_country);//$tax_amount;

            //todo: update total amount []
            $total = $additional_service_cost + $tax_amount;
            $orderDetails->total += $total;
            $orderDetails->save();

            //todo send mail to seller and buyer
            try {
                //send mail to seller
                $seller_details = User::select('name','email')->find($orderDetails->seller_id);
                $message = '<p>';
                $message .= __('Hello').' '.$seller_details->name.','."<br>";
                $message .= __('your have added extra service in your service request #').$orderDetails->id;
                $message .= '</p>';
                Mail::to($seller_details->email)->send(new BasicMail([
                    'subject' => __('Extra service added in your service request #').$orderDetails->id,
                    'message' => $message
                ]));

                $buyer_details = User::select('name','email')->find($orderDetails->buyer_id);
                //send mail to buyer
                $message = '<p>';
                $message .= __('Hello').' '.$buyer_details->name.','."<br>";
                $message .= __('service provider added extra service in your service request #').$orderDetails->id;
                $message .= '</p>';
                Mail::to($buyer_details->email)->send(new BasicMail([
                    'subject' => __('Extra service added in your service request #').$orderDetails->id,
                    'message' => $message
                ]));
            }catch (\Exception $e){
                //handle error
            }

            return response()->success([
                'extra_service' => $request->all(),
            ]);
        }

        //todo: else add it in order_additional table and update order table total price and admin commission etc

        return response()->error([
            'message' => __('something went wrong, try after sometime'),
        ]);
    }


    public function orderDecline(Request $request)
    {
        $find_order_id = Order::where('id',$request->order_id)->update([
            'status' => 5
        ]);

        try {
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => __('aA service request declined by the service provider service request ID').' '.$request->order_id,
                'message' => sprintf(__('an service request decliined by service provider ID: %1$s, a reported created for refund customer money for service request ID: $2$s'),$request->report_id,$request->order_id),
            ]));
        } catch (\Exception $e) {
            //handle exception
        }

        return response()->success([
            'msg'=> __('service request decline success'),
        ],200);

    }

    /* Extra Service Delete */
    public function extraServiceDelete(Request $request){
        $request->validate([
            'id' => 'required|integer'
        ]);
        ExtraService::find($request->id)->delete();
        return response()->success([
            'message' => 'Delete Success',
        ]);
    }

    /* Extra Service list */
    public function extraServiceList($id)
    {
        $extra_service_list = ExtraService::where('order_id',$id)->get(['id','order_id','title','quantity','price','tax','sub_total','total']);
        return response()->success([
            'extra_service_list' => $extra_service_list,
        ]);
    }
    
    //order request complete
     public function orderStatus(Request $request)
    {
        if($request->status == '' || $request->order_id == ''){
            return response()->error([
                'msg' => __('Please select both status and service request id first.'),
            ]);
        }
        $payment_status = Order::select('id','payment_status','status','email','name')->where('id',$request->order_id)->first();
        $cancel_order_money_return = Order::select('id','cancel_order_money_return')->where('id',$request->order_id)->first();
        if($cancel_order_money_return->cancel_order_money_return === 1){
            return response()->error([
                'msg' => __('You can not change status because earlier you canceled the service request'),
            ]);
        }
        if($payment_status->status !=2){
            if($payment_status->payment_status =='complete'){
                $order_details = Order::select(['id','seller_id','buyer_id','service_id'])->where('id',$request->order_id)->first();
                if($request->status==2){
                    Order::where('id',$request->order_id)->update(['order_complete_request'=>1]);
                    if($request->file('file')){
                        MediaHelper::insert_media_image($request,'web');
                        $last_image_id = DB::getPdo()->lastInsertId();
                    }
                    OrderCompleteDecline::create([
                        'order_id'=>$order_details->id,
                        'buyer_id'=>$order_details->buyer_id,
                        'seller_id'=>$order_details->seller_id,
                        'service_id'=>$order_details->service_id,
                        'decline_reason'=>__('Not decline or complete yet. Please wait'),
                        'image' => $last_image_id ?? '',
                    ]);
                    //Send email after change status
                    try {
                        $message_body_buyer =__('Hello, ').$payment_status->name. __('A new request is created for complete an service request.').'</br>' . ' <span class="verify-code">'.__('service request ID is: ') . $payment_status->id. '</span>';
                        $message_body_admin =__('Hello Admin A new request is created for complete an service request.').'</br>' . ' <span class="verify-code">'.__('service request ID is:') . $payment_status->id. '</span>';
                        Mail::to($payment_status->email)->send(new BasicMail([
                            'subject' => __('New Request For Complete an Service Request'),
                            'message' => $message_body_buyer
                        ]));
                        Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                            'subject' => __('New Request For Complete an Service Request'),
                            'message' => $message_body_admin
                        ]));
                    } catch (\Exception $e) {
                       //
                    }
                    return response()->success([
                        'msg' => __('Your request submitted. Customer will complete your request after review.'),
                    ]);
                }
//                Order::where('id',$request->order_id)->update(['status'=>$request->status]);
            }else{
                return response()->error([
                    'msg' => __('You can not change service request status due to payment status pending.'),
                ]);
            }
        }else{
            return response()->error([
                'msg' => __('You can not change service request status because this service request already completed.'),
            ]);
        }
    }
    
    //order request complete decline history
    
    public function orderCompleteRequestDeclineHistory(Request $request)
    {
        $find_order_id = OrderCompleteDecline::where('order_id',$request->order_id)->first();
        if(!empty($find_order_id)){
            $decline_histories = OrderCompleteDecline::latest()->where('order_id',$request->order_id)->get();
            $buyer_details = User::select(['name','email','phone'])->where('id',$find_order_id->buyer_id)->get();
            foreach($decline_histories as $history){
                $history_image[] = get_attachment_image_by_id($history->image);
            }
            return response()->success([
                'decline_histories'=> $decline_histories,
                'buyer_details'=> $buyer_details,
                'history_image'=> $history_image,
            ]);
        }else{
            return response()->error([
                'msg'=>__('Service Request id does not exists.'),
            ]);
        }
    }


    public function codPaymentStatusChange(Request $request)
    {
        $orderInfo = Order::where('id',$request->id)->first();
        if(is_null($orderInfo)){
            return response(['msg' => __("service request not found")],422);
        }
        if($orderInfo->payment_gateway === "cash_on_delivery"){
            $orderInfo->payment_status = "complete";
            $orderInfo->save();

            $user_info = auth('sanctum')->user();
          
            return response(['msg' => __("payment status update success")]);
        }
        return response(['msg' => __("something went wrong, try after sometime")],500);
    }
    
    public function OrderStatusChange(Request $request)
    {
        $orderInfo = Order::where('id',$request->id)->first();
        if(is_null($orderInfo)){
            return response(['msg' => __("service request not found")],422);
        }
        $orderInfo->status = 4;
        $orderInfo->save();
        $user_info = auth('sanctum')->user();
            $user_type =  $user_info->user_type ===  1 ? 'seller_' : '';
            
        return response(['msg' => __("service request status changed to cancel")],500);
    }
    
    public function availableDaysList(){
        return response()->json([
            "Sat","Sun","Mon","Tue","Wed","Thu","Fri"
        ]);
    }

    public function scheduleList(){
        $schedules = Schedule::with('days')->where('seller_id',Auth::guard('sanctum')->user()->id)->paginate(10)->withQueryString();
        $days = Day::where('seller_id',Auth::guard('sanctum')->user()->id)->get();
        //todo: insert days programmatically if no days available
        $days_lists = $days->pluck('day')->toArray();
        $days_need_to_add = ['Sat','Sun','Mon','Tue','Wed','Thu','Fri'];
        if(!empty($days_lists)){
            foreach($days_need_to_add as $dlit){
                if (!in_array($dlit,$days_lists)){
                    Day::create([
                        'day' => $dlit,
                        'status' => 0,
                        'seller_id' => Auth::guard('sanctum')->user()->id,
                        'total_day' => 7,
                    ]);
                }
            }
        }

        $days = Day::with('schedules')->where('seller_id',Auth::guard('sanctum')->user()->id)->get();
        return response()->json(["schedule" => $schedules, "days" => $days]);
    }

    public function scheduleDaysList(){
        $days = Day::with('schedules')->where('seller_id',Auth::guard('sanctum')->user()->id)->get();
        return response()->json($days);
    }

    public function createDay(Request $request){

        $validator = Validator::make($request->all(), [
            'day' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ],422);
        }

        $day = Day::select('day','seller_id')
            ->where('seller_id',Auth::guard('sanctum')->user()->id)
            ->where('day',$request->day)
            ->first();
        if(!empty($day)){
            return  response()->json(["message" => __('Day Already Exists---')],422);
        }

        Day::create([
            'day' => $request->day,
            'status' => 0,
            'seller_id' => Auth::guard('sanctum')->user()->id,
            'total_day' => 7,
        ]);


        return response()->json([
            "message" => __('Day Added Success---')
        ]);
    }
    public function deleteDay(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ],422);
        }

        Day::where('seller_id',Auth::guard('sanctum')->user()->id)
            ->where('id',$request->id)
            ->delete();

        return response()->json([
            "message" => __('Day Delete Success---')
        ]);
    }

    public function scheduleDelete(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ],422);
        }

        Schedule::find($request->id)->delete();

        return response()->json([
            "message" => __('Day Delete Success---')
        ]);
    }

    public function scheduleCreate(Request $request){
        $rule = $request->has('schedule_for_all_days') ? 'nullable' : 'required';
        $validator = Validator::make($request->all(), [
            'day_id' => $rule.'|integer',
            'schedule' => 'required',

        ]);
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ],422);
        }

        if($request->has('schedule_for_all_days')){
            $days = Day::where('seller_id',Auth::guard('sanctum')->user()->id)->get();
            foreach($days as $day){
                Schedule::create([
                    'day_id' => $day->id,
                    'seller_id' => Auth::guard('sanctum')->user()->id,
                    'schedule' => $request->schedule,
                    'status' => 0,
                    'allow_multiple_schedule' => 'no',
                ]);
            }

            return response()->json(["message" => __('Schedule Added Success---')]);
        }
        Schedule::create([
            'day_id' => $request->day_id,
            'seller_id' => Auth::guard('sanctum')->user()->id,
            'schedule' => $request->schedule,
            'status' => 0,
            'allow_multiple_schedule' => 'no',
        ]);
        return response()->json(["message" => __('Schedule Added Success---')]);

    }
    public function scheduleUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'day_id' => 'required',
            'schedule' => 'required',

        ]);
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ],422);
        }

        Schedule::where('id',$request->up_id)->update([
            'day_id' => $request->day_id,
            'seller_id' => Auth::guard('sanctum')->user()->id,
            'schedule' => $request->schedule,
        ]);
        return response()->json(["message" => __('Schedule Update Success---')]);
    }


    public function servicesListBySellerID(Request $request){

        $validator = Validator::make($request->all(), [
            'seller_id' => 'required',

        ]);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ],422);
        }

        $services = Service::query()
            ->where("seller_id",$request->seller_id)
            ->select('id','title','image','price','seller_id')
            ->with('reviews_for_mobile')
            ->where('status','1')
            ->where('is_service_on','1')
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->orderBy('id','Desc')
            ->paginate(20)
            ->through(function($item){
                $image_url =  get_attachment_image_by_id($item->image) ? get_attachment_image_by_id($item->image)['img_url'] : null;
                $item->image_url = !is_null($image_url) ? $image_url : null;// 

                $seller_details = User::find($item->seller_id);
                $item->seller_name = !is_null($seller_details) ? $seller_details->name : 'Unknown';// $item->buyer_id;
                $image_url =  get_attachment_image_by_id(optional($seller_details)->image) ? get_attachment_image_by_id($seller_details->image)['img_url'] : null;
                $item->seller_image = !is_null($seller_details) ? $image_url : null;// $item->buyer_id;
                return $item;

                return $item;
            })
            ->withQueryString();

        return response()->json(["services" => $services ]);
    }
    
    public function serviceProviderRequests(Request $request) {
        $serviceProviderId = $request->serviceproviderId;
        $token = $request->token;
        $finalToken = TokenGenrateHelper::genrateToken($serviceProviderId);
        if($token !== $finalToken){
            abort(401);
        }

        \Log::debug("Token Matched");
        if(!empty($request->order_id || $request->order_date|| $request->payment_status || $request->order_status || $request->total || $request->seller_name || $request->service_title)){
            $orders_query = Order::with('online_order_ticket')->where('seller_id', $serviceProviderId)->where('job_post_id', NULL);
            // search by order ID
            if (!empty($request->order_id)){
                $orders_query->where('id', $request->order_id);
            }
            // search by order create date
            if (!empty($request->order_date)){
                $start_date = \Str::of($request->order_date)->before('to');
                $end_date = \Str::of($request->order_date)->after('to');
                $orders_query->whereBetween('created_at', [$start_date,$end_date]);
            }
            // search by payment status
            if (!empty($request->payment_status)){
                $orders_query->where('payment_status', $request->payment_status);
            }
            // search by order status
            if (!empty($request->order_status)){
                if ($request->order_status == 'pending'){
                    $orders_query->where('status', 0);
                }else{
                    $orders_query->where('status', $request->order_status);
                }
            }
            // search by order amount
            if (!empty($request->total)){
                $orders_query->where('payment_status', $request->total);
            }
            // search by service title
            if (!empty($request->service_title)){
                $service_id = Service::select('id', 'title')->where('title',  'LIKE', "%{$request->service_title}%")->pluck('id')->toArray();
                $orders_query->whereIn('service_id', $service_id);
            }
            // search by buyer name
            if (!empty($request->buyer_name)){
                $buyer_id = User::select('id', 'name')->where('name',  'LIKE', "%{$request->buyer_name}%")->pluck('id')->toArray();
                $orders_query->whereIn('buyer_id', $buyer_id);
            }
            $all_orders = $orders_query->latest()->paginate(10);
        } else {
            $all_orders = Order::with('online_order_ticket')->where('seller_id',  $serviceProviderId)->where('job_post_id', NULL)->latest()->paginate(10);
        }

        $orders = Order::where('seller_id',  $serviceProviderId)->where('job_post_id', NULL)->get();
        $pending_orders = Order::where('seller_id',  $serviceProviderId)->where('job_post_id', NULL)->where('status',0);
        $active_orders = Order::where('seller_id',  $serviceProviderId)->where('job_post_id', NULL)->where('status',1);
        $complete_orders = Order::where('seller_id',  $serviceProviderId)->where('job_post_id', NULL)->where('status',2);
        $deliver_orders = Order::where('seller_id',  $serviceProviderId)->where('job_post_id', NULL)->where('status',3);
        $cancel_orders = Order::where('seller_id',  $serviceProviderId)->where('job_post_id', NULL)->where('status',4);
        $incompetent_orders = Order::where('seller_id',  $serviceProviderId)->where('job_post_id', NULL)->where('status',5);
        $isHideSideBarAndHeader = false;
        $penalties = Penalty::all();
        return view('frontend.user.seller.order.orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders', 'incompetent_orders', 'all_orders', 'pending_orders', 'isHideSideBarAndHeader', 'serviceProviderId', 'token', 'penalties'));
    }
}