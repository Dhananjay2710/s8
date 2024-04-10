<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <style>
        .table-td-padding {
            border-collapse: separate;
            border-spacing: 10px 20px;
        }
       .dash-icon.color-1{
           background: rgba(255,179,7,.1);
           color: #ffb307;
           text-align: center;
           border-radius: 5px;
           font-size: 14px;
           <?php if(request()->path() == 'seller/job-orders'): ?>padding: 8px;  <?php else: ?> padding: 6px; margin-bottom: -1px; <?php endif; ?>
}    </style>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/font-awesome.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.seller-buyer-preloader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.seller-buyer-preloader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php $default_lang = get_default_language(); ?>
    <?php echo $__env->make('frontend.user.seller.partials.sidebar-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__right">
        <?php echo $__env->make('frontend.user.buyer.header.buyer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="dashboard__body">
            <div class="dashboard__inner">
                <!-- search section start-->
                <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                    <div class="dashboard__wallet">
                         <form action="<?php if(request()->path() == 'seller/job-orders'): ?>  <?php echo e(route('seller.job.orders')); ?> <?php else: ?> <?php echo e(route('seller.orders')); ?>  <?php endif; ?>" method="GET">
                            <div class="dashboard__headerGlobal__flex">
                                <div class="dashboard__headerGlobal__content">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="dashboard_table__title"><?php echo e(__('Search Order Module')); ?></h4> <i class="las la-angle-down search_by_all"></i>
                                    </button>
                                </div>
                                <div class="dashboard__headerGlobal__btn">
                                    <div class="btn-wrapper">
                                        <button href="#" class="dashboard_table__title__btn btn-bg-1 radius-5" type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i> <?php echo e(__('Search')); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div id="collapseOne" class="accordion-collapse collapse
                                 <?php if(request()->get('order_id')): ?>  show
                                 <?php elseif(request()->get('order_date')): ?> show
                                 <?php elseif(request()->get('payment_status')): ?> show
                                 <?php elseif((request()->get('order_status'))): ?> show
                                 <?php elseif(request()->get('total')): ?> show
                                 <?php elseif(request()->get('service_title')): ?> show
                                 <?php elseif(request()->get('seller_name')): ?> show
                                 <?php elseif(request()->get('job_title')): ?> show
                                 <?php endif; ?>
                                " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="single-settings">
                                                    <div class="single-dashboard-input">

                                                        <div class="row g-4 mt-3">
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="order_id" class="info-title"> <?php echo e(__('Order ID')); ?> </label>
                                                                    <input class="form--control" name="order_id" value="<?php echo e(request()->get('order_id')); ?>" type="text" placeholder="<?php echo e(__('Order ID')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="order_status" class="info-title"> <?php echo e(__('Order Status')); ?> </label>
                                                                    <select name="order_status">
                                                                        <option value=""><?php echo e(__('Select Order Status')); ?></option>
                                                                         <option value="pending" <?php if(request()->get('order_status') == 'pending'): ?> selected <?php endif; ?>><?php echo e(__('Pending')); ?></option>
                                                                         <option value="1" <?php if(request()->get('order_status') == 1): ?> selected <?php endif; ?>><?php echo e(__('Active')); ?></option>
                                                                         <option value="2" <?php if(request()->get('order_status') == 2): ?> selected <?php endif; ?>><?php echo e(__('completed')); ?></option>
                                                                         <option value="3" <?php if(request()->get('order_status') == 3): ?> selected <?php endif; ?>><?php echo e(__('Delivered')); ?></option>
                                                                         <option value="4" <?php if(request()->get('order_status') == 4): ?> selected <?php endif; ?>><?php echo e(__('Cancel')); ?></option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="order_date" class="info-title"> <?php echo e(__('Created Date Range')); ?> </label>
                                                                    <input class="form--control flatpickr_input"  name="order_date" type="text" value="<?php echo e(request()->get('order_date')); ?>" placeholder="<?php echo e(__('Created Date Range')); ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-4 mt-2">
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <?php if(request()->path() == 'seller/job-orders'): ?>
                                                                        <input type="hidden" value="job_order" name="job_order_request">
                                                                        <label for="job_title" class="info-title"> <?php echo e(__('Job Title')); ?> </label>
                                                                        <input class="form--control" name="job_title" value="<?php echo e(request()->get('job_title')); ?>" type="text" placeholder="<?php echo e(__('Job Title')); ?>">
                                                                    <?php else: ?>
                                                                        <label for="service_title" class="info-title"> <?php echo e(__('Service Title')); ?> </label>
                                                                        <input class="form--control" name="service_title" value="<?php echo e(request()->get('service_title')); ?>" type="text" placeholder="<?php echo e(__('Service Title')); ?>">
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="buyer_name" class="info-title"> <?php echo e(__('Buyer Name')); ?> </label>
                                                                    <input class="form--control" name="buyer_name" value="<?php echo e(request()->get('buyer_name')); ?>" type="text" placeholder="<?php echo e(__('Buyer Name')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="payment_status" class="info-title"> <?php echo e(__('Payment Status')); ?> </label>
                                                                    <select name="payment_status">
                                                                        <option value=""><?php echo e(__('Select Payment Status')); ?></option>
                                                                        <option value="complete" <?php if(request()->get('payment_status') == 'complete'): ?> selected <?php endif; ?>><?php echo e(__('Complete')); ?></option>
                                                                        <option value="pending" <?php if(request()->get('payment_status') == 'pending'): ?> selected <?php endif; ?>><?php echo e(__('Pending')); ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                     </div>
                </div>
                <!--search section end-->

                <!-- order table section start-->
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <?php if(request()->path() == 'seller/job-orders'): ?>
                        <h4 class="dashboards-title mb-3"><?php echo e(__('All Job Orders')); ?></h4>
                    <?php else: ?>
                        <h4 class="dashboards-title mb-3"><?php echo e(__('All Service Orders')); ?></h4>
                    <?php endif; ?>
                    <!-- Order count section start -->

                    <div class="paymentGateway_add mt-3">
                        <div class="paymentGateway_add__item_seller_order custom_radio__single_seller_order radius-10">
                            <label for="Active" class="paymentGateway_add__item__img"><?php echo e(__('Pending')); ?> <strong class="numbers"><?php echo e($pending_orders->count()); ?></strong></label>
                        </div>
                        <div class="paymentGateway_add__item_seller_order custom_radio__single_seller_order radius-10">
                            <label for="Active" class="paymentGateway_add__item__img"><?php echo e(__('Active')); ?> <strong class="numbers"><?php echo e($active_orders->count()); ?></strong></label>
                        </div>
                        <div class="paymentGateway_add__item_seller_order custom_radio__single_seller_order radius-10">
                            <label for="Delivered" class="paymentGateway_add__item__img"><?php echo e(__('Delivered')); ?> <strong class="numbers"><?php echo e($complete_orders->count()); ?></strong></label>
                        </div>
                        <div class="paymentGateway_add__item_seller_order custom_radio__single_seller_order radius-10">
                            <label for="Completed" class="paymentGateway_add__item__img"><?php echo e(__('Completed')); ?> <strong class="numbers"><?php echo e($deliver_orders->count()); ?></strong></label>
                        </div>
                        <div class="paymentGateway_add__item_seller_order custom_radio__single_seller_order radius-10">
                            <label for="Cancelled" class="paymentGateway_add__item__img"><?php echo e(__('Cancelled')); ?> <strong class="numbers"><?php echo e($cancel_orders->count()); ?></strong></label>
                        </div>
                        <div class="paymentGateway_add__item_seller_order custom_radio__single_seller_order radius-10">
                            <label for="All" class="paymentGateway_add__item__img"><?php echo e(__('All')); ?> <strong class="numbers"><?php echo e($orders->count()); ?></strong> </label>
                        </div>
                    </div>
                    <!-- Order count section end -->
                   <div class="mt-3">
                       <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.success','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                       <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                   </div>
                    <?php if($all_orders->count() >= 1): ?>
                    <div class="dashboard_table__main custom--table mt-4">
                        <table>
                            <thead>
                            <tr>
                                <th><?php echo e(__('Order item')); ?></th>

                                <?php if(request()->path() == 'seller/orders'): ?>
                                    <th><?php echo e(__('Booking Date and Time')); ?></th>
                                <?php endif; ?>

                                <th><?php echo e(__('Order amount')); ?></th>
                                <th><?php echo e(__('Order type')); ?></th>
                                <th><?php echo e(__('Payment Details')); ?></th>
                                <th><?php echo e(__('Order Complete Request')); ?></th>
                                <th><?php echo e(__('Order status')); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $all_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="dashboard_table__main__order">
                                        <div class="dashboard_table__main__order__flex">
                                            <div class="dashboard_table__main__order__thumb">
                                            <?php if(request()->path() == 'seller/job-orders'): ?>
                                                <?php if(!empty(render_image_markup_by_attachment_id(optional($order->job)->image, '', 'thumb'))): ?>
                                                    <?php echo render_image_markup_by_attachment_id(optional($order->job)->image, '', 'thumb'); ?>

                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('assets/frontend/img/no-image-one.jpg')); ?>"  alt="No Image" style="height: 77px">
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if(!empty(render_image_markup_by_attachment_id(optional($order->service)->image, '', 'thumb'))): ?>
                                                    <?php echo render_image_markup_by_attachment_id(optional($order->service)->image, '', 'thumb'); ?>

                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('assets/frontend/img/no-image-one.jpg')); ?>"  alt="No Image" style="height: 77px">
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            </div>
                                            <div class="dashboard_table__main__order__contents">
                                                <?php if(request()->path() == 'seller/job-orders'): ?>
                                                    <h5 class="dashboard_table__main__order__contents__title"> <?php if($order->order_from_job == 'yes'): ?> <?php echo e(Str::limit(optional($order->job)->title,60)); ?> <?php endif; ?> </h5>
                                                <?php else: ?>
                                                    <h5 class="dashboard_table__main__order__contents__title"><?php echo e(optional($order->service)->title); ?></h5>
                                                <?php endif; ?>
                                                <span class="dashboard_table__main__order__contents__subtitle mt-2">
                                                    <a href="javascript:void(0)" class="dashboard_table__main__order__contents__id"> <strong class="text-dark"><?php echo e(__('Order ID:')); ?></strong> <?php echo e($order->id); ?></a> ,
                                                    <a href="javascript:void(0)" class="dashboard_table__main__order__contents__author"> <strong class="text-dark"><?php echo e(__('Buyer Name:')); ?></strong><?php echo e(optional($order->buyer)->name); ?> </a>
                                                </span>
                                                <span><strong><?php echo e(__('Order Date:')); ?></strong>  <?php echo e(Carbon\Carbon::parse( strtotime($order->created_at))->format('d/m/y')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <?php if(request()->path() == 'seller/orders'): ?>
                                <td>
                                    <div class="dashboard_table__main__date">
                                        <span class="date">
                                            <?php if($order->date === 'No Date Created'): ?>
                                                <?php echo e(__('No Date Created')); ?>

                                            <?php else: ?>
                                                <?php echo e(Carbon\Carbon::parse( strtotime($order->date))->format('d/m/y')); ?>

                                            <?php endif; ?>
                                        </span>
                                        <span class="time"><?php echo e(__($order->schedule)); ?></span>
                                    </div>
                                </td>
                                <?php endif; ?>

                                <td>
                                    <div class="dashboard_table__main__amount mx-4">
                                        <h6 class="price"><?php echo e(float_amount_with_currency_symbol($order->total)); ?></h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="dashboard_table__main__type">
                                        <?php if($order->is_order_online==1): ?>
                                            <span class="online"><?php echo e(__('Online')); ?></span>
                                        <?php else: ?>
                                            <span class="offline"><?php echo e(__('Offline')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <!-- payment status start -->
                                <td data-label="Payment Status">
                                    <?php if($order->payment_status == 'pending'): ?>
                                        <div class="dashboard_table__main__priority"><strong><?php echo e(__('Payment Status: ')); ?></strong> <span class="priorityBtn pending"><?php echo e(__('Pending')); ?></span> </div>
                                        <?php if($order->payment_gateway == 'cash_on_delivery'): ?>
                                            <span class="text-info"><strong><?php echo e(__('Payment Type: ')); ?></strong> <br>  <?php echo e(__('Cash on Delivery')); ?></span> <br>
                                            <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cancel-order','data' => ['url' => route('seller.order.cancel.cod.payment.pending',$order->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cancel-order'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.order.cancel.cod.payment.pending',$order->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($order->payment_status == 'complete'): ?>
                                     <div class="dashboard_table__main__priority"><strong><?php echo e(__('Payment Status: ')); ?></strong> <span class="priorityBtn completed"><?php echo e(__('Complete')); ?></span> </div>
                                    <?php endif; ?>
                                    <?php if(empty($order->payment_status)): ?>
                                         <div class="dashboard_table__main__priority"><strong><?php echo e(__('Payment Status: ')); ?></strong>  <span class="priorityBtn pending"><?php echo e(__('Pending')); ?></span> </div>
                                    <?php endif; ?>

                                    <!--for cash one delivery payment status change -->
                                        <?php if($order->payment_gateway === 'cash_on_delivery' && $order->payment_status === 'pending'): ?>
                                            <a href="javascript:void(0)"
                                               class="edit_payment_status_modal"
                                               data-bs-toggle="modal"
                                               data-bs-target="#editPaymentStatusModal"
                                               data-id="<?php echo e($order->id); ?>">
                                                <span class="dash-icon color-1 mt-2"><?php echo e(__('Change Payment Status')); ?></span>
                                            </a>
                                        <?php endif; ?>
                                </td>
                                <!-- payment status end -->

                                <!-- order complete request start-->
                                <td data-label="Order Status" >
                                <span class="<?php echo e(in_array($order->order_complete_request,[0,1]) ? 'pending' : ' completed'); ?> d-block">
                                    <?php  $review_count = \App\Review::where('order_id',$order->id)->where('type', 1)->where('seller_id',Auth::guard('web')->user()->id)->get(); ?>
                                    <?php if(in_array($order->order_complete_request,[0,1])): ?>
                                        <?php if($order->payment_status != 'pending'): ?>
                                            <?php if($order->order_complete_request == 0): ?>
                                                <a href="#0" class="edit_status_modal"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#editStatusModal"
                                                   data-id="<?php echo e($order->id); ?>"
                                                   data-status="<?php echo e($order->status); ?>">
                                                <span class="dash-icon color-1 text-success"><?php echo e(__('Create Complete Request')); ?></span>
                                            </a>
                                            <?php else: ?>
                                                <div class="dashboard_table__main__priority mt-3">
                                                    <a href="javascript:void(0)" class="priorityBtn pending"><?php echo e(__('Request Pending')); ?></a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    <?php elseif($order->order_complete_request == 2): ?>
                                        <div class="dashboard_table__main__priority   <?php if(request()->path() == 'seller/orders'): ?> mt-5 <?php else: ?> mt-4 <?php endif; ?> ">
                                            <a href="javascript:void(0)" class="priorityBtn completed"><?php echo e(__('Completed')); ?></a>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($order->order_complete_request == 3): ?>
                                        <a href="#0" class="edit_status_modal"
                                           data-bs-toggle="modal"
                                           data-bs-target="#editStatusModal"
                                           data-id="<?php echo e($order->id); ?>"
                                           data-status="<?php echo e($order->status); ?>">
                                                <span class="dash-icon color-1 text-success"> <?php echo e(__('Create Complete Request')); ?></span>
                                            </a> <br>
                                        <?php if(optional($order->completedeclinehistory)->count() >=1): ?>
                                            <span class="btn btn-warning mt-1"><a href="<?php echo e(route('seller.order.request.decline.history',$order->id)); ?>"> <?php echo e(__('View History')); ?> </a></span>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                </span>
                                    <?php if(request()->path() == 'seller/orders'): ?>
                                        <!-- order complete request start-->
                                        <?php if($order->status == 0 && $order->payment_status == 'pending'): ?>
                                            <span class="mx-1 pending"> <?php echo e(__('No Request Created')); ?></span>
                                        <?php endif; ?>

                                        <a href="#0"
                                           data-bs-toggle="modal"
                                           data-id="<?php echo e($order->id); ?>"
                                           data-bs-target="#extraServiceRequest"
                                           class="mt-2 btn btn-secondary extra_submit_request_btn"><?php echo e(__('Extra Services')); ?></a>
                                    <?php else: ?>
                                        <!-- order complete request start-->
                                        <?php if($order->status == 0 && $order->payment_status == 'pending'): ?>
                                            <span class="mx-1 pending"> <?php echo e(__('No Request Created')); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($order->order_complete_request == 2): ?>
                                        <!--review section start -->
                                        <?php if($review_count->count() == 0): ?>
                                            <?php if($order->status == 2): ?>
                                                <div class="dashboard_table__main__priority mx-2 mt-2" style="padding-left: 4px">
                                                    <a class="review_add_modal"
                                                       href="#"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#reviewModal"
                                                       data-buyer_id="<?php echo e($order->buyer_id); ?>"
                                                       data-service_id="<?php echo e($order->service_id); ?>"
                                                       data-order_id="<?php echo e($order->id); ?>"
                                                    ><i class="las la-star text-success"></i> <?php echo e(__('Review')); ?> </a>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="dashboard_table__main__priority mx-4 mt-2" style="color: rgb(255,165,52)">
                                                <a class="review_add_modal" href="#" title="<?php echo e(__('already reviewed')); ?>"> <?php echo e(__('Reviewed')); ?> </a>
                                            </div>
                                        <?php endif; ?>
                                        <!--review section end -->
                                    <?php endif; ?>

                                </td>
                                <!-- order complete request end-->

                                <!-- Order status start -->
                                <td>
                                   <?php if($order->status == 0): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn pending"><?php echo e(__('Pending')); ?></a> </div> <?php endif; ?>
                                   <?php if($order->status == 1): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn active"><?php echo e(__('Active')); ?></a> </div> <?php endif; ?>
                                   <?php if($order->status == 2): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn completed"><?php echo e(__('Completed')); ?></a> </div> <?php endif; ?>
                                   <?php if($order->status == 3): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn delivered"><?php echo e(__('Delivered')); ?></a> </div> <?php endif; ?>
                                   <?php if($order->status == 4): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn cancel"><?php echo e(__('Cancel')); ?></a> </div> <?php endif; ?>
                                </td>
                                <!-- Order status end -->
                                <td>

                                    <div class="dashboard_recentOrder__item__icon">
                                    <span class="dashboard_recentOrder__item__icon__single" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                        <ul class="dropdown-menu">
                                            <!--review section start -->
                                            <?php if($order->status == 2): ?>
                                                <li><a class="dropdown-item review_add_modal"
                                                       href="#"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#reviewModal"
                                                       data-buyer_id="<?php echo e($order->buyer_id); ?>"
                                                       data-service_id="<?php echo e($order->service_id); ?>"
                                                       data-order_id="<?php echo e($order->id); ?>"
                                                       class="review_add_modal"
                                                      ><i class="las la-star text-success"></i> <?php echo e(__('Review')); ?> </a>
                                            </li>
                                            <?php endif; ?>
                                            <!--review section end -->

                                            <li><a class="dropdown-item" href="<?php echo e(route('seller.order.details', $order->id)); ?>"><i class="fa-regular fa-eye text-success"></i><?php echo e(__('View Details')); ?></a></li>
                                           <?php if($order->is_order_online != 1): ?>
                                                <?php if($order->buyer_id != NULL): ?>
                                                 <li> <a class="dropdown-item" href="<?php echo e(route('seller.support.ticket.new', $order->id)); ?>"><i class="las la-ticket-alt text-success"></i> <?php echo e(__('New Ticket')); ?> </a> </li>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if(!empty($order->online_order_ticket->id)): ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('seller.support.ticket.view', optional($order->online_order_ticket)->id ?? 0)); ?>">
                                                        <i class="las la-eye-slash text-success"></i> <?php echo e(__('View Ticket')); ?></a>
                                                </li>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <li><a class="dropdown-item" href="<?php echo e(route('seller.order.invoice.details',$order->id)); ?>" target="_blank"><i class="las la-print text-danger"></i> <?php echo e(__('Print Pdf')); ?> </a></li>

                                            <!-- report section Start -->
                                            <?php if($order->status != 2): ?>
                                            <li><a class="dropdown-item report_add_modal"
                                                   href="#"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#reportModal"
                                                   data-buyer_id="<?php echo e($order->buyer_id); ?>"
                                                   data-service_id="<?php echo e($order->service_id); ?>"
                                                   data-order_id="<?php echo e($order->id); ?>"
                                                ><i class="lar la-file text-danger"></i> <?php echo e(__('Report')); ?> </a>
                                            </li>
                                            <?php endif; ?>
                                            <!-- report section end -->
                                        </ul>

                                    </span>
                                    </div>
                                </td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </tbody>
                        </table>
                    </div>

                        <div class="blog-pagination margin-top-55">
                            <div class="custom-pagination mt-4 mt-lg-5">
                                <?php echo $all_orders->links(); ?>

                            </div>
                        </div>

                    <?php else: ?>
                        <div class="chat_wrapper__details__inner__chat__contents">
                            <h2 class="chat_wrapper__details__inner__chat__contents__para"><?php echo e(__('No Orders Found')); ?></h2>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- order table section end-->
            </div>
        </div>
    </div>


    <!--Status Modal -->
    <div class="modal fade" id="editStatusModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="<?php echo e(route('seller.order.status')); ?>" method="post">
            <input type="hidden" id="order_id" name="order_id">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal"><?php echo e(__('Create Order Complete Request')); ?></h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="up_day_id" class="label_title"><?php echo e(__('Select Status')); ?></label>
                            <select name="status" id="status" class="form-control">
                                <option value=""><?php echo e(__('Select Status')); ?></option>
                                <option value="2"><?php echo e(__('Completed')); ?></option>
                            </select>
                            <p class="text-info mt-2"><?php echo e(__('Completed: Order is completed and closed.')); ?></p>
                        </div>

                        <div class="form-group m-3">
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" name="image">
                                <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="<?php echo e(__('Select Image')); ?>"
                                        data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-bs-toggle="modal"
                                        data-bs-target="#media_upload_modal">
                                    <?php echo e(__('Upload Image')); ?>

                                </button>
                                <small><?php echo e(__('image format: jpg,jpeg,png')); ?></small>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!--Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Review')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('seller.to.buyer.review')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" id="rating" name="rating" class="form-control form-control-sm">
                            <input type="hidden" id="buyer_id" name="buyer_id" class="form-control form-control-sm">
                            <input type="hidden" id="service_id" name="service_id" class="form-control form-control-sm">
                            <input type="hidden" id="order_id" name="order_id" class="form-control form-control-sm">
                            <div class="row g-4">
                                <div class="col-12">

                                    <div class="single-commetns" style="font-size: 1.1rem;">
                                        <label class="comment-label label_title"> <?php echo e(__('Ratings*')); ?> </label>
                                        <div id="review"></div>
                                    </div>

                                    <div class="single-input">
                                        <label for="ticketTitle" class="label_title"><?php echo e(__('Comments')); ?></label>
                                        <textarea id="message" name="message" cols="20" rows="4"  class="form--control radius-10 textarea-input" placeholder="<?php echo e(__('Post Comments')); ?>"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Send Review')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Report Us')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('seller.order.report')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" id="buyer_id" name="buyer_id" class="form-control form-control-sm">
                            <input type="hidden" id="service_id" name="service_id" class="form-control form-control-sm">
                            <input type="hidden" id="order_id" name="order_id" class="form-control form-control-sm">

                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="ticketTitle" class="label_title"><?php echo e(__('Report Here')); ?></label>
                                        <textarea name="report" cols="30" rows="4"  class="form--control radius-10" placeholder="<?php echo e(__('Report Here')); ?>"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Send Report')); ?></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="extraServiceRequest" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true">
        <form action="<?php echo e(route('seller.order.extra.service')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" ><?php echo e(__('Request For Extra Service')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="border: none">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="comments-flex-item">
                            <input type="hidden" name="order_id" class="form-control form-control-sm">
                        </div>
                        <div class="form-group mt-2">
                            <label class="payout-request-note d-block label_title" for="amount"><?php echo e(__('Title')); ?></label>
                            <input type="text" name="title" class="form-control" placeholder="<?php echo e(__('title')); ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label class="payout-request-note d-block label_title" for="quantity"><?php echo e(__('Quantity')); ?></label>
                            <input type="number" name="quantity" class="form-control" placeholder="<?php echo e(__('Quantity')); ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label class="payout-request-note d-block label_title" for="price"><?php echo e(__('Price')); ?></label>
                            <input type="number" name="price" class="form-control" step="0.05" placeholder="<?php echo e(__('price')); ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    
    <div class="modal fade" id="editPaymentStatusModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="<?php echo e(route('seller.order.payment.status')); ?>" method="post">
            <input type="hidden"  name="order_id">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal"><?php echo e(__('Change Payment Status')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="border: none">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="up_day_id"><?php echo e(__('Select Status')); ?></label>
                            <select name="status" id="status" class="form-control nice-select">
                                <option value=""><?php echo e(__('Select Status')); ?></option>
                                <option value="complete"><?php echo e(__('Completed')); ?></option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.markup','data' => ['type' => 'web']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('web')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/js/rating.js')); ?>"></script>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => ['type' => 'web']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('web')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {

                // date range
                $('.flatpickr_input').flatpickr({
                    altFormat: "invisible",
                    altInput: false,
                    mode: "range",
                });

                // for toggle dropdown menu
                $('.dropdown-menu > li > .dropdown-item').click(function () {
                    window.location = $(this).attr('href');
                });

                // media upload modal hide
                $(document).on('click','.media_upload_modal_submit_btn',function(e){
                    e.preventDefault();
                    $('#editStatusModal').modal('show');
                });

                $(document).on('click','.close',function(e){
                    e.preventDefault();
                    $('#media_upload_modal').modal('hide');
                });

                //order cancel status
                $(document).on('click','.swal_status_change_order_cancel',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure to cancel the order")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "<?php echo e(__('Yes, cancel it!')); ?>"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn_cancel_order').trigger('click');
                        }
                    });
                });

                $(document).on('click', '.edit_payment_status_modal', function(e) {
                    e.preventDefault();
                    let modalContainer = $('#editPaymentStatusModal');
                    let order_id = $(this).data('id');
                    modalContainer.find('input[name="order_id"]').val(order_id);
                    $('.nice-select').niceSelect('update');
                });

                /* ------------------------------
                *   Request for extra service
                * -----------------------------*/
                $(document).on('click', '.extra_submit_request_btn', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    let modalContainer = $('#extraServiceRequest');

                    modalContainer.find('input[name="order_id"]').val(order_id);
                });

                $(document).on('click', '.edit_status_modal', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    let status = $(this).data('status');

                    $('#order_id').val(order_id);
                    $('#status').val(status);
                    $('.nice-select').niceSelect('update');
                });

                //report us
                $(document).on('click', '.report_add_modal', function () {
                    let el = $(this);
                    let buyer_id = el.data('buyer_id');
                    let service_id = el.data('service_id');
                    let order_id = el.data('order_id');
                    let form = $('#reportModal');
                    form.find('#buyer_id').val(buyer_id);
                    form.find('#service_id').val(service_id);
                    form.find('#order_id').val(order_id);
                });


                // seller to buyer review start
                $(document).on('click', '.review_add_modal', function () {
                    let el = $(this);

                    let buyer_id = el.data('buyer_id');

                    let service_id = el.data('service_id');

                    let order_id = el.data('order_id');

                    let form = $('#reviewModal');
                    form.find('#buyer_id').val(buyer_id);
                    form.find('#service_id').val(service_id);
                    form.find('#order_id').val(order_id);
                });

                // rating
                $("#review").rating({
                    "value": 5,
                    "click": function (e) {
                        $("#rating").val(e.stars);
                    }
                });

            });

        })(jQuery);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/order/partials/orders-two.blade.php ENDPATH**/ ?>