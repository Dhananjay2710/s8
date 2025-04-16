<?php

namespace App\Http\Controllers\Api;

use App\AdminNotification;
use App\Actions\Media\MediaHelper;
use App\AdminCommission;
use App\Category;
use App\Subcategory;
use App\Day;
use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Notifications\OrderNotification;
use App\Order;
use App\OrderAdditional;
use App\OrderInclude;
use App\Review;
use App\Schedule;
use App\Service;
use App\Servicebenifit;
use App\ServiceCity;
use App\ServiceCoupon;
use App\Serviceinclude;
use App\Serviceaddresses;
use App\Tax;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;
use App\Helpers\StringMatchHelper;
use App\Helpers\TokenGenrateHelper;


class ServiceController extends Controller
{
    
    public function embedCodeTest(){
        $iframe_string = '<iframe width="560" height="315" src="https://www.youtube.com/embed/Uc5i1AKaSTs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        // $result = '';
        preg_match('/src="([^"]+)"/', $iframe_string, $match);
        //$url = $match[1];
        // $result = Str::after($sr,'src="');
        
        return response()->error([
            'message'=>  end($match),
        ]);
        
    }
    //top selling services
    public function topService(){
        
        $top_services_query = Service::query()->select('id','title','image','price','seller_id')
            ->with('reviews_for_mobile')
            ->whereHas('reviews_for_mobile')
            ->where('status','1')
            ->where('is_service_on','1')
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            });
            
            
        if(!empty(request()->get('state_id'))){
            $top_services_query->where('service_city_id',request()->get('state_id'));
        }
          
            
        $top_services_query->orderBy('sold_count','Desc');
        
        if(!empty(request()->get('paginate'))){
            $top_services = $top_services_query->paginate(request()->get('paginate'))->withQueryString();
        }else{
             $top_services = $top_services_query->take(10)->get();
        }
        
       
            
        $service_image=[];
        $service_seller_name=[];
        $reviewer_image=[];
        foreach($top_services as $service){
            $service_image[]= get_attachment_image_by_id($service->image);
            $service_seller_name[]= optional($service->seller_for_mobile)->name;
            foreach($service->reviews_for_mobile as $review){
                $reviewer_image[]=get_attachment_image_by_id(optional($review->buyer_for_mobile)->image);
            }
        }

        if($top_services){
            return response()->success([
                'top_services'=>$top_services,
                'service_image'=>$service_image,
                'service_seller_name'=>$service_seller_name,
                'reviewer_image'=>$reviewer_image,
            ]);
        }
        return response()->error([
            'message'=>__('Service Not Available'),
        ]);
    }

    //latest services
    public function latestService()
    {
        $latest_services_query = Service::query()->select('id','title','image','price','seller_id')
            ->with('reviews_for_mobile')
            ->where('status','1')
            ->where('is_service_on','1')
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
        ;
            
        if(!empty(request()->get('state_id'))){
            $latest_services_query->where('service_city_id',request()->get('state_id'));
        }
        
        $latest_services  = $latest_services_query->latest()
            ->take(10)
            ->get();
        $service_image=[];
        $service_seller_name=[];
        $reviewer_image=[];
        foreach($latest_services as $service){
            $service_image[]= get_attachment_image_by_id($service->image);
            $service_seller_name[]= optional($service->seller_for_mobile)->name;
            foreach($service->reviews_for_mobile as $review){
                $reviewer_image[]=get_attachment_image_by_id(optional($review->buyer_for_mobile)->image);
            }
        }

        if($latest_services){
            return response()->success([
                'latest_services'=>$latest_services,
                'service_image'=>$service_image,
                'service_seller_name'=>$service_seller_name,
                'reviewer_image'=>$reviewer_image,
            ]);
        }
        return response()->error([
            'message'=>__('Service Not Available'),
        ]);
    }

    // service details
    public function serviceDetails($id=null){
    
        $service_details =  Service::with('serviceFaq')->where('id',$id)->where('status',1)->where('is_service_on',1)->first();
        
        if(auth('sanctum')->check() && auth('sanctum')->user()->user_type === 0){
            $service_details = Service::with('serviceFaq')->where('id',$id)->first();
        }

        if(is_null($service_details)){
            return response(["msg" => __("service not found")],500);
        }
        $service_image = get_attachment_image_by_id($service_details->image);
        $service_seller_name = optional($service_details->seller_for_mobile)->name;
        $service_seller_image_Id = optional($service_details->seller_for_mobile)->image;
        $service_seller_image = get_attachment_image_by_id($service_seller_image_Id);
        $seller_complete_order = Order::where('seller_id',$service_details->seller_id)->where('status',2)->count();
        $seller_cancelled_order = Order::where('seller_id', $service_details->seller_id)->where('status', 4)->count();
        $seller_rating = Review::where('seller_id', $service_details->seller_id)->avg('rating');
        $seller_rating_percentage_value = round($seller_rating * 20);
        $seller_from = optional(optional($service_details->seller_for_mobile)->country)->country;
        $seller_since = User::select('created_at')->where('id', $service_details->seller_id)->where('user_status', 1)->first();
        $service_includes = Serviceinclude::select('id','service_id','include_service_title')->where('service_id', $service_details->id)->get();
        $service_benifits = Servicebenifit::select('id','service_id','benifits')->where('service_id', $service_details->id)->get();

        $order_completion_rate = 0;
        if ($seller_complete_order > 0 || $seller_cancelled_order > 0) {
            $order_completion_rate = $seller_complete_order / ($seller_complete_order + $seller_cancelled_order) * 100;
        }

        $service_reviews = $service_details->reviews_for_mobile->transform(function($item){
            $buyer_details = User::find($item->buyer_id);
            $item->buyer_name = !is_null($buyer_details) ? $buyer_details->name : 'Unknown';// $item->buyer_id;
            $image_url =  get_attachment_image_by_id(optional($buyer_details)->image) ? get_attachment_image_by_id($buyer_details->image)['img_url'] : null;
            $item->buyer_image = !is_null($buyer_details) ? $image_url : null;// $item->buyer_id;
            return $item;
            
        });
        $reviewer_image=[];
        foreach($service_details->reviews_for_mobile as $review){
            $reviewer_image[]=get_attachment_image_by_id(optional($review->buyer_for_mobile)->image);
        }

        $service_video_url = $service_details->video;
         preg_match('/src="([^"]+)"/', $service_video_url, $service_video_url_match);

        if($service_details){
            return response()->success([
                'service_details'=>$service_details,
                'service_image'=>$service_image,
                'service_seller_name'=>$service_seller_name,
                'service_seller_image'=> is_array($service_seller_image) && !empty($service_seller_image) ? $service_seller_image : null,
                'seller_complete_order'=>$seller_complete_order,
                'seller_rating'=>$seller_rating_percentage_value,
                'order_completion_rate'=>round($order_completion_rate),
                'seller_from'=>$seller_from,
                'seller_since'=>$seller_since,
                'service_includes'=>$service_includes,
                'service_benifits'=>$service_benifits,
                'service_reviews'=>$service_reviews,
                'reviewer_image'=>$reviewer_image,
                'video_url' => is_null($service_video_url) ? null : end($service_video_url_match)
            ]);
        }
        return response()->error([
            'message'=>__('Service Not Available'),
        ]);
    }

    //service rating
    public function serviceRating(Request $request,$id=null){
        $request->validate([
            'rating' => 'required|integer',
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'message' => 'required',
        ]);

        $service_details = Service::select('id','seller_id')->where('id',$id)->first();
        $order_count = Order::where(['service_id' => $service_details->id,'buyer_id' => auth('sanctum')->user()->id,'status' => 'complete' ])->count();
        
        
        if(!empty($order_count) && $order_count > 0){
            //todo add another filter to check this buyer already leave a review in this or not
            $old_review = Review::where(['service_id' => $service_details->id,'buyer_id' => auth('sanctum')->user()->id])->count();
            if($old_review > 0){
                 return response()->error([
                        'message'=>__('you have already leave a review in this service'),
                    ]); 
            }
             Review::create([
                'service_id' => $service_details->id,
                'seller_id' => $service_details->seller_id,
                'buyer_id' => auth('sanctum')->user()->id,
                'rating' => $request->rating,
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
            ]);
    
            return response()->success([
                'message'=>__('Review Added Success'),
            ]);
        }
        
        return response()->error([
            'message'=>__('You need to buy this service to leave feedback'),
        ]);
        
    }

    //all services
    public function allServices(){
        $all_services_query = Service::query()->with('seller_for_mobile','reviews_for_mobile','serviceCity')
            ->select('id','seller_id','title','price','image','is_service_online','service_city_id')
            ->where('status', 1)
            ->where('is_service_on', 1)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            });
            
        if(!empty(request()->get('state_id'))){
            $all_services_query->where('service_city_id',request()->get('state_id'));
        }
        
        $all_services = $all_services_query->OrderBy('id','desc')
            ->paginate(10)
            ->withQueryString();

        if($all_services){
            foreach($all_services as $service){
                $service_image[] = get_attachment_image_by_id($service->image);
                $service_country[] = optional(optional($service->serviceCity)->countryy)->country;
            }
            return response()->success([
                'all_services'=>$all_services,
                'service_image'=>$service_image,
            ]);
        }
        
        return response()->error([
            'message'=>__('Service Not Available'),
        ]);
    }

    //service search by category
    public function searchByCategory($category_id=null)
    {

        $all_services_query = Service::query()->with('seller_for_mobile','reviews_for_mobile','serviceCity')
            ->select('id','seller_id','title','price','image','is_service_online','service_city_id')
            ->where('status', 1)
            ->where('is_service_on', 1)
            ->where('category_id', $category_id)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            });
            
            if(!empty(request()->get('state_id'))){
                $all_services_query->where('service_city_id',request()->get('state_id'));
            }
        
        $all_services  =   $all_services_query->OrderBy('id','desc')
            ->paginate(10)
            ->withQueryString();

        if($all_services->count() >=1){
            foreach($all_services as $service){
                $service_image[] = get_attachment_image_by_id($service->image);
                $service_country[] = optional(optional($service->serviceCity)->countryy)->country;
            }
            return response()->success([
                'all_services'=>$all_services,
                'service_image'=>$service_image,
            ]);
        }
        return response()->error([
            'message'=>__('Service Not Found'),
        ]);
    }

    //service search by category and subcategory
    public function searchBySubCategory($category_id,$subcategory_id)
    {

        $all_services = Service::with('seller_for_mobile','reviews_for_mobile','serviceCity')
            ->select('id','seller_id','title','price','image','is_service_online','service_city_id')
            ->where('status', 1)
            ->where('is_service_on', 1)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->where('category_id', $category_id)
            ->where('subcategory_id', $subcategory_id)
            ->OrderBy('id','desc')
            ->paginate(10)
             ->withQueryString();

        if($all_services->count() >=1){
            foreach($all_services as $service){
                $service_image[] = get_attachment_image_by_id($service->image);
                $service_country[] = optional(optional($service->serviceCity)->countryy)->country;
            }
            return response()->success([
                'all_services'=>$all_services,
                'service_image'=>$service_image,
            ]);
        }
        return response()->error([
            'message'=>__('Service Not Found'),
        ]);
    }

    //service search by category, subcategory and rating
    public function searchByRating($category_id=null,$subcategory_id=null,$rating=null)
    {
        if(isset($rating)){
            $rating = (int) $rating;
            $all_services = Service::with('seller_for_mobile','reviews_for_mobile','serviceCity')
                ->select('id','seller_id','title','price','image','is_service_online','service_city_id')
                ->where('status', 1)
                ->where('is_service_on', 1)
                ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                    $q->whereHas('seller_subscription');
                })
                ->where('category_id', $category_id)
                ->where('subcategory_id', $subcategory_id);

            // $all_services = $all_services->whereHas('reviews', function ($q) use ($rating) {
            //     $q->groupBy('reviews.id')
            //         ->havingRaw('AVG(reviews.rating) >= ?', [$rating])
            //         ->havingRaw('AVG(reviews.rating) < ?', [$rating + 1]);
            // });
            $all_services = $all_services->whereHas('reviews', function ($q) use ($rating) {
                $q->groupBy('reviews.id')
                    ->havingRaw('AVG(s8_reviews.rating) >= ?', [$rating])
                    ->havingRaw('AVG(s8_reviews.rating) < ?', [$rating + 1]);
            });
            
            if(!empty(request()->get('state_id'))){
                $all_services->where('service_city_id',request()->get('state_id'));
            }
            
            $all_services = $all_services>OrderBy('id','desc')
                ->paginate(10)
                 ->withQueryString();

            $service_image[]='';
            if($all_services->count() >=1){
                foreach($all_services as $service){
                    $service_image[] = get_attachment_image_by_id($service->image);
                    $service_country[] = optional(optional($service->serviceCity)->countryy)->country;
                }
                return response()->success([
                    'all_services'=>$all_services,
                    'service_image'=>$service_image,
                ]);
            }
            return response()->error([
                'message'=>__('Service Not Found'),
            ]);
        }

    }

    //service search by category, subcategory and rating and sort by
    public function searchBySort()
    {
        $service_quyery = Service::query();
        $service_quyery->with('seller_for_mobile','reviews_for_mobile','serviceCity');
        $service_quyery->select('id','seller_id','title','price','image','is_service_online','service_city_id')
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            });
        if(!empty(request()->get('cat'))){
            $service_quyery->where('category_id',request()->get('cat'));
        }
        if(!empty(request()->get('subcat'))){
            $service_quyery->where('subcategory_id',request()->get('subcat'));
        }
        if(!empty(request()->get('rating'))){
            $rating = (int) request()->get('rating');
            // $service_quyery->whereHas('reviews', function ($q) use ($rating) {
            //     $q->groupBy('reviews.id')
            //         ->havingRaw('AVG(reviews.rating) >= ?', [$rating])
            //         ->havingRaw('AVG(reviews.rating) < ?', [$rating + 1]);
            // });
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
        $all_services = $service_quyery->where('status', 1)
            ->where('is_service_on', 1)
            ->OrderBy('id','desc')
            ->paginate(10)
             ->withQueryString();

        $service_image = [];
        if($all_services->count() >=1){
            foreach($all_services as $service){
                $service_image[] = get_attachment_image_by_id($service->image);
                $service_country[] = optional(optional($service->serviceCity)->countryy)->country;
            }
            return response()->success([
                'all_services'=>$all_services,
                'service_image'=>$service_image,
            ]);
        }
        return response()->error([
            'message'=>__('Service Not Found'),
        ]);

    }

    //service book
    public function serviceBook($id=null)
    {
        $service = Service::with('serviceAdditional','serviceInclude','serviceBenifit','seller_for_mobile','serviceCity')
            ->select('id','seller_id','title','price','tax','image','is_service_online','service_city_id')
            ->where('status', 1)
            ->where('is_service_on', 1)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            })
            ->where('id', $id)
            ->first();

        $service_image[]='';
        if(isset($service)){
            $service_image[] = get_attachment_image_by_id($service->image);
            return response()->success([
                'service'=>$service,
                'service_image'=>$service_image,
            ]);
        }
        return response()->error([
            'message'=>__('Service Not Found'),
        ]);
    }

    //get schedule by seller
    public function scheduleByDay($day,$seller_id)
    {
        $get_day = Day::select('id', 'day','total_day')
            ->where('day', $day)
            ->where('seller_id', $seller_id)
            ->first();

        if (!is_null($get_day)) {
            $schedules = Schedule::select('schedule')
                ->where('seller_id', $seller_id)
                ->where('day_id', $get_day->id)
                ->get();

            if($schedules->count() >= 1){
                return response()->json([
                    'day' => $get_day,
                    'schedules' => $schedules,
                ]);
            }
            return response()->json([
                'status' => __('no schedule'),
            ]);
        }
        return response()->json([
            'status' => __('no schedule'),
        ]);
    }

    // coupon apply
    public function couponApply(Request $request)
    {
        if(!isset($request->coupon_code)){
            return response()->error([
                'message'=>__('Please enter your coupon'),
            ]);
        }

        $coupon_code = ServiceCoupon::where('code',$request->coupon_code)->first();
        $current_date = date('Y-m-d');

        if(!empty($coupon_code)){

            if($coupon_code->seller_id != $request->seller_id){
                return response()->error([
                    'message'=>__('Coupon is not Applicable for this Service'),
                ]);
            }

            if($coupon_code->code == $request->coupon_code && $coupon_code->expire_date > $current_date){

                if($coupon_code->discount_type == 'percentage'){
                    $coupon_amount = ($request->total_amount * $coupon_code->discount)/100;
                    return response()->success([
                        'status' => __('success'),
                        'coupon_amount' => $coupon_amount,
                    ]);
                }else{
                    $coupon_amount = $coupon_code->discount;
                    return response()->success([
                        'status' => __('success'),
                        'coupon_amount' => $coupon_amount,
                    ]);
                }
            }

            if($coupon_code->expire_date < $current_date ){
                return response()->error([
                    'status' => __('expired'),
                    'msg' => __('Coupon is Expired'),
                ]);
            }
        }else{
            return response()->error([
                'status' => __('invalid'),
                'msg' => __('Coupon is Invalid'),
            ]);
        }

    }

    // service city
    public function serviceCity()
    {
        $service_city = ServiceCity::query()->select('id','service_city')->where('status',1)->get();
        
        if($service_city){
            return response()->success([
                'service_city'=>$service_city,
            ]);
        }
        return response()->error([
            'message'=>__('Service City Not Available'),
        ]);
    }

    // home search
    public function homeSearch(Request $request)
    {
        $services = Service::query();
        $services->with('seller_for_mobile','reviews_for_mobile','serviceCity');
        $services->where('status',1)
            ->where('is_service_on',1)
            ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
                $q->whereHas('seller_subscription');
            });

        if(!empty($request->search_text)){
            $services->Where('title', 'LIKE', '%' . $request->search_text . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search_text . '%');
        }
        
        $is_online = (int) $request->is_service_online;
        $services->where('is_service_online',$is_online);

        if(!empty($request->service_city_id)){
            $services->where('service_city_id',$request->service_city_id);
        }

        $services =  $services->orderBy('id', 'desc')->get();

        $service_image = [];
        if(!is_null($services)){
            foreach($services as $service){
                $service_image[] = get_attachment_image_by_id($service->image);
            }
            return response()->success([
                'services'=> $services,
                'service_image'=>$service_image,
            ]);
        }

        return response()->error([
            'message'=>__('No Service Found'),
        ]);
    }

    // order create
    public function order(Request $request)
    {
        $is_service_online_bool = $request->is_service_online === '1';
        if($is_service_online_bool){
            $request->validate([
                'name' => 'required|max:191',
                'email' => 'required|max:191',
                'phone' => 'required|max:191',
                'address' => 'nullable|max:191',
                'choose_service_city' => 'nullable',
                'choose_service_area' => 'nullable',
                'choose_service_country' => 'nullable',
                'date' => 'nullable|max:191',
                'schedule' => 'nullable|max:191',
                'include_services' => 'nullable',
                'include_services.*.title' => 'nullable',
                'include_services.*.price' => 'nullable',
                'include_services.*.quantity' => 'nullable',
            ]);
        }

        $commission = AdminCommission::first();

        if($request->selected_payment_gateway=='cash_on_delivery' || $request->selected_payment_gateway == 'manual_payment'){
            $payment_status='pending';
        }else{
            $payment_status='pending';
        }


        if (empty($request->seller_id)){
            return response()->error([
                'message'=>__('Seller Id missing, please try another seller services'),
            ]);
        }

        if($request->selected_payment_gateway === 'manual_payment') {
            $this->validate($request,[
                'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);
        }

        Order::create([
            'service_id' => $request->service_id,
            'seller_id' => $request->seller_id,
            'buyer_id' => Auth::guard('sanctum')->check() ? Auth::guard('sanctum')->user()->id : NULL,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => !$is_service_online_bool ? $request->post_code : '0000',
            'address' => !$is_service_online_bool ? $request->address : 'n/a',
            'city' => $request->choose_service_city,
            'area' => $request->choose_service_area,
            'country' => $request->choose_service_country,
            'date' => !$is_service_online_bool ? $request->date : '00.00.00',
            'schedule' => !$is_service_online_bool ? $request->schedule : '00.00.00',
            'package_fee' => 0,
            'is_order_online' => $is_service_online_bool ? 1 : '0',
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
        ]);

        $last_order_id = DB::getPdo()->lastInsertId();
        $service_details = Service::where('id',$request->service_id)->first();
        $service_sold_count = Service::select('sold_count')->where('id',$request->service_id)->first();
        
        Service::where('id',$request->service_id)->update(['sold_count'=> $service_sold_count->sold_count+1]);

        $package_fee = $is_service_online_bool ? $service_details->price : 0;
        
        if(isset($request->include_services)){
            $included_services = !empty($request->include_services) ? json_decode($request->include_services,true) : (object) [];
            foreach (current($included_services) as $requested_service) {
                $package_fee += $requested_service['quantity'] * $requested_service['price'];
                OrderInclude::create([
                    'order_id' => $last_order_id,
                    'title' => $requested_service['title'],
                    'price' => $requested_service['price'],
                    'quantity' => $requested_service['quantity'],
                ]);
            }
        }elseif($request->is_service_online === 0 && count($request->include_services) < 1){
            return response()->error([
                'message'=> __('Include service required'),
            ]);
        }

        $extra_service = 0;
        if(!empty($request->additional_services)){
            $additional_services = !empty($request->additional_services) ? json_decode($request->additional_services,true) : (object) [];
            foreach (current($additional_services) as $requested_additional) {
                $extra_service += $requested_additional['quantity'] * $requested_additional['additional_service_price'];

                OrderAdditional::create([
                    'order_id' => $last_order_id,
                    'title' => $requested_additional['additional_service_title'],
                    'price' => $requested_additional['additional_service_price'],
                    'quantity' => $requested_additional['quantity'],
                ]);
            }
        }

        $tax_amount = 0;
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


        //commission amount
        $commission_amount = 0;
        if($commission->commission_charge_type=='percentage'){
            $commission_amount = ($sub_total*$commission->commission_charge)/100;
        }else{
            $commission_amount = $commission->commission_charge;
        }

        if($request->selected_payment_gateway === 'manual_payment') {
            if ($image = $request->file('manual_payment_image')) {
                $imageName = 'manual_attachment_'.time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move('assets/uploads/manual-payment/', $imageName);
                Order::where('id',$last_order_id)->update([
                    'manual_payment_image'=>$imageName
                ]);
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
        $order_message = __('You have a new service request');
        $seller->notify(new OrderNotification($last_order_id,$request->service_id, $request->seller_id, $request->buyer_id,$order_message));

        $order_details = Order::find($last_order_id);

        //Send order email to buyer for cash on delivery or annual maintenance charge
        try {
            $subject = __('You have successfully created order');
            Mail::to($order_details->email)->send(new OrderMail($subject,$order_details));
            Mail::to($seller->email)->send(new OrderMail($subject,$order_details));
            Mail::to(get_static_option('site_global_email'))->send(new OrderMail($subject,$order_details));
        } catch (\Exception $e) {
            //return response()->error($e->getMessage());
        }
        //todo send success/cancel url
        //todo is it has paytm parameter then return paytm object instance
        $random_order_id_1 = Str::random(30);
        $random_order_id_2 = Str::random(30);
        $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;
        $paytm_details = null;

        if ($request->has('paytm') && !empty($request->has('paytm'))){
            $user_info = Auth::guard('sanctum')->user();
            $title = Str::limit(strip_tags($service_details->title),20);
            $description = sprintf(__('Service Request id #%1$d Email: %2$s, Name: %3$s'),$last_order_id,$user_info->email,$user_info->name);
            $paytm_details = XgPaymentGateway::paytm()->charge_customer([
                'amount' => $total,
                'title' => $title,
                'description' => $description,
                'ipn_url' => route('frontend.paytm.ipn'),
                'order_id' => $last_order_id,
                'track' => \Str::random(36),
                'success_url' => route('frontend.order.payment.success',$new_order_id),
                'cancel_url' => route('frontend.order.payment.cancel.static',$last_order_id),
                'email' => $user_info->email,
                'name' => $user_info->name,
                'payment_type' => 'order',
            ]);
        }
        \Log::debug("Response : " . print_r([
            'order_id'=> $last_order_id,
            'service_sold_count'=> $service_sold_count,
            'package_fee'=> float_amount_with_currency_symbol($package_fee),
            'extra_service'=>float_amount_with_currency_symbol($extra_service),
            'sub_total'=>float_amount_with_currency_symbol($sub_total),
            'tax_amount'=>float_amount_with_currency_symbol($tax_amount),
            'total'=>float_amount_with_currency_symbol($total),
            'coupon_code'=>$coupon_code,
            'coupon_type'=>$coupon_type,
            'coupon_amount'=>float_amount_with_currency_symbol($coupon_amount),
            'commission_amount'=>float_amount_with_currency_symbol($commission_amount),
            'success_url' => route('frontend.order.payment.success',$new_order_id),
            'cancel_url' => route('frontend.order.payment.cancel.static',$last_order_id),
            'paytm_details' => $paytm_details
        ],true));

        return response()->success([
            'order_id'=> $last_order_id,
            'service_sold_count'=> $service_sold_count,
            'package_fee'=> float_amount_with_currency_symbol($package_fee),
            'extra_service'=>float_amount_with_currency_symbol($extra_service),
            'sub_total'=>float_amount_with_currency_symbol($sub_total),
            'tax_amount'=>float_amount_with_currency_symbol($tax_amount),
            'total'=>float_amount_with_currency_symbol($total),
            'coupon_code'=>$coupon_code,
            'coupon_type'=>$coupon_type,
            'coupon_amount'=>float_amount_with_currency_symbol($coupon_amount),
            'commission_amount'=>float_amount_with_currency_symbol($commission_amount),
            'success_url' => route('frontend.order.payment.success',$new_order_id),
            'cancel_url' => route('frontend.order.payment.cancel.static',$last_order_id),
            'paytm_details' => $paytm_details
        ]);
    }

    public function searchServiceProviderAndAssignServiceRequest(Request $request)
    {
        header('Content-type: application/json');
        \Log::debug("Search using category started");
        $slugPart = $slugSubPart = ""; 
        $categoryID = $serviceCityId = $serviceAreaId = $subCategoryID =  0;
        $serviceProviderId = $request->service_provider_id ?? 0;
        $postCode = $request->post_code;
        $order_note = "";
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $service8TicketId = $request->service_ticket_id;
        $problemTitle = $request->problem_title;
        $ticketPipelineId = $request->ticket_pipeline_id;
        $ticketPipelineName = $request->ticket_pipeline_name;
        $responseResult = [];

        if ($request->category_id != "" || $serviceProviderId !="" || $request->post_code != ""){
            if (is_string($request->category_id)) {
                $parts = explode(':', $request->category_id);
                $slugPart = trim($parts[0]);
                $slugSubPart = trim($parts[1]);
                $categoryData = Category::where("slug", $slugPart)->first();
                $subCategoryData = Subcategory::where("slug", $slugSubPart)->first();
                if ($categoryData != null) {
                    $categoryID = $categoryData->id;
                } else {
                    $categoryID = 0;
                }

                if ($subCategoryData != null) {
                    $subCategoryID = $subCategoryData->id;
                } else {
                    $subCategoryID = 0;
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
                    ->when(!empty($subCategoryID), function($q) use ($subCategoryID) {
                        $q->where('subcategory_id', $subCategoryID);
                    })
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
                // \Log::debug("Services : " . print_r($services,true));
                if ($services->isEmpty()) {
                    $responseResult[] = [
                        "status" => "error",
                        "title" => "API Failed",
                        "message" => "No services found for current  based on service area and city. Please try again later",
                    ];
                    \Log::debug("No services found for current location \n Search using category ended with error");
                    exit(json_encode($responseResult));
                }

                $sortedServices = [];
                $arrayLength = count($services);
                \Log::debug("Before for loop : " . $arrayLength );
                foreach($services as $service){                    
                    $serviceIncludesData = Serviceaddresses::where("service_id", $service->id)
                    ->where("seller_id", $service->seller_id)
                    ->when(!empty($postCode), function($q) use ($postCode) {
                        $q->where('service_post_code', $postCode);
                    })
                    ->get();
                    if ($serviceIncludesData->isNotEmpty()) {
                        \Log::debug("Inside if");
                        if (StringMatchHelper::hasMatchingWord($service->title, $problemTitle, $slugPart, $slugSubPart)) {
                            $sortedServices[] = $service;
                            \Log::debug("True, Service added : Service Name and Provlem has matching words");
                        } else {
                            \Log::debug("False, Service Name and Problem has not found any matching words");
                        }                        
                    } else {
                        \Log::debug("Service Includes Data is empty.");
                    }
                }
                $arrayLengthAfter = count($sortedServices);
                \Log::debug("Afte for loop : " . $arrayLengthAfter );

                if ($arrayLengthAfter == 0){
                    \Log::debug("Insinde if array length after is 0");
                    $services = Service::where('category_id', $categoryID)
                    ->when(!empty($subCategoryID), function($q) use ($subCategoryID) {
                        $q->where('subcategory_id', $subCategoryID);
                    })
                    ->where('status', 1)
                    ->where('is_service_on', 1)
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
                    $lengthOfServicesList = count($services);
                    \Log::debug("Length of Services List : " . $lengthOfServicesList);
                    if ($lengthOfServicesList == 0){
                        $responseResult[] = [
                            "status" => "error",
                            "title" => "API Failed",
                            "message" => "No Service Provider Found",
                        ];
                    }
                    foreach($services as $service){
                        $serviceIncludesData = Serviceaddresses::where("service_id", $service->id)
                        ->where("seller_id", $service->seller_id)
                        ->when(!empty($postCode), function($q) use ($postCode) {
                            $q->where('service_post_code', $postCode);
                        })
                        ->get();
                        if ($serviceIncludesData->isNotEmpty()) {
                            $sortedServices[] = $service;
                        } else {
                            \Log::debug("Service Includes Data is empty.");
                        }
                    }
                }
                $counter = 0;
                $selectedUser = null;
                $serviceList = array_keys($sortedServices);
                $serviceCount = count($serviceList);
                if ($serviceCount == 0 ){
                    $responseResult[] = [
                        "status" => "error",
                        "title" => "API Failed",
                        "message" => "No Service Provider Found 2",
                    ];
                }
                // New code
                $allSortedServices = self::getNextUsers($counter, $serviceList, $selectedUser);

                foreach ($allSortedServices as $nextService) {
                    if (!isset($sortedServices[$nextService])) {
                        \Log::debug("User $nextService not found in sortedServices.");
                        continue;
                    }

                    $userData = $sortedServices[$nextService];
                    \Log::debug("Processing user: $nextService\n");
                    \Log::debug("Seller Id : " . $userData->seller_id . "\n Services Id : " . $userData->id);

                    $serviceIncludesData = Serviceinclude::where("service_id", $userData->id)->where("seller_id", $userData->seller_id)->get()->first();
                    if ($serviceIncludesData) {
                        \Log::debug("Service Includes id from database : " . $serviceIncludesData->id . "\n Service include quantity : " . $serviceIncludesData->include_service_quantity);
                    } else {
                        \Log::debug("No service includes data found for service_id: " . $userData->id);
                        continue;
                    }

                    $daysDataCollection = Day::where("seller_id", $userData->seller_id)->get();
                    $schedulesData = null;

                    if ($daysDataCollection->isNotEmpty()) {
                        foreach ($daysDataCollection as $daysData) {
                            \Log::debug("Days id from database : " . $daysData->id . "\n Days day : " . $daysData->day);

                            $schedulesData = Schedule::where("day_id", $daysData->id)
                                                    ->where("seller_id", $userData->seller_id)
                                                    ->where("status", 0)
                                                    ->first();
                            if ($schedulesData) {
                                break;
                            }
                        }

                        if (!$schedulesData) {
                            \Log::debug("No schedule time found for any day.");
                            $responseResult[] = [
                                "status" => "error",
                                "title" => "API Failed",
                                "message" => "No schedule time found for any day contact administrator for user: $nextService."
                            ];
                        } else {
                            \Log::debug("service : " . $userData->id);
                            $createServiceRequestResult = self::createServiceRequest(
                                $userData->id, $userData->seller_id, 0, $userData->online_service_package_fee,
                                $userData->choose_service_city, $userData->choose_service_area,
                                $userData->choose_service_country, $serviceIncludesData->id,
                                $serviceIncludesData->include_service_quantity, $schedulesData->schedule,
                                $order_note, $name, $email, $phone, $service8TicketId, $problemTitle, $ticketPipelineId, $ticketPipelineName
                            );
                            $responseResult[] = json_decode($createServiceRequestResult, true);
                        }
                    } else {
                        $responseResult[] = [
                            "status" => "error",
                            "title" => "API Failed",
                            "message" => "No day created by service provider contact administrator for user: $nextService."
                        ];
                        \Log::debug("No day created by service provider contact administrator for user: $nextService. Search using category ended with error.");
                    }
                }
            } else {
                $responseResult[] = [
                    "status" => "error",
                    "title" => "API Failed",
                    "message" => "Id Not Found for some input please provide proper inputs"
                ];
                \Log::debug("Id Not Found for some input please provide proper inputs \n Search using category ended with error");
            }
        } else {
            $responseResult[] = [
                "status" => "error",
                "title" => "API Failed",
                "message" => "Some inputs are empty"
            ];
            \Log::debug("Some inputs are empty \n Search using category ended with error");
        }
        exit(json_encode($responseResult));
    }

    public function getNextUsers(&$counter, $serviceList, $selectedUser) {
        $serviceCount = count($serviceList);
        if ($serviceCount > 5) {
            $serviceCount = 5;
        } else {
            $serviceCount = $serviceCount;
        }
        if ($selectedUser !== null && in_array($selectedUser, $serviceList)) {
            return [$selectedUser];
        }
    
        $selectedUsers = [];
        for ($i = 0; $i < $serviceCount; $i++) {
            $selectedUsers[] = $serviceList[$counter];
            $counter = ($counter + 1) % $serviceCount;
        }
    
        return $selectedUsers;
    }

    public function createServiceRequest($serviceId, $sellerId, $isServiceOnline, $online_service_package_fee_final, $choose_service_city_final, $choose_service_area_final, $choose_service_country_final, $serviceIncludesDataId, $final_include_service_quantity, $schedule_final, $order_note_final, $finalaName, $finalEmail, $finalPhone, $service8TicketId, $problemTitle, $ticketPipelineId, $ticketPipelineName) {
        header('Content-type: application/json');
        date_default_timezone_set('Asia/Kolkata');
        $createdDate = date('Y-m-d H:i:s');
        $todayDate = date('d-m-Y');
        $customerId = '';
        $selected_payment_gateway = "annual_maintenance_charge";
        $seller_id = $sellerId;
        $service_id = $serviceId; 
        $is_service_online_ = $online_service_package_fee = 0; 
        $name = $finalaName; 
        $email = $finalEmail; 
        $phone = $finalPhone; 
        $post_code = $address = ""; 
        $choose_service_city = $choose_service_city_final;
        $choose_service_area = $choose_service_area_final;
        $choose_service_country = $choose_service_country_final;  
        $date = $todayDate;
        $order_note = $order_note_final;
        $schedule = $schedule_final;
        $service8TicketId = $service8TicketId;
        $problemTitle = $problemTitle;
        $services = [
            [
                "id" => $serviceIncludesDataId,
                "quantity" => $final_include_service_quantity,
            ]
        ];
        $servicesid= $serviceIncludesDataId;
        $servicesquantity = $final_include_service_quantity ?? 1;
        $additionals = [""]; 

        $commission = AdminCommission::first();
        \Log::debug('User name : ' . $name . 
                    "\n Seller id : " . $seller_id . 
                    "\n Selected Payment Getway : " . $selected_payment_gateway .
                    "\n Service Request : " . $service_id);
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
                'service_ticket_id' => $service8TicketId,
                'problem_title' => $problemTitle,
                'ticket_pipeline_id' => $ticketPipelineId,
                'ticket_pipeline_name' => $ticketPipelineName,
                'created_at' => $createdDate,
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
                    'service_ticket_id' => $service8TicketId,
                    'problem_title' =>  $problemTitle,
                    'ticket_pipeline_id' => $ticketPipelineId,
                    'ticket_pipeline_name' => $ticketPipelineName,
                    'created_at' => $createdDate,
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
                    'service_ticket_id' => $service8TicketId,
                    'problem_title' =>  $problemTitle,
                    'ticket_pipeline_id' => $ticketPipelineId,
                    'ticket_pipeline_name' => $ticketPipelineName,
                    'created_at' => $createdDate,
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

    public function imageUpload(Request $request){
        $this->validate($request, [
            'file' => 'nullable|mimes:jpg,jpeg,png,gif|max:11000'
        ]);
        MediaHelper::insert_media_image($request);
        $last_image_id = DB::getPdo()->lastInsertId();
        return response()->success([
            'image_id'=> $last_image_id,
        ]);
    }

    public function manualPaymentImage(Request $request){
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,bmp'
        ]);

        if(isset($request->order_id)){
            if ($image = $request->file('image')) {
                $imageName = 'manual_attachment_'.time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move('assets/uploads/manual-payment/', $imageName);

                $update = Order::where('id',$request->order_id)->update([
                    'manual_payment_image'=>$imageName
                ]);
            }
        }
    }
    public function paymentStatusUpdate(Request $request){
          $request->validate([
            'order_id' => 'required|integer'
        ]);
        $order_details = Order::find($request->order_id);

        $user_id = Auth::guard("sanctum")->id();
        $order_details->payment_status = 'complete';
        $order_details->save();

        if($request->has('job_id') && $request->job_id === $order_details->job_post_id){
            BuyerJob::where('id',$request->job_id)->update(['status' => 1]);
        }
        return response()->error(['message' => __('payment status update success')]);
        
         
    }
}
