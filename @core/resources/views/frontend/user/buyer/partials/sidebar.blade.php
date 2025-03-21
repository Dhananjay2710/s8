<div class="dashboard-left-content">
    <div class="dashboard-close-main">
        <div class="close-bars"> <i class="las la-times"></i> </div>
        <div class="dashboard-top padding-top-40">
            <div class="thumb">
                @if(!is_null(Auth::guard('web')->user()->image))
                {!! render_image_markup_by_attachment_id(Auth::guard('web')->user()->image) !!}
                @else
                <img src="{{ asset('assets/frontend/img/static/user_profile.png') }}" alt="{{ __('No Image') }}"> 
                @endif
            </div>
            <div class="author-content">
                <h4 class="title"> {{ Auth::guard('web')->user()->name }} </h4>
                <strong><a href="{{ route('homepage') }}" target="_blank">{{ __('Visit Site') }}</a></strong>
            </div>
        </div>
        <div class="dashboard-bottom margin-top-35 margin-bottom-50">
            <ul class="dashboard-list ">

                <li class="list @if(request()->is('buyer/dashboard*')) active @elseif(request()->is('customer/dashboard*')) active @endif">
                    <a href="{{ route('buyer.dashboard') }}"> <i class="las la-th"></i> {{__('Dashboard')}} </a>
                </li>
                @if(moduleExists('JobPost'))
                    <li class="list @if(request()->is('buyer/jobpost*')) active @elseif (request()->is('customer/jobpost*')) active @endif">
                        <a href="{{ route('buyer.all.jobs') }}"> <i class="las la-briefcase"></i> {{__('Jobs')}} </a>
                    </li>
                    <li class="list @if(request()->is('buyer/job/request/all')) active @elseif (request()->is('customer/job/request/all')) active @endif">
                        <a href="{{ route('buyer.all.jobs.request') }}"> <i class="las la-briefcase"></i> {{__('Jobs Request')}} </a>
                    </li>
                @endif
                @if(moduleExists('Wallet'))
                    <li class="list @if(request()->is('buyer/wallet-history*')) active @elseif (request()->is('customer/wallet-history*')) active @endif">
                        <a href="{{ route('buyer.wallet.history') }}"> <i class="las la-wallet"></i> {{__('Wallet')}} </a>
                    </li>
                @endif

                <li class="list @if(request()->is('buyer/orders*')) active @elseif (request()->is('customer/orders*')) active @endif">
                    <a href="{{ route('buyer.orders') }}"> <i class="las la-tasks"></i>{{ __('All Service Orders') }}</a>
                </li>

                @if(moduleExists('JobPost'))
                <li class="list @if(request()->is('buyer/job-orders*')) active @elseif (request()->is('customer/job-orders*')) active @endif">
                    <a href="{{ route('buyer.job.orders') }}"> <i class="las la-tasks"></i>{{ __('All Job Orders') }}</a>
                </li>
                @endif

                <li class="list @if(request()->is('buyer/notification/all-notifications*')) active @elseif (request()->is('customer/notification/all-notifications*')) active @endif">
                    <a href="{{ route('buyer.notification.all') }}"><i class="las la-bell"></i> {{ __('All Notifications') }}</a>
                </li>

                <li class="list @if(request()->is('buyer/all-tickets*')) active @elseif (request()->is('customer/all-tickets*')) active @endif">
                    <a href="{{ route('buyer.support.ticket') }}"> <i class="lar la-star"></i>{{ __('Support Ticket') }}</a>
                </li>
                <li class="list @if(request()->is('buyer/report/list*')) active @elseif (request()->is('customer/report/list*')) active @endif">
                    <a href="{{ route('buyer.order.report.list')}}"> <i class="las la-file-alt"></i> {{__('Reports List')}} </a>
                </li>
                <li class="list @if(request()->is('buyer/profile*')) active @elseif (request()->is('customer/profile*')) active @endif">
                    <a href="{{ route('buyer.profile')}}"> <i class="las la-user"></i> {{__('Profile')}} </a>
                </li>
                <li class="list @if(request()->is('buyer/account-settings*')) active @elseif (request()->is('customer/account-settings*')) active @endif">
                    <a href="{{ route('buyer.account.settings') }}"> <i class="las la-cog"></i> {{__('Settings')}} </a>
                </li>
                <li class="list">
                    <a href="{{ route('buyer.logout')}}"> <i class="las la-sign-out-alt"></i> {{__('Log Out' )}} </a>
                </li>

            </ul>
        </div>
        <div class="dashboard-logo">
            <a href="{{ route('homepage') }}" class="logo"> 
                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
            </a>
        </div>
    </div>
</div>