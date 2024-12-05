<?php

namespace App\Http\Controllers\Frontend;

use App\AdminNotification;
use App\ChildCategory;
use App\Helpers\ModuleMetaData;
use App\Http\Controllers\Controller;
use App\OnlineServiceFaq;
use App\SupportTicket;
use App\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Serviceinclude;
use App\Serviceadditional;
use App\Servicebenifit;
use App\Service;
use App\Country;
use App\Day;
use App\Order;
use App\OrderAdditional;
use App\Category;
use App\Helpers\FlashMsg;
use App\Subcategory;
use App\OrderInclude;
use App\Schedule;
use App\ServiceCity;
use App\ServiceArea;
use App\Serviceaddresses;
use DB;
use Auth;
use App\Mail\OrderMail;
use App\Review;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderNotification;
use App\ServiceCoupon;
use App\AdminCommission;
use Modules\AzulPaymentGateway\Http\Helpers\AzulPaymentHelper;
use Modules\Wallet\Entities\Wallet;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;
use Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\BasicMail;
use App\Doc8yAPI;


class ServiceListController extends Controller
{

    private const CANCEL_ROUTE = 'frontend.order.payment.cancel.static';
    private const SUCCESS_ROUTE = 'frontend.order.payment.success';

    protected function cancel_page(){
    	if(!empty(session()->get('order_id'))){
           Order::find(session()->get('order_id'))->update(['status' => 4]);
        }
        return redirect()->route('frontend.order.payment.cancel.static');
    }
    public function order_payment_cancel_static()
    {
    	if(!empty(session()->get('order_id'))){
           Order::find(session()->get('order_id'))->update(['status' => 4]);
        }
        return view('frontend.payment.payment-cancel-static');
    }
    public function order_payment_success($id)
    {
        $order_details = Order::find(substr($id,30,-30));
        return view('frontend.payment.payment-success')->with(['order_details' => $order_details]);
    }


    public function serviceDetails($slug)
    {
        $service_details = Service::with('seller')->where('slug', $slug)->firstOrFail();
        $service_includes = ServiceInclude::where('service_id', $service_details->id)->get();
        $service_additionals = ServiceAdditional::where('service_id', $service_details->id)->get();
        $service_benifits = Servicebenifit::where('service_id', $service_details->id)->get();

        $another_service = Service::with('reviews')->where(['seller_id' => $service_details->seller_id, 'status' => 1, 'is_service_on' => 1])->inRandomOrder()->take(2)->get()->except($service_details->id);

        //if buyer buy a service only add review on that particular service
        if (Auth::guard('web')->check()) {
            $buyer_order_services = Order::select('service_id', 'buyer_id')->where('buyer_id', Auth::guard('web')->user()->id)->get();
        } else {
            $buyer_order_services = '';
        }

        $service_reviews = Review::where('service_id', $service_details->id)->where('service_id', $service_details->id)->where('type', 1)->get();

        $completed_order = Order::where('seller_id', $service_details->seller_id)->where('status', 2)->count();
        $cancelled_order = Order::where('seller_id', $service_details->seller_id)->where('status', 4)->count();
        $seller_since = User::select('created_at')->where('id', $service_details->seller_id)->where('user_status', 1)->first();

        $order_completion_rate = 0;
        if ($completed_order > 0 || $cancelled_order > 0) {
            $order_completion_rate = $completed_order / ($completed_order + $cancelled_order) * 100;
        }

        $seller_rating = Review::where('seller_id', $service_details->seller_id)->where('service_id', $service_details->id)->where('type', 1)->avg('rating');
        $seller_rating_percentage_value = $seller_rating * 20;

        $service_rating = Review::where('service_id', $service_details->id)->where('service_id', $service_details->id)->where('type', 1)->avg('rating');

        $service_view = Service::select('view')->where('id', $service_details->id)->first();
        $view_count = $service_view->view + 1;
        Service::where('id', $service_details->id)->update([
            'view' => $view_count,
        ]);

        $images = Service::select('image_gallery')->where('id', $service_details->id)->first();

        return view(
            'frontend.pages.services.service-details',
            compact(
                'service_details',
                'service_includes',
                'service_additionals',
                'service_benifits',
                'another_service',
                'buyer_order_services',
                'service_reviews',
                'completed_order',
                'seller_since',
                'order_completion_rate',
                'service_rating',
                'seller_rating_percentage_value',
                'images'
            )
        );
    }

    public function serviceBook($slug)
    {
        $service_details_for_book = Service::where(['slug' => $slug, 'status' => 1, 'is_service_on' => 1])->firstOrFail();
        $days_count = Day::select('total_day')->where('seller_id',$service_details_for_book->seller_id)->first();
        $days_count = optional($days_count)->total_day;

        $service_city_id = $service_details_for_book->service_city_id;
        $service_country_id = ServiceCity::select('country_id')->where('id',$service_city_id)->first();

        $country = null;
        if(!is_null($service_country_id)){
            $country = Country::select('id','country')->where('id',$service_country_id->country_id)->where('status', 1)->first();
        }

        $city = ServiceCity::select('id','service_city')->where('id',$service_city_id)->where('status', 1)->first();
        $areas = ServiceArea::select('id','service_area')->where('service_city_id',$service_city_id)->where('status', 1)->get();

        $service_includes = ServiceInclude::where('service_id', $service_details_for_book->id)->get();
        $service_additionals = ServiceAdditional::where('service_id', $service_details_for_book->id)->get();
        $service_benifits = Servicebenifit::where('service_id', $service_details_for_book->id)->get();
        $service_faqs = OnlineServiceFaq::select('title','description')->where('service_id', $service_details_for_book->id)->get();

        return view('frontend.pages.services.service-book', compact(
            'country',
            'city',
            'areas',
            'service_details_for_book',
            'service_includes',
            'service_additionals',
            'service_benifits',
            'service_faqs',
            'days_count'
        ));
    }

    //get area by city
    public function serviceBookGetCity(Request $request)
    {
        $cities = ServiceCity::where('country_id', $request->country_id)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'cities' => $cities,
        ]);
    }

    //get area by city
    public function serviceBookGetArea(Request $request)
    {
        $areas = ServiceArea::where('service_city_id', $request->city_id)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'areas' => $areas,
        ]);
    }

    //get schedule by seller
    public function scheduleByDay(Request $request)
    {
        if ($request->ajax()) {
            //todo
            $date_string = Carbon::parse($request->date_string)->format('D');
            $day = Day::select('id', 'day')
                ->where('day', $date_string)
                ->where('seller_id', $request->seller_id)
                ->first();

            if (!is_null($day)) {
                $schedules = [];
                $same_schedule_allow_or_not = Schedule::select('seller_id','allow_multiple_schedule')->where('seller_id', $request->seller_id)->first();

                if($same_schedule_allow_or_not->allow_multiple_schedule == 'no'){
                    // get schedules
                    $date_string_year_month_day = Carbon::parse($request->date_string)->format('D F d Y');
                    $order_date = Order::select('id','date','seller_id')
                        ->where('seller_id',$request->seller_id)
                        ->where('date',$date_string_year_month_day)
                        ->first();

                    if($order_date){
                        $schedules = Order::select('schedule')
                            ->where('date',$order_date->date)
                            ->get()->pluck("schedule")->toArray();

                        $schedules = Schedule::select('schedule')
                            ->where('seller_id', $request->seller_id)
                            ->whereNotIn("schedule", $schedules)
                            ->where('day_id', $day->id)
                            ->get();
                    }else{
                        $schedules = Schedule::select('schedule')
                            ->where('seller_id', $request->seller_id)
                            ->where('day_id', $day->id)
                            ->get();
                    }
                }else{
                    $schedules = Schedule::select('schedule')
                        ->where('seller_id', $request->seller_id)
                        ->where('day_id', $day->id)
                        ->get();
                }

                if(optional($schedules)->count() >= 1){
                    return response()->json([
                        'status' => 'success',
                        'schedules' => $schedules,
                        'day' => $day,
                    ]);
                }
                return response()->json([
                    'status' => 'no schedule',
                ]);
            }
            return response()->json([
                'status' => 'no schedule',
            ]);
        }
    }

    public function couponApply(Request $request)
    {
        if(empty($request->coupon_code)){
            return response()->json([
                'status' => 'emptycoupon',
                'msg' => __('Please Enter Your Coupon Code'),
            ]);
        }


        $coupon_code = ServiceCoupon::where('code',$request->coupon_code)->first();
        $current_date = date('Y-m-d');


        if(!empty($coupon_code)){

            if($coupon_code->seller_id != $request->seller_id){
                return response()->json([
                    'status' => 'notapplicable',
                    'msg' => __('Coupon is not Applicable for this Service'),
                ]);
            }

            if($coupon_code->code == $request->coupon_code && $coupon_code->expire_date > $current_date){

                if($coupon_code->discount_type == 'percentage'){
                    $coupon_amount = ($request->total_amount * $coupon_code->discount)/100;
                    return response()->json([
                        'status' => 'success',
                        'coupon_amount' => $coupon_amount,
                    ]);
                }else{
                    $coupon_amount = $coupon_code->discount;
                    return response()->json([
                        'status' => 'success',
                        'coupon_amount' => $coupon_amount,
                    ]);
                }
            }

            if($coupon_code->expire_date < $current_date ){
                return response()->json([
                    'status' => 'expired',
                    'msg' => __('Coupon is Expired'),
                ]);
            }

        }else{
            return response()->json([
                'status' => 'invalid',
                'msg' => __('Coupon is Invalid'),
            ]);
        }

    }

    public function createServiceOrder(Request $request) {
        header('Content-type: application/json');
        $todayDate = date('d-m-Y');
        $customerId = '';
        $commission = AdminCommission::first();
        \Log::debug('User name : ' . $request->name . 
                    "\nSeller id : " . $request->seller_id . 
                    "\nSelected Payment Getway: " . $request->selected_payment_gateway .
                    "\nService Request : " . $request->service_id);
        if (empty($request->name) || empty($request->seller_id) || empty($request->selected_payment_gateway) || empty($request->service_id)){
            $status = [
                "status" => "error",
                "title" => "API Failed",
                "message" => "Please check some inputs are empty"
            ];
            \Log::debug("Result : " . print_r($status,true));
            exit(json_encode($status));
        }
        if($request->selected_payment_gateway=='cash_on_delivery' || $request->selected_payment_gateway == 'manual_payment' || $request->selected_payment_gateway === 'annual_maintenance_charge'){
            $payment_status='complete';
        }else{
            $payment_status='';
        }

        if (empty($request->seller_id)){
            \Toastr::error(__('Service Provider Id missing, please try another another service provider services'));
            $status = [
                "status" => "error",
                "title" => "API Failed",
                "message" => "Please Provide Service Provider Id"
            ];
            \Log::debug("Result : " . print_r($status,true));
            exit(json_encode($status));
        }
        if ($request->seller_id == Auth::guard('web')->id()){
            \Toastr::error(__('You can not book your own service'));
            $status = [
                "status" => "error",
                "title" => "API Failed",
                "message" => "You can not book your own service"
            ];
            \Log::debug("Result : " . print_r($status,true));
            exit(json_encode($status));
        }

        if (Auth::guard('web')->id() === NULL){
            $userData = User::where('email', $request->email)->first();
            if ($userData != null){
                    $customerId = $userData->id;
            } else {
                $email_verify_tokn = Str::random(8);
                $passowrd = $request->name."@".rand(0000, 9999);
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->name,
                    'phone' => $request->phone,
                    'password' => Hash::make($passowrd),
                    'service_city' => $request->choose_service_city,
                    'service_area' => $request->choose_service_area,
                    'country_id' => $request->choose_service_country,
                    'user_type' => 1,
                    'terms_conditions' => 1,
                    'email_verify_token'=> $email_verify_tokn,
                ]);
                if($user){
                    try {
                        $message = get_static_option('customer_register_message');
                        $subject = get_static_option('customer_register_message_subject');
                        $message = str_replace(["@name", "@type", "@username", "@password"],[$user->name, "customer", $user->name, $passowrd],$message);
                        Mail::to($user->email)->send(new BasicMail([
                            'subject' => get_static_option('customer_register_message_subject'),
                            'message' => $message
                        ]));

                        $message = get_static_option('user_email_verify_message');
                        $message = str_replace(["@name", "@email_verify_tokn"],[$user->name, $email_verify_tokn],$message);
                        Mail::to($user->email)->send(new BasicMail([
                            'subject' => get_static_option('user_email_verify_subject'),
                            'message' => $message
                        ]));
    
                        $message = get_static_option('user_register_message');
                        $message = str_replace(["@name", "@type","@username","@email"],[$user->name, "customer", $user->name, $user->email], $message);
                        Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                            'subject' => get_static_option('user_register_subject') ?? __('New User Registration'),
                            'message' => $message
                        ]));
                    } catch (\Exception $e) {
    
                    }
                }
                $customerId = $user->id;

                // User Register inside Doc8
                \Log::debug("User registration start inside Doc8");
                $nameParts = explode(' ', $request->name);
                $firstName = $nameParts[0];
                $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

                $cityData = ServiceCity::where("id", $request->choose_service_city)->first();
                if ($cityData != null){
                    $serviceCityName = $cityData->service_city;
                } else {
                    $serviceCityName = "NA";
                }

                $countryData = Country::where("id", $request->choose_service_country)->first();
                if ($countryData != null){
                    $countryName = $countryData->country;
                } else {
                    $countryName = "NA";
                }

                $userDataToSubmit = [
                    "email" => $request->email,
                    'firstname' => $firstName,
                    'lastname' => $lastName ?? "",
                    'useremail' => 'vandana@gmail.com',
                    'phonenumber' => $request->phone,
                    'address' => $request->address,
                    'city' => $serviceCityName,
                    'postalcode' => $request->post_code,
                    'state' => "NA",
                    'country' => $countryName,
                    'pannumber' => 'NA',
                    'aadhaarnumber' => 'NA',
                    'signingparty' => 'SA',
                    'company' => 'NA',
                    'companygstin' => '',
                    'companybusinesspannumber' => '',
                    'companyudyamnumber' => '',
                    'companyyoe' => '',
                    'companyaddress' => '',
                    'companycityname' => '',
                    'companypostalcode' => '',
                    'companystatename' => '',
                    'companycountryname' => '',
                    'producttype' => 'Service Form',
                    'iswhatsappmessagesend' => 'false',
                ];

                $resultOfUserRegister = Doc8yAPI::userRegister($userDataToSubmit);
                $decodedData = json_decode($resultOfUserRegister,true);
                \Log::debug("Result of User Register : " . print_r($decodedData,true));
            }
        }

        if (Auth::guard('web')->check() && Auth::guard('web')->user()->type === 0){
            \Toastr::error(__('service provider are not allowed to place service order'));
            $status = [
                "status" => "error",
                "title" => "API Failed",
                "message" => "service provider are not allowed to place service order"
            ];
            \Log::debug("Result : " . print_r($status,true));
            exit(json_encode($status));
        }

        if($request->selected_payment_gateway === 'manual_payment') {
            $this->validate($request,[
                'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);
        }

        $order_create='';
        if($request->is_service_online_ != 1 && Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1){
            Order::create([
                'service_id' => $request->service_id,
                'seller_id' => $request->seller_id,
                'buyer_id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : $customerId,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code ?? 0000,
                'address' => $request->address,
                'city' => $request->choose_service_city,
                'area' => $request->choose_service_area,
                'country' => $request->choose_service_country,
                'date' => \Carbon\Carbon::parse($request->date)->format('D F d Y'),
                'schedule' => $request->schedule,
                'package_fee' => 0,
                'extra_service' => 0,
                'sub_total' => 0,
                'tax' => 0,
                'total' => 0,
                'commission_type' => $commission->commission_charge_type,
                'commission_charge' => $commission->commission_charge,
                'status' => 0,
                'order_note' => $request->order_note,
                'payment_gateway' => $request->selected_payment_gateway,
                'payment_status' => $payment_status,
                'file_id' => 0,
                'service_provider_file_link' => '',
                'customer_file_link' => '',
                'admin_file_link' => '',       
                'service_provider_signing_status' => 'Pending', 
                'customer_signing_status' => 'Pending',         
                'admin_signing_status' => 'Pending', 
            ]);
        }else{
            if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1 ){
                $order_create = Order::create([
                    'service_id' => $request->service_id,
                    'seller_id' => $request->seller_id,
                    'buyer_id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : $customerId,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'post_code' => $request->post_code ?? 0000,
                    'address' => $request->address,
                    'city' => $request->choose_service_city,
                    'area' => $request->choose_service_area,
                    'country' => $request->choose_service_country,
                    'date' => '00.00.00',
                    'schedule' => '00.00.00',
                    'package_fee' => 0,
                    'extra_service' => 0,
                    'sub_total' => 0,
                    'tax' => 0,
                    'total' => 0,
                    'commission_type' => $commission->commission_charge_type,
                    'commission_charge' => $commission->commission_charge,
                    'status' => 0,
                    'is_order_online'=>$request->is_service_online_,
                    'order_note' => $request->order_note,
                    'payment_gateway' => $request->selected_payment_gateway,
                    'payment_status' => $payment_status,
                    'file_id' => 0,
                    'service_provider_file_link' => '',
                    'customer_file_link' => '',
                    'admin_file_link' => '',       
                    'service_provider_signing_status' => 'Pending', 
                    'customer_signing_status' => 'Pending',         
                    'admin_signing_status' => 'Pending',
                ]);
            }else{
               if( get_static_option('order_create_settings') !== 'anyone'){
                    toastr_error(__('You must login as a buyer to create an order.'));
                    return redirect()->back();
                }
                Order::create([
                    'service_id' => $request->service_id,
                    'seller_id' => $request->seller_id,
                    'buyer_id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : $customerId,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'post_code' => $request->post_code ?? 0000,
                    'address' => $request->address,
                    'city' => $request->choose_service_city,
                    'area' => $request->choose_service_area,
                    'country' => $request->choose_service_country,
                    'date' => $request->is_service_online_ != 1 ? \Carbon\Carbon::parse($request->date)->format('D F d Y') : '00.00.00',
                    'schedule' => $request->is_service_online_ != 1 ? $request->schedule : '00.00.00',
                    'package_fee' => 0,
                    'extra_service' => 0,
                    'sub_total' => 0,
                    'tax' => 0,
                    'total' => 0,
                    'commission_type' => $commission->commission_charge_type,
                    'commission_charge' => $commission->commission_charge,
                    'status' => 0,
                    'order_note' => $request->order_note,
                    'payment_gateway' => $request->selected_payment_gateway,
                    'payment_status' => $payment_status,
                    'file_id' => 0,
                    'service_provider_file_link' => '',
                    'customer_file_link' => '',
                    'admin_file_link' => '',       
                    'service_provider_signing_status' => 'Pending', 
                    'customer_signing_status' => 'Pending',         
                    'admin_signing_status' => 'Pending', 
                ]);

            }
        }

        $last_order_id = DB::getPdo()->lastInsertId();

        if($order_create !=''){
            SupportTicket::create([
                'title' => 'New Order',
                'subject' => 'Service Request Created By '.$request->name,
                'status' => 'open',
                'priority' => 'high',
                'buyer_id' => Auth::guard('web')->user()->id,
                'seller_id' => $request->seller_id,
                'service_id' => $request->service_id,
                'order_id' => $last_order_id ,
            ]);
        }

        $service_sold_count = Service::select('sold_count')->where('id',$request->service_id)->first();
        Service::where('id',$request->service_id)->update(['sold_count'=>$service_sold_count->sold_count+1]);

        $servs = [];
        $service_ids = [];
        $package_fee = 0;

        if (isset($request->services) && is_array($request->services)) {

            foreach ($request->services as $key => $service) {
                $service_ids[] = $service['id'];
            }

            $included_services = Serviceinclude::whereIn('id', $service_ids)->get();

            if($request->is_service_online_ != 1) {
                foreach ($request->services as $key => $requested_service) {
                    $service = $included_services->find($requested_service['id']);
                    $servs[] = [
                        'id' => $service->id,
                        'title' => $service->include_service_title,
                        'unit_price' => $service->include_service_price,
                        'quantity' => $requested_service['quantity'],
                    ];

                    $package_fee += $requested_service['quantity'] * $service->include_service_price;

                    OrderInclude::create([
                        'order_id' => $last_order_id,
                        'title' => $service->include_service_title,
                        'price' => $service->include_service_price,
                        'quantity' => $requested_service['quantity'],
                    ]);
                }
            }else{
                foreach ($request->services as $key => $requested_service) {
                    $service = $included_services->find($requested_service['id']);
                    $servs[] = [
                        'id' => $service->id,
                        'title' => $service->include_service_title,
                        'unit_price' => $service->include_service_price,
                        'quantity' => $requested_service['quantity'],
                    ];
                    OrderInclude::create([
                        'order_id' => $last_order_id,
                        'title' => $service->include_service_title,
                        'price' => 0,
                        'quantity' => 0,
                    ]);
                }

                $package_fee = $request->online_service_package_fee;
            }
        }


        $addis = [];
        $additional_ids = [];
        $extra_service = 0;

        if($request->additionals['0'] != NULL){
            if (isset($request->additionals) && is_array($request->additionals)) {
                foreach ($request->additionals as $key => $additional) {
                    $additional_ids[] = $additional['id'];
                }

                $additional_services = Serviceadditional::whereIn('id', $additional_ids)->get();

                foreach ($request->additionals as $key => $requested_additional) {
                    $service = $additional_services->find($requested_additional['id']);
                    $addis[] = [
                        'id' => $service->id,
                        'title' => $service->additional_service_title,
                        'unit_price' => $service->additional_service_price,
                        'quantity' => $requested_additional['quantity'],
                    ];

                    $extra_service += $requested_additional['quantity'] * $service->additional_service_price;

                    OrderAdditional::create([
                        'order_id' => $last_order_id,
                        'title' => $service->additional_service_title,
                        'price' => $service->additional_service_price,
                        'quantity' => $requested_additional['quantity'],
                    ]);
                }
            }
        }


        $sub_total = 0;
        $total = 0;
        $tax_amount =0;

        $tax = Service::select('tax')->where('id', $request->service_id)->first();
        $service_details_for_book = Service::select('id','service_city_id')->where('id',$request->service_id)->first();
        $service_country =  optional(optional($service_details_for_book->serviceCity)->countryy)->id;
        $country_tax =  Tax::select('id','tax')->where('country_id',$service_country)->first();
        $sub_total = $package_fee + $extra_service;
        if(!is_null($country_tax )){
            $tax_amount = ($sub_total * $country_tax->tax) / 100;
        }
        $total = $sub_total + $tax_amount;

        //calculate coupon amount
        $coupon_code = '';
        $coupon_type = '';
        $coupon_amount = 0;

        if(!empty($request->coupon_code)){
            $coupon_code = ServiceCoupon::where('code',$request->coupon_code)->first();
            $current_date = date('Y-m-d');
            if(!empty($coupon_code)){
                if($coupon_code->seller_id == $request->seller_id){
                    if($coupon_code->code == $request->coupon_code && $coupon_code->expire_date > $current_date){
                        if($coupon_code->discount_type == 'percentage'){
                            $coupon_amount = ($total * $coupon_code->discount)/100;
                            $total = $total-$coupon_amount;
                            $coupon_code = $request->coupon_code;
                            $coupon_type = 'percentage';
                        }else{
                            $coupon_amount = $coupon_code->discount;
                            $total = $total-$coupon_amount;
                            $coupon_code = $request->coupon_code;
                            $coupon_type = 'amount';
                        }
                    }else{
                        $coupon_code = '';
                    }
                }else{
                    $coupon_code = '';
                }
            }
        }
        $commission_amount = 0;

        //commission amount
        if($commission->system_type == 'subscription'){
            if(subscriptionModuleExistsAndEnable('Subscription')){
                $commission_amount = 0;
                \Modules\Subscription\Entities\SellerSubscription::where('id', $request->seller_id)->update([
                    'connect' => DB::raw(sprintf("connect - %s",(int)strip_tags(get_static_option('set_number_of_connect')))),
                ]);
            }
        }else{
            if($commission->commission_charge_type=='percentage'){
                $commission_amount = ($sub_total*$commission->commission_charge)/100;
            }else{
                $commission_amount = $commission->commission_charge;
            }
        }

        Order::where('id', $last_order_id)->update([
            'package_fee' => $package_fee,
            'extra_service' => $extra_service,
            'sub_total' => $sub_total,
            'tax' => $tax_amount,
            'total' => $total,
            'coupon_code' => $coupon_code,
            'coupon_type' => $coupon_type,
            'coupon_amount' => $coupon_amount,
            'commission_amount' => $commission_amount,
        ]);

        //Send order notification to seller
        $seller = User::where('id',$request->seller_id)->first();
        $buyer_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : NULL;
        $order_message = __('You have a new service request');

        // admin notification add
        AdminNotification::create(['order_id' => $last_order_id]);

        // seller buyer notification
        $seller->notify(new OrderNotification($last_order_id,$request->service_id, $request->seller_id, $buyer_id,$order_message));

        // variable for all payment gateway
        $global_currency = get_static_option('site_global_currency');
        $usd_conversion_rate =  get_static_option('site_' . strtolower($global_currency) . '_to_usd_exchange_rate');
        $inr_exchange_rate = getenv('INR_EXCHANGE_RATE');
        $ngn_exchange_rate = getenv('NGN_EXCHANGE_RATE');
        $zar_exchange_rate = getenv('ZAR_EXCHANGE_RATE');
        $brl_exchange_rate = getenv('BRL_EXCHANGE_RATE');
        $idr_exchange_rate = getenv('IDR_EXCHANGE_RATE');
        $myr_exchange_rate = getenv('MYR_EXCHANGE_RATE');

        if(Auth::guard('web')->check()){
            $user_name = Auth::guard('web')->user()->name;
            $user_email = Auth::guard('web')->user()->email;
        }else{
            $user_name = $request->name;
            $user_email = $request->email;
        }

        $get_service_id_from_last_order = Order::select('service_id')->where('id',$last_order_id)->first();
        $title = Str::limit(strip_tags(optional($get_service_id_from_last_order->service)->title),20);
        $description = sprintf(__('Service Request id #%1$d Email: %2$s, Name: %3$s'),$last_order_id,$user_email,$user_name);

        //todo: check payment gateway is wallet or not
        if(moduleExists('Wallet')){
            if ($request->selected_payment_gateway === 'wallet') {
                $order_details = Order::find($last_order_id);
                $random_order_id_1 = Str::random(30);
                $random_order_id_2 = Str::random(30);
                $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;
                $buyer_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : NULL;
                $wallet_balance = Wallet::where('buyer_id',$buyer_id)->first();

                if(!empty($wallet_balance)){
                    if($wallet_balance->balance >= $order_details->total){
                        try {
                            $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an service request #');
                            $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new service request #');
                            Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                            Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                            Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                        } catch (\Exception $e) {
                            \Toastr::error($e->getMessage());
                        }
                        Order::where('id', $last_order_id)->update([
                            'payment_status' => 'complete',
                            'payment_gateway' => 'wallet',
                        ]);
                        Wallet::where('buyer_id',$buyer_id)->update([
                            'balance' => $wallet_balance->balance-$order_details->total,
                        ]);
                    }else{
                        $shortage_balance =  $order_details->total-$wallet_balance->balance;
                        toastr_warning('Your wallet has '.float_amount_with_currency_symbol($shortage_balance).' shortage to service request this service. Please Credit your wallet first and try again.');
                        return back();
                    }

                }

                $formDataToSubmit = [
                    "ServiceProviderName" => $seller->name,
                    "ServiceProviderEmail" => $seller->email,
                    "ServiceProviderPhone" => $seller->phone,
                    "ServiceName" => $service->include_service_title ?? "NA",
                    "ServiceAmount" => $total,
                    "CutomerName" => $request->name,
                    "CutomerEmail" => $request->email,
                    "CutomerPhone" => $request->phone,
                    "ServiceId" => $last_order_id,
                    "Date" => $todayDate
                ];

                $resultOfFormSubmiation = Doc8yAPI::createDuplicateDocumentAndRequest($seller->phone, $formDataToSubmit);
                $DecodeData = json_decode($resultOfFormSubmiation,true);
                \Log::debug("Result of Form Creation : " . print_r($DecodeData,true));
                if ($DecodeData['status'] == "error"){
                    $resultData = [
                        "status" => "success",
                        "title" => "API Success",
                        "message" => "New Service Request id : " . $last_order_id ." successfully created",
                        "servicerequestid" => $last_order_id,
                        "serviceprovidername" => $seller->name,
                        "serviceproviderid" => $seller->id,
                        "serviceprovideremail" => $seller->email,
                    ];
                    \Log::debug("Result : " . print_r($status,true));
                    exit(json_encode($resultData));
                } else {
                    $fileId = $DecodeData['fileid'];
                    $signingLink = $DecodeData['signinglinks'];
                    \Log::debug("File ID : " . $fileId . "\nSigning Link : " . $signingLink);

                    Order::where('id',$last_order_id)->update([
                        'file_id' => $fileId,
                        'service_provider_file_link' => $signingLink[0],
                        'customer_file_link' => $signingLink[1],
                        'admin_file_link' => $signingLink[2],
                    ]);

                    $resultData = [
                        "status" => "success",
                        "title" => "API Success",
                        "message" => "New Service Request id : " . $last_order_id ." successfully created",
                        "servicerequestid" => $last_order_id,
                        "serviceprovidername" => $seller->name,
                        "serviceproviderid" => $seller->id,
                        "serviceprovideremail" => $seller->email,
                    ];
                    \Log::debug("Result : " . print_r($status,true));
                    exit(json_encode($resultData));
                }
            }
        }

        if ($request->selected_payment_gateway === 'cash_on_delivery' || $request->selected_payment_gateway === 'annual_maintenance_charge') {
            $order_details = Order::find($last_order_id);
            $random_order_id_1 = Str::random(30);
            $random_order_id_2 = Str::random(30);
            $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

            try {
                $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an service Rrequest #');
                $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new service request #');
                Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
            } catch (\Exception $e) {
                \Toastr::error($e->getMessage());
            }
            
            $formDataToSubmit = [
                "ServiceProviderName" => $seller->name,
                "ServiceProviderEmail" => $seller->email,
                "ServiceProviderPhone" => $seller->phone,
                "ServiceName" => $service->include_service_title ?? "NA",
                "ServiceAmount" => $total,
                "CutomerName" => $request->name,
                "CutomerEmail" => $request->email,
                "CutomerPhone" => $request->phone,
                "ServiceId" => $last_order_id,
                "Date" => $todayDate
            ];
            // $resultOfFormSubmiation = Doc8yAPI::sumbitData($seller->phone, $formDataToSubmit);
            $resultOfFormSubmiation = Doc8yAPI::createDuplicateDocumentAndRequest($seller->phone, $formDataToSubmit);
            $decodeData = json_decode($resultOfFormSubmiation,true);
            \Log::debug("Result of Form Creation : " . print_r($decodeData,true));
            
            // if ($decodeData['status'] == 'error'){
            //     Order::where('id', $last_order_id)->delete();
            //     $status = [
            //         "status" => "error",
            //         "title" => "API Failed",
            //         "message" => "Creation of document get failed",
            //     ];
            //     exit(json_encode($status));
            // }
            if ($decodeData['status'] == "error"){
                $resultData = [
                    "status" => "success",
                    "title" => "API Success",
                    "message" => "New Service Request id : " . $last_order_id ." successfully created. But Form aganist it not created in doc8.",
                    "servicerequestid" => $last_order_id,
                    "serviceprovidername" => $seller->name,
                    "serviceproviderid" => $seller->id,
                    "serviceprovideremail" => $seller->email,
                ];
                \Log::debug("Result : " . print_r($resultData,true));
                exit(json_encode($resultData));
            } else {
                $fileId = $decodeData['file_id'];
                $signingLink = $decodeData['signinglinks'];
                \Log::debug("File ID : " . $fileId . "\nSigning Link : " . print_r($signingLink,true));

                Order::where('id',$last_order_id)->update([
                    'file_id' => $fileId,
                    'service_provider_file_link' => $signingLink[0],
                    'customer_file_link' => $signingLink[1],
                    'admin_file_link' => $signingLink[2],
                ]);

                $status = [
                    "status" => "success",
                    "title" => "API Success",
                    "message" => "New service request id : " . $last_order_id ." successfully created",
                    "servicerequestid" => $last_order_id,
                    "serviceprovidername" => $seller->name,
                    "serviceproviderid" => $seller->id,
                    "serviceprovideremail" => $seller->email,
                ];
                \Log::debug("Result : " . print_r($status,true));
                exit(json_encode($status));
            }
        }
        if($request->selected_payment_gateway === 'manual_payment') {
            $order_details = Order::find($last_order_id);
            $random_order_id_1 = Str::random(30);
            $random_order_id_2 = Str::random(30);
            $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

            $this->validate($request,[
                'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);
            if($request->hasFile('manual_payment_image')){
                $manual_payment_image = $request->manual_payment_image;
                $img_ext = $manual_payment_image->extension();

                $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
                if(in_array($img_ext,['jpg','jpeg','png','pdf'])){
                    $manual_image_path = 'assets/uploads/manual-payment/';
                    $manual_payment_image->move($manual_image_path,$manual_payment_image_name);

                    Order::where('id',$last_order_id)->update([
                        'manual_payment_image'=>$manual_payment_image_name
                    ]);
                }else{
                    return back()->with(['msg' => __('image type not supported'),'type' => 'danger']);
                }
            }

            try {
                $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an service request #');
                $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new service request #');
                Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
            } catch (\Exception $e) {
                \Toastr::error($e->getMessage());
            }

            $formDataToSubmit = [
                "ServiceProviderName" => $seller->name,
                "ServiceProviderEmail" => $seller->email,
                "ServiceProviderPhone" => $seller->phone,
                "ServiceName" => $service->include_service_title ?? "NA",
                "ServiceAmount" => $total,
                "CutomerName" => $request->name,
                "CutomerEmail" => $request->email,
                "CutomerPhone" => $request->phone,
                "ServiceId" => $last_order_id,
                "Date" => $todayDate
            ];
           
            $resultOfFormSubmiation = Doc8yAPI::createDuplicateDocumentAndRequest($seller->phone, $formDataToSubmit);
            $DecodeData = json_decode($resultOfFormSubmiation,true);
            \Log::debug("Result of Form Creation : " . print_r($DecodeData,true));
            if ($DecodeData['status'] == "error"){
                $resultData = [
                    "status" => "success",
                    "title" => "API Success",
                    "message" => "New Service Request id : " . $last_order_id ." successfully created",
                    "servicerequestid" => $last_order_id,
                    "serviceprovidername" => $seller->name,
                    "serviceproviderid" => $seller->id,
                    "serviceprovideremail" => $seller->email,
                ];
                \Log::debug("Result : " . print_r($status,true));
                exit(json_encode($resultData));
            } else {
                $fileId = $DecodeData['fileid'];
                $signingLink = $DecodeData['signinglinks'];
                \Log::debug("File ID : " . $fileId . "\nSigning Link : " . $signingLink);

                Order::where('id',$last_order_id)->update([
                    'file_id' => $fileId,
                    'service_provider_file_link' => $signingLink[0],
                    'customer_file_link' => $signingLink[1],
                    'admin_file_link' => $signingLink[2],
                ]);

                $status = [
                    "status" => "success",
                    "title" => "API Success",
                    "message" => "New service request id : " . $last_order_id ." successfully created",
                    "servicerequestid" => $last_order_id,
                    "serviceprovidername" => $seller->name,
                    "serviceproviderid" => $seller->id,
                    "serviceprovideremail" => $seller->email,
                ];
                \Log::debug("Result : " . print_r($status,true));
                exit(json_encode($status));
            }
        } else {
            if ($request->selected_payment_gateway === 'paypal') {
                try{
                    $paypal_mode = getenv('PAYPAL_MODE');
                    $client_id = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_CLIENT_ID') : getenv('PAYPAL_LIVE_CLIENT_ID');
                    $client_secret = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_CLIENT_SECRET') : getenv('PAYPAL_LIVE_CLIENT_SECRET');
                    $app_id = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_APP_ID') : getenv('PAYPAL_LIVE_APP_ID');

                    $paypal = XgPaymentGateway::paypal();

                    $paypal->setClientId($client_id); // provide sandbox id if payment env set to true, otherwise provide live credentials
                    $paypal->setClientSecret($client_secret); // provide sandbox id if payment env set to true, otherwise provide live credentials
                    $paypal->setAppId($app_id); // provide sandbox id if payment env set to true, otherwise provide live credentials
                    $paypal->setCurrency($global_currency);
                    $paypal->setEnv($paypal_mode === 'sandbox'); //env must set as boolean, string will not work
                    $paypal->setExchangeRate($usd_conversion_rate); // if INR not set as currency

                    $redirect_url = $paypal->charge_customer([
                        'amount' => $total, // amount you want to charge from customer
                        'title' => $title, // payment title
                        'description' => $description, // payment description
                        'ipn_url' => route('frontend.paypal.ipn'), //you will get payment response in this route
                        'order_id' => $last_order_id, // your order number
                        'track' => \Str::random(36), // a random number to keep track of your payment
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id), //payment gateway will redirect here if the payment is failed
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id), // payment gateway will redirect here after success
                        'email' => $user_email, // user email
                        'name' => $user_name, // user name
                        'payment_type' => 'order', // which kind of payment your are receving from customer
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            } elseif($request->selected_payment_gateway === 'paytm'){
                try{
                    $paytm_merchant_id = getenv('PAYTM_MERCHANT_ID');
                    $paytm_merchant_key = getenv('PAYTM_MERCHANT_KEY');
                    $paytm_merchant_website = getenv('PAYTM_MERCHANT_WEBSITE') ?? 'WEBSTAGING';
                    $paytm_channel = getenv('PAYTM_CHANNEL') ?? 'WEB';
                    $paytm_industry_type = getenv('PAYTM_INDUSTRY_TYPE') ?? 'Retail';
                    $paytm_env = getenv('PAYTM_ENVIRONMENT');

                    $paytm = XgPaymentGateway::paytm();
                    $paytm->setMerchantId($paytm_merchant_id);
                    $paytm->setMerchantKey($paytm_merchant_key);
                    $paytm->setMerchantWebsite($paytm_merchant_website);
                    $paytm->setChannel($paytm_channel);
                    $paytm->setIndustryType($paytm_industry_type);
                    $paytm->setCurrency($global_currency);
                    $paytm->setEnv($paytm_env === 'local'); // this must be type of boolean , string will not work
                    $paytm->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $paytm->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.paytm.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);

                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            } elseif($request->selected_payment_gateway === 'mollie'){
                try{
                    $mollie_key = getenv('MOLLIE_KEY');
                    $mollie = XgPaymentGateway::mollie();
                    $mollie->setApiKey($mollie_key);
                    $mollie->setCurrency($global_currency);
                    $mollie->setEnv(true); //env must set as boolean, string will not work
                    $mollie->setExchangeRate($usd_conversion_rate); // if INR not set as currency
                    $redirect_url = $mollie->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.mollie.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            } elseif($request->selected_payment_gateway === 'stripe'){
                try{
                    $stripe_public_key = getenv('STRIPE_PUBLIC_KEY');
                    $stripe_secret_key = getenv('STRIPE_SECRET_KEY');
                    $stripe = XgPaymentGateway::stripe();
                    $stripe->setSecretKey($stripe_secret_key);
                    $stripe->setPublicKey($stripe_public_key);
                    $stripe->setCurrency($global_currency);
                    $stripe->setEnv(true); //env must set as boolean, string will not work
                    $stripe->setExchangeRate($usd_conversion_rate); // if INR not set as currency

                    $redirect_url = $stripe->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.stripe.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                }
                catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }


            } elseif($request->selected_payment_gateway === 'razorpay'){
                try{
                    $razorpay_api_key = getenv('RAZORPAY_API_KEY');
                    $razorpay_api_secret = getenv('RAZORPAY_API_SECRET');
                    $razorpay = XgPaymentGateway::razorpay();
                    $razorpay->setApiKey($razorpay_api_key);
                    $razorpay->setApiSecret($razorpay_api_secret);
                    $razorpay->setCurrency($global_currency);
                    $razorpay->setEnv(true); //env must set as boolean, string will not work
                    $razorpay->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $razorpay->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.razorpay.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            } elseif($request->selected_payment_gateway === 'flutterwave'){
                try{
                    $flutterwave_public_key = getenv("FLW_PUBLIC_KEY");
                    $flutterwave_secret_key = getenv("FLW_SECRET_KEY");
                    $flutterwave_secret_hash = getenv("FLW_SECRET_HASH");

                    $flutterwave = XgPaymentGateway::flutterwave();
                    $flutterwave->setPublicKey($flutterwave_public_key);
                    $flutterwave->setSecretKey($flutterwave_secret_key);
                    $flutterwave->setCurrency($global_currency);
                    $flutterwave->setEnv(true); //env must set as boolean, string will not work
                    $flutterwave->setExchangeRate($usd_conversion_rate); // if NGN not set as currency

                    $redirect_url = $flutterwave->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.flutterwave.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                }
                catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            } elseif($request->selected_payment_gateway === 'paystack'){
                try{
                    $paystack_public_key = getenv('PAYSTACK_PUBLIC_KEY');
                    $paystack_secret_key = getenv('PAYSTACK_SECRET_KEY');
                    $paystack_merchant_email = getenv('MERCHANT_EMAIL');

                    $paystack = XgPaymentGateway::paystack();
                    $paystack->setPublicKey($paystack_public_key);
                    $paystack->setSecretKey($paystack_secret_key);
                    $paystack->setMerchantEmail($paystack_merchant_email);
                    $paystack->setCurrency($global_currency);
                    $paystack->setEnv(true); //env must set as boolean, string will not work
                    $paystack->setExchangeRate($ngn_exchange_rate); // if NGN not set as currency

                    $redirect_url = $paystack->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.paystack.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' =>  $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                } catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            } elseif($request->selected_payment_gateway === 'payfast'){
                try{
                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);

                    $payfast_merchant_id = getenv('PF_MERCHANT_ID');
                    $payfast_merchant_key = getenv('PF_MERCHANT_KEY');
                    $payfast_passphrase = getenv('PAYFAST_PASSPHRASE');
                    $payfast_env = getenv('PF_MERCHANT_ENV') === 'true';

                    $payfast = XgPaymentGateway::payfast();
                    $payfast->setMerchantId($payfast_merchant_id);
                    $payfast->setMerchantKey($payfast_merchant_key);
                    $payfast->setPassphrase($payfast_passphrase);
                    $payfast->setCurrency($global_currency);
                    $payfast->setEnv($payfast_env); //env must set as boolean, string will not work
                    $payfast->setExchangeRate($zar_exchange_rate); // if ZAR not set as currency

                    $redirect_url = $payfast->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.payfast.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$random_order_id_1.$last_order_id.$random_order_id_2),
                        'email' => $user_email,
                        'name' =>  $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                } catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            } elseif($request->selected_payment_gateway === 'cashfree'){
                try{
                    $cashfree_env = getenv('CASHFREE_TEST_MODE') === 'true';
                    $cashfree_app_id = getenv('CASHFREE_APP_ID');
                    $cashfree_secret_key = getenv('CASHFREE_SECRET_KEY');

                    $cashfree = XgPaymentGateway::cashfree();
                    $cashfree->setAppId($cashfree_app_id);
                    $cashfree->setSecretKey($cashfree_secret_key);
                    $cashfree->setCurrency($global_currency);
                    $cashfree->setEnv($cashfree_env); //true means sandbox, false means live , //env must set as boolean, string will not work
                    $cashfree->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $cashfree->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.cashfree.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' =>  $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            } elseif($request->selected_payment_gateway === 'instamojo'){

                try{
                    $instamojo_client_id = getenv('INSTAMOJO_CLIENT_ID');
                    $instamojo_client_secret = getenv('INSTAMOJO_CLIENT_SECRET');
                    $instamojo_env = getenv('INSTAMOJO_TEST_MODE') === 'true';

                    $instamojo = XgPaymentGateway::instamojo();
                    $instamojo->setClientId($instamojo_client_id);
                    $instamojo->setSecretKey($instamojo_client_secret);
                    $instamojo->setCurrency($global_currency);
                    $instamojo->setEnv($instamojo_env); //true mean sandbox mode , false means live mode //env must set as boolean, string will not work
                    $instamojo->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $instamojo->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.instamojo.ipn'),
                        'order_id' => $last_order_id,
                        'track' => 'asdfasdfsdf',
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            } elseif($request->selected_payment_gateway === 'marcadopago'){
                try{
                    $mercadopago_client_id = getenv('MERCADO_PAGO_CLIENT_ID');
                    $mercadopago_client_secret = getenv('MERCADO_PAGO_CLIENT_SECRET');
                    $mercadopago_env =  getenv('MERCADO_PAGO_TEST_MOD') === 'true';

                    $marcadopago = XgPaymentGateway::marcadopago();
                    $marcadopago->setClientId($mercadopago_client_id);
                    $marcadopago->setClientSecret($mercadopago_client_secret);
                    $marcadopago->setCurrency($global_currency);
                    $marcadopago->setExchangeRate($brl_exchange_rate); // if BRL not set as currency, you must have to provide exchange rate for it
                    $marcadopago->setEnv($mercadopago_env); ////true mean sandbox mode , false means live mode
                    ///
                    $redirect_url = $marcadopago->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.marcadopago.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            } elseif($request->selected_payment_gateway === 'midtrans'){

                try{
                    $midtrans_env =  getenv('MIDTRANS_ENVAIRONTMENT') === 'true';
                    $midtrans_server_key = getenv('MIDTRANS_SERVER_KEY');
                    $midtrans_client_key = getenv('MIDTRANS_CLIENT_KEY');

                    $midtrans = XgPaymentGateway::midtrans();
                    $midtrans->setClientKey($midtrans_client_key);
                    $midtrans->setServerKey($midtrans_server_key);
                    $midtrans->setCurrency($global_currency);
                    $midtrans->setEnv($midtrans_env); //true mean sandbox mode , false means live mode
                    $midtrans->setExchangeRate($idr_exchange_rate); // if IDR not set as currency

                    $redirect_url = $midtrans->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.midtrans.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            } elseif($request->selected_payment_gateway === 'squareup'){
                try{
                    $squareup_env =  !empty(get_static_option('squareup_test_mode'));
                    $squareup_location_id = get_static_option('squareup_location_id');
                    $squareup_access_token = get_static_option('squareup_access_token');
                    $squareup_application_id = get_static_option('squareup_application_id');

                    $squareup = XgPaymentGateway::squareup();
                    $squareup->setLocationId($squareup_location_id);
                    $squareup->setAccessToken($squareup_access_token);
                    $squareup->setApplicationId($squareup_application_id);
                    $squareup->setCurrency($global_currency);
                    $squareup->setEnv($squareup_env);
                    $squareup->setExchangeRate($usd_conversion_rate); // if USD not set as currency

                    $redirect_url = $squareup->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.squareup.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            } elseif($request->selected_payment_gateway === 'cinetpay'){
                try{
                    $cinetpay_env =  !empty(get_static_option('cinetpay_test_mode'));
                    $cinetpay_site_id = get_static_option('cinetpay_site_id');
                    $cinetpay_app_key = get_static_option('cinetpay_app_key');

                    $cinetpay = XgPaymentGateway::cinetpay();
                    $cinetpay->setAppKey($cinetpay_app_key);
                    $cinetpay->setSiteId($cinetpay_site_id);
                    $cinetpay->setCurrency($global_currency);
                    $cinetpay->setEnv($cinetpay_env);
                    $cinetpay->setExchangeRate($usd_conversion_rate); // if ['XOF', 'XAF', 'CDF', 'GNF', 'USD'] not set as currency

                    $redirect_url = $cinetpay->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.cinetpay.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            } elseif ($request->selected_payment_gateway === 'paytabs'){
                try{
                    $paytabs_env =  !empty(get_static_option('paytabs_test_mode'));
                    $paytabs_region = get_static_option('paytabs_region');
                    $paytabs_profile_id = get_static_option('paytabs_profile_id');
                    $paytabs_server_key = get_static_option('paytabs_server_key');

                    $paytabs = XgPaymentGateway::paytabs();
                    $paytabs->setProfileId($paytabs_profile_id);
                    $paytabs->setRegion($paytabs_region);
                    $paytabs->setServerKey($paytabs_server_key);
                    $paytabs->setCurrency($global_currency);
                    $paytabs->setEnv($paytabs_env);
                    $paytabs->setExchangeRate($usd_conversion_rate); // if ['AED','EGP','SAR','OMR','JOD','USD'] not set as currency

                    $redirect_url = $paytabs->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.paytabs.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            } elseif($request->selected_payment_gateway === 'billplz'){
                try{
                    $billplz_env =  !empty(get_static_option('billplz_test_mode'));
                    $billplz_key =  get_static_option('billplz_key');
                    $billplz_xsignature =  get_static_option('billplz_xsignature');
                    $billplz_collection_name =  get_static_option('billplz_collection_name');

                    $billplz = XgPaymentGateway::billplz();
                    $billplz->setKey($billplz_key);
                    $billplz->setVersion('v4');
                    $billplz->setXsignature($billplz_xsignature);
                    $billplz->setCollectionName($billplz_collection_name);
                    $billplz->setCurrency($global_currency);
                    $billplz->setEnv($billplz_env);
                    $billplz->setExchangeRate($myr_exchange_rate); // if ['MYR'] not set as currency
                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

                    $redirect_url = $billplz->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.billplz.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$new_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            } elseif($request->selected_payment_gateway === 'zitopay'){
                try{
                    $zitopay_env =  !empty(get_static_option('zitopay_test_mode'));
                    $zitopay_username =  get_static_option('zitopay_username');

                    $zitopay = XgPaymentGateway::zitopay();
                    $zitopay->setUsername($zitopay_username);
                    $zitopay->setCurrency($global_currency);
                    $zitopay->setEnv($zitopay_env);
                    $zitopay->setExchangeRate($usd_conversion_rate);

                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

                    $redirect_url = $zitopay->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.zitopay.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$new_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            } else {
                //todo check qixer meta data for new payment gateway
                $module_meta =  new ModuleMetaData();
                $list = $module_meta->getAllPaymentGatewayList();
                if (in_array($request->selected_payment_gateway,$list)){
                    //todo call the module payment gateway customerCharge function
                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

                    $customerChargeMethod =  $module_meta->getChargeCustomerMethodNameByPaymentGatewayName($request->selected_payment_gateway);
                    try {
                        $returned_val = $customerChargeMethod([
                            'amount' => $total,
                            'title' => $title,
                            'description' => $description,
                            'ipn_url' => null,
                            'order_id' => $last_order_id,
                            'track' => \Str::random(36),
                            'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                            'success_url' => route(self::SUCCESS_ROUTE,$new_order_id),
                            'email' => $user_email,
                            'name' => $user_name,
                            'payment_type' => 'order',
                        ]);
                        if(is_array($returned_val) && isset($returned_val['route'])){
    					   $return_url = !empty($returned_val['route']) ? $returned_val['route'] : route('homepage');
    						return redirect()->away($return_url); 
    					}
					
                    }catch (\Exception $e){
                        toastr_error( $e->getMessage());
                        return back();
                    }
                }
            }
        }
    }

    /*
     * Update Service Request File Status
     */
    public function updateServiceRequestFileStatus(Request $request) {
        header('Content-type: application/json');
        \Log::debug('File ID : ' . $request->fileId .
                    "\nFile Status : " . $request->fileStatus .
                    "\nSigning Link : " . $request->signinglink);
        
        $orderData = Order::where('file_id', $request->fileId)->first();
        if ($orderData->service_provider_file_link == $request->signinglink){
            $updateResult = Order::where('file_id', $request->fileId)->update([
                'service_provider_signing_status' => $request->fileStatus,
            ]);
        } else if ($orderData->customer_file_link == $request->signinglink){
            $updateResult = Order::where('file_id', $request->fileId)->update([
                'customer_signing_status' => $request->fileStatus,
            ]);
        } else if ($orderData->admin_file_link == $request->signinglink) {
            $updateResult = Order::where('file_id', $request->fileId)->update([
                'admin_signing_status' => $request->fileStatus,
            ]);
        } else {
            $updateResult = 0;
            \Log::debug("Link Not Found");
        }

        if ($updateResult == 1){
            $response = [
                "status" => "success",
                "message" => "Status updated successfully"
            ];
        } else {
            $response = [
                "status" => "error",
                "message" => "Error while updating status"
            ];
        }
        return response()->json($response);
    }

    public function createOrder(Request $request)
    {
        $customerId = '';
        if($request->is_service_online_ != 1){
            $request->validate([
                'name' => 'required|max:191',
                'email' => 'required|max:191',
                'phone' => 'required|max:191',
                'address' => 'required|max:191',
                'choose_service_city' => 'required',
                'choose_service_area' => 'required',
                'choose_service_country' => 'required',
                'date' => 'required|max:191',
                'order_note' => 'nullable|max:191',
                'schedule' => 'required|max:191',
                'services' => 'required|array',
                'services.*.id' => 'required|exists:serviceincludes',
                'services.*.quantity' => 'required|numeric',
            ]);
        }
        $commission = AdminCommission::first();

        if($request->selected_payment_gateway=='cash_on_delivery' || $request->selected_payment_gateway == 'manual_payment' || $request->selected_payment_gateway === 'annual_maintenance_charge'){
            $payment_status='complete';
        }else{
            $payment_status='';
        }


        if (empty($request->seller_id)){
            \Toastr::error(__('Service Provider Id missing, please try another another service provider services'));
            return back();
        }
        if ($request->seller_id == Auth::guard('web')->id()){
            \Toastr::error(__('You can not book your own service'));
            return back();
        }

        if (Auth::guard('web')->id() === NULL){
            $userData = User::where('email', $request->email)->first();
            if ($userData != null){
                    $customerId = $userData->id;
            } else {
                $email_verify_tokn = Str::random(8);
                $passowrd = $request->name."@".rand(0000, 9999);
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->name,
                    'phone' => $request->phone,
                    'password' => Hash::make($passowrd),
                    'service_city' => $request->choose_service_city,
                    'service_area' => $request->choose_service_area,
                    'country_id' => $request->choose_service_country,
                    'user_type' => 1,
                    'terms_conditions' => 1,
                    'email_verify_token'=> $email_verify_tokn,
                ]);
                if($user){
                    try {
                        $message = get_static_option('customer_register_message');
                        $message = str_replace(["@name", "@type", "@username", "@password"],[$user->name, "customer", $user->name, $passowrd],$message);
                        Mail::to($user->email)->send(new BasicMail([
                            'subject' => get_static_option('customer_register_message_subject'),
                            'message' => $message
                        ]));

                        $message = get_static_option('user_email_verify_message');
                        $message = str_replace(["@name", "@email_verify_tokn"],[$user->name, $email_verify_tokn],$message);
                        Mail::to($user->email)->send(new BasicMail([
                            'subject' => get_static_option('user_email_verify_subject'),
                            'message' => $message
                        ]));
    
                        $message = get_static_option('user_register_message');
                        $message = str_replace(["@name", "@type","@username","@email"],[$user->name, "customer", $user->name, $user->email], $message);
                        Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                            'subject' => get_static_option('user_register_subject') ?? __('New User Registration'),
                            'message' => $message
                        ]));
                    } catch (\Exception $e) {
    
                    }
                }
                $customerId = $user->id;
            }
        }

        if (Auth::guard('web')->check() && Auth::guard('web')->user()->type === 0){
            \Toastr::error(__('service provider are not allowed to place service order'));
            return back();
        }

        if($request->selected_payment_gateway === 'manual_payment') {
            $this->validate($request,[
                'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);
        }

        $order_create='';
        if($request->is_service_online_ != 1 && Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1){
            Order::create([
                'service_id' => $request->service_id,
                'seller_id' => $request->seller_id,
                'buyer_id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : $customerId,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code ?? 0000,
                'address' => $request->address,
                'city' => $request->choose_service_city,
                'area' => $request->choose_service_area,
                'country' => $request->choose_service_country,
                'date' => \Carbon\Carbon::parse($request->date)->format('D F d Y'),
                'schedule' => $request->schedule,
                'package_fee' => 0,
                'extra_service' => 0,
                'sub_total' => 0,
                'tax' => 0,
                'total' => 0,
                'commission_type' => $commission->commission_charge_type,
                'commission_charge' => $commission->commission_charge,
                'status' => 0,
                'order_note' => $request->order_note,
                'payment_gateway' => $request->selected_payment_gateway,
                'payment_status' => $payment_status,
                'file_id' => 0,
                'service_provider_file_link' => '',
                'customer_file_link' => '',
                'admin_file_link' => '',       
                'service_provider_signing_status' => 'Pending', 
                'customer_signing_status' => 'Pending',         
                'admin_signing_status' => 'Pending',
            ]);
        }else{
            if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1 ){
                $order_create = Order::create([
                    'service_id' => $request->service_id,
                    'seller_id' => $request->seller_id,
                    'buyer_id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : $customerId,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'post_code' => $request->post_code ?? 0000,
                    'address' => $request->address,
                    'city' => $request->choose_service_city,
                    'area' => $request->choose_service_area,
                    'country' => $request->choose_service_country,
                    'date' => '00.00.00',
                    'schedule' => '00.00.00',
                    'package_fee' => 0,
                    'extra_service' => 0,
                    'sub_total' => 0,
                    'tax' => 0,
                    'total' => 0,
                    'commission_type' => $commission->commission_charge_type,
                    'commission_charge' => $commission->commission_charge,
                    'status' => 0,
                    'is_order_online'=>$request->is_service_online_,
                    'order_note' => $request->order_note,
                    'payment_gateway' => $request->selected_payment_gateway,
                    'payment_status' => $payment_status,
                    'file_id' => 0,
                    'service_provider_file_link' => '',
                    'customer_file_link' => '',
                    'admin_file_link' => '',       
                    'service_provider_signing_status' => 'Pending', 
                    'customer_signing_status' => 'Pending',         
                    'admin_signing_status' => 'Pending',
                ]);
            }else{
               if( get_static_option('order_create_settings') !== 'anyone'){
                    toastr_error(__('You must login as a buyer to create an order.'));
                    return redirect()->back();
                }
                Order::create([
                    'service_id' => $request->service_id,
                    'seller_id' => $request->seller_id,
                    'buyer_id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : $customerId,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'post_code' => $request->post_code ?? 0000,
                    'address' => $request->address,
                    'city' => $request->choose_service_city,
                    'area' => $request->choose_service_area,
                    'country' => $request->choose_service_country,
                    'date' => $request->is_service_online_ != 1 ? \Carbon\Carbon::parse($request->date)->format('D F d Y') : '00.00.00',
                    'schedule' => $request->is_service_online_ != 1 ? $request->schedule : '00.00.00',
                    'package_fee' => 0,
                    'extra_service' => 0,
                    'sub_total' => 0,
                    'tax' => 0,
                    'total' => 0,
                    'commission_type' => $commission->commission_charge_type,
                    'commission_charge' => $commission->commission_charge,
                    'status' => 0,
                    'order_note' => $request->order_note,
                    'payment_gateway' => $request->selected_payment_gateway,
                    'payment_status' => $payment_status,
                    'file_id' => 0,
                    'service_provider_file_link' => '',
                    'customer_file_link' => '',
                    'admin_file_link' => '',       
                    'service_provider_signing_status' => 'Pending', 
                    'customer_signing_status' => 'Pending',         
                    'admin_signing_status' => 'Pending',
                ]);

            }
        }

        $last_order_id = DB::getPdo()->lastInsertId();

        if($order_create !=''){
            SupportTicket::create([
                'title' => 'New Service Request',
                'subject' => 'Service Request Created By '.$request->name,
                'status' => 'open',
                'priority' => 'high',
                'buyer_id' => Auth::guard('web')->user()->id,
                'seller_id' => $request->seller_id,
                'service_id' => $request->service_id,
                'order_id' => $last_order_id ,
            ]);
        }

        $service_sold_count = Service::select('sold_count')->where('id',$request->service_id)->first();
        Service::where('id',$request->service_id)->update(['sold_count'=>$service_sold_count->sold_count+1]);

        $servs = [];
        $service_ids = [];
        $package_fee = 0;

        if (isset($request->services) && is_array($request->services)) {

            foreach ($request->services as $key => $service) {
                $service_ids[] = $service['id'];
            }

            $included_services = Serviceinclude::whereIn('id', $service_ids)->get();

            if($request->is_service_online_ != 1) {
                foreach ($request->services as $key => $requested_service) {
                    $service = $included_services->find($requested_service['id']);
                    $servs[] = [
                        'id' => $service->id,
                        'title' => $service->include_service_title,
                        'unit_price' => $service->include_service_price,
                        'quantity' => $requested_service['quantity'],
                    ];

                    $package_fee += $requested_service['quantity'] * $service->include_service_price;

                    OrderInclude::create([
                        'order_id' => $last_order_id,
                        'title' => $service->include_service_title,
                        'price' => $service->include_service_price,
                        'quantity' => $requested_service['quantity'],
                    ]);
                }
            }else{
                foreach ($request->services as $key => $requested_service) {
                    $service = $included_services->find($requested_service['id']);
                    $servs[] = [
                        'id' => $service->id,
                        'title' => $service->include_service_title,
                        'unit_price' => $service->include_service_price,
                        'quantity' => $requested_service['quantity'],
                    ];
                    OrderInclude::create([
                        'order_id' => $last_order_id,
                        'title' => $service->include_service_title,
                        'price' => 0,
                        'quantity' => 0,
                    ]);
                }

                $package_fee = $request->online_service_package_fee;
            }
        }


        $addis = [];
        $additional_ids = [];
        $extra_service = 0;

        if($request->additionals['0'] != NULL){
            if (isset($request->additionals) && is_array($request->additionals)) {
                foreach ($request->additionals as $key => $additional) {
                    $additional_ids[] = $additional['id'];
                }

                $additional_services = Serviceadditional::whereIn('id', $additional_ids)->get();

                foreach ($request->additionals as $key => $requested_additional) {
                    $service = $additional_services->find($requested_additional['id']);
                    $addis[] = [
                        'id' => $service->id,
                        'title' => $service->additional_service_title,
                        'unit_price' => $service->additional_service_price,
                        'quantity' => $requested_additional['quantity'],
                    ];

                    $extra_service += $requested_additional['quantity'] * $service->additional_service_price;

                    OrderAdditional::create([
                        'order_id' => $last_order_id,
                        'title' => $service->additional_service_title,
                        'price' => $service->additional_service_price,
                        'quantity' => $requested_additional['quantity'],
                    ]);
                }
            }
        }


        $sub_total = 0;
        $total = 0;
        $tax_amount =0;

        $tax = Service::select('tax')->where('id', $request->service_id)->first();
        $service_details_for_book = Service::select('id','service_city_id')->where('id',$request->service_id)->first();
        $service_country =  optional(optional($service_details_for_book->serviceCity)->countryy)->id;
        $country_tax =  Tax::select('id','tax')->where('country_id',$service_country)->first();
        $sub_total = $package_fee + $extra_service;
        if(!is_null($country_tax )){
            $tax_amount = ($sub_total * $country_tax->tax) / 100;
        }
        $total = $sub_total + $tax_amount;

        //calculate coupon amount
        $coupon_code = '';
        $coupon_type = '';
        $coupon_amount = 0;

        if(!empty($request->coupon_code)){
            $coupon_code = ServiceCoupon::where('code',$request->coupon_code)->first();
            $current_date = date('Y-m-d');
            if(!empty($coupon_code)){
                if($coupon_code->seller_id == $request->seller_id){
                    if($coupon_code->code == $request->coupon_code && $coupon_code->expire_date > $current_date){
                        if($coupon_code->discount_type == 'percentage'){
                            $coupon_amount = ($total * $coupon_code->discount)/100;
                            $total = $total-$coupon_amount;
                            $coupon_code = $request->coupon_code;
                            $coupon_type = 'percentage';
                        }else{
                            $coupon_amount = $coupon_code->discount;
                            $total = $total-$coupon_amount;
                            $coupon_code = $request->coupon_code;
                            $coupon_type = 'amount';
                        }
                    }else{
                        $coupon_code = '';
                    }
                }else{
                    $coupon_code = '';
                }
            }
        }
        $commission_amount = 0;

        //commission amount
        if($commission->system_type == 'subscription'){
            if(subscriptionModuleExistsAndEnable('Subscription')){
                $commission_amount = 0;
                \Modules\Subscription\Entities\SellerSubscription::where('id', $request->seller_id)->update([
                    'connect' => DB::raw(sprintf("connect - %s",(int)strip_tags(get_static_option('set_number_of_connect')))),
                ]);
            }
        }else{
            if($commission->commission_charge_type=='percentage'){
                $commission_amount = ($sub_total*$commission->commission_charge)/100;
            }else{
                $commission_amount = $commission->commission_charge;
            }
        }

        Order::where('id', $last_order_id)->update([
            'package_fee' => $package_fee,
            'extra_service' => $extra_service,
            'sub_total' => $sub_total,
            'tax' => $tax_amount,
            'total' => $total,
            'coupon_code' => $coupon_code,
            'coupon_type' => $coupon_type,
            'coupon_amount' => $coupon_amount,
            'commission_amount' => $commission_amount,
        ]);


        //Send order notification to seller
        $seller = User::where('id',$request->seller_id)->first();
        $buyer_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : NULL;
        $order_message = __('You have a new service request');

        // admin notification add
        AdminNotification::create(['order_id' => $last_order_id]);

        // seller buyer notification
        $seller->notify(new OrderNotification($last_order_id,$request->service_id, $request->seller_id, $buyer_id,$order_message));

        // variable for all payment gateway
        $global_currency = get_static_option('site_global_currency');

        $usd_conversion_rate =  get_static_option('site_' . strtolower($global_currency) . '_to_usd_exchange_rate');
        $inr_exchange_rate = getenv('INR_EXCHANGE_RATE');
        $ngn_exchange_rate = getenv('NGN_EXCHANGE_RATE');
        $zar_exchange_rate = getenv('ZAR_EXCHANGE_RATE');
        $brl_exchange_rate = getenv('BRL_EXCHANGE_RATE');
        $idr_exchange_rate = getenv('IDR_EXCHANGE_RATE');
        $myr_exchange_rate = getenv('MYR_EXCHANGE_RATE');


        if(Auth::guard('web')->check()){
            $user_name = Auth::guard('web')->user()->name;
            $user_email = Auth::guard('web')->user()->email;
        }else{
            $user_name = $request->name;
            $user_email = $request->email;
        }

        $get_service_id_from_last_order = Order::select('service_id')->where('id',$last_order_id)->first();
        $title = Str::limit(strip_tags(optional($get_service_id_from_last_order->service)->title),20);
        $description = sprintf(__('Service Request id #%1$d Email: %2$s, Name: %3$s'),$last_order_id,$user_email,$user_name);

        //todo: check payment gateway is wallet or not
        if(moduleExists('Wallet')){
            if ($request->selected_payment_gateway === 'wallet') {
                $order_details = Order::find($last_order_id);
                $random_order_id_1 = Str::random(30);
                $random_order_id_2 = Str::random(30);
                $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;
                $buyer_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : NULL;
                $wallet_balance = Wallet::where('buyer_id',$buyer_id)->first();

                if(!empty($wallet_balance)){
                    if($wallet_balance->balance >= $order_details->total){
                        try {
                            $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an rervice request #');
                            $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new service request #');
                            Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                            Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                            Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                        } catch (\Exception $e) {
                            \Toastr::error($e->getMessage());
                        }
                        Order::where('id', $last_order_id)->update([
                            'payment_status' => 'complete',
                            'payment_gateway' => 'wallet',
                        ]);
                        Wallet::where('buyer_id',$buyer_id)->update([
                            'balance' => $wallet_balance->balance-$order_details->total,
                        ]);
                    }else{
                        $shortage_balance =  $order_details->total-$wallet_balance->balance;
                        toastr_warning('Your wallet has '.float_amount_with_currency_symbol($shortage_balance).' shortage to service request this service. Please Credit your wallet first and try again.');
                        return back();
                    }

                }
                return redirect()->route('frontend.order.payment.success',$new_order_id);
            }
        }


        if ($request->selected_payment_gateway === 'cash_on_delivery' || $request->selected_payment_gateway === 'annual_maintenance_charge') {
            $order_details = Order::find($last_order_id);
            $random_order_id_1 = Str::random(30);
            $random_order_id_2 = Str::random(30);
            $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

            try {
                $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an service request #');
                $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new service request #');
                Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
            } catch (\Exception $e) {
                \Toastr::error($e->getMessage());
            }
            return redirect()->route('frontend.order.payment.success',$new_order_id);
        }
        if($request->selected_payment_gateway === 'manual_payment') {
            $order_details = Order::find($last_order_id);
            $random_order_id_1 = Str::random(30);
            $random_order_id_2 = Str::random(30);
            $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;


            $this->validate($request,[
                'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);
            if($request->hasFile('manual_payment_image')){
                $manual_payment_image = $request->manual_payment_image;
                $img_ext = $manual_payment_image->extension();

                $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
                if(in_array($img_ext,['jpg','jpeg','png','pdf'])){
                    $manual_image_path = 'assets/uploads/manual-payment/';
                    $manual_payment_image->move($manual_image_path,$manual_payment_image_name);

                    Order::where('id',$last_order_id)->update([
                        'manual_payment_image'=>$manual_payment_image_name
                    ]);
                }else{
                    return back()->with(['msg' => __('image type not supported'),'type' => 'danger']);
                }
            }

            try {
                $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an service request #');
                $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new service request #');
                Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
            } catch (\Exception $e) {
                \Toastr::error($e->getMessage());
            }
            return redirect()->route('frontend.order.payment.success',$new_order_id);

        }else{
            if ($request->selected_payment_gateway === 'paypal') {

                try{
                    $paypal_mode = getenv('PAYPAL_MODE');
                    $client_id = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_CLIENT_ID') : getenv('PAYPAL_LIVE_CLIENT_ID');
                    $client_secret = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_CLIENT_SECRET') : getenv('PAYPAL_LIVE_CLIENT_SECRET');
                    $app_id = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_APP_ID') : getenv('PAYPAL_LIVE_APP_ID');

                    $paypal = XgPaymentGateway::paypal();

                    $paypal->setClientId($client_id); // provide sandbox id if payment env set to true, otherwise provide live credentials
                    $paypal->setClientSecret($client_secret); // provide sandbox id if payment env set to true, otherwise provide live credentials
                    $paypal->setAppId($app_id); // provide sandbox id if payment env set to true, otherwise provide live credentials
                    $paypal->setCurrency($global_currency);
                    $paypal->setEnv($paypal_mode === 'sandbox'); //env must set as boolean, string will not work
                    $paypal->setExchangeRate($usd_conversion_rate); // if INR not set as currency

                    $redirect_url = $paypal->charge_customer([
                        'amount' => $total, // amount you want to charge from customer
                        'title' => $title, // payment title
                        'description' => $description, // payment description
                        'ipn_url' => route('frontend.paypal.ipn'), //you will get payment response in this route
                        'order_id' => $last_order_id, // your order number
                        'track' => \Str::random(36), // a random number to keep track of your payment
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id), //payment gateway will redirect here if the payment is failed
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id), // payment gateway will redirect here after success
                        'email' => $user_email, // user email
                        'name' => $user_name, // user name
                        'payment_type' => 'order', // which kind of payment your are receving from customer
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'paytm'){
                try{
                    $paytm_merchant_id = getenv('PAYTM_MERCHANT_ID');
                    $paytm_merchant_key = getenv('PAYTM_MERCHANT_KEY');
                    $paytm_merchant_website = getenv('PAYTM_MERCHANT_WEBSITE') ?? 'WEBSTAGING';
                    $paytm_channel = getenv('PAYTM_CHANNEL') ?? 'WEB';
                    $paytm_industry_type = getenv('PAYTM_INDUSTRY_TYPE') ?? 'Retail';
                    $paytm_env = getenv('PAYTM_ENVIRONMENT');

                    $paytm = XgPaymentGateway::paytm();
                    $paytm->setMerchantId($paytm_merchant_id);
                    $paytm->setMerchantKey($paytm_merchant_key);
                    $paytm->setMerchantWebsite($paytm_merchant_website);
                    $paytm->setChannel($paytm_channel);
                    $paytm->setIndustryType($paytm_industry_type);
                    $paytm->setCurrency($global_currency);
                    $paytm->setEnv($paytm_env === 'local'); // this must be type of boolean , string will not work
                    $paytm->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $paytm->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.paytm.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);

                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            }
            elseif($request->selected_payment_gateway === 'mollie'){
                try{
                    $mollie_key = getenv('MOLLIE_KEY');
                    $mollie = XgPaymentGateway::mollie();
                    $mollie->setApiKey($mollie_key);
                    $mollie->setCurrency($global_currency);
                    $mollie->setEnv(true); //env must set as boolean, string will not work
                    $mollie->setExchangeRate($usd_conversion_rate); // if INR not set as currency


                    $redirect_url = $mollie->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.mollie.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'stripe'){
                try{
                    $stripe_public_key = getenv('STRIPE_PUBLIC_KEY');
                    $stripe_secret_key = getenv('STRIPE_SECRET_KEY');
                    $stripe = XgPaymentGateway::stripe();
                    $stripe->setSecretKey($stripe_secret_key);
                    $stripe->setPublicKey($stripe_public_key);
                    $stripe->setCurrency($global_currency);
                    $stripe->setEnv(true); //env must set as boolean, string will not work
                    $stripe->setExchangeRate($usd_conversion_rate); // if INR not set as currency

                    $redirect_url = $stripe->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.stripe.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                }
                catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }


            }
            elseif($request->selected_payment_gateway === 'razorpay'){

                try{
                    $razorpay_api_key = getenv('RAZORPAY_API_KEY');
                    $razorpay_api_secret = getenv('RAZORPAY_API_SECRET');
                    $razorpay = XgPaymentGateway::razorpay();
                    $razorpay->setApiKey($razorpay_api_key);
                    $razorpay->setApiSecret($razorpay_api_secret);
                    $razorpay->setCurrency($global_currency);
                    $razorpay->setEnv(true); //env must set as boolean, string will not work
                    $razorpay->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $razorpay->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.razorpay.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'flutterwave'){
                try{
                    $flutterwave_public_key = getenv("FLW_PUBLIC_KEY");
                    $flutterwave_secret_key = getenv("FLW_SECRET_KEY");
                    $flutterwave_secret_hash = getenv("FLW_SECRET_HASH");

                    $flutterwave = XgPaymentGateway::flutterwave();
                    $flutterwave->setPublicKey($flutterwave_public_key);
                    $flutterwave->setSecretKey($flutterwave_secret_key);
                    $flutterwave->setCurrency($global_currency);
                    $flutterwave->setEnv(true); //env must set as boolean, string will not work
                    $flutterwave->setExchangeRate($usd_conversion_rate); // if NGN not set as currency

                    $redirect_url = $flutterwave->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.flutterwave.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                }
                catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'paystack'){
                try{
                    $paystack_public_key = getenv('PAYSTACK_PUBLIC_KEY');
                    $paystack_secret_key = getenv('PAYSTACK_SECRET_KEY');
                    $paystack_merchant_email = getenv('MERCHANT_EMAIL');

                    $paystack = XgPaymentGateway::paystack();
                    $paystack->setPublicKey($paystack_public_key);
                    $paystack->setSecretKey($paystack_secret_key);
                    $paystack->setMerchantEmail($paystack_merchant_email);
                    $paystack->setCurrency($global_currency);
                    $paystack->setEnv(true); //env must set as boolean, string will not work
                    $paystack->setExchangeRate($ngn_exchange_rate); // if NGN not set as currency

                    $redirect_url = $paystack->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.paystack.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' =>  $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                } catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'payfast'){

                try{

                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);


                    $payfast_merchant_id = getenv('PF_MERCHANT_ID');
                    $payfast_merchant_key = getenv('PF_MERCHANT_KEY');
                    $payfast_passphrase = getenv('PAYFAST_PASSPHRASE');
                    $payfast_env = getenv('PF_MERCHANT_ENV') === 'true';

                    $payfast = XgPaymentGateway::payfast();
                    $payfast->setMerchantId($payfast_merchant_id);
                    $payfast->setMerchantKey($payfast_merchant_key);
                    $payfast->setPassphrase($payfast_passphrase);
                    $payfast->setCurrency($global_currency);
                    $payfast->setEnv($payfast_env); //env must set as boolean, string will not work
                    $payfast->setExchangeRate($zar_exchange_rate); // if ZAR not set as currency

                    $redirect_url = $payfast->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.payfast.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$random_order_id_1.$last_order_id.$random_order_id_2),
                        'email' => $user_email,
                        'name' =>  $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;
                } catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'cashfree'){

                try{
                    $cashfree_env = getenv('CASHFREE_TEST_MODE') === 'true';
                    $cashfree_app_id = getenv('CASHFREE_APP_ID');
                    $cashfree_secret_key = getenv('CASHFREE_SECRET_KEY');

                    $cashfree = XgPaymentGateway::cashfree();
                    $cashfree->setAppId($cashfree_app_id);
                    $cashfree->setSecretKey($cashfree_secret_key);
                    $cashfree->setCurrency($global_currency);
                    $cashfree->setEnv($cashfree_env); //true means sandbox, false means live , //env must set as boolean, string will not work
                    $cashfree->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $cashfree->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.cashfree.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' =>  $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'instamojo'){

                try{
                    $instamojo_client_id = getenv('INSTAMOJO_CLIENT_ID');
                    $instamojo_client_secret = getenv('INSTAMOJO_CLIENT_SECRET');
                    $instamojo_env = getenv('INSTAMOJO_TEST_MODE') === 'true';

                    $instamojo = XgPaymentGateway::instamojo();
                    $instamojo->setClientId($instamojo_client_id);
                    $instamojo->setSecretKey($instamojo_client_secret);
                    $instamojo->setCurrency($global_currency);
                    $instamojo->setEnv($instamojo_env); //true mean sandbox mode , false means live mode //env must set as boolean, string will not work
                    $instamojo->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $instamojo->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.instamojo.ipn'),
                        'order_id' => $last_order_id,
                        'track' => 'asdfasdfsdf',
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'marcadopago'){
                try{
                    $mercadopago_client_id = getenv('MERCADO_PAGO_CLIENT_ID');
                    $mercadopago_client_secret = getenv('MERCADO_PAGO_CLIENT_SECRET');
                    $mercadopago_env =  getenv('MERCADO_PAGO_TEST_MOD') === 'true';

                    $marcadopago = XgPaymentGateway::marcadopago();
                    $marcadopago->setClientId($mercadopago_client_id);
                    $marcadopago->setClientSecret($mercadopago_client_secret);
                    $marcadopago->setCurrency($global_currency);
                    $marcadopago->setExchangeRate($brl_exchange_rate); // if BRL not set as currency, you must have to provide exchange rate for it
                    $marcadopago->setEnv($mercadopago_env); ////true mean sandbox mode , false means live mode
                    ///
                    $redirect_url = $marcadopago->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.marcadopago.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'midtrans'){

                try{
                    $midtrans_env =  getenv('MIDTRANS_ENVAIRONTMENT') === 'true';
                    $midtrans_server_key = getenv('MIDTRANS_SERVER_KEY');
                    $midtrans_client_key = getenv('MIDTRANS_CLIENT_KEY');

                    $midtrans = XgPaymentGateway::midtrans();
                    $midtrans->setClientKey($midtrans_client_key);
                    $midtrans->setServerKey($midtrans_server_key);
                    $midtrans->setCurrency($global_currency);
                    $midtrans->setEnv($midtrans_env); //true mean sandbox mode , false means live mode
                    $midtrans->setExchangeRate($idr_exchange_rate); // if IDR not set as currency

                    $redirect_url = $midtrans->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.midtrans.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'squareup'){

                try{
                    $squareup_env =  !empty(get_static_option('squareup_test_mode'));
                    $squareup_location_id = get_static_option('squareup_location_id');
                    $squareup_access_token = get_static_option('squareup_access_token');
                    $squareup_application_id = get_static_option('squareup_application_id');

                    $squareup = XgPaymentGateway::squareup();
                    $squareup->setLocationId($squareup_location_id);
                    $squareup->setAccessToken($squareup_access_token);
                    $squareup->setApplicationId($squareup_application_id);
                    $squareup->setCurrency($global_currency);
                    $squareup->setEnv($squareup_env);
                    $squareup->setExchangeRate($usd_conversion_rate); // if USD not set as currency


                    $redirect_url = $squareup->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.squareup.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'cinetpay'){
                try{
                    $cinetpay_env =  !empty(get_static_option('cinetpay_test_mode'));
                    $cinetpay_site_id = get_static_option('cinetpay_site_id');
                    $cinetpay_app_key = get_static_option('cinetpay_app_key');

                    $cinetpay = XgPaymentGateway::cinetpay();
                    $cinetpay->setAppKey($cinetpay_app_key);
                    $cinetpay->setSiteId($cinetpay_site_id);
                    $cinetpay->setCurrency($global_currency);
                    $cinetpay->setEnv($cinetpay_env);
                    $cinetpay->setExchangeRate($usd_conversion_rate); // if ['XOF', 'XAF', 'CDF', 'GNF', 'USD'] not set as currency


                    $redirect_url = $cinetpay->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.cinetpay.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            }
            elseif($request->selected_payment_gateway === 'paytabs'){
                try{

                    $paytabs_env =  !empty(get_static_option('paytabs_test_mode'));
                    $paytabs_region = get_static_option('paytabs_region');
                    $paytabs_profile_id = get_static_option('paytabs_profile_id');
                    $paytabs_server_key = get_static_option('paytabs_server_key');

                    $paytabs = XgPaymentGateway::paytabs();
                    $paytabs->setProfileId($paytabs_profile_id);
                    $paytabs->setRegion($paytabs_region);
                    $paytabs->setServerKey($paytabs_server_key);
                    $paytabs->setCurrency($global_currency);
                    $paytabs->setEnv($paytabs_env);
                    $paytabs->setExchangeRate($usd_conversion_rate); // if ['AED','EGP','SAR','OMR','JOD','USD'] not set as currency

                    $redirect_url = $paytabs->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.paytabs.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            }elseif($request->selected_payment_gateway === 'billplz'){
                try{

                    $billplz_env =  !empty(get_static_option('billplz_test_mode'));
                    $billplz_key =  get_static_option('billplz_key');
                    $billplz_xsignature =  get_static_option('billplz_xsignature');
                    $billplz_collection_name =  get_static_option('billplz_collection_name');

                    $billplz = XgPaymentGateway::billplz();
                    $billplz->setKey($billplz_key);
                    $billplz->setVersion('v4');
                    $billplz->setXsignature($billplz_xsignature);
                    $billplz->setCollectionName($billplz_collection_name);
                    $billplz->setCurrency($global_currency);
                    $billplz->setEnv($billplz_env);
                    $billplz->setExchangeRate($myr_exchange_rate); // if ['MYR'] not set as currency
                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

                    $redirect_url = $billplz->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.billplz.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$new_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            }elseif($request->selected_payment_gateway === 'zitopay'){
                try{


                    $zitopay_env =  !empty(get_static_option('zitopay_test_mode'));
                    $zitopay_username =  get_static_option('zitopay_username');

                    $zitopay = XgPaymentGateway::zitopay();
                    $zitopay->setUsername($zitopay_username);
                    $zitopay->setCurrency($global_currency);
                    $zitopay->setEnv($zitopay_env);
                    $zitopay->setExchangeRate($usd_conversion_rate);

                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

                    $redirect_url = $zitopay->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('frontend.zitopay.ipn'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$new_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            }else{
                //todo check qixer meta data for new payment gateway
                $module_meta =  new ModuleMetaData();
                $list = $module_meta->getAllPaymentGatewayList();
                if (in_array($request->selected_payment_gateway,$list)){
                    //todo call the module payment gateway customerCharge function
                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

                    $customerChargeMethod =  $module_meta->getChargeCustomerMethodNameByPaymentGatewayName($request->selected_payment_gateway);
                    try {
                        $returned_val = $customerChargeMethod([
                            'amount' => $total,
                            'title' => $title,
                            'description' => $description,
                            'ipn_url' => null,
                            'order_id' => $last_order_id,
                            'track' => \Str::random(36),
                            'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                            'success_url' => route(self::SUCCESS_ROUTE,$new_order_id),
                            'email' => $user_email,
                            'name' => $user_name,
                            'payment_type' => 'order',
                        ]);
                        if(is_array($returned_val) && isset($returned_val['route'])){
    					   $return_url = !empty($returned_val['route']) ? $returned_val['route'] : route('homepage');
    						return redirect()->away($return_url); 
    					}
					
                    }catch (\Exception $e){
                        toastr_error( $e->getMessage());
                        return back();
                    }
                }
            }

        }

        return redirect()->route('homepage');
    }

    //service review add
    public function serviceReviewAdd(Request $request)
    {

        if (empty($request->message)){
            return response()->json([
                'status' => 'danger',
                'message' => __("The Comments field is required")
            ]);
        }elseif (empty($request->rating)){
            return response()->json([
                'status' => 'danger',
                'message' => __("The rating field is required")
            ]);
        }

        $request->validate([
            'rating' => 'required',
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'message' => 'required',
        ]);

        //todo: add filter
        $order_count = Order::where(['service_id' => $request->service_id,'buyer_id' => Auth::guard('web')->user()->id,'status' => 2 ])->count();
        $get_order_id = Order::select('id', 'buyer_id', 'seller_id', 'service_id', 'status')
            ->where(['service_id' => $request->service_id,'buyer_id' => Auth::guard('web')->user()->id,'status' => 2 ])->first();

        if(!empty($order_count) && $order_count > 0){
            //todo add another filter to check this buyer already leave a review in this or not
            $old_review = Review::where(['service_id' => $request->service_id,'buyer_id' => Auth::guard('web')->user()->id])->count();
            if($old_review > 0){
                return response()->json([
                    'status' => 'danger',
                    'message' => __("you have already leave a review in this service")
                ]);
            }


            Review::create([
                'order_id' => $get_order_id->id,
                'service_id' => $request->service_id,
                'seller_id' => $request->seller_id,
                'buyer_id' => Auth::guard()->check() ? Auth::guard('web')->user()->id : NULL,
                'rating' => $request->rating,
                'name' => $request->name,
                'email' => $request->email,
                'type' => 1,
                'message' => $request->message,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => __("Success!! Thanks For Review---")
            ]);
        }

        return response()->json([
            'status' => 'danger',
            'message' => __("you can not leave review in this service...")
        ]);
    }

    //seller all services
    public function sellerAllServices($seller_id = null)
    {
        $all_services = Service::with('reviews')
            ->where(['seller_id' => $seller_id, 'status' => 1, 'is_service_on' => 1])
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->paginate(9);

        $single_service = Service::select('id','seller_id')
            ->where(['seller_id' => $seller_id, 'status' => 1, 'is_service_on' => 1])
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->first();

        $categories = Category::select('id', 'name')->where('status', 1)->get();
        $sub_categories = Subcategory::select('id', 'name')->where('status', 1)->get();
        if($all_services->count() >= 1){
            return view('frontend.pages.services.seller-all-services', compact('all_services','single_service', 'categories', 'sub_categories'));
        }
        abort(404);

    }

    //search by category
    public function searchByCategory(Request $request)
    {
        $services = Service::where('category_id', $request->category_id)
            ->where('status', 1)
            ->where('is_service_on', 1)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->where('seller_id',$request->seller_id)
            ->get();

        $single_service = Service::select('id','seller_id')
            ->where(['seller_id' => $request->seller_id, 'status' => 1, 'is_service_on' => 1])
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->first();

        return response()->json([
            'status' => 'success',
            'services' => $services,
            'result' => view('frontend.pages.services.partials.search-result', compact('services','single_service'))->render(),
        ]);
    }

    //search by category
    public function searchUsingCategory(Request $request)
    {
        header('Content-type: application/json');
        \Log::debug("Search using category started");
        $categoryID = $serviceCityId = $serviceAreaId = 0;
        $serviceProviderId = $request->service_provider_id ?? 0;
        $postCode = $request->post_code;
        $order_note = "";
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        if ($request->category_id != "" || $serviceProviderId !="" || $request->post_code != ""){
            
            if (is_string($request->category_id)) {
                $parts = explode(':', $request->category_id);
                $slugPart = trim($parts[0]);
                \Log::debug("slug Part : " . $slugPart);
                $categoryData = Category::where("slug", $slugPart)->first();

                if ($categoryData != null) {
                    $categoryID = $categoryData->id;
                } else {
                    $categoryID = 0;
                }
            } elseif (is_int($request->category_id)) {
                $categoryID = $request->category_id;
            }

            if (is_string($request->service_city_id)) {
                $cityData = ServiceCity::where("service_city", $request->service_city_id)->first();
                if ($cityData != null){
                    $serviceCityId = $cityData->id;
                } else {
                    $serviceCityId = 0;
                }
            } elseif (is_int($request->service_city_id)) {
                $serviceCityId = $request->service_city_id;
            }

            if (is_string($request->service_area_id)) {
                $serviceAreaData = ServiceArea::where("service_city_id", $serviceCityId)->where("service_area", $request->service_area_id)->first();
                if ($serviceAreaData != null) {
                    $serviceAreaId = $serviceAreaData->id;
                } else {
                    $serviceAreaId = 0;
                }
            } elseif (is_int($request->service_area_id)) {
                $serviceAreaId = $request->service_area_id;
            }

            \Log::debug("Category Id : " . $categoryID . "\nService City Id : " . $serviceCityId . "\nService Area Id : " . $serviceAreaId);

            if ($categoryID != 0){
                \Log::debug("Service Provider Id : " . $serviceProviderId);
                $services = Service::where('category_id', $categoryID)
                    ->where('status', 1)
                    ->where('is_service_on', 1)
                    ->when(!empty($serviceProviderId), function($q) use ($serviceProviderId) {
                        $q->where('seller_id', $serviceProviderId);
                    })
                    ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                        $q->whereHas('seller_subscription');
                    })
                    ->when(!empty($serviceCityId), function($q) use ($serviceCityId) {
                        $q->where('service_city_id', $serviceCityId);
                    })
                    ->when(!empty($serviceAreaId), function($q) use ($serviceAreaId) {
                        $q->where('service_area_id', $serviceAreaId);
                    })
                    ->orderBy('price', 'ASC')
                    ->get();
                if ($services->isEmpty()) {
                    $responseResult = [
                        "status" => "error",
                        "title" => "API Failed",
                        "message" => "No services found for current location"
                    ];
                    \Log::debug("No services found for current location \n Search using category ended with error");
                    exit(json_encode($responseResult));
                }

                // \Log::debug("Services : " . print_r($services,true));
                $sortedServices = [];
                $arrayLength = count($services);
                \Log::debug("Before for loop : " . $arrayLength );
                foreach($services as $service){
                    \Log::debug("service id: " . $service->id);
                    \Log::debug("seller id: " . $service->seller_id);
                    
                    $serviceIncludesData = Serviceaddresses::where("service_id", $service->id)
                    ->where("seller_id", $service->seller_id)
                    ->when(!empty($postCode), function($q) use ($postCode) {
                        $q->where('service_post_code', $postCode);
                    })
                    // ->where("service_post_code", $postCode)
                    ->get();
                    if ($serviceIncludesData->isNotEmpty()) {
                        \Log::debug("Inside if");
                        $sortedServices[] = $service;
                    } else {
                        \Log::debug("Service Includes Data is empty.");
                    }
                }
                $arrayLengthAfter = count($sortedServices);
                \Log::debug("Afte for loop : " . $arrayLengthAfter );

                $counter = 0;
                $selectedUser = null;
                $usersList = array_keys($sortedServices);
                $userCount = count($usersList);
                $randomIndex = rand(0, $userCount - 1);
                $selectedUser = $usersList[$randomIndex];
                \Log::debug("Randomly selected user : " . print_r($selectedUser,true) . "\n");
                $nextUser = self::getNextUser($counter, $usersList, $selectedUser);
                $userData = $sortedServices[$nextUser];
               \Log::debug("Processing user: $nextUser\n");
                \Log::debug("Seller Id : " . $userData->seller_id . "\n Services Id : " . $userData->id);
                $serviceIncludesData = Serviceinclude::where("service_id", $userData->id)->where("seller_id", $userData->seller_id)->get()->first();
                \Log::debug("Service Includes id from database : " . $serviceIncludesData->id . "\n Service include quantity : " .  $serviceIncludesData->include_service_quantity);
                
                $daysDataCollection = Day::where("seller_id", $userData->seller_id)->get();
                $schedulesData = null;

                if($daysDataCollection != null){
                    foreach ($daysDataCollection as $daysData) {
                        // \Log::debug(print_r($daysData,true));
                        \Log::debug("Days id from database : " . $daysData->id . "\n Days day : " .  $daysData->day);
                    
                        $schedulesData = Schedule::where("day_id", $daysData->id)
                                            ->where("seller_id", $userData->seller_id)
                                            ->where("status", 0)
                                            ->first();
                        if ($schedulesData) {
                            \Log::debug("Schedules id from database : " . $schedulesData->id . "\n schedulesData timing : " .  $schedulesData->schedule);
                            break; // Exit the loop as soon as a valid schedulesData is found
                        }
                    }

                    if (!$schedulesData) {
                        \Log::debug("No schedule time found for any day.");
                        $responseResult = [
                            "status" => "error",
                            "title" => "API Failed",
                            "message" => "No schedule time found for any day contact administrator."
                        ];
                    } else {
                        \Log::debug("service : " . $userData->id);
                        $createServiceRequestResult = self::createServiceRequest($userData->id, $userData->seller_id, 0, $userData->online_service_package_fee, $userData->choose_service_city, $userData->choose_service_area, $userData->choose_service_country, $serviceIncludesData->id, $serviceIncludesData->include_service_quantity, $schedulesData->schedule, $order_note, $name, $email, $phone );
                        $responseResult = json_decode($createServiceRequestResult);
                        \Log::debug("Search using category ended with success");
                    }
                } else {
                    $responseResult = [
                        "status" => "error",
                        "title" => "API Failed",
                        "message" => "No day crated by service provider contact administrator."
                    ];
                    \Log::debug("No day crated by service provider contact administrator. \n Search using category ended with error");
                }
            } else {
                $responseResult = [
                    "status" => "error",
                    "title" => "API Failed",
                    "message" => "Id Not Found for some input please provide proper inputs"
                ];
                \Log::debug("Id Not Found for some input please provide proper inputs \n Search using category ended with error");
            }
        } else {
            $responseResult = [
                "status" => "error",
                "title" => "API Failed",
                "message" => "Some inputs are empty"
            ];
            \Log::debug("Some inputs are empty \n Search using category ended with error");
        }
        exit(json_encode($responseResult));
    }

    public function getNextUser(&$counter, $usersList, $selectedUser) {
        // If a specific user is selected and exists in the list, continue with that user
        if ($selectedUser !== null && in_array($selectedUser, $usersList)) {
            return $selectedUser;
        }
        
        // If no specific user selected, use round-robin to select the next user
        $currentUser = $usersList[$counter];
        
        // Update the counter for the next round-robin user
        $counter = ($counter + 1) % count($usersList);
        
        return $currentUser;
    }

 
    public function createServiceRequest($serviceId, $sellerId, $isServiceOnline, $online_service_package_fee_final, $choose_service_city_final, $choose_service_area_final, $choose_service_country_final, $serviceIncludesDataId, $final_include_service_quantity, $schedule_final, $order_note_final, $finalaName, $finalEmail, $finalPhone) {
        header('Content-type: application/json');
        $todayDate = date('d-m-Y');
        $customerId = '';
        \Log::debug("Inside create service request");
        \Log::debug("Service is : " . $serviceId);
        $selected_payment_gateway = "annual_maintenance_charge";
        $seller_id = $sellerId;
        $service_id = $serviceId; 
        $is_service_online_ = 0;
        $online_service_package_fee = 0; 
        $name = $finalaName; 
        $email = $finalEmail; 
        $phone = $finalPhone; 
        $post_code = "";
        $address = ""; 
        $choose_service_city = $choose_service_city_final;
        $choose_service_area = $choose_service_area_final;
        $choose_service_country = $choose_service_country_final;  
        $date = $todayDate;
        $order_note = $order_note_final;
        $schedule = $schedule_final;
        $services = [
            [
                "id" => $serviceIncludesDataId,
                "quantity" => $final_include_service_quantity,
            ]
        ];
        \Log::debug("Service Includes Data Id : ". $serviceIncludesDataId . "Final include service quantity : " . $final_include_service_quantity);
        $servicesid= $serviceIncludesDataId;
        \Log::debug("service ID : ". $servicesid);
        $servicesquantity = $final_include_service_quantity ?? 1;
        \Log::debug("final_include_service_quantity : " . $final_include_service_quantity);
        $additionals = [""]; 

        $commission = AdminCommission::first();
        \Log::debug('User name : ' . $name . 
                    "\nSeller id : " . $seller_id . 
                    "\nSelected Payment Getway: " . $selected_payment_gateway .
                    "\nService Request : " . $service_id);
        if (empty($name) || empty($seller_id) || empty($selected_payment_gateway) || empty($service_id)){
            $status = [
                "status" => "error",
                "title" => "API Failed",
                "message" => "Please check some inputs are empty"
            ];
            \Log::debug("Result : " . print_r($status,true));
            return json_encode($status);
        }
        if($selected_payment_gateway=='cash_on_delivery' || $selected_payment_gateway == 'manual_payment' || $selected_payment_gateway === 'annual_maintenance_charge'){
            $payment_status='complete';
        }else{
            $payment_status='';
        }

        if (empty($seller_id)){
            \Toastr::error(__('Service Provider Id missing, please try another another service provider services'));
            $status = [
                "status" => "error",
                "title" => "API Failed",
                "message" => "Please Provide Service Provider Id"
            ];
            \Log::debug("Result : " . print_r($status,true));
            return json_encode($status);
        }
        if ($seller_id == Auth::guard('web')->id()){
            \Toastr::error(__('You can not book your own service'));
            $status = [
                "status" => "error",
                "title" => "API Failed",
                "message" => "You can not book your own service"
            ];
            \Log::debug("Result : " . print_r($status,true));
            return json_encode($status);
        }

        if (Auth::guard('web')->id() === NULL){
            $userData = User::where('email', $email)->first();
            if ($userData != null){
                    $customerId = $userData->id;
            } else {
                $email_verify_tokn = Str::random(8);
                $passowrd = $name."@".rand(0000, 9999);
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'username' => $name,
                    'phone' => $phone,
                    'password' => Hash::make($passowrd),
                    'service_city' => $choose_service_city,
                    'service_area' => $choose_service_area,
                    'country_id' => $choose_service_country,
                    'user_type' => 1,
                    'terms_conditions' => 1,
                    'email_verify_token'=> $email_verify_tokn,
                ]);
                if($user){
                    try {
                        $message = get_static_option('customer_register_message');
                        $subject = get_static_option('customer_register_message_subject');
                        $message = str_replace(["@name", "@type", "@username", "@password"],[$user->name, "customer", $user->name, $passowrd],$message);
                        Mail::to($user->email)->send(new BasicMail([
                            'subject' => get_static_option('customer_register_message_subject'),
                            'message' => $message
                        ]));

                        $message = get_static_option('user_email_verify_message');
                        $message = str_replace(["@name", "@email_verify_tokn"],[$user->name, $email_verify_tokn],$message);
                        Mail::to($user->email)->send(new BasicMail([
                            'subject' => get_static_option('user_email_verify_subject'),
                            'message' => $message
                        ]));
    
                        $message = get_static_option('user_register_message');
                        $message = str_replace(["@name", "@type","@username","@email"],[$user->name, "customer", $user->name, $user->email], $message);
                        Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                            'subject' => get_static_option('user_register_subject') ?? __('New User Registration'),
                            'message' => $message
                        ]));
                    } catch (\Exception $e) {
    
                    }
                }
                $customerId = $user->id;

                // User Register inside Doc8
                \Log::debug("User registration start inside Doc8");
                $nameParts = explode(' ', $name);
                $firstName = $nameParts[0];
                $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

                $cityData = ServiceCity::where("id", $choose_service_city)->first();
                if ($cityData != null){
                    $serviceCityName = $cityData->service_city;
                } else {
                    $serviceCityName = "NA";
                }

                $countryData = Country::where("id", $choose_service_country)->first();
                if ($countryData != null){
                    $countryName = $countryData->country;
                } else {
                    $countryName = "NA";
                }

                $userDataToSubmit = [
                    "email" => $email,
                    'firstname' => $firstName,
                    'lastname' => $lastName ?? "",
                    'useremail' => 'vandana@gmail.com',
                    'phonenumber' => $phone,
                    'address' => $address,
                    'city' => $serviceCityName,
                    'postalcode' => $post_code,
                    'state' => "NA",
                    'country' => $countryName,
                    'pannumber' => 'NA',
                    'aadhaarnumber' => 'NA',
                    'signingparty' => 'SA',
                    'company' => 'NA',
                    'companygstin' => '',
                    'companybusinesspannumber' => '',
                    'companyudyamnumber' => '',
                    'companyyoe' => '',
                    'companyaddress' => '',
                    'companycityname' => '',
                    'companypostalcode' => '',
                    'companystatename' => '',
                    'companycountryname' => '',
                    'producttype' => 'Service Form',
                    'iswhatsappmessagesend' => 'false',
                ];

                $resultOfUserRegister = Doc8yAPI::userRegister($userDataToSubmit);
                $decodedData = json_decode($resultOfUserRegister,true);
                \Log::debug("Result of User Register : " . print_r($decodedData,true));
            }
        }

        if (Auth::guard('web')->check() && Auth::guard('web')->user()->type === 0){
            \Toastr::error(__('service provider are not allowed to place service order'));
            $status = [
                "status" => "error",
                "title" => "API Failed",
                "message" => "service provider are not allowed to place service order"
            ];
            \Log::debug("Result : " . print_r($status,true));
            return json_encode($status);
        }

        if($selected_payment_gateway === 'manual_payment') {
            $this->validate($request,[
                'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);
        }

        $order_create='';
        if($is_service_online_ != 1 && Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1){
            Order::create([
                'service_id' => $service_id,
                'seller_id' => $seller_id,
                'buyer_id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : $customerId,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'post_code' => $post_code ?? 0000,
                'address' => $address,
                'city' => $choose_service_city,
                'area' => $choose_service_area,
                'country' => $choose_service_country,
                'date' => \Carbon\Carbon::parse($date)->format('D F d Y'),
                'schedule' => $shedule,
                'package_fee' => 0,
                'extra_service' => 0,
                'sub_total' => 0,
                'tax' => 0,
                'total' => 0,
                'commission_type' => $commission->commission_charge_type,
                'commission_charge' => $commission->commission_charge,
                'status' => 0,
                'order_note' => $order_note,
                'payment_gateway' => $selected_payment_gateway,
                'payment_status' => $payment_status,
                'file_id' => 0,
                'service_provider_file_link' => '',
                'customer_file_link' => '',
                'admin_file_link' => '',       
                'service_provider_signing_status' => 'Pending', 
                'customer_signing_status' => 'Pending',         
                'admin_signing_status' => 'Pending', 
            ]);
        }else{
            if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1 ){
                $order_create = Order::create([
                    'service_id' => $service_id,
                    'seller_id' => $seller_id,
                    'buyer_id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : $customerId,
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'post_code' => $post_code ?? 0000,
                    'address' => $address,
                    'city' => $choose_service_city,
                    'area' => $choose_service_area,
                    'country' => $choose_service_country,
                    'date' => '00.00.00',
                    'schedule' => '00.00.00',
                    'package_fee' => 0,
                    'extra_service' => 0,
                    'sub_total' => 0,
                    'tax' => 0,
                    'total' => 0,
                    'commission_type' => $commission->commission_charge_type,
                    'commission_charge' => $commission->commission_charge,
                    'status' => 0,
                    'is_order_online'=>$is_service_online_,
                    'order_note' => $order_note,
                    'payment_gateway' => $selected_payment_gateway,
                    'payment_status' => $payment_status,
                    'file_id' => 0,
                    'service_provider_file_link' => '',
                    'customer_file_link' => '',
                    'admin_file_link' => '',       
                    'service_provider_signing_status' => 'Pending', 
                    'customer_signing_status' => 'Pending',         
                    'admin_signing_status' => 'Pending',
                ]);
            }else{
               if( get_static_option('order_create_settings') !== 'anyone'){
                    toastr_error(__('You must login as a buyer to create an order.'));
                    return redirect()->back();
                }
                Order::create([
                    'service_id' => $service_id,
                    'seller_id' => $seller_id,
                    'buyer_id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : $customerId,
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'post_code' => $post_code ?? 0000,
                    'address' => $address ?? "" ,
                    'city' => $choose_service_city,
                    'area' => $choose_service_area,
                    'country' => $choose_service_country,
                    'date' => $is_service_online_ != 1 ? \Carbon\Carbon::parse($date)->format('D F d Y') : '00.00.00',
                    'schedule' => $is_service_online_ != 1 ? $schedule : '00.00.00',
                    'package_fee' => 0,
                    'extra_service' => 0,
                    'sub_total' => 0,
                    'tax' => 0,
                    'total' => 0,
                    'commission_type' => $commission->commission_charge_type,
                    'commission_charge' => $commission->commission_charge,
                    'status' => 0,
                    'order_note' => $order_note,
                    'payment_gateway' => $selected_payment_gateway,
                    'payment_status' => $payment_status,
                    'file_id' => 0,
                    'service_provider_file_link' => '',
                    'customer_file_link' => '',
                    'admin_file_link' => '',       
                    'service_provider_signing_status' => 'Pending', 
                    'customer_signing_status' => 'Pending',         
                    'admin_signing_status' => 'Pending', 
                ]);

            }
        }

        $last_order_id = DB::getPdo()->lastInsertId();

        if($order_create !=''){
            SupportTicket::create([
                'title' => 'New Order',
                'subject' => 'Service Request Created By '.$name,
                'status' => 'open',
                'priority' => 'high',
                'buyer_id' => Auth::guard('web')->user()->id,
                'seller_id' => $seller_id,
                'service_id' => $service_id,
                'order_id' => $last_order_id ,
            ]);
        }

        $service_sold_count = Service::select('sold_count')->where('id',$service_id)->first();
        Service::where('id',$service_id)->update(['sold_count'=>$service_sold_count->sold_count+1]);

        $servs = [];
        $service_ids = [];
        $package_fee = 0;

        if (isset($services) && is_array($services)) {

            foreach ($services as $key => $service) {
                $service_ids[] = $service['id'];
            }

            $included_services = Serviceinclude::whereIn('id', $service_ids)->get();

            if($is_service_online_ != 1) {
                \Log::debug("Inside if");
                foreach ($services as $key => $requested_service) {
                    $service = $included_services->find($requested_service['id']);
                    $servs[] = [
                        'id' => $service->id,
                        'title' => $service->include_service_title,
                        'unit_price' => $service->include_service_price,
                        'quantity' => $requested_service['quantity'],
                    ];
                    \Log::debug("Before OrderInclude package_fee : " . $package_fee );
                    \Log::debug("Quantity : " . $requested_service['quantity'] );
                    \Log::debug("Service Price : " . $service->include_service_price);

                    $package_fee += $requested_service['quantity'] * $service->include_service_price;

                    OrderInclude::create([
                        'order_id' => $last_order_id,
                        'title' => $service->include_service_title,
                        'price' => $service->include_service_price,
                        'quantity' => $requested_service['quantity'],
                    ]);
                    \Log::debug("After OrderInclude package_fee : " . $package_fee );
                }
            }else{
                \Log::debug("Inside if");
                foreach ($services as $key => $requested_service) {
                    $service = $included_services->find($requested_service['id']);
                    $servs[] = [
                        'id' => $service->id,
                        'title' => $service->include_service_title,
                        'unit_price' => $service->include_service_price,
                        'quantity' => $requested_service['quantity'],
                    ];
                    OrderInclude::create([
                        'order_id' => $last_order_id,
                        'title' => $service->include_service_title,
                        'price' => 0,
                        'quantity' => 0,
                    ]);
                }

                $package_fee = $online_service_package_fee;
            }
        }


        $addis = [];
        $additional_ids = [];
        $extra_service = 0;

        if($additionals['0'] != NULL){
            if (isset($additionals) && is_array($additionals)) {
                foreach ($additionals as $key => $additional) {
                    $additional_ids[] = $additional['id'];
                }

                $additional_services = Serviceadditional::whereIn('id', $additional_ids)->get();

                foreach ($request->additionals as $key => $requested_additional) {
                    $service = $additional_services->find($requested_additional['id']);
                    $addis[] = [
                        'id' => $service->id,
                        'title' => $service->additional_service_title,
                        'unit_price' => $service->additional_service_price,
                        'quantity' => $requested_additional['quantity'],
                    ];

                    $extra_service += $requested_additional['quantity'] * $service->additional_service_price;

                    OrderAdditional::create([
                        'order_id' => $last_order_id,
                        'title' => $service->additional_service_title,
                        'price' => $service->additional_service_price,
                        'quantity' => $requested_additional['quantity'],
                    ]);
                }
            }
        }


        $sub_total = 0;
        $total = 0;
        $tax_amount =0;

        $tax = Service::select('tax')->where('id', $service_id)->first();
        $service_details_for_book = Service::select('id','service_city_id')->where('id',$service_id)->first();
        $service_country =  optional(optional($service_details_for_book->serviceCity)->countryy)->id;
        $country_tax =  Tax::select('id','tax')->where('country_id',$service_country)->first();
        $sub_total = $package_fee + $extra_service;
        \Log::debug("package_fee" . $package_fee);
        \Log::debug("extra_service" . $extra_service);
        \Log::debug("sub_total" . $sub_total);
        if(!is_null($country_tax )){
            $tax_amount = ($sub_total * $country_tax->tax) / 100;
        }
        $total = $sub_total + $tax_amount;
        \Log::debug("total" . $total);
        //calculate coupon amount
        $coupon_code = '';
        $coupon_type = '';
        $coupon_amount = 0;

        if(!empty($request->coupon_code)){
            $coupon_code = ServiceCoupon::where('code',$request->coupon_code)->first();
            $current_date = date('Y-m-d');
            if(!empty($coupon_code)){
                if($coupon_code->seller_id == $request->seller_id){
                    if($coupon_code->code == $request->coupon_code && $coupon_code->expire_date > $current_date){
                        if($coupon_code->discount_type == 'percentage'){
                            $coupon_amount = ($total * $coupon_code->discount)/100;
                            $total = $total-$coupon_amount;
                            $coupon_code = $request->coupon_code;
                            $coupon_type = 'percentage';
                        }else{
                            $coupon_amount = $coupon_code->discount;
                            $total = $total-$coupon_amount;
                            $coupon_code = $request->coupon_code;
                            $coupon_type = 'amount';
                        }
                    }else{
                        $coupon_code = '';
                    }
                }else{
                    $coupon_code = '';
                }
            }
        }
        $commission_amount = 0;

        //commission amount
        if($commission->system_type == 'subscription'){
            if(subscriptionModuleExistsAndEnable('Subscription')){
                $commission_amount = 0;
                \Modules\Subscription\Entities\SellerSubscription::where('id', $request->seller_id)->update([
                    'connect' => DB::raw(sprintf("connect - %s",(int)strip_tags(get_static_option('set_number_of_connect')))),
                ]);
            }
        }else{
            if($commission->commission_charge_type=='percentage'){
                $commission_amount = ($sub_total*$commission->commission_charge)/100;
            }else{
                $commission_amount = $commission->commission_charge;
            }
        }

        Order::where('id', $last_order_id)->update([
            'package_fee' => $package_fee,
            'extra_service' => $extra_service,
            'sub_total' => $sub_total,
            'tax' => $tax_amount,
            'total' => $total,
            'coupon_code' => $coupon_code,
            'coupon_type' => $coupon_type,
            'coupon_amount' => $coupon_amount,
            'commission_amount' => $commission_amount,
        ]);

        //Send order notification to seller
        $seller = User::where('id',$seller_id)->first();
        $buyer_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : NULL;
        $order_message = __('You have a new service request');

        // admin notification add
        AdminNotification::create(['order_id' => $last_order_id]);

        // seller buyer notification
        $seller->notify(new OrderNotification($last_order_id,$service_id, $seller_id, $buyer_id,$order_message));

        // variable for all payment gateway
        $global_currency = get_static_option('site_global_currency');
        $usd_conversion_rate =  get_static_option('site_' . strtolower($global_currency) . '_to_usd_exchange_rate');
        $inr_exchange_rate = getenv('INR_EXCHANGE_RATE');
        $ngn_exchange_rate = getenv('NGN_EXCHANGE_RATE');
        $zar_exchange_rate = getenv('ZAR_EXCHANGE_RATE');
        $brl_exchange_rate = getenv('BRL_EXCHANGE_RATE');
        $idr_exchange_rate = getenv('IDR_EXCHANGE_RATE');
        $myr_exchange_rate = getenv('MYR_EXCHANGE_RATE');

        if(Auth::guard('web')->check()){
            $user_name = Auth::guard('web')->user()->name;
            $user_email = Auth::guard('web')->user()->email;
        }else{
            $user_name = $name;
            $user_email = $email;
        }

        $get_service_id_from_last_order = Order::select('service_id')->where('id',$last_order_id)->first();
        $title = Str::limit(strip_tags(optional($get_service_id_from_last_order->service)->title),20);
        $description = sprintf(__('Service Request id #%1$d Email: %2$s, Name: %3$s'),$last_order_id,$user_email,$user_name);

        //todo: check payment gateway is wallet or not
        if(moduleExists('Wallet')){
            if ($selected_payment_gateway === 'wallet') {
                $order_details = Order::find($last_order_id);
                $random_order_id_1 = Str::random(30);
                $random_order_id_2 = Str::random(30);
                $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;
                $buyer_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : NULL;
                $wallet_balance = Wallet::where('buyer_id',$buyer_id)->first();

                if(!empty($wallet_balance)){
                    if($wallet_balance->balance >= $order_details->total){
                        try {
                            $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an service request #');
                            $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new service request #');
                            Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                            Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                            Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                        } catch (\Exception $e) {
                            \Toastr::error($e->getMessage());
                        }
                        Order::where('id', $last_order_id)->update([
                            'payment_status' => 'complete',
                            'payment_gateway' => 'wallet',
                        ]);
                        Wallet::where('buyer_id',$buyer_id)->update([
                            'balance' => $wallet_balance->balance-$order_details->total,
                        ]);
                    }else{
                        $shortage_balance =  $order_details->total-$wallet_balance->balance;
                        toastr_warning('Your wallet has '.float_amount_with_currency_symbol($shortage_balance).' shortage to service request this service. Please Credit your wallet first and try again.');
                        return back();
                    }

                }

                $formDataToSubmit = [
                    "ServiceProviderName" => $seller->name,
                    "ServiceProviderEmail" => $seller->email,
                    "ServiceProviderPhone" => $seller->phone,
                    "ServiceName" => $service->include_service_title ?? "NA",
                    "ServiceAmount" => $total,
                    "CutomerName" => $name,
                    "CutomerEmail" => $email,
                    "CutomerPhone" => $phone,
                    "ServiceId" => $last_order_id,
                    "Date" => $todayDate
                ];

                $resultOfFormSubmiation = Doc8yAPI::createDuplicateDocumentAndRequest($seller->phone, $formDataToSubmit);
                $DecodeData = json_decode($resultOfFormSubmiation,true);
                \Log::debug("Result of Form Creation : " . print_r($DecodeData,true));
                if ($DecodeData['status'] == "error"){
                    $resultData = [
                        "status" => "success",
                        "title" => "API Success",
                        "message" => "New Service Request id : " . $last_order_id ." successfully created",
                        "servicerequestid" => $last_order_id,
                        "serviceprovidername" => $seller->name,
                        "serviceproviderid" => $seller->id,
                        "serviceprovideremail" => $seller->email,
                    ];
                    \Log::debug("Result : " . print_r($status,true));
                    exit(json_encode($resultData));
                } else {
                    $fileId = $DecodeData['fileid'];
                    $signingLink = $DecodeData['signinglinks'];
                    \Log::debug("File ID : " . $fileId . "\nSigning Link : " . $signingLink);

                    Order::where('id',$last_order_id)->update([
                        'file_id' => $fileId,
                        'service_provider_file_link' => $signingLink[0],
                        'customer_file_link' => $signingLink[1],
                        'admin_file_link' => $signingLink[2],
                    ]);

                    $resultData = [
                        "status" => "success",
                        "title" => "API Success",
                        "message" => "New Service Request id : " . $last_order_id ." successfully created",
                        "servicerequestid" => $last_order_id,
                        "serviceprovidername" => $seller->name,
                        "serviceproviderid" => $seller->id,
                        "serviceprovideremail" => $seller->email,
                    ];
                    \Log::debug("Result : " . print_r($resultData,true));
                    return json_encode($resultData);
                }
            }
        }

        if ($selected_payment_gateway === 'cash_on_delivery' || $selected_payment_gateway === 'annual_maintenance_charge') {
            $order_details = Order::find($last_order_id);
            $random_order_id_1 = Str::random(30);
            $random_order_id_2 = Str::random(30);
            $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

            try {
                $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an service Rrequest #');
                $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new service request #');
                Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
            } catch (\Exception $e) {
                \Toastr::error($e->getMessage());
            }
            
            $formDataToSubmit = [
                "ServiceProviderName" => $seller->name,
                "ServiceProviderEmail" => $seller->email,
                "ServiceProviderPhone" => $seller->phone,
                "ServiceName" => $service->include_service_title ?? "NA",
                "ServiceAmount" => $total,
                "CutomerName" => $name,
                "CutomerEmail" => $email,
                "CutomerPhone" => $phone,
                "ServiceId" => $last_order_id,
                "Date" => $todayDate
            ];
            // $resultOfFormSubmiation = Doc8yAPI::sumbitData($seller->phone, $formDataToSubmit);
            $resultOfFormSubmiation = Doc8yAPI::createDuplicateDocumentAndRequest($seller->phone, $formDataToSubmit);
            $decodeData = json_decode($resultOfFormSubmiation,true);
            \Log::debug("Result of Form Creation : " . print_r($decodeData,true));
            
            // if ($decodeData['status'] == 'error'){
            //     Order::where('id', $last_order_id)->delete();
            //     $status = [
            //         "status" => "error",
            //         "title" => "API Failed",
            //         "message" => "Creation of document get failed",
            //     ];
            //     exit(json_encode($status));
            // }
            if ($decodeData['status'] == "error"){
                $resultData = [
                    "status" => "success",
                    "title" => "API Success",
                    "message" => "New Service Request id : " . $last_order_id ." successfully created. But Form aganist it not created in doc8.",
                    "servicerequestid" => $last_order_id,
                    "serviceprovidername" => $seller->name,
                    "serviceproviderid" => $seller->id,
                    "serviceprovideremail" => $seller->email,
                ];
                \Log::debug("Result : " . print_r($resultData,true));
                return json_encode($resultData);
            } else {
                $fileId = $decodeData['file_id'];
                $signingLink = $decodeData['signinglinks'];
                \Log::debug("File ID : " . $fileId . "\nSigning Link : " . print_r($signingLink,true));

                Order::where('id',$last_order_id)->update([
                    'file_id' => $fileId,
                    'service_provider_file_link' => $signingLink[0],
                    'customer_file_link' => $signingLink[1],
                    'admin_file_link' => $signingLink[2],
                ]);

                $resultData = [
                    "status" => "success",
                    "title" => "API Success",
                    "message" => "New service request id : " . $last_order_id ." successfully created",
                    "servicerequestid" => $last_order_id,
                    "serviceprovidername" => $seller->name,
                    "serviceproviderid" => $seller->id,
                    "serviceprovideremail" => $seller->email,
                ];
                \Log::debug("Result : " . print_r($resultData,true));
                return json_encode($resultData);
            }
        }
    }

    //search by sub category
    public function searchBySubcategory(Request $request)
    {
        $services = Service::where('subcategory_id', $request->subcategory_id)
            ->where('status', 1)
            ->where('is_service_on', 1)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->where('seller_id',$request->seller_id)
            ->get();

        $single_service = Service::select('id','seller_id')
            ->where(['seller_id' => $request->seller_id, 'status' => 1, 'is_service_on' => 1])
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->first();

        return response()->json([
            'status' => 'success',
            'services' => $services,
            'result' => view('frontend.pages.services.partials.search-result', compact('services','single_service'))->render(),
        ]);
    }

    //search by rating
    public function searchByRating(Request $request)
    {
        $this->validate($request, ['rating' => 'numeric|min:1|max:5']);

        $rating = $request->rating;
        $services = Service::with('reviews')
            ->where('status', 1)
            ->where('is_service_on', 1)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->where('seller_id',$request->seller_id)
            ->whereHas('reviews', function ($q) use ($rating) {
                $q->havingRaw('AVG(s8_reviews.rating) >= ?', [$rating])
                    ->havingRaw('AVG(s8_reviews.rating) <= ?', [$rating + 1]);
            })->get();


        $single_service = Service::select('id','seller_id')
            ->where(['seller_id' => $request->seller_id, 'status' => 1, 'is_service_on' => 1])
            ->first();

        return response()->json([
            'status' => 'success',
            'services' => $services,
            'result' => view('frontend.pages.services.partials.search-result', compact('services','single_service'))->render(),
        ]);
    }

    //search by sub sorting
    public function searchBySorting(Request $request)
    {

        if ($request['sorting'] == 'latest_service') {
            $services = Service::orderBy('id', 'Desc')
                ->where('status', 1)
                ->where('is_service_on', 1)
                ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                    $q->whereHas('seller_subscription');
                })
                ->where('seller_id',$request->seller_id)
                ->get();
        }
        if ($request['sorting'] == 'price_lowest') {
            $services = Service::orderBy('price', 'Asc')
                ->where('status', 1)
                ->where('is_service_on', 1)
                ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                    $q->whereHas('seller_subscription');
                })
                ->where('seller_id',$request->seller_id)
                ->get();
        }
        if ($request['sorting'] == 'price_highest') {
            $services = Service::orderBy('price', 'Desc')
                ->where('status', 1)
                ->where('is_service_on', 1)
                ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                    $q->whereHas('seller_subscription');
                })
                ->where('seller_id',$request->seller_id)
                ->get();
        }

        $single_service = Service::select('id','seller_id')
            ->where(['seller_id' => $request->seller_id, 'status' => 1, 'is_service_on' => 1])
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->first();
        return response()->json([
            'status' => 'success',
            'services' => $services,
            'result' => view('frontend.pages.services.partials.search-result', compact('services','single_service'))->render(),
        ]);
    }

    //search by category from all services
    public function allSearchByCategory(Request $request)
    {
        $services = Service::where('category_id', $request->category_id)->where('status', 1)->where('is_service_on', 1)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->get();

        return response()->json([
            'status' => 'success',
            'services' => $services,
            'result' => view('frontend.pages.services.partials.search-result', compact('services'))->render(),
        ]);
    }

    //search by subcategory from all services
    public function allSearchBySubcategory(Request $request)
    {
        $services = Service::where('subcategory_id', $request->subcategory_id)->where('status', 1)->where('is_service_on', 1)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->get();

        return response()->json([
            'status' => 'success',
            'services' => $services,
            'result' => view('frontend.pages.services.partials.search-result', compact('services'))->render(),
        ]);
    }

    //search by rating from all services
    public function allSearchByRating(Request $request)
    {
        $this->validate($request, ['rating' => 'numeric|min:1|max:5']);

        $rating = $request->rating;
        $services = Service::with('reviews')
            ->where('status', 1)
            ->where('is_service_on', 1)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->whereHas('reviews', function ($q) use ($rating) {
                $q->havingRaw('AVG(s8_reviews.rating) >= ?', [$rating])
                    ->havingRaw('AVG(s8_reviews.rating) <= ?', [$rating + 1]);
            })->get();

        return response()->json([
            'status' => 'success',
            'services' => $services,
            'result' => view('frontend.pages.services.partials.search-result', compact('services'))->render(),
        ]);
    }

    //search by sorting from all services
    public function allSearchBySorting(Request $request)
    {

        if ($request['sorting'] == 'latest_service') {
            $services = Service::orderBy('id', 'Desc')->where('status', 1)->where('is_service_on', 1)
                ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                    $q->whereHas('seller_subscription');
                })
                ->get();
        }
        if ($request['sorting'] == 'price_lowest') {
            $services = Service::orderBy('price', 'Asc')->where('status', 1)->where('is_service_on', 1)
                ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                    $q->whereHas('seller_subscription');
                })
                ->get();
        }
        if ($request['sorting'] == 'price_highest') {
            $services = Service::orderBy('price', 'Desc')->where('status', 1)->where('is_service_on', 1)
                ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                    $q->whereHas('seller_subscription');
                })
                ->get();
        }

        return response()->json([
            'status' => 'success',
            'services' => $services,
            'result' => view('frontend.pages.services.partials.search-result', compact('services'))->render(),
        ]);
    }

    //category wise services
    public function categoryServices($slug = null)
    {
        $category = Category::select('id','name', 'description')->where('slug',$slug)->first();
        $subcategory_under_category = Subcategory::where('category_id',$category->id)->orderBy('name','asc')->take(20)->get()->transform(function($item) {
            $item->total_service = Service::where('subcategory_id',$item->id)->count();
            return $item;
        });

        $all_services = collect([]);

        $service_quyery = Service::query();
        $service_quyery->with('reviews');

        if (!empty(request()->get('q') )){
            $service_quyery->Where('title', 'LIKE', '%' . trim(strip_tags(request()->get('q'))) . '%')
                ->orWhere('description', 'LIKE', '%' . trim(strip_tags(request()->get('q'))) . '%');
        }
        if(!empty(request()->get('rating'))){
            $rating = (int) request()->get('rating');
            $service_quyery->whereHas('reviews', function ($q) use ($rating) {
                $q->groupBy('reviews.id')
                    ->havingRaw('AVG(s8_reviews.rating) >= ?', [$rating])
                    ->havingRaw('AVG(s8_reviews.rating) < ?', [$rating + 1]);
            });
        }

        if(!empty(request()->get('sortby'))){

            if (request()->get('sortby') == 'latest_service') {
                $service_quyery->orderBy('id', 'Desc');
            }
            if (request()->get('sortby') == 'lowest_price') {
                $service_quyery->orderBy('price', 'Asc');
            }
            if (request()->get('sortby') == 'highest_price') {
                $service_quyery->orderBy('price', 'Desc');
            }
        }

        if(!is_null($category)){
            $all_services = $service_quyery->where(['category_id' => $category->id, 'status' => 1, 'is_service_on' => 1])
                ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                    $q->whereHas('seller_subscription');
                })
                ->paginate(9);
        }

        return view('frontend.pages.services.category-services', compact(
            'all_services',
            'category',
            'subcategory_under_category'
        ));
    }

    //sub category wise services
    public function subCategoryServices($slug = null)
    {
        $subcategory = Subcategory::select('id','name', 'slug', 'description')->where('slug',$slug)->first();
        // get child category
        $child_category_under_category = ChildCategory::where('sub_category_id',$subcategory->id)->orderBy('name','asc')->take(20)->get()->transform(function($item) {
            $item->total_service = Service::where('child_category_id',$item->id)->count();
            return $item;
        });

        $all_services = collect([]);

        $service_quyery = Service::query();
        $service_quyery->with('reviews');

        if (!empty(request()->get('q') )){
            $service_quyery ->Where('title', 'LIKE', '%' . trim(strip_tags(request()->get('q'))) . '%')
                ->orWhere('description', 'LIKE', '%' . trim(strip_tags(request()->get('q'))) . '%');
        }

        if(!empty(request()->get('rating'))){
            $rating = (int) request()->get('rating');
            $service_quyery->whereHas('reviews', function ($q) use ($rating) {
                $q->groupBy('reviews.id')
                    ->havingRaw('AVG(s8_reviews.rating) >= ?', [$rating])
                    ->havingRaw('AVG(s8_reviews.rating) < ?', [$rating + 1]);
            });
        }

        if(!empty(request()->get('sortby'))){

            if (request()->get('sortby') == 'latest_service') {
                $service_quyery->orderBy('id', 'Desc');
            }
            if (request()->get('sortby') == 'lowest_price') {
                $service_quyery->orderBy('price', 'Asc');
            }
            if (request()->get('sortby') == 'highest_price') {
                $service_quyery->orderBy('price', 'Desc');
            }

        }

        if(!is_null($subcategory)){
            $all_services = $service_quyery->where(['subcategory_id' => $subcategory->id, 'status' => 1, 'is_service_on' => 1])
                ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                    $q->whereHas('seller_subscription');
                })
                ->paginate(12);
        }

        return view('frontend.pages.services.subcategory-services', compact(
            'all_services',
            'subcategory',
            'child_category_under_category'
        ));
    }

    // child category wise service get
    public function childCategoryServices($slug = null)
    {

        $child_category = ChildCategory::select('id','name', 'slug', 'description')->where('slug',$slug)->first();
        $all_services = collect([]);
        $service_quyery = Service::query();
        $service_quyery->with('reviews');

        if (!empty(request()->get('q') )){
            $service_quyery ->Where('title', 'LIKE', '%' . trim(strip_tags(request()->get('q'))) . '%')
                ->orWhere('description', 'LIKE', '%' . trim(strip_tags(request()->get('q'))) . '%');
        }

        if(!empty(request()->get('rating'))){
            $rating = (int) request()->get('rating');
            $service_quyery->whereHas('reviews', function ($q) use ($rating) {
                $q->groupBy('reviews.id')
                    ->havingRaw('AVG(s8_reviews.rating) >= ?', [$rating])
                    ->havingRaw('AVG(s8_reviews.rating) < ?', [$rating + 1]);
            });
        }

        if(!empty(request()->get('sortby'))){

            if (request()->get('sortby') == 'latest_service') {
                $service_quyery->orderBy('id', 'Desc');
            }
            if (request()->get('sortby') == 'lowest_price') {
                $service_quyery->orderBy('price', 'Asc');
            }
            if (request()->get('sortby') == 'highest_price') {
                $service_quyery->orderBy('price', 'Desc');
            }

        }



        if(!is_null($child_category)){
            $all_services = $service_quyery->where(['child_category_id' => $child_category->id, 'status' => 1, 'is_service_on' => 1])
                ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                    $q->whereHas('seller_subscription');
                })
                ->paginate(12);
        }

        return view('frontend.pages.services.child-category-services', compact(
            'all_services',
            'child_category'
        ));
    }

    //all featured service
    public function allfeaturedService()
    {
        $all_featurd_service = Service::select('id','title','image','description','price','slug','seller_id')
            ->with('reviews')
            ->where(['status'=>1,'is_service_on'=>1,'featured'=>1])
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->paginate(9);
        return view('frontend.pages.services.featured-services',compact('all_featurd_service'));
    }

    //all popular service
    public function allPopularService()
    {
        $all_popular_service = Service::select('id','title','image','description','price','slug','seller_id','view','featured')
            ->with('reviews')
            ->where(['status'=>1,'is_service_on'=>1])
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->orderBy('view','DESC')
            ->paginate(9);
        return view('frontend.pages.services.popular-service',compact('all_popular_service'));
    }

    //all categories
    public function allCategory()
    {
        $all_category = Category::select('id','name','slug','image')->with('services')
            ->whereHas('services')
            ->get();
        return view('frontend.pages.category.all-category',compact('all_category'));
    }
    
    public function allSellers()
    {
        $seller_lists = User::with(['review','sellerVerify','order'])->where('user_type',0)->orderBy('id','desc')->paginate(12);
        return view('frontend.pages.seller.all-seller',compact('seller_lists'));
    }
    
    //category wise services
    public function loadMoreSubCategories(Request $request)
    {
        $subcategory_under_category = Subcategory::where('category_id',$request->catId)->orderBy('name','asc')->skip($request->total)->take(12)->get()->transform(function($item) {
            $item->total_service = Service::where('subcategory_id',$item->id)->count();
            return $item;
        });
      $markup = '';
          if(!is_null($subcategory_under_category)){
            foreach($subcategory_under_category as $sub_cat){
              $markup .= '<div class="col-lg-3 col-sm-6 margin-top-30 category-child">
                            <div class="single-category style-02 wow fadeInUp" data-wow-delay=".2s">
                                <div class="icon category-bg-thumb-format" '.render_background_image_markup_by_attachment_id($sub_cat->image).'></div>
                                <div class="category-contents">
                                    <h4 class="category-title"> <a href="'. route('service.list.subcategory',$sub_cat->slug) .'">'. $sub_cat->name.'</a> </h4>
                                    <span class="category-para">  '. sprintf(__('%s Service'),$sub_cat->total_service).' </span>
                                </div>
                            </div>
                        </div>';
            }
        }
         return response(['markup' => $markup ,'total' => $request->total + 12]);
    }

    // sub category wish service
    public function loadMoreChildCategories(Request $request)
    {
        $child_category_under_category = ChildCategory::where('sub_category_id',$request->catId)->orderBy('name','asc')->skip($request->total)->take(12)->get()->transform(function($item) {
            $item->total_service = Service::where('child_category_id',$item->id)->count();
            return $item;
        });
      $markup = '';
          if(!is_null($child_category_under_category)){
            foreach($child_category_under_category as $child_cat){
              $markup .= '<div class="col-lg-3 col-sm-6 margin-top-30 category-child">
                            <div class="single-category style-02 wow fadeInUp" data-wow-delay=".2s">
                                <div class="icon category-bg-thumb-format" '.render_background_image_markup_by_attachment_id($child_cat->image).'></div>
                                <div class="category-contents">
                                    <h4 class="category-title"> <a href="'. route('service.list.subcategory',$child_cat->slug) .'">'. $child_cat->name.'</a> </h4>
                                    <span class="category-para">  '. sprintf(__('%s Service'),$child_cat->total_service).' </span>
                                </div>
                            </div>
                        </div>';
            }
        }
         return response(['markup' => $markup ,'total' => $request->total + 12]);
    }

}
