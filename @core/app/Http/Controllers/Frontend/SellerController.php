<?php

namespace App\Http\Controllers\Frontend;

use App\Accountdeactive;
use App\AdminCommission;
use App\AdminNotification;
use App\ChildCategory;
use App\EditServiceHistory;
use App\ExtraService;
use App\Helpers\ServiceCalculationHelper;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Mail\OrderMail;
use App\Notifications\TicketNotification;
use App\OnlineServiceFaq;
use App\OrderCompleteDecline;
use App\Report;
use App\ReportChatMessage;
use App\Tax;
use FontLib\Table\Type\post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Serviceadditional;
use App\Serviceinclude;
use App\Servicebenifit;
use App\Serviceaddresses;
use App\Subcategory;
use App\Category;
use App\Country;
use App\Service;
use App\ServiceCity;
use App\ServiceArea;
use App\User;
use App\Day;
use App\Order;
use App\OrderAdditional;
use App\OrderInclude;
use App\Review;
use App\Schedule;
use App\ServiceCoupon;
use App\SupportTicket;
use App\SupportTicketMessage;
use App\ToDoList;
use App\Events\SupportMessage;
use App\Helpers\FlashMsg;
use App\PayoutRequest;
use App\AmountSettings;
use App\SellerVerify;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Mail;
use Modules\JobPost\Entities\BuyerJob;
use Modules\JobPost\Entities\JobRequest;
use Str;
use DB;
use App\Events\UpdateTicket;
use App\SignzyAPI;
use App\Helpers\StringMatchHelper;
use App\Helpers\TokenGenrateHelper;
use App\Company;
use App\Penalty;
use App\CurlCall;
use App\Pipeline;
use App\Stage;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('inactiveuser');
    }

    public function sellerDashboard()
    {
        $total_earnings = 0;
        $seller_id = Auth::guard('web')->user()->id;
        $pending_order = Order::where(['status' => 0, 'seller_id' => $seller_id])->count();
        $complete_order = Order::where(['status' => 2, 'seller_id' => $seller_id])->count();
        $active_order = Order::where(['status' => 1, 'seller_id' => $seller_id])->count();
        $total_order = Order::where(['seller_id' => $seller_id])->count();

        //balance calculate
        $get_sum = Order::where(['status' => 2, 'seller_id' => $seller_id]);

        $complete_order_balance_with_tax = $get_sum->sum('total');
        $complete_order_tax = $get_sum->sum('tax');
        $complete_order_balance_without_tax = $complete_order_balance_with_tax - $complete_order_tax;
        $admin_commission_amount = $get_sum->sum('commission_amount');
        $remaning_balance = $complete_order_balance_without_tax - $admin_commission_amount;

        $this_month = Order::where(['seller_id' => $seller_id, 'status' => 2])->whereMonth('created_at', Carbon::now()->month);
        //earning or withdraw calculate
        $total_earnings = PayoutRequest::where('seller_id',$seller_id)->where('payment_type', 'Withdraw')->sum('amount');
        $total_penalties = PayoutRequest::where('seller_id',$seller_id)->where('payment_type', 'Penalty')->sum('amount');
        $last_five_order = Order::where('seller_id', $seller_id)->latest()->take(4)->get();
        $this_month_order_count = $this_month->count();

        //this month balance calculate        
        $this_month_total_balance_with_tax = $this_month->sum('total');
        $this_month_total_tax = $this_month->sum('tax');
        $this_month_admin_commission = $this_month->sum('commission_amount');
        $this_month_balance_without_tax_and_admin_commission = $this_month_total_balance_with_tax - ($this_month_total_tax + $this_month_admin_commission);
        //this month earning or withdraw calculate
        $this_month_earnings = PayoutRequest::where('seller_id', $seller_id)->where('payment_type', 'Withdraw')->whereMonth('created_at', Carbon::now()->month)->sum('amount');
        $this_month_penalties = PayoutRequest::where('seller_id', $seller_id)->where('payment_type', 'Penalty')->whereMonth('created_at', Carbon::now()->month)->sum('amount');

        //to do list 
        $to_do_list = ToDoList::where(['user_id' => $seller_id, 'status' => 0])->take(3)->latest()->get();
        $to_do_list_all = ToDoList::where('user_id', $seller_id)->latest()->get();

        $buyer_count = Order::where('seller_id', $seller_id)->distinct('buyer_id')->count();


        //get last 12 months order
        $month_list = [];
        $monthly_order_list = [];

        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::parse(date('Y') . '-01-01')->addMonth($i);
            $month_list[] = $month->shortMonthName;

            $monthly_order_list[] = Order::where('seller_id', $seller_id)->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at',  $month)
                ->count();
        }

        //get last 7 days order
        $currentDateTime = Carbon::now();
        $days_list = [];
        $pending_order_list = [];
        $active_order_list = [];
        $complete_order_list = [];

        $startWeek = get_static_option("start_week_from");

        for ($i = 0; $i < 7; $i++) {
            $day = $currentDateTime->startOfWeek($startWeek)->addDay($i);
            $days_list[] = $day->dayName;

            $pending_order_list[] = Order::where('seller_id', $seller_id)->where('status', 0)
                ->whereDate('created_at', $day)
                ->count();
            $active_order_list[] = Order::where('seller_id', $seller_id)->where('status', 1)
                ->whereDate('created_at', $day)
                ->count();
            $complete_order_list[] = Order::where('seller_id', $seller_id)->where('status', 2)
                ->whereDate('created_at', $day)
                ->count();
        }

        return view('frontend.user.seller.dashboard.dashboard', compact(
            'pending_order', 'complete_order', 'remaning_balance', 'total_earnings', 'last_five_order',
            'this_month_order_count', 'this_month_balance_without_tax_and_admin_commission', 'this_month_earnings', 'buyer_count', 'to_do_list', 'to_do_list_all',
            'month_list',
            'monthly_order_list',
            'days_list',
            'pending_order_list',
            'active_order_list',
            'complete_order_list',
            'active_order',
            'total_order',
            'total_penalties',
            'this_month_penalties'
        ));
    }

    public function sellerProfile()
    {
        if(get_static_option('dashboard_variant_buyer') == '02'){
            $cities = ServiceCity::where('status',1)->get();
            $areas = ServiceArea::where('status',1)->get();
            $countries = Country::where('status',1)->get();
        }else{
            $cities = 0;
            $areas = 0;
            $countries = 0;
        }

        return view('frontend.user.seller.profile.seller-profile', compact('countries', 'areas' ,'cities'));
    }

    public function sellerProfileEdit(Request $request)
    {

        if ($request->isMethod('post')) {
            $user = Auth::guard('web')->user()->id;
            $request->validate([
                'name' => 'required|max:191',
                'email' => 'required|max:191|email|unique:users,email,' . $user,
                'phone' => 'required|max:191',
                'service_area' => 'required|max:191',
                'post_code' => 'required|max:191',
                'address' => 'required|max:191',
            ]);
            $old_image = User::select('image', 'profile_background')->where('id', Auth::guard('web')->user()->id)->first();
            User::where('id', Auth::guard('web')->user()->id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'image' => $request->image ?? $old_image->image,
                    'profile_background' => $request->profile_background ?? $old_image->profile_background,
                    'service_city' => $request->service_city,
                    'service_area' => $request->service_area,
                    'country_id' => $request->country_id,
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'about' => $request->about,
                    'fb_url' => $request->fb_url,
                    'tw_url' => $request->tw_url,
                    'go_url' => $request->go_url,
                    'yo_url' => $request->yo_url,
                    'li_url' => $request->li_url,
                    'in_url' => $request->in_url,
                    'pi_url' => $request->pi_url,
                    'dr_url' => $request->dr_url,
                    'twi_url' => $request->twi_url,
                    're_url' => $request->re_url,
                ]);

            toastr_success(__('Profile Update Success---'));

            $user_info = Auth::guard('web')->user();
            if ($user_info->user_type === 0) {
                Service::where('seller_id', $user_info->id)->update(['service_city_id' => $request->service_city]);
            }

            return redirect()->back();
        }

        $countries = Country::where('status', 1)->get();
        $user_country = Auth::guard('web')->user()->country_id;
        $cities = ServiceCity::where('country_id', $user_country)->get();
        $areas = ServiceArea::where('service_city_id', Auth::guard('web')->user()->service_city)->get();
        return view('frontend.user.seller.profile.seller-profile-edit', compact('cities', 'areas', 'countries'));
    }

    public function sellerAccountSetting(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'current_password' => 'required|min:6',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|min:6',
            ]);

            $seller = User::where('id', Auth::user()->id)->first();

            if (Hash::check($request->current_password, $seller->password)) {
                if ($request->new_password == $request->confirm_password) {
                    User::where('id', $seller->id)->update(['password' => Hash::make($request->new_password)]);
                    toastr_success(__('Password Update Success---'));
                    return redirect()->back();
                }
                toastr_error(__('Password and Confirm Password not match---'));
                return redirect()->back();
            }
            toastr_error(__('Current Password is Wrong---'));
            return redirect()->back();
        }
        $user = Accountdeactive::select('user_id', 'status')->where('user_id', Auth::guard('web')->user()->id)->first();
        return view('frontend.user.seller.profile.seller-account-settings', compact('user'));
    }

    public function accountDeactive(Request $request)
    {

        if ($request->isMethod('post')) {
            $request->validate([
                'reason' => 'required',
                'description' => 'required|max:20',
            ]);

            //first seller order status check
            $auth_seller_id = Auth::guard('web')->user()->id;
            //first seller order status check
            $all_orders = Order::where('seller_id', $auth_seller_id)->where('status', 1)->count();
            if ($all_orders > 1) {
                toastr_error(__('Your have active orders. Please complete them before trying to delete your account.'));
                return redirect()->back();
            } else {
                Accountdeactive::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'reason' => $request['reason'],
                    'description' => $request['description'],
                    'status' => 0,
                    'account_status' => 0,
                ]);
                Service::where('seller_id', Auth::guard('web')->user()->id)->update(['status' => 0]);
                toastr_error(__('Your Account Successfully Deactivate'));
                return redirect()->back();
            }
        }
    }

    // seller account delete
    public function accountDelete(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'reason' => 'required',
                'description' => 'required|max:20',
            ]);
            $auth_seller_id = Auth::guard('web')->user()->id;
            //first seller order status check
            $all_orders = Order::where('seller_id', $auth_seller_id)->where('status', 1)->count();
            if ($all_orders > 1) {
                toastr_error(__('Your have active orders. Please complete them before trying to delete your account.'));
                return redirect()->back();
            } else {
                Accountdeactive::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'reason' => $request['reason'],
                    'description' => $request['description'],
                    'status' => 1,
                    'account_status' => 1,
                ]);
                Service::where('seller_id', Auth::guard('web')->user()->id)
                    ->update(['status' => 0]);
                toastr_error(__('Your Account Delete Successfully'));
            }

            return redirect()->route('seller.logout');
        }
    }

    public function accountDeactiveCancel($id = null)
    {
        $account_details = Accountdeactive::where('user_id', $id)->first();
        $account_details->delete();
        Service::where('seller_id', Auth::guard('web')->user()->id)
            ->update(['status' => 1]);
        toastr_success(__('Your Account Successfully Active'));
        return redirect()->back();
    }

    public function sellerLogout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    //coupons 
    public function serviceCoupon(Request $request)
    {
        if(!empty($request->coupon_code || $request->status || $request->discount_type || $request->coupon_date)){
            $coupon_query = ServiceCoupon::where('seller_id', Auth::guard('web')->user()->id);

            if (!empty($request->coupon_code)){
                $coupon_query->where('code', 'LIKE', "%{$request->coupon_code}%");
            }
            if (!empty($request->status)){
                if ($request->status == 'pending'){
                    $coupon_query->where('status', 0);
                }else{
                    $coupon_query->where('status', $request->status);
                }

            }

            // Discount Type
            if (!empty($request->discount_type)){
               $coupon_query->where('discount_type', $request->discount_type);
            }

            // search by date range
            if (!empty($request->coupon_date)){
                $start_date = \Str::of($request->coupon_date)->before('to');
                $end_date = \Str::of($request->coupon_date)->after('to');
                $coupon_query->whereBetween('created_at', [$start_date,$end_date]);
            }
            $coupons = $coupon_query->paginate(10);

        }else{
            $coupons = ServiceCoupon::where('seller_id', Auth::guard('web')->user()->id)->latest()->paginate(10);
        }

        return view('frontend.user.seller.coupons.coupons', compact('coupons'));
    }

    public function addServiceCoupon(Request $request)
    {

        $request->validate([
            'code' => 'required|max:191',
            'discount' => 'required|numeric',
            'discount_type' => 'required|max:191',
            'expire_date' => 'required',
        ]);

        ServiceCoupon::create([
            'code' => str_replace(' ', '', $request->code),
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'expire_date' => $request->expire_date,
            'status' => 0,
            'seller_id' => Auth::guard('web')->user()->id,

        ]);

        toastr_success(__('Coupon Added Success---'));
        return redirect()->back();
    }

    public function updateServiceCoupon(Request $request)
    {
        $request->validate([
            'up_code' => 'required|max:191',
            'up_discount' => 'required|numeric',
            'up_discount_type' => 'required|max:191',
            'up_expire_date' => 'required',
        ]);

        ServiceCoupon::where('id', $request->up_id)->update([
            'code' => str_replace(' ', '', $request->up_code),
            'discount' => $request->up_discount,
            'discount_type' => $request->up_discount_type,
            'expire_date' => $request->up_expire_date,
            'seller_id' => Auth::guard('web')->user()->id,
        ]);

        toastr_success(__('Coupon Update Success---'));
        return redirect()->back();
    }

    public function changeCouponStatus($id = null)
    {
        $status = ServiceCoupon::select('status')->where('id', $id)->first();
        if ($status->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        ServiceCoupon::where('id', $id)->update([
            'status' => $status,
        ]);
        toastr_success(__('Coupon status Update Success---'));
        return redirect()->back();
    }

    public function couponDelete($id = null)
    {
        ServiceCoupon::find($id)->delete();
        toastr_error(__('Coupon Delete Success---'));
        return redirect()->back();
    }

    //services
    public function sellerServices(Request $request)
    {


        if(!empty($request->service_id || $request->service_status || $request->service_title || $request->online_offline_status || $request->service_price || $request->service_post_code || $request->service_date)){

            $services_query = Service::with('reviews', 'pendingOrder', 'completeOrder', 'cancelOrder')->where('seller_id', Auth::user()->id);

            // search by service ID
            if (!empty($request->service_id)){
                $services_query->where('id', $request->service_id);
            }
            // search by service create date
            if (!empty($request->service_date)){
                $start_date = \Str::of($request->service_date)->before('to');
                $end_date = \Str::of($request->service_date)->after('to');
                $services_query->whereBetween('created_at', [$start_date,$end_date]);
            }

            // search by service status
            if (!empty($request->service_status)){
                if ($request->service_status == 'pending'){
                    $services_query->where('status', 0);
                }else{
                    $services_query->where('status', $request->service_status);
                }
            }

            // search by online offline service
            if (!empty($request->online_offline_status)){
                if ($request->online_offline_status == 'offline'){
                    $services_query->where('is_service_online', 0);
                }else{
                    $services_query->where('is_service_online', $request->online_offline_status);
                }
            }

            // search by service amount
            if (!empty($request->service_price)){
                $service_id = Service::select('id', 'title')->where('price',  'LIKE', "%{$request->service_price}%")->pluck('id')->toArray();
                $services_query->whereIn('id', $service_id);
            }

            // search by service amount
            if (!empty($request->service_post_code)){
                $service_post_code_id = Serviceaddresses::where('service_post_code', 'LIKE', "%{$request->service_post_code}%")->pluck('service_id')->toArray();
                foreach ($service_post_code_id as $service_id) {
                    $service_id = Service::select('id', 'title')->where('id',  $service_id)->pluck('id')->toArray();
                    $services_query->whereIn('id', $service_id);
                }
            }

            // search by service title
            if (!empty($request->service_title)){
                $service_id = Service::select('id', 'title')->where('title',  'LIKE', "%{$request->service_title}%")->pluck('id')->toArray();
                $services_query->whereIn('id', $service_id);
            }

            $services = $services_query->latest()->paginate(10);

        }else{
            $services = Service::with('reviews', 'pendingOrder', 'completeOrder', 'cancelOrder')
                ->where('seller_id', Auth::user()->id)
                ->latest()->paginate(10);

        }

        return view('frontend.user.seller.services.services', compact('services'));
    }

    public function addServices(Request $request)
    {
        \Log::debug("Add server Start");
        $commissionGlobal = AdminCommission::first();
        if(moduleExists('Subscription') && $commissionGlobal->system_type == 'subscription' && empty(auth('web')->user()->subscribedSeller)){
            toastr_error(__('you must have to subscribe any of our package in order to start selling your services.'));
            return back();
        }

        if ($request->isMethod('post')) {
            \Log::debug("Inside If for method post");
            //seller Verify check
            if (get_static_option('service_create_settings') == 'verified_seller'){
                $seller = SellerVerify::select('seller_id','status')->where('seller_id',Auth::guard('web')->user()->id)->first();
                $seller_verified_status = $seller->status ?? 0;
                if($seller_verified_status != 1 ){
                    toastr_error(__('You are not verified. to add services you must have to verify your account first'));
                    return redirect()->back();
                }
            }

            //todo: check subscription step:1 commission type check step:2 subscription check step:3 subscription
            // type example(monthly, yearly, liveTime) Step:4 seller total service check to subscription service count

            //commission type check
            $commission = AdminCommission::first();
                if($commission->system_type == 'subscription'){
                    \Log::debug("Inside If subscription");
                if(subscriptionModuleExistsAndEnable('Subscription')){
                    \Log::debug("Inside If Subscription");
                    $seller_subscription = \Modules\Subscription\Entities\SellerSubscription::where('seller_id', Auth::guard('web')->user()->id)->first();
                        // Seller Service count
                       $seller_service_count = Service::where('seller_id', Auth::guard('web')->user()->id)->count();
                    if(is_null($seller_subscription)){
                        toastr_error(__('you have to subscibe a package to create services'));
                        return redirect()->back();
                   }
                    if ($seller_subscription->type === 'monthly'){
                        // check seller connect,service,expire date
                        if ($seller_subscription->connect == 0){
                            toastr_error(__('Your Subscription is expired'));
                            return redirect()->back();
                        }elseif ($seller_subscription->initial_service <= $seller_service_count){
                            toastr_error(__('Your Subscription is expired'));
                            return redirect()->back();
                        }elseif ($seller_subscription->expire_date <= Carbon::now()){
                            toastr_error(__('Your Subscription is expired'));
                            return redirect()->back();
                        }
                    }elseif ($seller_subscription->type === 'yearly'){
                        // check seller connect,service,expire date
                        if ($seller_subscription->connect == 0){
                            toastr_error(__('Your Subscription is expired'));
                            return redirect()->back();
                        }elseif ($seller_subscription->initial_service <= $seller_service_count){
                            toastr_error(__('Your Subscription is expired'));
                            return redirect()->back();
                        }elseif ($seller_subscription->expire_date <= Carbon::now()){
                            toastr_error(__('Your Subscription is expired'));
                            return redirect()->back();
                        }
                    }
                }
            }
            \Log::debug("Before validate");
            $request->validate([
                'category' => 'required',
                'title' => 'required|max:191|unique:services',
                'description' => 'required|min:10',
                'slug' => 'required',
            ]);
            \Log::debug("After validate");
            $seller_country = User::select('id', 'country_id')->where('country_id', Auth::guard('web')->user()->country_id)->first();
            $country_tax = Tax::select('tax')->where('country_id', $seller_country->country_id)->first();

            if(get_static_option('service_create_status_settings') == 'approved'){
                $service_status = 1;
            }else{
                $service_status = 0;
            }

            $service = new Service();
            $service->category_id = $request->category;
            $service->subcategory_id = $request->subcategory;
            $service->child_category_id = $request->child_category;
            $service->title = $request->title;
            $service->slug = $request->slug;
            $service->description = $request->description;
            $service->image = $request->image;
            $service->image_gallery = $request->image_gallery;
            $service->video = $request->video;
            $service->seller_id = Auth::guard('web')->user()->id;
            $service->service_city_id = Auth::guard('web')->user()->service_city;
            $service->service_area_id = Auth::guard('web')->user()->service_area;
            $service->status = $service_status;
            $service->tax = $country_tax->tax ?? 0;
            $service->is_service_all_cities = $request->is_service_all_cities ?? 0;

            $Metas = [
                'meta_title' => purify_html($request->meta_title),
                'meta_tags' => purify_html($request->meta_tags),
                'meta_description' => purify_html($request->meta_description),

                'facebook_meta_tags' => purify_html($request->facebook_meta_tags),
                'facebook_meta_description' => purify_html($request->facebook_meta_description),
                'facebook_meta_image' => $request->facebook_meta_image,

                'twitter_meta_tags' => purify_html($request->twitter_meta_tags),
                'twitter_meta_description' => purify_html($request->twitter_meta_description),
                'twitter_meta_image' => $request->twitter_meta_image,
            ];
            $service->save();
            \Log::debug("After Save");
            $last_service_id = DB::getPdo()->lastInsertId();
            \Log::debug("last_service_id" . $last_service_id);
            try {
                $message = get_static_option('service_approve_message');
                $message = str_replace(["@service_id"], [$last_service_id], $message);
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => get_static_option('service_approve_subject') ?? __('New Service Approve Request'),
                    'message' => $message
                ]));
            } catch (\Exception $e) {
                //
            }

            toastr_success(__('Service Added Success---'));
            return redirect('/seller/service-attributes');

        } else{
            \Log::debug("Inside else");
        }


        $categories = Category::where('status', 1)->get();
        $sub_categories = Subcategory::all();
        \Log::debug("Add server End");
        if(get_static_option('dashboard_variant_seller') == '02'){
            return view('frontend.user.seller.services.partials.add-service-two', compact('categories', 'sub_categories'));
        }else{
            return view('frontend.user.seller.services.add-service', compact('categories', 'sub_categories'));
        }
    }

    public function getSubcategory(Request $request)
    {
        $sub_categories = Subcategory::where('category_id', $request->category_id)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'sub_categories' => $sub_categories,
        ]);
    }

    // child category for service add
    public function getChildCategory(Request $request)
    {
        $child_categories = ChildCategory::where('sub_category_id', $request->sub_cat_id)->where('status', 1)->get();

        return response()->json([
            'status' => 'success',
            'child_category' => $child_categories,
        ]);
    }

    public function serviceAttributes(Request $request)
    {
        $latest_service = Service::where('seller_id', Auth::guard('web')->id())->latest()->first();
        return view('frontend.user.seller.services.service-attributes', compact('latest_service'));
    }

    public function addServiceAttributes(Request $request)
    {

        $data = $request->all();
        if (isset($data['is_service_online_id'])) {
            if ($data['is_service_online_id'] == 1) {
                $request->validate(
                    [
                        'include_service_title.*' => 'required|max:191',
                        'online_service_price' => 'required|integer',
                        'delivery_days' => 'required|integer',
                        'revision' => 'required|integer',
                        'benifits.*' => 'max:191',
                        'faqs_title.*' => 'max:191',
                        'additional_service_title.*' => 'max:191',
                    ],
                    [
                        'include_service_title.*.required' => __('Title is required'),
                    ]
                );
            }
        } else {
            $request->validate(
                [
                    'include_service_title.*' => 'required|max:191',
                    'include_service_price.*' => 'required|numeric',
                    'include_service_quantity.*' => 'required|numeric',
                    'benifits.*' => 'max:191',
                    'faqs_title.*' => 'max:191',
                    'additional_service_title.*' => 'max:191',
                ],
                [
                    'include_service_title.*.required' => __('Title is required'),
                    'include_service_price.*.required' => __('Price is required'),
                    'include_service_price.*.numeric' => __('Price must be a number'),
                    'include_service_quantity.*.required' => __('Quantity is required'),
                    'include_service_quantity.*.numeric' => __('Quantity must be a number'),
                ]
            );
        }

        $all_include_service = [];
        $all_additional_service = [];
        $all_benifits_service = [];
        $online_service_faqs = [];
        $service_total_price = 0;

        if (isset($data['is_service_online_id'])) {
            Service::where('id', $request->service_id)->update([
                'price' => $data['online_service_price'],
                'delivery_days' => $data['delivery_days'],
                'revision' => $data['revision'],
                'is_service_online' => 1,
            ]);

            if ($data['is_service_online_id'] == 1) {
                if (isset($data['include_service_title'])) {
                    foreach ($data['include_service_title'] as $key => $value) {
                        $all_include_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => Auth::guard('web')->user()->id,
                            'include_service_title' => $data['include_service_title'][$key],
                            'include_service_price' => 0,
                            'include_service_quantity' => 0,
                        ];
                    }
                }
                Serviceinclude::insert($all_include_service);
            }
        } else {
            if (isset($data['include_service_title'])) {
                foreach ($data['include_service_title'] as $key => $value) {
                    $all_include_service[] = [
                        'service_id' => $request->service_id,
                        'seller_id' => Auth::guard('web')->user()->id,
                        'include_service_title' => $data['include_service_title'][$key],
                        'include_service_price' => $data['include_service_price'][$key],
                        'include_service_quantity' => $data['include_service_quantity'][$key],
                    ];
                    $service_total_price += $data['include_service_price'][$key] * $data['include_service_quantity'][$key];
                }
            }
            Serviceinclude::insert($all_include_service);
            Service::where('id', $request->service_id)->update(['price' => $service_total_price]);
        }

        if (isset($data['additional_service_title'])) {
            foreach ($data['additional_service_title'] as $key => $value) {
                if (!empty($data['additional_service_title'][$key])) {
                    $all_additional_service[] = [
                        'service_id' => $request->service_id,
                        'seller_id' => Auth::guard('web')->user()->id,
                        'additional_service_title' => $data['additional_service_title'][$key],
                        'additional_service_price' => $data['additional_service_price'][$key],
                        'additional_service_quantity' => $data['additional_service_quantity'][$key],
                        'additional_service_image' => $data['image'][$key],
                    ];
                }
            }
        }
        Serviceadditional::insert($all_additional_service);

        if (isset($data['benifits'])) {
            foreach ($data['benifits'] as $key => $value) {
                $all_benifits_service[] = [
                    'service_id' => $request->service_id,
                    'seller_id' => Auth::guard('web')->user()->id,
                    'benifits' => $data['benifits'][$key],
                ];
            }
        }

        Servicebenifit::insert($all_benifits_service);

        if (isset($data['faqs_title'])) {
            foreach ($data['faqs_title'] as $key => $value) {
                if (!empty($data['faqs_title'][$key])) {
                    $online_service_faqs[] = [
                        'service_id' => $request->service_id,
                        'seller_id' => Auth::guard('web')->user()->id,
                        'title' => $data['faqs_title'][$key],
                        'description' => $data['faqs_description'][$key],
                    ];
                }
            }
        }


        OnlineServiceFaq::insert($online_service_faqs);


        toastr_success(__('Service attributes added success---'));
        return redirect()->route('seller.services');
    }

      public function addServiceAttributesById(Request $request, $id = null)
    {
        if ($request['is_service_online_id'] == 1) {
            $request->validate(
                [
                    'include_service_title.*' => 'nullable|max:191',
                    'additional_service_title.*' => 'required_with:include_service_title.*|max:191',
                    'benifits.*' => 'max:191',
                    'faqs_title.*' => 'max:191',
                ],
                [
                    'include_service_title.*.required' => __('Title is required'),
                ]
            );
        }else{
            $request->validate(
                [
                    'include_service_title.*' => 'nullable|max:191',
                    'include_service_price.*' => 'required_with:include_service_price.*',
                    'include_service_quantity.*' => 'required_with:include_service_quantity.*',
                    'benifits.*' => 'max:191',
                    'faqs_title.*' => 'max:191',
                    'additional_service_title.*' => 'max:191',
                ],
                [
                    'include_service_title.*.required' => __('Title is required'),
                    'include_service_price.*.required' => __('Price is required'),
                    'include_service_price.*.numeric' => __('Price must be a number'),
                    'include_service_quantity.*.required' => __('Quantity is required'),
                    'include_service_quantity.*.numeric' => __('Quantity must be a number'),
                ]
            );
        }


        $get_service = Service::where('id',$id)->where('seller_id',Auth::guard('web')->user()->id)->first();
        if($request->isMethod('post')) {
            $data = $request->all();

            $all_include_service = [];
            $all_additional_service = [];
            $all_benifits_service = [];
            $online_service_faqs = [];
            $service_total_price = 0;
            $service_total_price_with_new_added_attribute = 0;
            $service_count = 0;

            if(isset($data['is_service_online_id'])){
                if($data['is_service_online_id'] == 1){
                    if(isset($data['include_service_title'])){
                        foreach ($data['include_service_title'] as $key => $value) {
                            if (!empty($data['include_service_title'][$key])) {
                                $all_include_service[] = [
                                    'service_id' => $request->service_id,
                                    'seller_id' => Auth::guard('web')->user()->id,
                                    'include_service_title' => $data['include_service_title'][$key],
                                    'include_service_price' => 0,
                                    'include_service_quantity' => 0,
                                ];
                                $service_count++;
                            }
                        }
                    }
                }
            }else{
                if(isset($data['include_service_title'])){
                    foreach ($data['include_service_title'] as $key => $value) {
                        if (!empty($data['include_service_title'][$key])) {
                            $all_include_service[] = [
                                'service_id' => $request->service_id,
                                'seller_id' => Auth::guard('web')->user()->id,
                                'include_service_title' => $data['include_service_title'][$key],
                                'include_service_price' => (int)$data['include_service_price'][$key],
                                'include_service_quantity' => (int)$data['include_service_quantity'][$key],
                            ];
                            $service_total_price += $data['include_service_price'][$key] * $data['include_service_quantity'][$key];
                            $service_count++;
                        }
                    }
                }
            }

            if($service_count>=1){
                Serviceinclude::insert($all_include_service);
                $service_old_price = Service::where('id',$id)->select('price')->first();
                $service_total_price_with_new_added_attribute =($service_old_price->price + $service_total_price);
                Service::where('id', $request->service_id)->update(['price' => $service_total_price_with_new_added_attribute]);
            }

            if(isset($data['additional_service_title'])) {
                foreach ($data['additional_service_title'] as $key => $value) {
                    if (!empty($data['additional_service_title'][$key])) {
                        $all_additional_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => Auth::guard('web')->user()->id,
                            'additional_service_title' => $data['additional_service_title'][$key],
                            'additional_service_price' => $data['additional_service_price'][$key],
                            'additional_service_quantity' => $data['additional_service_quantity'][$key],
                            'additional_service_image' => $data['image'][$key],
                        ];
                        $service_count++;
                    }
                }
            }

            if($service_count>=1){
                Serviceadditional::insert($all_additional_service);
            }

            if(isset($data['benifits'])) {
                foreach ($data['benifits'] as $key => $value) {
                    if (!empty($data['benifits'][$key])) {
                        $all_benifits_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => Auth::guard('web')->user()->id,
                            'benifits' => $data['benifits'][$key],
                        ];
                        $service_count++;
                    }
                }
            }

            if($service_count>=1){
                Servicebenifit::insert($all_benifits_service);
            }

            if(isset($data['faqs_title'])){
                foreach ($data['faqs_title'] as $key => $value) {
                    if (!empty($data['faqs_title'][$key])) {
                        $online_service_faqs[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => Auth::guard('web')->user()->id,
                            'title' => $data['faqs_title'][$key],
                            'description' => $data['faqs_description'][$key],
                        ];
                        $service_count++;
                    }
                }
            }else{

            }

            if($service_count>=1){
                OnlineServiceFaq::insert($online_service_faqs);
            }

            if($service_count <= 0){
                toastr_error(__('Please input service attributes---'));
                return redirect()->back();
            }

            toastr_success(__('Service attributes added success---'));
            return redirect()->route('seller.services');
        }
        if($get_service !=''){
            return view('frontend.user.seller.services.add-service-attributes-by-id', compact('get_service'));
        }else{
            abort(404);
        }

    }

    public function ServiceOnOf(Request $request)
    {
        $is_service_on = Service::select('is_service_on')->where('id', $request->service_id)->first();
        if ($is_service_on->is_service_on == 1) {
            $is_service_on = 0;
            Service::where('id', $request->service_id)->update(['is_service_on' => $is_service_on]);
        } else {
            $is_service_on = 1;
            Service::where('id', $request->service_id)->update(['is_service_on' => $is_service_on]);
        }
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function editServices(Request $request, $id = null)
    {


        if ($request->isMethod('post')) {
            $request->validate([
                'category' => 'required',
                'title' => 'required|max:191|unique:services,id,'.$id,
                'description' => 'required|min:20',
            ]);

            $seller_country = User::select('id','country_id')->where('country_id',Auth::guard('web')->user()->country_id)->first();
            $country_tax = Tax::select('tax')->where('country_id',$seller_country->country_id)->first();

            $old_image = Service::select('image','image_gallery')->where('id',$id)->first();
            $old_slug = Service::select('slug')->where('id',$id)->first();

            if(get_static_option('service_create_status_settings') == 'approved'){
                $service_status = 1;
            }else{
                $service_status = 0;
            }

            Service::where('id', $id)->update([
                'category_id' => $request->category,
                'subcategory_id' => $request->subcategory,
                'child_category_id' => $request->child_category,
                'title' => $request->title,
                'slug' => $request->slug ?? $old_slug->slug,
                'description' => $request->description,
                'image' => $request->image ?? $old_image->image,
                'image_gallery' => $request->image_gallery ?? $old_image->image_gallery,
                'video' => $request->video,
                'tax' => $country_tax->tax ?? 0,
                'status' => $service_status,
                'is_service_all_cities' => $request->is_service_all_cities,
            ]);

            $service_meta_update =  Service::findOrFail($id);
            $Metas = [
                'meta_title'=> purify_html($request->meta_title),
                'meta_tags'=> $request->meta_tags,
                'meta_description'=> purify_html($request->meta_description),

                'facebook_meta_tags'=> purify_html($request->facebook_meta_tags),
                'facebook_meta_description'=> purify_html($request->facebook_meta_description),
                'facebook_meta_image'=> $request->facebook_meta_image,

                'twitter_meta_tags'=> purify_html($request->twitter_meta_tags),
                'twitter_meta_description'=> purify_html($request->twitter_meta_description),
                'twitter_meta_image'=> $request->twitter_meta_image,
            ];

            DB::beginTransaction();

            try {
                $service_meta_update->metaData()->update($Metas);
                DB::commit();
            }catch (\Throwable $th){
                DB::rollBack();
            }

            EditServiceHistory::create([
                'service_id' => $id,
                'seller_id' => Auth::guard('web')->user()->id,
                'service_title' => $request->title,
                'service_description' => $request->description,
            ]);

            toastr_success(__('Service updated success---'));
            return redirect()->route('seller.services');
        }

        $categories = Category::where('status', 1)->get();
        $sub_categories = Subcategory::all();
        $child_categories = ChildCategory::all();
        $service = Service::with('subcategory', 'childcategory')->find($id);

        if(get_static_option('dashboard_variant_seller') == '02'){
            if($service != ''){
                $edit_service_id = $id;
                return view('frontend.user.seller.services.partials.edit-service-two', compact('edit_service_id'));
            }else{
                abort(404);
            }

        }else{
            if($service != ''){
                return view('frontend.user.seller.services.edit-service', compact('categories', 'sub_categories', 'service', 'child_categories'));
            }else{
                abort(404);
            }
        }
    }


    public function editServiceAttribute(Request $request, $id = null)
    {
        // update
        if ($request->isMethod('post')) {
            $data = $request->all();
            if(isset($data['is_service_online_id'])){

                if($data['is_service_online_id'] == 1){
                    $request->validate([
                        'include_service_title.*' => 'required|max:191',
                        'online_service_price' => 'required|integer',
                        'delivery_days' => 'required|integer',
                        'revision' => 'required|integer',
                        'benifits.*' => 'max:191',
                        'faqs_title.*' => 'max:191',
                        'additional_service_title.*' => 'max:191',
                    ],
                        [
                            'include_service_title.*.required' => __('Title is required'),
                        ]);
                }
            }else{
                $request->validate(
                    [
                        'include_service_title.*' => 'required|max:191',
                        'include_service_price.*' => 'required|numeric',
                        'include_service_quantity.*' => 'required|numeric',
                        'benifits.*' => 'max:191',
                        'faqs_title.*' => 'max:191',
                        'additional_service_title.*' => 'max:191',
                    ],
                    [
                        'include_service_title.*.required' => __('Title is required'),
                        'include_service_price.*.required' => __('Price is required'),
                        'include_service_price.*.numeric' => __('Price must be a number'),
                        'include_service_quantity.*.required' => __('Quantity is required'),
                        'include_service_quantity.*.numeric' => __('Quantity must be a number'),
                    ]
                );
            }

            $all_include_service = [];
            $all_additional_service = [];
            $all_benifits_service = [];
            $service_total_price = 0;

            $x = [
                'include' => [],
            ];

            if(isset($data['is_service_online_id'])){
                if($data['is_service_online_id'] == 1){
                    Service::where('id', $id)->update([
                        'price' => $data['online_service_price'],
                        'delivery_days' => $data['delivery_days'],
                        'revision' => $data['revision'],
                    ]);
                    if(isset($data['include_service_title'])) {
                        foreach ($data['include_service_title'] as $key => $value) {
                            Serviceinclude::where('id', $data['service_include_id'][$key])->update([
                                'include_service_title' => $data['include_service_title'][$key],
                                'include_service_price' => 0,
                                'include_service_quantity' => 0,
                            ]);
                        }
                    }
                }
            }else{
                if (isset($data['include_service_title'])) {
                    foreach ($data['include_service_title'] as $key => $value) {
                        Serviceinclude::where('id', $data['service_include_id'][$key])->update([
                            'include_service_title' => $data['include_service_title'][$key],
                            'include_service_price' => $data['include_service_price'][$key],
                            'include_service_quantity' => $data['include_service_quantity'][$key],
                        ]);
                        $service_total_price += $data['include_service_price'][$key] * $data['include_service_quantity'][$key];
                    }
                    Service::where('id', $id)->update(['price' => $service_total_price]);
                }
            }

            if (isset($data['additional_service_title'])) {
                foreach ($data['additional_service_title'] as $key => $value) {
                    $old_image = Serviceadditional::select('additional_service_image')->where('id', $data['service_additional_id'][$key])->first();

                    Serviceadditional::where('id', $data['service_additional_id'][$key])->update([
                        'additional_service_title' => $data['additional_service_title'][$key],
                        'additional_service_price' => $data['additional_service_price'][$key],
                        'additional_service_quantity' => $data['additional_service_quantity'][$key],
                        'additional_service_image' => $data['image'][$key],
                        'additional_service_image' => $data['image'][$key] ?? $old_image->additional_service_image,
                    ]);
                }
            }

            if (isset($data['benifits'])) {
                foreach ($data['benifits'] as $key => $value) {
                    Servicebenifit::where('id', $data['service_benifit_id'][$key])->update([
                        'benifits' => $data['benifits'][$key],
                    ]);
                }
            }

            if (isset($data['faqs_title'])) {
                foreach ($data['faqs_title'] as $key => $value) {
                    OnlineServiceFaq::where('id', $data['online_service_faq_id'][$key])->update([
                        'title' => $data['faqs_title'][$key],
                        'description' => $data['faqs_description'][$key],
                    ]);
                }
            }

            toastr_success(__('Service Attributes Updated Success---'));
            return redirect()->route('seller.services');
        }

        $service = Service::find($id);
        if($service !=''){
            $service_includes = ServiceInclude::where('service_id', $id)->get();
            $service_additionals = ServiceAdditional::where('service_id', $id)->get();
            $service_benifits = ServiceBenifit::where('service_id', $id)->get();
            $online_service_faq = OnlineServiceFaq::where('service_id', $id)->get();

                return view('frontend.user.seller.services.edit-service-attributes', compact(
                    'service',
                    'service_includes',
                    'service_additionals',
                    'service_benifits',
                    'online_service_faq',
                ));

        }else{
            abort(404);
        }

    }

    // service online to offline and offline to online
    public function editServiceAttributeOfflineToOnline(Request $request,$id=null)
    {
        $get_service = Service::where('id',$id)->where('seller_id',Auth::guard('web')->user()->id)->first();
        if($request->isMethod('post')) {
            $data = $request->all();

            $all_include_service = [];
            $all_additional_service = [];
            $all_benifits_service = [];
            $online_service_faqs = [];
            $service_total_price = 0;
            $service_total_price_with_new_added_attribute = 0;
            $service_count = 0;

            if(isset($data['is_service_online_id'])){
                if($data['is_service_online_id'] == 1){
                    $this->validate($request,[
                        'online_service_price' => 'required',
                        'delivery_days' => 'required',
                        'benifits.*' => 'max:191',
                        'faqs_title.*' => 'max:191',
                        'additional_service_title.*' => 'max:191',
                        'include_service_title.*' => 'max:191',
                    ]);

                    Serviceinclude::where('service_id',$id)->delete();
                    Serviceadditional::where('service_id',$id)->delete();
                    Servicebenifit::where('service_id',$id)->delete();

                    Service::where('id', $id)->update([
                        'price' => $data['online_service_price'],
                        'delivery_days' => $data['delivery_days'],
                        'revision' => $data['revision'],
                    ]);

                    if(isset($data['include_service_title'])){
                        foreach ($data['include_service_title'] as $key => $value) {
                            if (!empty($data['include_service_title'][$key])) {
                                $all_include_service[] = [
                                    'service_id' => $request->service_id,
                                    'seller_id' => Auth::guard('web')->user()->id,
                                    'include_service_title' => $data['include_service_title'][$key],
                                    'include_service_price' => 0,
                                    'include_service_quantity' => 0,
                                ];
                                $service_count++;
                            }
                        }
                    }
                }
            }

            if($data['is_service_online_id'] == 0){

                Serviceinclude::where('service_id',$id)->delete();
                Serviceadditional::where('service_id',$id)->delete();
                Servicebenifit::where('service_id',$id)->delete();

                foreach ($data['include_service_title'] as $key => $value) {
                    if (!empty($data['include_service_title'][$key])) {
                        $all_include_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => Auth::guard('web')->user()->id,
                            'include_service_title' => $data['include_service_title'][$key],
                            'include_service_price' => $data['include_service_price'][$key],
                            'include_service_quantity' => $data['include_service_quantity'][$key],
                        ];
                        $service_total_price += $data['include_service_price'][$key] * $data['include_service_quantity'][$key];
                        $service_count++;
                    }
                }
            }

            if($data['is_service_online_id'] == 0) {
                Serviceinclude::insert($all_include_service);
                $service_old_price = Service::where('id',$id)->select('price')->first();
                $service_total_price_with_new_added_attribute = $service_total_price;
                Service::where('id', $request->service_id)->update(['price' => $service_total_price_with_new_added_attribute]);
            }

            if(isset($data['additional_service_title'])) {
                foreach ($data['additional_service_title'] as $key => $value) {
                    if (!empty($data['additional_service_title'][$key])) {
                        $all_additional_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => Auth::guard('web')->user()->id,
                            'additional_service_title' => $data['additional_service_title'][$key],
                            'additional_service_price' => $data['additional_service_price'][$key],
                            'additional_service_quantity' => $data['additional_service_quantity'][$key],
                            'additional_service_image' => $data['image'][$key],
                        ];
                        $service_count++;
                    }
                }
            }

            if($service_count>=1){
                Serviceadditional::insert($all_additional_service);
            }

            if(isset($data['benifits'])) {
                foreach ($data['benifits'] as $key => $value) {
                    if (!empty($data['benifits'][$key])) {
                        $all_benifits_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => Auth::guard('web')->user()->id,
                            'benifits' => $data['benifits'][$key],
                        ];
                        $service_count++;
                    }
                }
            }

            if($service_count>=1){
                Servicebenifit::insert($all_benifits_service);
            }

            if(isset($data['faqs_title'])){
                foreach ($data['faqs_title'] as $key => $value) {
                    if (!empty($data['faqs_title'][$key])) {
                        $online_service_faqs[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => Auth::guard('web')->user()->id,
                            'title' => $data['faqs_title'][$key],
                            'description' => $data['faqs_description'][$key],
                        ];
                        $service_count++;
                    }
                }
            }
            if($service_count>=1){
                OnlineServiceFaq::insert($online_service_faqs);
            }

            // update offline to online service is_service_online value 0 to change 1 6060
            if($data['is_service_online_id'] == 1) {
                Service::where('id', $id)->update([
                    'is_service_online' => 1,
                ]);
            }

            //update online to offline service is_service_online value 1 to change 0
            if($data['is_service_online_id'] == 0) {
                OnlineServiceFaq::where('service_id', $id)->delete();
                Service::where('id', $id)->update([
                    'is_service_online' => 0,
                    'delivery_days' => 0,
                    'revision' => 0,
                    'online_service_price' => 0,
                ]);
            }

            if($service_count <= 0){
                toastr_error(__('Please input service attributes---'));
                return redirect()->back();
            }

            toastr_success(__('Service Edit attributes added success---'));

            return redirect()->route('seller.edit.service.attribute', $id);
        }
        if($get_service !=''){
            return view('frontend.user.seller.services.add-service-attributes-offline-to-online-by-id', compact('get_service'));
        }else{
            abort(404);
        }

    }

    public function ServiceDelete($id = null)
    {
        Serviceinclude::where('service_id',$id)->delete();
        Serviceadditional::where('service_id',$id)->delete();
        Servicebenifit::where('service_id',$id)->delete();
        OnlineServiceFaq::where('service_id',$id)->delete();
        Serviceaddresses::where('service_id',$id)->delete();
        Service::find($id)->delete();
        toastr_error(__('Service Delete Success---'));
        return redirect()->back();
    }

    public function showServiceAttributesById($id=null)
    {
        $seller_id = Auth::guard('web')->user()->id;
        $service = Service::select('id','title','image')
            ->where('id',$id)
            ->where('seller_id',$seller_id)
            ->first();

        if(!empty($service)){
            $include_service = Serviceinclude::where('service_id',$id)->get();
            $additional_service = Serviceadditional::where('service_id',$id)->get();
            $service_benifit = Servicebenifit::where('service_id',$id)->get();
            $service_faqs = OnlineServiceFaq::where('service_id',$id)->get();
            return view('frontend.user.seller.services.show-service-attributes-by-id', compact('service','include_service','additional_service','service_benifit', 'service_faqs'));
        }
        abort(404);
    }

    public function deleteIncludeService($id = null)
    {
        $include_details = Serviceinclude::find($id);

        //todo udpate service price
        $service_details = Service::where('id',$include_details->service_id)->first();
        $service_details->price -= $include_details->include_service_price * $include_details->include_service_quantity;
        $service_details->save();

        $include_details->delete();


        toastr_error(__('Include Service Delete Success---'));
        return redirect()->back();
    }

    public function deleteAdditionalService($id = null)
    {
        Serviceadditional::find($id)->delete();
        toastr_error(__('Additional Service Delete Success---'));
        return redirect()->back();
    }

    public function deleteBenifit($id = null)
    {
        Servicebenifit::find($id)->delete();
        toastr_error(__('Service Benifit Delete Success---'));
        return redirect()->back();
    }

    public function deleteFaq($id = null)
    {
        OnlineServiceFaq::find($id)->delete();
        toastr_error(__('Service Faq Delete Success---'));
        return redirect()->back();
    }

    //dates 
    public function days()
    {
        $days = Day::with('schedules')->where('seller_id',Auth::guard('web')->user()->id)->get();
        $total_day = Day::select('total_day')->where('seller_id',Auth::guard('web')->user()->id)->first();
        return view('frontend.user.seller.day-and-schedule.days',compact('days','total_day'));
    }

    public function addDay(Request $request)
    {
        $request->validate([
            'day' => 'required',
        ]);

        $day = Day::select('day','seller_id')
            ->where('seller_id',Auth::guard('web')->user()->id)
            ->where('day',$request->day)
            ->first();
        if(!empty($day)){
            toastr_error(__('Day Already Exists---'));
            return redirect()->back();
        }

        Day::create([
            'day' => $request->day,
            'status' => 0,
            'seller_id' => Auth::guard('web')->user()->id,
            'total_day' => 7,
        ]);

        toastr_success(__('Day Added Success---'));
        return redirect()->back();
    }

    public function dayDelete($id = null)
    {
        Schedule::where('day_id',$id)->delete();
        Day::find($id)->delete();
        toastr_error(__('Day Delete Success---'));
        return redirect()->back();
    }

    public function updateTotalDay(Request $request){
        Day::where('seller_id',Auth::guard('web')->user()->id)
            ->update(['total_day'=>$request->total_day]);
        toastr_success(__('Service Day Update Success---'));
        return redirect()->back();
    }

    //schedules
    public function schedules()
    {
        $schedules = Schedule::with('days')->where('seller_id',Auth::guard('web')->user()->id)->paginate(10);
        $days = Day::where('seller_id',Auth::guard('web')->user()->id)->get();
        //todo: insert days programmatically if no days available
        $days_lists = $days->pluck('day')->toArray();
        $days_need_to_add = ['Sat','Sun','Mon','Tue','Wed','Thu','Fri'];
        if(empty($days_lists)){
            foreach($days_need_to_add as $dlit){
                if (!in_array($dlit,$days_lists)){
                    Day::create([
                        'day' => $dlit,
                        'status' => 0,
                        'seller_id' => Auth::guard('web')->user()->id,
                        'total_day' => 7,
                    ]);
                }
            }
        }

        return view('frontend.user.seller.day-and-schedule.schedules',compact('schedules','days'));
    }

    public function addSchedule(Request $request)
    {
        $rule = $request->has('schedule_for_all_days') ? 'nullable' : 'required';
        $request->validate([
            'day_id' => $rule.'|integer',
            'schedule' => 'required',
        ]);
        if($request->has('schedule_for_all_days')){
            $days = Day::where('seller_id',Auth::guard('web')->user()->id)->get();
            foreach($days as $day){
                Schedule::create([
                    'day_id' => $day->id,
                    'seller_id' => Auth::guard('web')->user()->id,
                    'schedule' => $request->schedule,
                    'status' => 0,
                    'allow_multiple_schedule' => 'no',
                ]);
            }
            toastr_success(__('Schedule Added Success---'));
            return redirect()->back();
        }
        Schedule::create([
            'day_id' => $request->day_id,
            'seller_id' => Auth::guard('web')->user()->id,
            'schedule' => $request->schedule,
            'status' => 0,
            'allow_multiple_schedule' => 'no',
        ]);

        toastr_success(__('Schedule Added Success---'));
        return redirect()->back();
    }

    public function editSchedule(Request $request)
    {
        $request->validate([
            'up_day_id' => 'required',
            'up_schedule' => 'required',
        ]);

        Schedule::where('id',$request->up_id)->update([
            'day_id' => $request->up_day_id,
            'seller_id' => Auth::guard('web')->user()->id,
            'schedule' => $request->up_schedule,
        ]);

        toastr_success(__('Schedule Update Success---'));
        return redirect()->back();
    }

    public function scheduleDelete($id = null)
    {
        Schedule::find($id)->delete();
        toastr_error(__('Schedule Delete Success---'));
        return redirect()->back();
    }

    public function allow(Request $request)
    {
        Schedule::where('seller_id',Auth::guard('web')->user()->id)->update([
            'allow_multiple_schedule'=>$request->allow_multiple_schedule,
        ]);
        toastr_success(__('Update Success---'));
        return back();
    }

    //orders
    public function pendingOrders(Request $request)
    {
        if(!empty($request->order_id || $request->order_date)){
            $order_query = Order::with('service')->where('seller_id', Auth::guard('web')->user()->id)->where('status',0);

            if (!empty($request->order_id)){
                $order_query->where('id', $request->order_id);
            }

            // search by date range
            if (!empty($request->order_date)){
                $start_date = \Str::of($request->order_date)->before('to');
                $end_date = \Str::of($request->order_date)->after('to');
                $order_query->whereBetween('created_at', [$start_date,$end_date]);
            }
            $pending_orders = $order_query->paginate(10);

        }else{
            $pending_orders = Order::with('service')
                ->where('seller_id', Auth::guard('web')->user()->id)
                ->where('status',0)
                ->paginate(10);
        }

        return view('frontend.user.seller.order.pending-orders', compact('pending_orders'));
    }

    public function orderDelete($id=null)
    {
        $order = Order::find($id);
        if($order->payment_status == 'pending' || $order->payment_status == ''){
            Order::find($id)->delete();
            toastr_error(__('Service Request Delete Success---'));
        }else{
            toastr_error(__('Service Request Can Not be Deleted Due to Payment Status Complete---'));
        }
        return redirect()->back();
    }

    public function sellerOrders(Request $request)
    {

        if(!empty($request->order_id || $request->order_date|| $request->payment_status || $request->order_status || $request->total || $request->seller_name || $request->service_title)){

            $orders_query = Order::with('online_order_ticket')->where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL);
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

        }else{
            $all_orders = Order::with('online_order_ticket')->where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->latest()->paginate(10);

        }

        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->get();
        $pending_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',0);
        $active_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',1);
        $complete_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',2);
        $deliver_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',3);
        $cancel_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',4);
        $incompetent_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',5);
        $isHideSideBarAndHeader = true;
        $penalties = Penalty::all();
        return view('frontend.user.seller.order.orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders', 'incompetent_orders', 'all_orders', 'pending_orders', 'isHideSideBarAndHeader', 'penalties'));
    }

    public function serviceProviderRequests(Request $request)
    {
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
        }else{
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

    public function sellerJobOrders(Request $request)
    {

        if(!empty($request->order_id || $request->order_date|| $request->payment_status || $request->order_status || $request->total || $request->job_title || $request->seller_name)){

            $orders_query = Order::with('online_order_ticket')
                ->where('seller_id', Auth::guard('web')->user()->id)
                ->where('job_post_id', '!=', NULL);

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

            // search by job title
            if (!empty($request->job_title)){
                $job_id = BuyerJob::select('id', 'title')->where('title',  'LIKE', "%{$request->job_title}%")->pluck('id')->toArray();
                $orders_query->whereIn('job_post_id', $job_id);
            }

            // search by seller name
            if (!empty($request->buyer_name)){
                $buyer_id = User::select('id', 'name')->where('name',  'LIKE', "%{$request->buyer_name}%")->pluck('id')->toArray();
                $orders_query->whereIn('buyer_id', $buyer_id);
            }

            $all_orders = $orders_query->latest()->paginate(10);

        }else{
            $all_orders = Order::with('online_order_ticket')->where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->latest()->paginate(10);

        }

        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->get();
        $pending_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=',NULL)->where('status',0);
        $active_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',1);
        $complete_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',2);
        $deliver_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',3);
        $cancel_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',4);
        $incompetent_orders = Order::where('seller_id',  Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',5);
        $isHideSideBarAndHeader = true;
        $penalties = Penalty::all();
        return view('frontend.user.seller.order.orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders', 'all_orders', 'pending_orders', 'incompetent_orders', 'isHideSideBarAndHeader', 'penalties'));
    }

    public function activeOrders()
    {
        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL);
        $active_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',1)->paginate(10);
        $complete_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',2);
        $deliver_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',3);
        $cancel_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',4);
        return view('frontend.user.seller.order.active-orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders'));
    }

    public function activeJobOrders()
    {
        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL);
        $active_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',1)->paginate(10);
        $complete_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',2);
        $deliver_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',3);
        $cancel_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',4);
        return view('frontend.user.seller.order.active-orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders'));
    }

    public function completeOrders()
    {
        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL);
        $active_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',1);
        $complete_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',2)->paginate(10);
        $deliver_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',3);
        $cancel_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',4);
        return view('frontend.user.seller.order.complete-orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders'));
    }

    public function completeJobOrders()
    {
        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL);
        $active_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',1);
        $complete_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',2)->paginate(10);
        $deliver_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',3);
        $cancel_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',4);
        return view('frontend.user.seller.order.complete-orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders'));
    }

    public function deliverOrders()
    {
        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL);
        $active_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',1);
        $complete_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',2);
        $deliver_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',3)->paginate(10);
        $cancel_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',4);
        return view('frontend.user.seller.order.deliver-orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders'));
    }

    public function deliverJobOrders()
    {
        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL);
        $active_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',1);
        $complete_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',2);
        $deliver_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',3)->paginate(10);
        $cancel_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',4);
        return view('frontend.user.seller.order.deliver-orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders'));
    }

    public function cancelOrders()
    {
        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL);
        $active_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',1);
        $complete_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',2);
        $deliver_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',3);
        $cancel_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', NULL)->where('status',4)->paginate(10);
        return view('frontend.user.seller.order.cancel-orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders'));
    }

    public function cancelJobOrders()
    {
        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL);
        $active_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',1);
        $complete_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',2);
        $deliver_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',3);
        $cancel_orders = Order::where('seller_id', Auth::guard('web')->user()->id)->where('job_post_id', '!=', NULL)->where('status',4)->paginate(10);
        return view('frontend.user.seller.order.cancel-orders', compact('orders','active_orders','complete_orders','deliver_orders','cancel_orders'));
    }

    public function orderDetails($id=null)
    {
        $order_details = Order::where('id',$id)->where('seller_id',Auth::guard('web')->user()->id)->first();
        $order_declines_history = OrderCompleteDecline::where('order_id',$id)->latest()->get();
        if(!empty($order_details)){
            $order_includes = OrderInclude::where('order_id',$id)->get();
            $order_additionals = OrderAdditional::where('order_id',$id)->get();
            foreach(Auth::guard('web')->user()->unreadNotifications()->where('data->order_message' , 'You have a new service request')->get() as $notification){
                if($order_details->id == $notification->data['order_id']){
                    $Notification = Auth::guard('web')->user()->Notifications->find($notification->id);
                    if($Notification){
                        $Notification->markAsRead();
                    }
                    return view('frontend.user.seller.order.order-details', compact('order_details','order_includes','order_additionals','order_declines_history'));
                }
            }
            return view('frontend.user.seller.order.order-details', compact('order_details','order_includes','order_additionals','order_declines_history'));
        }else{
            abort(404);
        }

    }

    public function orderDetailsForUpdate(Request $request)
    {
        $order_details = Order::where('id',$request->id)->first();
        $order_declines_history = OrderCompleteDecline::where('order_id',$request->id)->latest()->get();
        if(!empty($order_details)){
            return $order_details;
        }else{
            abort(404);
        }
    }
    
    public function orderStatus(Request $request,$id=null)
    {

        $pipelineData = Pipeline::all();
        $stageData = Stage::all();
        if($request->status == ''){
            toastr_error(__('Please select status first.'));
            return redirect()->back();
        }

        $payment_status = Order::select('id','payment_status','status','email','name')->where('id',$request->order_id)->first();

        $cancel_order_money_return = Order::select('id','cancel_order_money_return')->where('id',$request->order_id)->first();
        if($cancel_order_money_return->cancel_order_money_return === 1){
            toastr_error(__('You can not change status because earlier you canceled the order'));
            return redirect()->back();
        }

        if($payment_status->status !=2){
            if($payment_status->payment_status =='complete'){
                $order_details = Order::select(['id','seller_id','buyer_id','service_id','ticket_pipeline_id','ticket_pipeline_name'])->where('id',$request->order_id)->first();
                $seller = User::select(['id','email','name'])->where('id',$order_details->seller_id)->first();
                if($request->status==2){
                    Order::where('id',$request->order_id)->update(['order_complete_request'=>1]);
                    toastr_success(__('Your request submitted. Customer will complete your request after review'));
                    OrderCompleteDecline::create([
                        'order_id'=>$order_details->id,
                        'buyer_id'=>$order_details->buyer_id,
                        'seller_id'=>$order_details->seller_id,
                        'service_id'=>$order_details->service_id,
                        'decline_reason'=>'Not decline yet',
                        'image' => $request->image,
                    ]);
                    \Log::debug("Pipeline Id" . $order_details->ticket_pipeline_id);
                    \Log::debug("Pipeline Name" . $order_details->ticket_pipeline_name);
                    // update ticket stage to completion needs approval
                    foreach($pipelineData as $pipeline){
                        foreach($stageData as $stage){
                            if ($stage->stage_action_key == "completion" && $pipeline->id == $stage->pipeline_id && $order_details->ticket_pipeline_name == $pipeline->pipeline_name) {
                                event(new UpdateTicket([
                                    'sr_id' => $order_details->id,
                                    'stage_name' => $stage->stage_name,
                                    'service_ticket_id' => $order_details->service_ticket_id,
                                    'service_provider_id' => $order_details->seller_id,
                                    'service_provider_email' => $seller->email,
                                    'service_provider_name' => $seller->name,
                                    'ticket_pipeline_name' => $order_details->ticket_pipeline_name,
                                ]));
                                break;
                            }
                        }
                    }

                    //Send email after change status
                    try {
                        $message_body_buyer =__('Hello, ').$payment_status->name. __(' A new request is created for complete an service request.').'</br>' . ' <span class="verify-code">'.__('Service Request ID is: ') . $payment_status->id. '</span>';
                        $message_body_admin =__('Hello Admin A new request is created for complete an service request.').'</br>' . ' <span class="verify-code">'.__('Service Request ID is: ') . $payment_status->id. '</span>';
                        Mail::to($payment_status->email)->send(new BasicMail([
                            'subject' => __('New Request For Complete an Service Request'),
                            'message' => $message_body_buyer
                        ]));
                        Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                            'subject' => __('New Request For Complete an Service Request'),
                            'message' => $message_body_admin
                        ]));
                    } catch (\Exception $e) {
                        return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
                    }

                    return redirect()->back();
                }elseif($request->status==3){
                    \Log::debug("Insinde SLM selected");
                    \Log::debug("Progress Type : " . $request->progress_type);
                    if ($request->progress_type == 'SLM') {
                        foreach($pipelineData as $pipeline){
                            foreach($stageData as $stage){
                                if ($stage->stage_action_key == "escalate_to_slm" && $pipeline->id == $stage->pipeline_id) {
                                    event(new UpdateTicket([
                                        'sr_id' => $order_details->id,
                                        'stage_name' => $stage->stage_name,
                                        'service_ticket_id' => $order_details->service_ticket_id,
                                        'service_provider_id' => $order_details->seller_id,
                                        'service_provider_email' => $seller->email,
                                        'service_provider_name' => $seller->name,
                                        'ticket_pipeline_name' => $order_details->ticket_pipeline_name,
                                    ]));
                                    break;
                                }
                            }
                        }
                        Order::where('id',$request->order_id)->update(['payment_status'=>'','status'=>5]);
                        toastr_success(__('Your request submitted. Assign to SLM'));
                    } elseif($request->progress_type == "Spares Required") {
                        event(new UpdateTicket([
                            'sr_id' => $order_details->id,
                            'stage_name' => 'SPARES REQUIRED',
                            'service_ticket_id' => $order_details->service_ticket_id,
                            'service_provider_id' => $order_details->seller_id,
                            'service_provider_email' => $seller->email,
                            'service_provider_name' => $seller->name,
                        ]));
                        toastr_success(__('Your request submitted. Ask for spare parts'));
                    }
                    
                    //Send email after change status
                    try {
                        $message_body_buyer =__('Hello, ').$payment_status->name. __(' A new request is created for complete an service request.').'</br>' . ' <span class="verify-code">'.__('Service Request ID is: ') . $payment_status->id. '</span>';
                        $message_body_admin =__('Hello Admin A new request is created for complete an service request.').'</br>' . ' <span class="verify-code">'.__('Service Request ID is: ') . $payment_status->id. '</span>';
                        Mail::to($payment_status->email)->send(new BasicMail([
                            'subject' => __('New Request For Complete an Service Request'),
                            'message' => $message_body_buyer
                        ]));
                        Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                            'subject' => __('New Request For Complete an Service Request'),
                            'message' => $message_body_admin
                        ]));
                    } catch (\Exception $e) {
                        return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
                    }
                    return redirect()->back();
                }
            }else{

                toastr_error(__('You can not change service request status due to payment status pending'));
                return redirect()->back();
            }
        }else{
            toastr_error(__('You can not change service request status because this service request already completed.'));
            return redirect()->back();
        }
    }

    public function orderCancel($id=null)
    {
        $pipelineData = Pipeline::all();
        $stageData = Stage::all();
        Order::where('id',$id)->update(['payment_status'=>'','status'=>4]);
        $orderData = Order::where('id',$id)->get();
        $order_info_decode = json_decode($orderData, true);
        $statusValue = $order_info_decode[0]['status'];
        $SR_ID = $order_info_decode[0]['id'];
        $seller = User::select(['id','email','name'])->where('id',$order_info_decode[0]['seller_id'])->first();
        if ($statusValue == 4){
            // update ticket stage to Waiting to Assign 
            foreach($pipelineData as $pipeline){
                foreach($stageData as $stage){
                    if ($stage->stage_action_key == "assign" && $pipeline->id == $stage->pipeline_id && $order_info_decode[0]['ticket_pipeline_name'] == $pipeline->pipeline_name) {
                        event(new UpdateTicket([
                            'sr_id' => $SR_ID,
                            'stage_name' => $stage->name,
                            'service_ticket_id' => $order_info_decode[0]['service_ticket_id'],
                            'service_provider_id' => $order_info_decode[0]['seller_id'],
                            'service_provider_email' => $seller->email,
                            'service_provider_name' => $seller->name,
                            'ticket_pipeline_name' => $order_info_decode[0]['ticket_pipeline_name'],
                        ]));
                    }
                }
            }
        }
        toastr_success(__('Service Request successfully cancelled.'));
        return redirect()->back();
    }

    public function orderAccept($id=null)
    {
        $pipelineData = Pipeline::all();
        $stageData = Stage::all();
        Order::where('id',$id)->update(['status'=>1]);
        $orderData = Order::where('id',$id)->get();
        $order_info_decode = json_decode($orderData, true);
        $statusValue = $order_info_decode[0]['status'];
        $SR_ID = $order_info_decode[0]['id'];
        $seller = User::select(['id','email','name'])->where('id',$order_info_decode[0]['seller_id'])->first();
        if ($statusValue == 1){
            // update ticket stage to accepted by service provider
            foreach($pipelineData as $pipeline){
                foreach($stageData as $stage){
                    if ($stage->stage_action_key == "accept" && $pipeline->id == $stage->pipeline_id && $order_info_decode[0]['ticket_pipeline_name'] == $pipeline->pipeline_name) {
                        event(new UpdateTicket([
                            'sr_id' => $SR_ID,
                            'stage_name' => $stage->stage_name,
                            'service_ticket_id' => $order_info_decode[0]['service_ticket_id'],
                            'service_provider_id' => $order_info_decode[0]['seller_id'],
                            'service_provider_email' => $seller->email,
                            'service_provider_name' => $seller->name,
                            'ticket_pipeline_name' => $order_info_decode[0]['ticket_pipeline_name'],
                        ]));
                        break;
                    }
                }
            }
        }
        toastr_success(__('Service Request successfully accepted.'));
        return redirect()->back();
    }

    public function orderIncompetent(Request $request, $id=null)
    {
        $pipelineData = Pipeline::all();
        $stageData = Stage::all();
        $penaltyId = $request->input('penalty_reason_id');
        $penaltyReason = $request->input('penalty_reason_text');
        Order::where('id',$id)->update(['payment_status'=>'','status'=>5]);
        $orderData = Order::where('id',$id)->get();
        $order_info_decode = json_decode($orderData, true);
        $statusValue = $order_info_decode[0]['status'];
        $SR_ID = $order_info_decode[0]['id'];
        $packageFee = $order_info_decode[0]['package_fee'];
        $penaltyPercentage = Penalty::select('penalty_percentage')->where('id',$penaltyId)->first();
        $penaltyAmount = ($packageFee * $penaltyPercentage->penalty_percentage) / 100;
        PayoutRequest::create([
            'seller_id' => Auth::guard('web')->user()->id,
            'payment_type' => 'Penalty',
            'amount' => $penaltyAmount,
            'payment_gateway' => "Payment_AMC",
            'seller_note' => "Penalty Amount",
            'status' => 1,
        ]);
        $seller = User::select(['id','email','name'])->where('id',$order_info_decode[0]['seller_id'])->first();
        if ($statusValue == 5){
            // update ticket stage to Waiting to Assign 
            foreach($pipelineData as $pipeline){
                foreach($stageData as $stage){
                    if ($stage->stage_action_key == "assign" && $pipeline->id == $stage->pipeline_id && $order_info_decode[0]['ticket_pipeline_name'] == $pipeline->pipeline_name) {
                        event(new UpdateTicket([
                            'sr_id' => $SR_ID,
                            'stage_name' => $stage->stage_name,
                            'service_ticket_id' => $order_info_decode[0]['service_ticket_id'],
                            'service_provider_id' => $order_info_decode[0]['seller_id'],
                            'service_provider_email' => $seller->email,
                            'service_provider_name' => $seller->name,
                            'ticket_pipeline_name' => $order_info_decode[0]['ticket_pipeline_name'],
                        ]));
                    }
                }
            }
        }
        toastr_success(__('Service Request successfully Incompetent.'));
        return redirect()->back();
    }

    public function orderPaymentStatus(Request $request,$id=null)
    {

        $this->validate($request,[
            'order_id' => 'required',
            'status' => 'required|string'
        ]);
        $payment_status = Order::select('payment_status','status', 'job_post_id')->where(['id' => $request->order_id,'seller_id' => Auth::guard('web')->id()])->first();

        if (!is_null($payment_status)){
            Order::where(['id' => $request->order_id,'seller_id' => Auth::guard('web')->id()])->update([
                'payment_status' =>  $request->status
            ]);
        }
        toastr_success(sprintf(__('Payment Status Has been changed to %s'),$request->status));
        return redirect()->back();
    }

    //seller report
    public function reportUs(Request $request)
    {
        $request->validate([
            'report' => 'required',
        ]);

        $seller_id = Auth::guard()->check() ? Auth::guard('web')->user()->id : NULL;
        $is_report_exist = Report::where(['order_id'=>$request->order_id , 'report_from'=>'seller'])->first();

        if($is_report_exist){
            toastr_error(__('Report Already Created For This Order'));
            return redirect()->back();
        }
        $report = Report::create([
            'order_id' => $request->order_id,
            'service_id' => $request->service_id,
            'seller_id' => $seller_id,
            'buyer_id' => $request->buyer_id,
            'report_from' => 'seller',
            'report_to' => 'buyer',
            'report' => $request->report,
        ]);

        $last_report_id = $report->id;
        try {
            $message = get_static_option('seller_report_message');
            $message = str_replace(["@report_id"],[$last_report_id],$message);
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => get_static_option('seller_report_subject') ?? __('Seller New Report'),
                'message' => $message
            ]));
        } catch (\Exception $e){
            return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
        }
        toastr_success(__('Report Send Success'));
        return redirect()->back();
    }

    public function reportList(Request $request)
    {
        if(!empty($request->order_id || $request->report_id || $request->report_date)){
            $reports_query = Report::where('seller_id', Auth::guard('web')->user()->id);
            if (!empty($request->order_id)){
                $reports_query->where('order_id', $request->order_id);
            }
            if (!empty($request->report_id)){
                $reports_query->where('id', $request->report_id);
            }
            // search by date range
            if (!empty($request->report_date)){
                $start_date = \Str::of($request->report_date)->before('to');
                $end_date = \Str::of($request->report_date)->after('to');
                $reports_query->whereBetween('created_at', [$start_date,$end_date]);
            }
            $reports = $reports_query->paginate(10);

        }else{
            $reports = Report::where('seller_id',Auth::guard('web')->user()->id)->paginate(10);
        }

        return view('frontend.user.seller.report.report-list',compact('reports'));
    }

    public function chat_to_admin(Request $request, $report_id)
    {
        $seller_id = Auth::guard('web')->user()->id;
        if($request->isMethod('post')){
            $this->validate($request,[
                'message' => 'required',
                'notify' => 'nullable|string',
                'attachment' => 'nullable|mimes:zip,jpg,jpeg,png,pdf,webp,xlsx, csv, xls,docx',
            ]);

            $ticket_info = ReportChatMessage::create([
                'report_id' => $report_id,
                'seller_id' => $seller_id,
                'message' => $request->message,
                'type' =>'seller',
                'notify' => $request->send_notify_mail ? 'on' : 'off',
            ]);

            if ($request->hasFile('attachment')){
                $uploaded_file = $request->attachment;
                $file_extension = $uploaded_file->extension();
                $file_name =  pathinfo($uploaded_file->getClientOriginalName(),PATHINFO_FILENAME).time().'.'.$file_extension;
                $uploaded_file->move('assets/uploads/ticket',$file_name);
                $ticket_info->attachment = $file_name;
                $ticket_info->save();
            }

            //send mail to user
//            event(new SupportMessage($ticket_info));
            return redirect()->back()->with(FlashMsg::item_new(__('Message Send')));
        }
        $report_details = Report::where('id',$report_id)->where('seller_id',$seller_id)->first();
        $all_messages = ReportChatMessage::where('report_id',$report_id)
            ->where('seller_id',$seller_id)
            ->get();
        $q = $request->q ?? '';
        return view('frontend.user.seller.report.report-chat',compact('report_details','all_messages','q'));

    }

    //payout request 
    public function payoutRequest(Request $request,$id=null)
    {

        $seller_id = Auth::guard('web')->user()->id;

        if(!empty($request->payout_history_id || $request->status || $request->payout_request_date)){
            $payout_history_query = PayoutRequest::where('seller_id',$seller_id);

            if (!empty($request->payout_history_id)){
                $payout_history_query->where('id', $request->payout_history_id);
            }
            if (!empty($request->status)){
                if ($request->status == 'pending'){
                    $payout_history_query->where('status', 0);
                }else{
                    $payout_history_query->where('status', $request->status);
                }

            }
            // search by date range
            if (!empty($request->payout_request_date)){
                $start_date = \Str::of($request->payout_request_date)->before('to');
                $end_date = \Str::of($request->payout_request_date)->after('to');
                $payout_history_query->whereBetween('created_at', [$start_date,$end_date]);
            }
            $all_payout_request = $payout_history_query->paginate(10);

        }else{
            $all_payout_request = PayoutRequest::where('seller_id',$seller_id)->paginate(10);
        }

        $total_earnings = 0;
        $pending_order = Order::where(['status'=>0,'seller_id'=>$seller_id])->count();
        $complete_order = Order::where(['status'=>2,'seller_id'=>$seller_id])->count();
        $complete_order_balance_with_tax = Order::where(['status'=>2,'seller_id'=>$seller_id])->sum('total');
        $complete_order_tax = Order::where(['status'=>2,'seller_id'=>$seller_id])->sum('tax');
        $complete_order_balance_without_tax = $complete_order_balance_with_tax - $complete_order_tax;
        $admin_commission_amount = Order::where(['status'=>2,'seller_id'=>$seller_id])->sum('commission_amount');
        $remaning_balance = $complete_order_balance_without_tax-$admin_commission_amount;
        $total_earnings = PayoutRequest::where('seller_id',$seller_id)->where('payment_type', 'Withdraw')->sum('amount');
        $total_penalties = PayoutRequest::where('seller_id',$seller_id)->where('payment_type', 'Penalty')->sum('amount');
        return view('frontend.user.seller.payout.payout-request',compact(
            'pending_order','complete_order','remaning_balance','all_payout_request','total_earnings','total_penalties'
        ));
    }

    public function createPayoutRequest(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request,[
                'amount' => 'required|numeric',
                'payment_gateway' => 'required|string|max:191',
            ],[
                'amount.required' => __('Amount required'),
                'amount.numeric' => __('Amount must be numeric'),
                'payment_gateway.required' =>  __('Payment Gateway required'),
            ]);

            $seller_id = Auth::guard('web')->user()->id;

            $complete_order_balance_with_tax = Order::where(['status'=>2,'seller_id'=>$seller_id])->sum('total');
            $complete_order_tax = Order::where(['status'=>2,'seller_id'=>$seller_id])->sum('tax');
            $complete_order_balance_without_tax = $complete_order_balance_with_tax - $complete_order_tax;
            $admin_commission_amount = Order::where(['status'=>2,'seller_id'=>$seller_id])->sum('commission_amount');
            $remaning_balance = $complete_order_balance_without_tax-$admin_commission_amount;
            $total_earnings = PayoutRequest::where('seller_id',$seller_id)->where('payment_type', 'Withdraw')->sum('amount');
            $total_penalties = PayoutRequest::where('seller_id',$seller_id)->where('payment_type', 'Penalty')->sum('amount');
            $available_balance = $remaning_balance - $total_earnings;
            if($request->amount<=0 || $request->amount >$available_balance){
                toastr_error(__('Enter a valid amount'));
                return redirect()->back();
            }

            $min_amount = AmountSettings::select('min_amount')->first();
            $max_amount = AmountSettings::select('max_amount')->first();
            if($request->amount < $min_amount->min_amount){
                $msg = sprintf(__('Withdraw amount not less than %s'),float_amount_with_currency_symbol($min_amount->min_amount));
                toastr_error($msg);
                return redirect()->back();
            }
            if($request->amount > $max_amount->max_amount){
                $msg = sprintf(__('Withdraw amount must less or equal to %s'),float_amount_with_currency_symbol($max_amount->max_amount));
                toastr_error($msg);
                return redirect()->back();
            }

            PayoutRequest::create([
                'seller_id' => Auth::guard('web')->user()->id,
                'payment_type' => 'Withdraw',
                'amount' => $request->amount,
                'payment_gateway' => $request->payment_gateway,
                'seller_note' => $request->seller_note,
                'status' => 0,
            ]);

            $last_payout_request_id = DB::getPdo()->lastInsertId();
            try {
                $message = get_static_option('seller_payout_message');
                $message = str_replace(["@payout_request_id"],[$last_payout_request_id],$message);
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => get_static_option('seller_payout_subject') ?? __('New Payout Request'),
                    'message' => $message
                ]));
            } catch (\Exception $e) {
                return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
            }

            toastr_success(__('Payment request create success'));
            return redirect()->back();

        }
    }

    public function PayoutRequestDetails($id=null)
    {
        $request_details = PayoutRequest::where('id',$id)
            ->where('seller_id',Auth::guard('web')
                ->user()->id)
            ->first();
        if($request_details != ''){
            return view('frontend.user.seller.payout.payout-request-details',compact('request_details'));
        }else{
            abort(404);
        }
    }

    //reviews 
    public function serviceReview(Request $request)
    {

        if(!empty($request->title || $request->service_date)){
            $service_review_query = Service::whereHas('reviews')->where('seller_id', Auth::user()->id);
            if (!empty($request->title)){
                $service_review_query->where('title', 'LIKE', "%{$request->title}%");
            }
            // search by date range
            if (!empty($request->service_date)){
                $start_date = \Str::of($request->service_date)->before('to');
                $end_date = \Str::of($request->service_date)->after('to');
                $service_review_query->whereBetween('created_at', [$start_date,$end_date]);
            }
            $services = $service_review_query->paginate(10);

        }else{
            $services = Service::whereHas('reviews')->where('seller_id', Auth::user()->id)->paginate(10);
        }

        return view('frontend.user.seller.services.service-reviews', compact('services'));
    }

    public function serviceReviewAll($id=null)
    {

        $service_reviews = Review::where('service_id',$id)
            ->where('seller_id',Auth::guard('web')->user()->id)->where('type', 1)
            ->paginate(10);

         return view('frontend.user.seller.services.service-all-reviews', compact('service_reviews'));

    }

    public function reviewDelete($id=null)
    {
        Review::find($id)->delete();
        toastr_error(__('Review Delete Success---'));
        return redirect()->back();
    }

    public function allTickets(Request $request)
    {
        if(!empty($request->title || $request->order_id || $request->ticket_id || $request->ticket_date)){
            $tickets_query = SupportTicket::where('seller_id', Auth::guard('web')->user()->id);
            if (!empty($request->title)){
                $tickets_query->where('title', 'LIKE', "%{$request->title}%");
            }
            if (!empty($request->order_id)){
                $tickets_query->where('order_id', $request->order_id);
            }
            if (!empty($request->ticket_id)){
                $tickets_query->where('id', $request->ticket_id);
            }

            // search by date range
            if (!empty($request->ticket_date)){
                $start_date = \Str::of($request->ticket_date)->before('to');
                $end_date = \Str::of($request->ticket_date)->after('to');
                $tickets_query->whereBetween('created_at', [$start_date,$end_date]);
            }

            $tickets = $tickets_query->orderBy('id','desc')->paginate(10);
        }else{
            $tickets = SupportTicket::where('seller_id',Auth::guard('web')->user()->id)->orderBy('id','desc')->paginate(10);
        }

        $orders = Order::where('seller_id', Auth::guard('web')->user()->id)
            ->where('payment_status', '!=','')
            ->whereNotNull('buyer_id',)
            ->latest()->get();
        return view('frontend.user.seller.support-ticket.all-tickets', compact('tickets','orders'));
    }

    public function addNewTicket(Request $request,$id=null)
    {
        if($request->isMethod('post')){
            $seller_id = Auth::guard('web')->user()->id;
            if($request->order_id){
                $buyer_id = Order::select('buyer_id')->where('id',$request->order_id)->first();
            }

            $this->validate($request,[
                'title' => 'required|string|max:191',
                'subject' => 'required|string|max:191',
                'priority' => 'required|string|max:191',
                'description' => 'required|string',
                'order_id' => 'required|string'
            ],[
                'title.required' => __('title required'),
                'subject.required' =>  __('subject required'),
                'priority.required' =>  __('priority required'),
                'description.required' => __('description required'),
            ]);


            SupportTicket::create([
                'title' => $request->title,
                'description' => $request->description,
                'subject' => $request->subject,
                'status' => 'open',
                'priority' => $request->priority,
                'seller_id' => $seller_id,
                'buyer_id' => $buyer_id->buyer_id,
                'order_id' => $request->order_id,
            ]);
            toastr_success(__('Ticket successfully created.'));
            $last_ticket_id = DB::getPdo()->lastInsertId();
            $last_ticket = SupportTicket::where('id',$last_ticket_id)->first();

            // send order ticket notification to buyer
            $buyer = User::where('id',$last_ticket->buyer_id)->first();
            if($buyer){
                $order_ticcket_message = __('You have a new service request ticket');
                $buyer ->notify(new TicketNotification($last_ticket_id , $seller_id, $last_ticket->buyer_id,$order_ticcket_message ));
            }
            // admin notification add
            AdminNotification::create(['ticket_id' => $last_ticket_id]);

            //Send ticket mail to buyer and admin
            try {
                $message = get_static_option('seller_order_ticket_message');
                $message = str_replace(["@order_ticket_id"],[$last_ticket_id],$message);
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => get_static_option('order_ticket_subject') ?? __('New Service Request Ticket'),
                    'message' => $message
                ]));
                Mail::to($buyer->email)->send(new BasicMail([
                    'subject' => get_static_option('seller_order_ticket_subject') ?? __('New Service Request Ticket'),
                    'message' => $message
                ]));
            } catch (\Exception $e) {
                return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
            }

            return redirect()->back();
        }

        $order = Order::select('id','service_id','buyer_id')
            ->where('id',$id)
            ->where('seller_id',Auth::guard('web')->user()->id)
            ->first();
        return view('frontend.user.seller.support-ticket.add-new-ticket', compact('order'));
    }

    public function ticketDelete($id=null)
    {
        SupportTicket::find($id)->delete();
        toastr_error(__('Ticket Delete Success---'));
        return redirect()->back();
    }

    //view ticket 
    public function view_ticket(Request $request,$id){
        $ticket_details = SupportTicket::findOrFail($id);
        $all_messages = SupportTicketMessage::where(['support_ticket_id'=>$id])->get();
        $q = $request->q ?? '';

        foreach(Auth::guard('web')->user()->notifications as $notification){
            if($ticket_details->id == array_key_exists("seller_last_ticket_id",$notification->data)){
                $Notification = Auth::guard('web')->user()->Notifications->find($notification->id);
                if($Notification){
                    $Notification->markAsRead();
                }
                return view('frontend.user.seller.support-ticket.view-ticket', compact('ticket_details','all_messages','q'));
            }
        }
        return view('frontend.user.seller.support-ticket.view-ticket', compact('ticket_details','all_messages','q'));
    }

    //priority status 
    public function priorityChange(Request $request)
    {
        SupportTicket::where('id',$request->ticket_id)->update(['priority'=>$request->priority]);
        toastr_success(__('Priority Change Success---'));
        return redirect()->back();
    }

    //change status 
    public function statusChange($id=null)
    {
        $status = SupportTicket::find($id);
        if($status->status=='open'){
            $status = 'close';
        }else{
            $status = 'open';
        }
        SupportTicket::where('id',$id)->update(['status'=>$status]);
        toastr_success(__('Status Change Success---'));
        return redirect()->back();
    }

    //send message 
    public function support_ticket_message(Request $request)
    {
        $this->validate($request,[
            'ticket_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
            'send_notify_mail' => 'nullable|string',
            'file' => 'nullable|mimes:zip,jpg,jpeg,png,pdf,webp,xlsx, csv, xls,docx',
        ]);

        $ticket_info = SupportTicketMessage::create([
            'support_ticket_id' => $request->ticket_id,
            'type' => $request->user_type,
            'message' => $request->message,
            'notify' => $request->send_notify_mail ? 'on' : 'off',
        ]);

        if ($request->hasFile('file')){
            $uploaded_file = $request->file;
            $file_extension = $uploaded_file->getClientOriginalExtension();
            $file_name =  pathinfo($uploaded_file->getClientOriginalName(),PATHINFO_FILENAME).time().'.'.$file_extension;
            $uploaded_file->move('assets/uploads/ticket',$file_name);
            $ticket_info->attachment = $file_name;
            $ticket_info->save();
        }

        //send mail to user
        event(new SupportMessage($ticket_info));
        return redirect()->back()->with(FlashMsg::item_new('Message Send'));
    }

    //to do list 
    public function toDoList(Request $request)
    {
        if(!empty($request->title || $request->status || $request->todolist_date)){
            $todolist_query = ToDoList::where('user_id',Auth::guard('web')->user()->id);

            if (!empty($request->title)){
                $todolist_query->where('title', 'LIKE', "%{$request->title}%");
            }
            if (!empty($request->status)){
                if ($request->status == 'in_completed'){
                    $todolist_query->where('status', 0);
                }else{
                    $todolist_query->where('status', $request->status);
                }

            }
            // search by date range
            if (!empty($request->todolist_date)){
                $start_date = \Str::of($request->todolist_date)->before('to');
                $end_date = \Str::of($request->todolist_date)->after('to');
                $todolist_query->whereBetween('created_at', [$start_date,$end_date]);
            }
            $to_do_list = $todolist_query->paginate(10);

        }else{
            $to_do_list = ToDoList::where('user_id',Auth::guard('web')->user()->id)->paginate(10);
        }

        return view('frontend.user.seller.to-do-list.todolist',compact('to_do_list'));
    }

    public function addTodolist(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        ToDoList::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::guard('web')->user()->id,

        ]);

        toastr_success(__('To Do List Added Success---'));
        return redirect()->back();
    }

    public function updateTodolist(Request $request)
    {
        $request->validate([
            'up_description' => 'required',
        ]);

        ToDoList::where('id',$request->up_id)->update([
            'title' => $request->up_title,
            'description' => $request->up_description,
        ]);

        toastr_success(__('To Do List Update Success---'));
        return redirect()->back();
    }

    public function deleteTodolist($id = null)
    {
        ToDoList::find($id)->delete();
        toastr_error(__('To Do List Delete Success---'));
        return redirect()->back();
    }

    public function changeTodoStatus($id=null)
    {
        $status = ToDoList::select('status')->where('id', $id)->first();
        if ($status->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        ToDoList::where('id',$id)->update([
            'status' => $status,
        ]);
        toastr_success(__('ToDo List status Update Success---'));
        return redirect()->back();
    }

    //notifications 
    public function allNotification(){
        return view('frontend.user.seller.notification.all-notification');
    }

    //seller verify
    public function sellerVerify(Request $request){
        $user = Auth::guard('web')->user()->id;

        if($request->isMethod('post')){
            $request->validate([
                'national_id' => 'required|max:191',
                'pan_number' => 'required|max:10|min:10',
                'aadhaar_number' => 'required|max:12|min:10',
                'account_number' => 'required|max:35|min:10',
                'ifsc_number' => 'required|max:30|min:10',
                'mobile_number' => 'required|max:10|min:10',
                'name_as_per_bank_account_number' => 'required|max:500'
            ]);

            $old_image = SellerVerify::select('national_id','address')->where('seller_id',$user)->first();
            $verificationData = SellerVerify::select('verification_data')->where('seller_id',$user)->first();
            
            if(is_null($old_image) || is_null($verificationData)){
                $verificationOrgData = json_encode([
                    "aadhaar_number" => "",
                    "is_aadhaar_verified" => "",
                    "request_id" => "",
                    "provided_address" => "",
                    "address_as_per_aadhaar" => "",
                    "aadhaar_address_match_status" => "",
                    "provided_name" => "",
                    "name_as_per_aadhaar" => "",
                    "aadhaar_name_match_status" => "",
                    "pan_number" => "",
                    "is_pan_verified" => "",
                    "name_as_per_pan" => "",
                    "pan_name_match_status" => "",
                    "account_number" => "",
                    "ifsc_number" => "",
                    "mobile_number" => "",
                    "name_as_per_bank_account_number" => "",
                    "is_account_verified" => ""
                ]);
                SellerVerify::create([
                    'seller_id' => $user,
                    'national_id' => $request->national_id ?? optional($old_image)->national_id,
                    'address' => $request->address ?? optional($old_image)->address,
                    'verification_data' => $verificationOrgData
                ]);
            }else{
                SellerVerify::where('seller_id', $user)
                    ->update([
                        'seller_id' => $user,
                        'national_id' => $request->national_id ?? optional($old_image)->national_id,
                        'address' => $request->address ?? optional($old_image)->address,
                        'verification_data' => $verificationData->verification_data
                    ]);
            }

            try {
                $message = get_static_option('seller_verification_message');
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => get_static_option('seller_verification_subject') ?? __('Seller Verification Request'),
                    'message' => $message
                ]));
            } catch (\Exception $e) {
                return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
            }

            toastr_success(__('Verify Info Update Success---'));
            return redirect()->back();
        }
        $seller_verify_info = SellerVerify::where('seller_id',$user)->first();
        
        if ($seller_verify_info->verification_data == null) {
            $seller_verification_data = [
                "aadhaar_number" => "",
                "is_aadhaar_verified" => "",
                "request_id" => "",
                "provided_address" => "",
                "address_as_per_aadhaar" => "",
                "aadhaar_address_match_status" => "",
                "provided_name" => "",
                "name_as_per_aadhaar" => "",
                "aadhaar_name_match_status" => "",
                "pan_number" => "",
                "is_pan_verified" => "",
                "name_as_per_pan" => "",
                "pan_name_match_status" => "",
                "account_number" => "",
                "ifsc_number" => "",
                "mobile_number" => "",
                "name_as_per_bank_account_number" => "",
                "is_account_verified" => ""
            ];
        } else {
            $seller_verification_data = json_decode($seller_verify_info->verification_data, true);
        }
        return view('frontend.user.seller.profile-verify.seller-profile-verify',compact('seller_verify_info','seller_verification_data'));
    }

    /* Extra Service Request */
    public function extraService(Request $request){
        $request->validate([
            'order_id' => 'required|integer',
            'title' => 'required|max:191',
            'quantity' => 'required|integer|gte:0',
            'price' => 'required',
        ]);

        //todo: get order details from database
        $orderDetails = Order::find($request->order_id);
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
            if(!empty($service_details_for_book)){
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
                    $message = get_static_option('seller_extra_service_message');
                    $message = str_replace(["@seller_name","@order_id"],[$seller_details->name,$orderDetails->id],$message);
                    Mail::to($seller_details->email)->send(new BasicMail([
                        'subject' => get_static_option('seller_extra_service_subject') ?? __('Extra Service Added'),
                        'message' => $message
                    ]));

                    $buyer_details = User::select('name','email')->find($orderDetails->buyer_id);
                    //send mail to buyer
                    $message = get_static_option('seller_to_buyer_extra_service_message');
                    $message = str_replace(["@buyer_name","@order_id"],[$buyer_details->name,$orderDetails->id],$message);
                    Mail::to($buyer_details->email)->send(new BasicMail([
                        'subject' => get_static_option('seller_extra_service_subject') ?? __('Extra Service Added'),
                        'message' => $message
                    ]));
                }catch (\Exception $e){
                    //handle error
                }

                toastr_success(__('Extra Service Request Send'));
                return back();
            }else{
                toastr_error(__('Service Not Found'));
                return back();
            }


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
            if(!empty($service_details_for_book)){
                $service_country =  optional(optional($service_details_for_book->serviceCity)->countryy)->id;
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
                    $message .= __('seller added extra service in your service request #').$orderDetails->id;
                    $message .= '</p>';
                    Mail::to($buyer_details->email)->send(new BasicMail([
                        'subject' => __('Extra service added in your service request #').$orderDetails->id,
                        'message' => $message
                    ]));
                }catch (\Exception $e){
                    //handle error
                }

                toastr_success(__('Extra Service Request Send'));
                return back();
            }else{
                toastr_error(__('Service Not Found'));
                return back();
            }

        }
        //todo: else add it in order_additional table and update order table total price and admin commission etc
        toastr_error(__('something went wrong, try after sometime'));
        return back();
    }


    public function extraServiceDelete(Request $request){
        $request->validate([
            'id' => 'required|integer'
        ]);

        ExtraService::find($request->id)->delete();

        return response([
            'msg' => __('Delete Success')
        ]);
    }

    public function orderRequestDeclineHistory($id)
    {
        $order_id = $id;
        $decline_histories = OrderCompleteDecline::latest()->where('order_id',$id)->paginate(10);
        return view('frontend.user.seller.order.decline-history',compact('decline_histories','order_id'));
    }

    // seller to buyer review
    public function sellerToBuyerReview(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'message' => 'required',
        ]);

        $review_count = Review::where('order_id',$request->order_id)->where('type', 0)->where('seller_id',Auth::guard('web')->user()->id)->first();
        if(!$review_count){
            $review = Review::create([
                'order_id' => $request->order_id,
                'service_id' => $request->service_id ?? 0,
                'buyer_id' => $request->buyer_id,
                'seller_id' => Auth::guard()->check() ? Auth::guard('web')->user()->id : NULL,
                'rating' => $request->rating,
                'name' => Auth::guard()->check() ? Auth::guard('web')->user()->name : NULL,
                'email' => Auth::guard()->check() ? Auth::guard('web')->user()->email : NULL,
                'message' => $request->message,
                'type' => 0,
            ]);
            if($review){
                toastr_success(__('Review Added Success---'));
                return redirect()->back();
            }
        }
        toastr_error(__('You Can Not Send Review More Than One'));
        return redirect()->back();
    }

    public function createTicket(Request $request)
    {
        $seller_id = Auth::guard('sanctum')->user()->id;

        if($request->order_id){
            $buyer_id = Order::select('buyer_id')->where('id',$request->order_id)->first();
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'subject' => 'required|string|max:191',
            'priority' => 'required|string|max:191',
            'description' => 'required|string',
            'order_id' => 'required|string'
        ],[
            'title.required' => __('title required'),
            'subject.required' =>  __('subject required'),
            'priority.required' =>  __('priority required'),
            'description.required' => __('description required'),
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ],422);
        }

        SupportTicket::create([
            'title' => $request->title,
            'description' => $request->description,
            'subject' => $request->subject,
            'status' => 'open',
            'priority' => $request->priority,
            'seller_id' => $seller_id,
            'buyer_id' => $buyer_id->buyer_id,
            'order_id' => $request->order_id,
        ]);
        // toastr_success(__('Ticket successfully created.'));
        $last_ticket_id = DB::getPdo()->lastInsertId();
        $last_ticket = SupportTicket::where('id',$last_ticket_id)->first();

        // send order ticket notification to buyer
        $buyer = User::where('id',$last_ticket->buyer_id)->first();
        if($buyer){
            $order_ticcket_message = __('You have a new service request ticket');
            $buyer ->notify(new TicketNotification($last_ticket_id , $seller_id, $last_ticket->buyer_id,$order_ticcket_message ));
        }
        // admin notification add
        AdminNotification::create(['ticket_id' => $last_ticket_id]);

        //Send ticket mail to buyer and admin
        try {
            $message = get_static_option('seller_order_ticket_message');
            $message = str_replace(["@order_ticket_id"],[$last_ticket_id],$message);
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => get_static_option('order_ticket_subject') ?? __('New Service Request Ticket'),
                'message' => $message
            ]));
            Mail::to($buyer->email)->send(new BasicMail([
                'subject' => get_static_option('seller_order_ticket_subject') ?? __('New Service Request Ticket'),
                'message' => $message
            ]));
        } catch (\Exception $e) {
            //return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
        }

        return response()->success([
            "ticket" => "",
            "message" => __('Ticket successfully created.')
        ]);
        
    }

    public function allClearMessage(Request $request)
    {
        if (Auth::guard('web')->user()->unreadNotifications->count() >=1){
            Auth::guard('web')->user()->Notifications->markAsRead();
            toastr_success(__('Clear all Notifications Success---'));
        }else{
            toastr_error(__('No Notifications Found'));
        }
        return redirect()->back();
    }

    /*
     * Verify Seller Pan Number 
     */
    public function sellerVerifyPanNumber(Request $request) {
        $user = Auth::guard('web')->user()->id;
    
        if ($request->isMethod('post')) {
            $verificationData = SellerVerify::select('verification_data')->where('seller_id', $user)->first();
            $userData = User::find($user);
            $verificationDataArray = [];
            if ($verificationData) {
                \Log::debug("Inside If 1");
                $verificationDataArray = json_decode($verificationData->verification_data, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $verificationDataArray = [];
                }
            }
            $panNumber = $request->pan_number ?? ($verificationDataArray['pan_number'] ?? '');
            
            if (is_null($verificationData)) {
                $verificationDataArray = [
                    "aadhaar_number" => "",
                    "is_aadhaar_verified" => "",
                    "request_id" => "",
                    "provided_address" => "",
                    "address_as_per_aadhaar" => "",
                    "aadhaar_address_match_status" => "",
                    "provided_name" => "",
                    "name_as_per_aadhaar" => "",
                    "aadhaar_name_match_status" => "",
                    "pan_number" => $panNumber,
                    "is_pan_verified" => "",
                    "name_as_per_pan" => "",
                    "pan_name_match_status" => "",
                    "account_number" => "",
                    "ifsc_number" => "",
                    "mobile_number" => "",
                    "name_as_per_bank_account_number" => "",
                    "is_account_verified" => ""
                ];
                $verificationPanData = json_encode($verificationDataArray);
                SellerVerify::create([
                    'seller_id' => $user,
                    'verification_data' => $verificationPanData,
                ]);
                $responseMessage = 'Data added successfully';
            } else {
                $verificationDataArray['pan_number'] = $panNumber;
                $verificationPanData = json_encode($verificationDataArray);
                SellerVerify::where('seller_id', $user)->update([
                    'verification_data' => $verificationPanData,
                ]);
                $responseMessage = 'Data updated successfully';
            }

            $panData = json_encode(["number" => $panNumber]);
            $panResponse = SignzyAPI::fetchData("FetchPAN", $panData);
            $panResponseData = json_decode($panResponse, true);
            \Log::debug("Response : " . print_r($panResponseData,true));
            if ($panResponseData && isset($panResponseData['vendorData'][0]['statusCode']) && $panResponseData['vendorData'][0]['statusCode'] === 200) {
                $result = $panResponseData['result'];
                $nameMatchResult = StringMatchHelper::matchNames($result['name'], $userData->name);
                if ($panNumber == $result['number'] && $nameMatchResult) {
                    $verificationDataArray = json_decode($verificationPanData, true);
                    $verificationDataArray['is_pan_verified'] = 1;
                    $verificationDataArray['name_as_per_pan'] = $result['name'];
                    $verificationDataArray['pan_name_match_status'] = 1;
                    $verificationPanData = json_encode($verificationDataArray);
                    SellerVerify::where('seller_id', $user)->update([
                        'verification_data' => $verificationPanData,
                    ]);
                    $response = [
                        "status" => "success",
                        "message" => "PAN Card Number Verified successfully",
                        'full_name' => $result['name'],
                        'typeOfHolder' => $result['typeOfHolder'],
                        'panStatus' => $result['panStatus'],
                        'aadhaarSeedingStatus' => $result['aadhaarSeedingStatus'],
                    ];
                } else {
                    $verificationDataArray = json_decode($verificationPanData, true);
                    $verificationDataArray['is_pan_verified'] = 0;
                    $verificationDataArray['name_as_per_pan'] = "";
                    $verificationDataArray['pan_name_match_status'] = 0;
                    $verificationPanData = json_encode($verificationDataArray);
                    SellerVerify::where('seller_id', $user)->update([
                        'verification_data' => $verificationPanData,
                    ]);
                    $response = [
                        "status" => "error",
                        "message" => "Name or Pan Number not matched as per PAN records",
                    ];
                }
            } elseif ($panResponseData && isset($panResponseData['error'][0]['status']) && $panResponseData['error'][0]['status'] === 404) {
                $verificationDataArray = json_decode($verificationPanData, true);
                $verificationDataArray['is_pan_verified'] = 0;
                $verificationDataArray['name_as_per_pan'] = "";
                $verificationDataArray['pan_name_match_status'] = 0;
                $verificationPanData = json_encode($verificationDataArray);
                SellerVerify::where('seller_id', $user)->update([
                    'verification_data' => $verificationPanData,
                ]);
                $response = [
                    'status' => 'error', 
                    'message' => 'Fetch Pan Card Number Data ended with error'
                ];
            } else {
                $verificationDataArray = json_decode($verificationPanData, true);
                $verificationDataArray['is_pan_verified'] = 0;
                $verificationDataArray['name_as_per_pan'] = "";
                $verificationDataArray['pan_name_match_status'] = 0;
                $verificationPanData = json_encode($verificationDataArray);
                SellerVerify::where('seller_id', $user)->update([
                    'verification_data' => $verificationPanData,
                ]);
                $response = [
                    'status' => 'error', 
                    'message' => 'Fetch Pan Card Number Data ended with error'
                ];
            }
            if ($response['status'] == 'success') {
                toastr_success(__('PAN Card Number Verified Successfully'));
            } else {
                toastr_error(__('PAN Card Number Verification Failed'));
            }
    
            return response()->json($response);
        }
    }
    
    /*
     * Send OTP to seller based on Aadhaar Number  
     */
    public function sellerVerifyAadhaarNumber(Request $request){
        $user = Auth::guard('web')->user()->id;
        if($request->isMethod('post')){
            // Fetch data of verification_data column
            $verificationData = SellerVerify::select('verification_data')->where('seller_id',$user)->first();
            $verificationDataArray = [];
            if ($verificationData) {
                $verificationDataArray = json_decode($verificationData->verification_data, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $verificationDataArray = [];
                }
            }
            $aadhaarNumber = $request->aadhaar_number ?? ($verificationDataArray['aadhaar_number'] ?? '');
            if(is_null($verificationData)){
                $verificationDataArray = [
                    "aadhaar_number" =>  $aadhaarNumber,
                    "is_aadhaar_verified" => "",
                    "request_id" => "",
                    "provided_address" => "",
                    "address_as_per_aadhaar" => "",
                    "aadhaar_address_match_status" => "",
                    "provided_name" => "",
                    "name_as_per_aadhaar" => "",
                    "aadhaar_name_match_status" => "",
                    "pan_number" => "",
                    "is_pan_verified" => "",
                    "name_as_per_pan" => "",
                    "pan_name_match_status" => "",
                    "account_number" => "",
                    "ifsc_number" => "",
                    "mobile_number" => "",
                    "name_as_per_bank_account_number" => "",
                    "is_account_verified" => ""
                ];
                $verificationAadhaarData = json_encode($verificationDataArray);
                $createResult = SellerVerify::create([
                    'seller_id' => $user,
                    'verification_data' => $verificationAadhaarData,
                ]);
                $responseMessage = 'Data added successfully';
            }else{
                $verificationDataArray['aadhaar_number'] = $aadhaarNumber;
                $verificationAadhaarData = json_encode($verificationDataArray);
                $updateResult = SellerVerify::where('seller_id', $user)->update([
                    'verification_data' => $verificationAadhaarData,
                ]);
                $responseMessage = 'Data updated successfully';
            }
            $aadhaardata = json_encode(array(
                "aadhaarNumber" => $request->aadhaar_number
            ));
            $aadhaarResponse = SignzyAPI::fetchData("getOkycOtp", $aadhaardata);
            $apiResponse = json_decode($aadhaarResponse, true);
            \Log::debug("Response Data : " . print_r($apiResponse,true) );
            if ($apiResponse && isset($apiResponse['statusCode']) && $apiResponse['statusCode'] === 200) {
                $requestId = $apiResponse['data']['requestId'];
                if ($requestId != ""){
                    $verificationDataArray = json_decode($verificationAadhaarData, true);
                    $verificationDataArray['request_id'] = $requestId;
                    $verificationAadhaarData = json_encode($verificationDataArray);
                    $updateRequestIdResult =SellerVerify::where('seller_id', $user)->update([
                        'verification_data' => $verificationAadhaarData,
                    ]);
                    if($updateRequestIdResult){
                        $response = [
                            "status" => "success",
                            "message" => "OTP is send to your mobile number",
                        ];
                    } else {
                        $response = [
                            "status" => "error",
                            "message" => "Error while updating request id",
                        ];
                    }
                } else {
                    $response = [
                        "status" => "error",
                        "message" => "Error : " . $aadhaarResponse,
                    ];
                }
            } else {
                $response = [
                    "status" => "error",
                    "message" => "Error : " . $aadhaarResponse,
                ];
            }
            if ($response['status'] == 'success') {
                toastr_success(__('OTP send successfully'));
            } else {
                toastr_error(__('OTP send failed'));
            }
            return response()->json($response);
        }
    }

    /*
     * Verify Aadhaar OTP of seller
     */
    public function sellerVerifyAadhaarOTP(Request $request){
        $user = Auth::guard('web')->user()->id;
        if($request->isMethod('post')){
            $userData = User::find($user);
            // Fetch data of verification_data column
            $verificationData = SellerVerify::select('verification_data')->where('seller_id',$user)->first();
            $verificationDataArray = [];
            if ($verificationData) {
                $verificationDataArray = json_decode($verificationData->verification_data, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $verificationDataArray = [];
                }
            }
        
            if ($verificationDataArray['request_id'] != ""){
                $otpData = json_encode(array(
                    "requestId" => $verificationDataArray['request_id'],
                    "otp" => $request->otp
                ));
                $otpVerifyResponse = SignzyAPI::fetchData("fetchOkycData", $otpData);
                $otpVerifyResponseJsonData = json_decode($otpVerifyResponse, true);
                \Log::debug("Response : " . print_r($otpVerifyResponseJsonData,true));
                if ($otpVerifyResponseJsonData && isset($otpVerifyResponseJsonData['statusCode']) && $otpVerifyResponseJsonData['statusCode'] === 200) { 
                    $data = $otpVerifyResponseJsonData['data'];
                    $finalAddress = $otpVerifyResponseJsonData['data']['address']['house'] . " " . $otpVerifyResponseJsonData['data']['address']['street'] . " " . $otpVerifyResponseJsonData['data']['address']['loc']; 
                    // $otpVerifyResponseJsonData['data']['address']['vtc'];
                    // $otpVerifyResponseJsonData['data']['address']['subdist'];
                    // $otpVerifyResponseJsonData['data']['address']['state'];
                    // $otpVerifyResponseJsonData['data']['address']['country']; 
                    // $otpVerifyResponseJsonData['data']['zip'];
                    // $profile_image = $data['profile_image'];
                    $nameMatchResult = StringMatchHelper::matchNames($data['full_name'], $userData->name);
                    $addressMatchResult = StringMatchHelper::matchAddresses($finalAddress, $userData->address);
                    $verificationDataArray['provided_address'] = $userData->address;
                    $verificationDataArray['address_as_per_aadhaar'] = $finalAddress;
                    if($addressMatchResult){
                        $verificationDataArray['aadhaar_address_match_status'] = 1;
                    } else {
                        $verificationDataArray['aadhaar_address_match_status'] = 0;
                    }
                
                    if ($data != null && $nameMatchResult){
                        $verificationDataArray['is_aadhaar_verified'] = 1;
                        $verificationDataArray['provided_name'] =  $userData->name;
                        $verificationDataArray['name_as_per_aadhaar'] = $data['full_name'];
                        $verificationDataArray['aadhaar_name_match_status'] = 1;
                        $verificationAadhaarOTPData = json_encode($verificationDataArray);
                        $updateRequestIdResult =SellerVerify::where('seller_id', $user)->update([
                            'verification_data' => $verificationAadhaarOTPData,
                        ]);

                        $response = [
                            "status" => "success",
                            "message" => "OTP Verify success",
                            "full_name" => $data['full_name'],
                            "dob" => $data['dob'],
                            "gender" => $data['gender'],
                            "address" => $finalAddress,
                        ];
                    } else {
                        $response = [
                            "status" => "error",
                            "message" => "Name or Adress isnot matched"
                        ];
                    }
                    // if (!empty($profile_image)) {
                    //     $upload = File::upload(
                    //         $profile_image, 
                    //         "avatar",
                    //         array(
                    //             "source" => "base64",
                    //             "extension" => "png"
                    //         )
                    //     );
                    //     $aadhaarprofileimage = $upload['info']['name'];
                    // }else{
                    //     $aadhaarprofileimage = '';
                    // }
                    // if($aadhaarprofileimage != ""){
                    //     Database::table("user_kyc")->where("userid" , $userId)->update("aadhaar_profile_image", $aadhaarprofileimage);
                    // } else {
                    //     \Log::debug("Storing of aadhaar profile image is ended with error");
                    // }
                } elseif ($otpVerifyResponseJsonData && isset($otpVerifyResponseJsonData['error'][0]['status']) && ($otpVerifyResponseJsonData['error'][0]['status'] === 404 || $otpVerifyResponseJsonData['error'][0]['status'] === 409)) {
                    $verificationDataArray['is_aadhaar_verified'] = 0;
                    $verificationDataArray['provided_name'] =  $userData->name;
                    $verificationDataArray['name_as_per_aadhaar'] = "";
                    $verificationDataArray['aadhaar_name_match_status'] = 0;
                    $verificationAadhaarOTPData = json_encode($verificationDataArray);
                    $updateRequestIdResult =SellerVerify::where('seller_id', $user)->update([
                        'verification_data' => $verificationAadhaarOTPData,
                    ]);
                    $response = [
                        'status' => 'error', 
                        'message' => 'Fetch Pan Card Number Data ended with error'
                    ];
                } else {
                    $verificationDataArray['is_aadhaar_verified'] = 0;
                    $verificationDataArray['provided_name'] =  $userData->name;
                    $verificationDataArray['name_as_per_aadhaar'] = "";
                    $verificationDataArray['aadhaar_name_match_status'] = 0;
                    $verificationAadhaarOTPData = json_encode($verificationDataArray);
                    $updateRequestIdResult =SellerVerify::where('seller_id', $user)->update([
                        'verification_data' => $verificationAadhaarOTPData,
                    ]);
                    $response = [
                        "status" => "error",
                        "message" => "Error: " . $otpVerifyResponse,
                    ];
                }
            } else {
                $verificationDataArray['is_aadhaar_verified'] = 0;
                $verificationDataArray['provided_name'] =  $userData->name;
                $verificationDataArray['name_as_per_aadhaar'] = "";
                $verificationDataArray['aadhaar_name_match_status'] = 0;
                $verificationAadhaarOTPData = json_encode($verificationDataArray);
                $updateRequestIdResult =SellerVerify::where('seller_id', $user)->update([
                    'verification_data' => $verificationAadhaarOTPData,
                ]);
                $response = [
                    "status" => "error",
                    "message" => "Request ID Not found",
                ];
            }
            if ($response['status'] == 'success') {
                toastr_success(__('OTP verify successfully'));
            } else {
                toastr_error(__('Data Not Match or OTP Verification failed'));
            }
            return response()->json($response);
        }
    }

    /*
     * Verify Seller Account Number
     */
    public function sellerVerifyAccountNumber(Request $request) {
        $user = Auth::guard('web')->user()->id;
        if ($request->isMethod('post')) {
            $verificationData = SellerVerify::select('verification_data')->where('seller_id', $user)->first();
            $userData = User::find($user);
            $verificationDataArray = [];
            if ($verificationData) {
                $verificationDataArray = json_decode($verificationData->verification_data, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $verificationDataArray = [];
                }
            }

            $accountNumber = $request->beneficiaryAccount ?? ($verificationDataArray['account_number'] ?? '');
            $IFSCNumber = $request->beneficiaryIFSC ?? ($verificationDataArray['ifsc_number'] ?? '');
            $mobileNumber = $request->beneficiaryMobile ?? ($verificationDataArray['mobile_number'] ?? '');
            $nameAsPerBankAccount = $request->beneficiaryName ?? ($verificationDataArray['name_as_per_bank_account_number'] ?? '');

            if (is_null($verificationData)) {
                $verificationDataArray = [
                    "aadhaar_number" => "",
                    "is_aadhaar_verified" => "",
                    "request_id" => "",
                    "provided_address" => "",
                    "address_as_per_aadhaar" => "",
                    "aadhaar_address_match_status" => "",
                    "provided_name" => "",
                    "name_as_per_aadhaar" => "",
                    "aadhaar_name_match_status" => "",
                    "pan_number" => "",
                    "is_pan_verified" => "",
                    "name_as_per_pan" => "",
                    "pan_name_match_status" => "",
                    "account_number" => $accountNumber,
                    "ifsc_number" => $IFSCNumber,
                    "mobile_number" => $mobileNumber,
                    "name_as_per_bank_account_number" => "",
                    "is_account_verified" => ""
                ];
                $verificationAccountData = json_encode($verificationDataArray);
                SellerVerify::create([
                    'seller_id' => $user,
                    'verification_data' => $verificationAccountData,
                ]);
                $responseMessage = 'Data added successfully';
            } else {
                $verificationDataArray['account_number'] = $accountNumber;
                $verificationDataArray['ifsc_number'] = $IFSCNumber;
                $verificationDataArray['mobile_number'] = $mobileNumber;
                $verificationAccountData = json_encode($verificationDataArray);
                SellerVerify::where('seller_id', $user)->update([
                    'verification_data' => $verificationAccountData,
                ]);
                $responseMessage = 'Data updated successfully';
            }

            $accountData = json_encode([
                "beneficiaryAccount" => $accountNumber,
                "beneficiaryIFSC" => $IFSCNumber,
                "beneficiaryMobile" => $mobileNumber,
                "beneficiaryName" => $nameAsPerBankAccount,
                "nameFuzzy" => $request->nameFuzzy,
            ]);

            $accountResponse = SignzyAPI::fetchData("bankaccountverification", $accountData);
            $accountResponseData = json_decode($accountResponse, true);
            \Log::debug("Response : " . print_r($accountResponseData,true));
            if ($accountResponseData && isset($accountResponseData['result'])) {
                $active = $accountResponseData['result']['active'] ?? null;
                $nameMatchScore = $accountResponseData['result']['nameMatchScore'] ?? null;
                $beneName = $accountResponseData['result']['bankTransfer']['beneName'] ?? null;
                $verificationDataArray = json_decode($verificationAccountData, true);
                if ($active === "yes" && $nameMatchScore >= 0.5){
                    $verificationDataArray['is_account_verified'] = 1;
                    $verificationDataArray['name_as_per_bank_account_number'] = $beneName;
                } else {
                    $verificationDataArray['is_account_verified'] = 0;
                    $verificationDataArray['name_as_per_bank_account_number'] = $beneName;
                }
                $verificationAccountData = json_encode($verificationDataArray);
                SellerVerify::where('seller_id', $user)->update([
                        'verification_data' => $verificationAccountData,
                ]);
                $response = [
                    "status" => "success",
                    "message" => "Account Number Verified successfully",
                ];
            } else {
                $response = [
                    'status' => 'error', 
                    'message' => 'Fetch account number data ended with error'
                ];
            }
            if ($response['status'] == 'success') {
                toastr_success(__('Bank Account Number Verified Successfully'));
            } else {
                toastr_error(__('Bank Account Number Verification Failed'));
            }
    
            return response()->json($response);
        }
    }

    // Get seller company
    public function sellerCompany(Request $request) {
        $company_Id = Auth::guard('web')->user()->company_id;
        if(get_static_option('dashboard_variant_buyer') == '02' && $company_Id != null){
            if ($request->member_id || $request->member_name) {
                $companyData = Company::where('id', $company_Id)->first();
                $userDataWithCompany = User::where('company_id', $company_Id)->where('name', $request->member_name)->where('service_provider_type', "ACP")->get();
                $cities = ServiceCity::where('status',1)->get();
                $areas = ServiceArea::where('status',1)->get();
                $countries = Country::where('status',1)->get();
            } elseif ($request->member_id || $request->member_email) {
                $companyData = Company::where('id', $company_Id)->first();
                $userDataWithCompany = User::where('company_id', $company_Id)->where('email', $request->member_email)->where('service_provider_type', "ACP")->get();
                $cities = ServiceCity::where('status',1)->get();
                $areas = ServiceArea::where('status',1)->get();
                $countries = Country::where('status',1)->get();
            } elseif ($request->member_id || $request->member_phone) {
                $companyData = Company::where('id', $company_Id)->first();
                $userDataWithCompany = User::where('company_id', $company_Id)->where('phone', $request->member_phone)->where('service_provider_type', "ACP")->get();
                $cities = ServiceCity::where('status',1)->get();
                $areas = ServiceArea::where('status',1)->get();
                $countries = Country::where('status',1)->get();
            } else {
                $companyData = Company::where('id', $company_Id)->first();
                $userDataWithCompany = User::where('company_id', $company_Id)->where('service_provider_type', "ACP")->get();
                $cities = ServiceCity::where('status',1)->get();
                $areas = ServiceArea::where('status',1)->get();
                $countries = Country::where('status',1)->get();
            }
        } else {
                $companyData = 0;
                $userDataWithCompany = 0;
                $cities = ServiceCity::where('status',1)->get();
                $areas = ServiceArea::where('status',1)->get();
                $countries = Country::where('status',1)->get();
        }
        
        return view('frontend.user.seller.company.seller-company', compact('countries', 'areas' ,'cities','companyData', 'userDataWithCompany'));
    }

    // Add seller company
    public function addCompany(Request $request) {
        $request->validate([
            'companyname' => 'required|max:191',
            'companyemail' => 'required|max:191',
            'companyphone' => 'required|max:191',
            'companyaddress' => 'required',
            'country_id_add' => 'required',
            'service_city_add' => 'required',
            'service_area_add' => 'required',
            'companypostcode' => 'required',
        ]);

        $resultOfAddCompany = Company::create([
            'name' => $request->companyname,
            'email' => $request->companyemail,
            'phone' => $request->companyphone,
            'address' => $request->companyaddress,
            'country_id' => $request->country_id_add,
            'service_city' => $request->service_city_add,
            'service_area' => $request->service_area_add,
            'post_code' => $request->companypostcode,
            'image' => '',
            'profile_background' => '',
            'gstin' => '',
        ]);

        $companyId = $resultOfAddCompany->id;
        User::where('id', Auth::guard('web')->user()->id)->update(['company_id' => $companyId, 'service_provider_type' => "ACP"]);

        toastr_success(__('Company Added Success---'));
        return redirect()->back();
    }

    // Edit seller company details 
    public function sellerCompanyEdit(Request $request) {
        if ($request->isMethod('post')) {
            $company_Id = Auth::guard('web')->user()->company_id;
            $user = Auth::guard('web')->user()->id;
            $request->validate([
                'companyname' => 'required|max:191',
                'companyemail' => 'required|max:191',
                'companyphone' => 'required|max:191',
                'service_area' => 'required|max:191',
                'companypost_code' => 'required|max:191',
                'companyaddress' => 'required|max:191',
            ]);
            $old_image = Company::select('image', 'profile_background')->where('id', $company_Id)->first();
            Company::where('id', $company_Id)
                ->update([
                    'name' => $request->companyname,
                    'email' => $request->companyemail,
                    'phone' => $request->companyphone,
                    'address' => $request->companyaddress,
                    'service_area' => $request->service_area,
                    'service_city' => $request->service_city,
                    'country_id' => $request->country_id,
                    'post_code' => $request->companypost_code,
                    'image' => $request->companyimage ?? $old_image->image,
                    'profile_background' => $request->company_profile_background ?? $old_image->profile_background,
                    'gstin' => $request->gstin,
                ]);
            toastr_success(__('Company Data Updated Successfully---'));
            return redirect()->back();
        }

        $countries = Country::where('status', 1)->get();
        $user_country = Auth::guard('web')->user()->country_id;
        $cities = ServiceCity::where('country_id', $user_country)->get();
        $areas = ServiceArea::where('service_city_id', Auth::guard('web')->user()->service_city)->get();
        return view('frontend.user.seller.profile.seller-profile-edit', compact('cities', 'areas', 'countries'));
    }

    // add seller member of company
    public function addCompanyMember(Request $request) {
        $request->validate([
            'companyid' => 'required',
            'memberfullname' => 'required|max:191',
            'memberusername' => 'required|max:191',
            'memberemail' => 'required|max:191',
            'memberphone' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required',
            'country_id_add_member' => 'required',
            'service_city_add_member' => 'required',
            'service_area_add_member' => 'required',
        ]);

        $email_verify_tokn = Str::random(8);
        $passowrd = $request->newpassword."@".rand(0000, 9999);
        $user = User::create([
                'name' => $request->memberfullname,
                'email' => $request->memberemail,
                'username' => $request->memberusername,
                'phone' => $request->memberphone,
                'password' => Hash::make($passowrd),
                'service_city' => $request->service_city_add_member,
                'service_area' => $request->service_area_add_member,
                'country_id' => $request->country_id_add_member,
                'user_type' => 0,
                'terms_conditions' => 1,
                'email_verify_token'=> $email_verify_tokn,
                'company_id' => $request->companyid,
                'service_provider_type' => "ACP",
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

        toastr_success(__('Team Member Added Success---'));
        return redirect()->back();
    }

    // Change the status of seller compnay member
    public function changeMemberStatus($id = null) {
        $status = User::select('user_status')->where('id', $id)->first();
        if ($status->user_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        User::where('id', $id)->update([
            'user_status' => $status,
        ]);
        toastr_success(__('Member status Update Success---'));
        return redirect()->back();
    }
    
    // Edit deatils of seller compnay member
    public function sellerCompanyMemberEdit(Request $request) {
        if ($request->isMethod('post')) {
            $memberId = $request->up_member_id;
            $request->validate([
                'up_member_id' => 'required|max:191',
                'up_name' => 'required|max:191',
                'up_email' => 'required',
            ]);

            User::where('id', $memberId)
                ->update([
                    'name' => $request->up_name,
                    'email' => $request->up_email,
                    'phone' => $request->up_phone,
                    'address' => $request->companyaddress,
                    'service_area' => $request->service_area_update_member,
                    'service_city' => $request->service_city_update_member,
                    'country_id' => $request->country_id_update_member,
                    'address' => $request->up_address,
                    'post_code' => $request->up_post_code,
                ]);
            toastr_success(__('Member Data Updated Successfully---'));
            return redirect()->back();
        }

        $countries = Country::where('status', 1)->get();
        $user_country = Auth::guard('web')->user()->country_id;
        $cities = ServiceCity::where('country_id', $user_country)->get();
        $areas = ServiceArea::where('service_city_id', Auth::guard('web')->user()->service_city)->get();
        return view('frontend.user.seller.profile.seller-profile-edit', compact('cities', 'areas', 'countries'));
    }

    // Delete member of seller compnay 
    public function memberDelete($id = null) {
        \Log::debug("Inside member delete \n User ID : " . $id);
        User::find($id)->delete();
        toastr_error(__('Member Delete Success---'));
        return redirect()->back();
    }

    /*
     * Send OTP to Service Provider based on Aadhaar Number (Sample API)
     */
    public function sellerVerifyAadhaarNumberSample(Request $request){
        $user = Auth::guard('web')->user()->id;
        if($request->isMethod('post')){
            // Fetch data of verification_data column
            $verificationData = SellerVerify::select('verification_data')->where('seller_id',$user)->first();
            $verificationDataArray = [];
            if ($verificationData) {
                $verificationDataArray = json_decode($verificationData->verification_data, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $verificationDataArray = [];
                }
            }
            $aadhaarNumber = $request->aadhaar_number ?? ($verificationDataArray['aadhaar_number'] ?? '');
            if(is_null($verificationData)){
                $verificationDataArray = [
                    "aadhaar_number" =>  $aadhaarNumber,
                    "is_aadhaar_verified" => "",
                    "request_id" => "",
                    "provided_address" => "",
                    "address_as_per_aadhaar" => "",
                    "aadhaar_address_match_status" => "",
                    "provided_name" => "",
                    "name_as_per_aadhaar" => "",
                    "aadhaar_name_match_status" => "",
                    "pan_number" => "",
                    "is_pan_verified" => "",
                    "name_as_per_pan" => "",
                    "pan_name_match_status" => "",
                    "account_number" => "",
                    "ifsc_number" => "",
                    "mobile_number" => "",
                    "name_as_per_bank_account_number" => "",
                    "is_account_verified" => ""
                ];
                $verificationAadhaarData = json_encode($verificationDataArray);
                $createResult = SellerVerify::create([
                    'seller_id' => $user,
                    'verification_data' => $verificationAadhaarData,
                ]);
                $responseMessage = 'Data added successfully';
            }else{
                $verificationDataArray['aadhaar_number'] = $aadhaarNumber;
                $verificationAadhaarData = json_encode($verificationDataArray);
                $updateResult = SellerVerify::where('seller_id', $user)->update([
                    'verification_data' => $verificationAadhaarData,
                ]);
                $responseMessage = 'Data updated successfully';
            }
            $userData = User::where('id',$user)->first();
            \Log::debug("Phone Number : " . $userData->phone);

            $aadhaardata = json_encode(array(
                "aadhaarNumber" => $request->aadhaar_number,
                "phoneNumber" => $userData->phone,
            ));
            $aadhaarResponse = SignzyAPI::fetchData("getokycotpsample", $aadhaardata);
            $apiResponse = json_decode($aadhaarResponse, true);
            \Log::debug("Response Data : " . print_r($apiResponse,true) );
            if ($apiResponse && isset($apiResponse['status']) && ($apiResponse['status'] == 'success')) {
                $response = [
                    "status" => "success",
                    "message" => "OTP is send to your mobile number",
                ];
                toastr_success(__('OTP send successfully'));
            } else {
                $response = [
                    "status" => "error",
                    "message" => "Error : " . $aadhaarResponse,
                ];
                toastr_error(__('OTP send failed'));
            }
            return response()->json($response);
        }
    }

    /*
     * Verify OTP of Service Provider (Sample API)
     */
    public function sellerVerifyAadhaarOTPSample(Request $request){
        $user = Auth::guard('web')->user()->id;
        if($request->isMethod('post')){
            $verificationData = SellerVerify::select('verification_data')->where('seller_id',$user)->first();
            $verificationDataArray = [];
            if ($verificationData) {
                $verificationDataArray = json_decode($verificationData->verification_data, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $verificationDataArray = [];
                }
            }

            $userData = User::find($user);
            $otpData = json_encode(array(
                "otp" => $request->otp
            ));
            $otpVerifyResponse = SignzyAPI::fetchData("fetchokycotpsample", $otpData);
            $otpVerifyResponseJsonData = json_decode($otpVerifyResponse, true);
            \Log::debug("Response Of Data : " . print_r($otpVerifyResponseJsonData, true));
            $messageStatus = $otpVerifyResponseJsonData['status'];
            if ($messageStatus == "success") {
                $verificationDataArray['is_aadhaar_verified'] = 1;
                $verificationDataArray['provided_name'] =  $userData->name;
                $verificationDataArray['name_as_per_aadhaar'] = $userData->name;
                $verificationDataArray['aadhaar_name_match_status'] = 1;
                $verificationAadhaarOTPData = json_encode($verificationDataArray);
                $updateRequestIdResult =SellerVerify::where('seller_id', $user)->update([
                    'verification_data' => $verificationAadhaarOTPData,
                ]);
                $response = [
                    "status" => "success",
                    "message" => "OTP Verified",
                ];
                toastr_success(__('OTP verify successfully'));
            } else {
                $response = [
                    "status" => "error",
                    "message" => "OTP Verification Failed",
                ];
                toastr_error(__('Data Not Match or OTP Verification failed'));
            }
            return response()->json($response);
        }
    }
}
