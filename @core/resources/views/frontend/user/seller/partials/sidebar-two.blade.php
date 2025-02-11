<div class="dashboard__left dashboard-left-content">
    <div class="dashboard__left__main">
        <div class="dashboard__left__close close-bars"> <i class="fa-solid fa-times"></i> </div>
        <div class="dashboard__top">
            <div class="dashboard__top__logo">
                <a href="{{ route('homepage') }}" class="logo" target="_blank">
                    {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                </a>
            </div>
        </div>
        <div class="dashboard__bottom mt-5">
            <ul class="dashboard__bottom__list dashboard-list">

                <li class="dashboard__bottom__list__item @if(request()->is('seller/dashboard*')) active @elseif(request()->is('serviceprovider/dashboard*')) active @endif">
                    <a href="{{ route('seller.dashboard') }}"><i class="las la-tachometer-alt"></i> {{ __('Dashboard') }}</a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('seller/profile*')) active @elseif(request()->is('serviceprovider/profile*')) active @endif">
                    <a href="{{ route('seller.profile')}}"><i class="las la-user-alt"></i> {{ __('Profile') }}</a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('seller/company*')) active @elseif(request()->is('serviceprovider/company*')) active @endif">
                    <a href="{{ route('seller.company')}}"><i class="las la-building"></i> {{ __('Company') }}</a>
                </li>

                @if(moduleExists('LiveChat'))
                    <li class="dashboard__bottom__list__item @if(request()->is('seller/live-chat*')) active @elseif(request()->is('serviceprovider/live-chat*')) active @endif ">
                        <a href="{{ route('seller.live.chat') }}"><i class="las la-sms"></i> {{__('Chat Inbox')}}  </a>
                    </li>
                @endif

                @if(moduleExists('Subscription') && $commissionGlobal->system_type === 'subscription' && Route::has('seller.subscription.all'))
                    <li class="dashboard__bottom__list__item @if(request()->is('seller/subscription*')) active @elseif(request()->is('serviceprovider/subscription*')) active @endif">
                        <a href="{{ route('seller.subscription.all') }}"> <i class="las la-th"></i> {{__('Subscriptions')}} </a>
                    </li>
                @endif

                <li class="dashboard__bottom__list__item @if(request()->is('seller/services*') || request()->is('seller/add-services*') || request()->is('seller/service-attributes*') || request()->is('seller/edit-services*') || request()->is('seller/edit-service-attributes*') || request()->is('seller/add-service-attributes-by-id*')) active @elseif(request()->is('serviceprovider/services*') || request()->is('serviceprovider/add-services*') || request()->is('serviceprovider/service-attributes*') || request()->is('serviceprovider/edit-services*') || request()->is('serviceprovider/edit-service-attributes*') || request()->is('serviceprovider/add-service-attributes-by-id*')) active @endif">
                    <a href="{{ route('seller.services') }}"> <i class="las la-cogs"></i>{{ __('Services') }} </a>
                </li>
                <li class="dashboard__bottom__list__item @if(request()->is('seller/coupons*')) active @elseif(request()->is('serviceprovider/coupons*')) active @endif">
                    <a href="{{ route('seller.service.coupon') }}"> <i class="las la-gifts"></i> {{__('Service Coupons')}} </a>
                </li>
                <li class="dashboard__bottom__list__item @if(request()->is('seller/days*') || request()->is('seller/add-day*')) active @elseif(request()->is('serviceprovider/days*') || request()->is('seller/add-day*')) active @endif">
                    <a href="{{ route('seller.days') }}"> <i class="las la-calendar-week"></i>{{ __('Create Day') }} </a>
                </li>
                <li class="dashboard__bottom__list__item @if(request()->is('seller/schedules*') || request()->is('seller/add-schedule*')) active @elseif(request()->is('serviceprovider/schedules*') || request()->is('serviceprovider/add-schedule*')) active @endif">
                    <a href="{{ route('seller.schedules') }}"> <i class="las la-clock"></i>{{ __('Create Schedule') }} </a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('seller/pending-orders')) active @elseif(request()->is('serviceprovider/pending-orders')) active @endif">
                    <a href="{{ route('seller.pending.orders') }}"> <i class="las la-tasks"></i> {{ __('Pending Service Request') }} </a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('seller/orders*')) active @elseif(request()->is('serviceprovider/orders*')) active @endif">
                    <a href="{{ route('seller.orders') }}"><i class="las la-list-alt"></i> {{ __('All Service Orders') }} </a>
                </li>

                @if(moduleExists('JobPost'))
                    <li class="dashboard__bottom__list__item @if(request()->is('seller/job-orders*')) active @elseif(request()->is('serviceprovider/job-orders*')) active @endif">
                        <a href="{{ route('seller.job.orders') }}"> <i class="las la-bars"></i> {{ __('All Job Orders') }}</a>
                    </li>
                @endif

                <li class="dashboard__bottom__list__item @if(request()->is('seller/notification/all-notifications*')) active @elseif(request()->is('serviceprovider/notification/all-notifications*')) active @endif">
                    <a href="{{ route('seller.notification.all') }}"><i class="las la-bell"></i> {{ __('All Notifications') }}</a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('seller/payout-request*')) active @elseif(request()->is('serviceprovider/payout-request*')) active @endif">
                    <a href="{{ route('seller.payout') }}"> <i class="fa fa-indian-rupee-sign"></i>{{ __('Payout History') }} </a>
                </li>
                <li class="dashboard__bottom__list__item @if(request()->is('seller/service-reviews*')) active @elseif(request()->is('serviceprovider/service-reviews*')) active @endif">
                    <a href="{{ route('seller.service.review') }}"> <i class="lar la-star"></i>{{ __('Review') }}</a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('seller/all-tickets*')) active @elseif(request()->is('serviceprovider/all-tickets*')) active @endif">
                    <a href="{{ route('seller.support.ticket') }}"><i class="las la-ticket-alt"></i> {{ __('Support Ticket') }}</a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('seller/order/report/list*')) active @elseif(request()->is('serviceprovider/order/report/list*')) active  @endif">
                    <a href="{{ route('seller.order.report.list')}}"> <i class="las la-file-alt"></i> {{__('Reports List')}} </a>
                </li>


                @if(moduleExists('Wallet'))
                    <li class="dashboard__bottom__list__item @if(request()->is('seller/wallet-history*')) active @elseif(request()->is('serviceprovider/wallet-history*')) active @endif ">
                        <a href="{{ route('seller.wallet.history') }}"><i class="las la-wallet"></i> {{__('Wallet')}}  </a>
                    </li>
                @endif

                @if(moduleExists('JobPost'))
                    @php
                        $jobs = \Modules\JobPost\Entities\BuyerJob::whereDoesntHave('sellerViewJobs', function ($list){
                           $list->where('seller_id', Auth::guard('web')->user()->id);
                        })->latest()->count();
                    @endphp
                    <li class="dashboard__bottom__list__item @if(request()->is('seller/job/notification/new/jobs*')) active @elseif(request()->is('serviceprovider/job/notification/new/jobs*')) active @endif">
                        <a href="{{ route('seller.new.jobs') }}"> <i class="las la-briefcase"></i> {{__('New Jobs')}}
                            <span class="badge badge-danger" style="color: #2163b3; border: solid 2px">{{ $jobs }}</span></a>
                    </li>
                    <li class="dashboard__bottom__list__item @if(request()->is('seller/job/request/*')) active @elseif(request()->is('serviceprovider/job/request/*')) active @endif">
                        <a href="{{ route('seller.all.jobs.request') }}"> <i class="las la-briefcase"></i> {{__('All Jobs Request')}} </a>
                    </li>
                @endif

                <li class="dashboard__bottom__list__item @if(request()->is('seller/to-do-list*')) active @elseif(request()->is('serviceprovider/to-do-list*')) active @endif">
                    <a href="{{ route('seller.todolist') }}"> <i class="las la-list"></i>{{ __('Todo List') }}</a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('seller/seller-profile-verify*')) active @elseif(request()->is('serviceprovider/seller-profile-verify*')) active @endif">
                    <a href="{{ route('seller.profile.verify')}}"> <i class="las la-user"></i> {{__('Profile Verification')}} </a>
                </li>
                <li class="dashboard__bottom__list__item @if(request()->is('seller/account-settings*')) active @elseif(request()->is('serviceprovider/account-settings*')) active @endif">
                    <a href="{{ route('seller.account.settings') }}"> <i class="las la-cog"></i> {{__('Settings')}} </a>
                </li>

                <li class="dashboard__bottom__list__item">
                    <a href="{{ route('seller.logout')}}"> <i class="las la-sign-out-alt"></i> {{__('Log Out' )}} </a>
                </li>

            </ul>
        </div>
    </div>
</div>