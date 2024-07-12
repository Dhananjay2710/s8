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

                <li class="dashboard__bottom__list__item @if(request()->is('buyer/dashboard*')) active @elseif(request()->is('customer/dashboard*')) active @endif">
                    <a href="{{ route('buyer.dashboard') }}"><i class="las la-chart-bar"></i> {{ __('Dashboard') }}</a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('buyer/profile*')) active @elseif(request()->is('customer/profile*')) active @endif">
                    <a href="{{ route('buyer.profile')}}"><i class="las la-user-alt"></i> {{ __('Profile') }}</a>
                </li>

                @if(moduleExists('LiveChat'))
                    <li class="dashboard__bottom__list__item @if(request()->is('buyer/live-chat*')) active @elseif(request()->is('customer/live-chat*')) active @endif ">
                        <a href="{{ route('buyer.live.chat') }}"><i class="las la-sms"></i> {{__('Chat Inbox')}}  </a>
                    </li>
                @endif

                <li class="dashboard__bottom__list__item @if(request()->is('buyer/orders*')) active @elseif(request()->is('customer/orders*')) active @endif">
                    <a href="{{ route('buyer.orders') }}"><i class="las la-list-alt"></i> {{ __('All Service Orders') }} </a>
                </li>

                @if(moduleExists('JobPost'))
                    <li class="dashboard__bottom__list__item @if(request()->is('buyer/job-orders*')) active @elseif(request()->is('customer/job-orders*')) active @endif">
                        <a href="{{ route('buyer.job.orders') }}"> <i class="las la-bars"></i> {{ __('All Job Orders') }}</a>
                    </li>
                @endif

                <li class="dashboard__bottom__list__item @if(request()->is('buyer/notification/all-notifications*')) active @elseif(request()->is('customer/notification/all-notifications*')) active @endif">
                    <a href="{{ route('buyer.notification.all') }}"><i class="las la-bell"></i> {{ __('All Notifications') }}</a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('buyer/all-tickets*')) active @elseif(request()->is('customer/all-tickets*')) active @endif">
                    <a href="{{ route('buyer.support.ticket') }}"><i class="las la-ticket-alt"></i> {{ __('Support Ticket') }}</a>
                </li>

                <li class="dashboard__bottom__list__item @if(request()->is('buyer/order/report/list*')) active @elseif(request()->is('customer/order/report/list*')) active @endif">
                    <a href="{{ route('buyer.order.report.list')}}"> <i class="las la-file-alt"></i> {{__('Reports List')}} </a>
                </li>


                @if(moduleExists('Wallet'))
                    <li class="dashboard__bottom__list__item @if(request()->is('buyer/wallet-history*')) active @elseif(request()->is('customer/wallet-history*')) active @endif ">
                        <a href="{{ route('buyer.wallet.history') }}"><i class="las la-wallet"></i> {{__('Wallet')}}  </a>
                    </li>
                @endif

                @if(moduleExists('JobPost'))
                    <li class="dashboard__bottom__list__item @if(request()->is('buyer/jobpost*')) active @elseif(request()->is('customer/jobpost*')) active @endif ">
                        <a href="{{ route('buyer.all.jobs') }}"><i class="las la-briefcase"></i> {{__('Jobs')}}
                            <span class="badge_notification">
                             @php $buyer_all_job_count = \Modules\JobPost\Entities\BuyerJob::where('buyer_id', \Illuminate\Support\Facades\Auth::guard('web')->user()->id)->count();  @endphp
                                {{ $buyer_all_job_count }}
                            </span>
                        </a>
                    </li>

                    <li class="dashboard__bottom__list__item @if(request()->is('buyer/job/request/all*')) active @elseif(request()->is('customer/job/request/all*')) active @endif ">
                         @php
                             $buyer_job_id = \Modules\JobPost\Entities\BuyerJob::where('buyer_id', \Illuminate\Support\Facades\Auth::guard('web')->user()->id)->pluck('id')->toArray();
                             $buyer_all_job_request = \Modules\JobPost\Entities\JobRequest::whereIn('job_post_id', $buyer_job_id)->count();
                        @endphp
                        <a href="{{ route('buyer.all.jobs.request') }}"><i class="las la-briefcase"></i>  {{__('Jobs Request')}} <span class="badge_notification"> {{ $buyer_all_job_request }} </span> </a>
                    </li>
                @endif


                <li class="dashboard__bottom__list__item @if(request()->is('buyer/account-settings*')) active @elseif (request()->is('customer/account-settings*')) active @endif">
                    <a href="{{ route('buyer.account.settings') }}"> <i class="las la-cog"></i> {{__('Settings')}} </a>
                </li>
                <li class="dashboard__bottom__list__item">
                    <a href="{{ route('buyer.logout')}}"> <i class="las la-sign-out-alt"></i> {{__('Log Out' )}} </a>
                </li>

            </ul>
        </div>
    </div>
</div>