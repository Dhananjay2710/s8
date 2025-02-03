<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .table-td-padding {
            border-collapse: separate;
            border-spacing: 10px 20px;
        }
        .add-to-calendar .icon-google {
            display: block!important;
        }
        .add-to-calendar-checkbox~a:before{
            display:none!important;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/font-awesome.min.css')); ?>">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
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
    <?php echo $__env->make('frontend.user.buyer.partials.sidebar-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__right">
        <?php echo $__env->make('frontend.user.buyer.header.buyer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="dashboard__body">
            <div class="dashboard__inner">

                <!-- search section start-->
                <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                    <div class="dashboard__wallet">
                            <form action="<?php if(request()->path() == 'buyer/job-orders' || request()->path() == 'customer/job-orders'): ?> <?php echo e(route('buyer.job.orders')); ?> <?php else: ?> <?php echo e(route('buyer.orders')); ?> <?php endif; ?>" method="GET">
                            <div class="dashboard__headerGlobal__flex">
                                <div class="dashboard__headerGlobal__content">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="dashboard_table__title"><?php echo e(__('Search Service Request Module')); ?></h4> <i class="las la-angle-down search_by_all"></i>
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
                                                                    <label for="order_id" class="info-title"> <?php echo e(__('Service Request ID')); ?> </label>
                                                                    <input class="form--control" name="order_id" value="<?php echo e(request()->get('order_id')); ?>" type="text" placeholder="<?php echo e(__('Service Request ID')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="order_status" class="info-title"> <?php echo e(__('Service Request Status')); ?> </label>
                                                                    <select name="order_status">
                                                                        <option value=""><?php echo e(__('Select Service Request Status')); ?></option>
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
                                                                    <input class="form--control flatpickr_input"  name="order_date" type="text" placeholder="<?php echo e(__('Created Date Range')); ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-4 mt-2">
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <?php if(request()->path() == 'buyer/job-orders' || request()->path() == 'customer/job-orders'): ?>
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
                                                                    <label for="seller_name" class="info-title"> <?php echo e(__('Service Provider Name')); ?> </label>
                                                                    <input class="form--control" name="seller_name" value="<?php echo e(request()->get('seller_name')); ?>" type="text" placeholder="<?php echo e(__('Service Provider Name')); ?>">
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
                    <?php if(request()->path() == 'buyer/job-orders' || request()->path() == 'customer/job-orders'): ?>
                        <h4 class="dashboards-title mb-3"><?php echo e(__('All Job Orders')); ?></h4>
                    <?php else: ?>
                        <h4 class="dashboards-title mb-3"><?php echo e(__('All Service Orders')); ?></h4>
                    <?php endif; ?>
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

                    <?php if($orders->count() >= 1): ?>
                    <div class="dashboard_table__main custom--table mt-4">
                        <table>
                            <thead>
                            <tr>
                                <th><?php echo e(__('Service Request Details')); ?></th>

                                <?php if(request()->path() == 'buyer/orders' || request()->path() == 'customer/orders'): ?>
                                    <th><?php echo e(__('Booking Date and Time')); ?></th>
                                <?php endif; ?>

                                <th><?php echo e(__('Problem Deatils')); ?></th>
                                
                                
                                <th><?php echo e(__('Service Reqest To Review')); ?></th>
                                <th><?php echo e(__('Status/Action')); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="dashboard_table__main__order">
                                        <div class="dashboard_table__main__order__flex">
                                            <div class="dashboard_table__main__order__thumb">
                                                <?php if(request()->path() == 'buyer/job-orders' || request()->path() == 'customer/job-orders'): ?>
                                                    <?php if(!empty(render_image_markup_by_attachment_id(optional($order->job)->image, '', 'thumb'))): ?>
                                                        <?php echo render_image_markup_by_attachment_id(optional($order->job)->image, '', 'thumb'); ?>

                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('assets/frontend/img/no-image-one.jpg')); ?>" alt="No Image" style="height: 80px">
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if(!empty(render_image_markup_by_attachment_id(optional($order->service)->image, '', 'thumb'))): ?>
                                                        <?php echo render_image_markup_by_attachment_id(optional($order->service)->image, '', 'thumb'); ?>

                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('assets/frontend/img/no-image-one.jpg')); ?>" alt="No Image" style="height: 80px">
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </div>
                                            <div class="dashboard_table__main__order__contents">
                                                <?php if(request()->path() == 'buyer/job-orders' || request()->path() == 'customer/job-orders'): ?>
                                                    <h5 class="dashboard_table__main__order__contents__title"> <?php if($order->order_from_job == 'yes'): ?> <?php echo e(Str::limit(optional($order->job)->title,60)); ?> <?php endif; ?> </h5>
                                                <?php else: ?>
                                                    <h5 class="dashboard_table__main__order__contents__title"><strong class="text-dark"><?php echo e(__('Name : ')); ?></strong><?php echo e(optional($order->service)->title); ?></h5>
                                                <?php endif; ?>
                                                <span class="dashboard_table__main__order__contents__subtitle mt-2">
                                                    <a href="javascript:void(0)" class="dashboard_table__main__order__contents__id"> <strong class="text-dark"><?php echo e(__('ID : ')); ?></strong> <?php echo e($order->id); ?></a>
                                                    <h6 class="price"><strong>Amount : </strong><?php echo e(float_amount_with_currency_symbol($order->total)); ?></h6>
                                                    <div class="dashboard_table__main__type">
                                                        <?php if($order->is_order_online==1): ?>
                                                            <span class="online"><strong>Type : </strong><?php echo e(__('Online')); ?></span>
                                                        <?php else: ?>
                                                            <span class="offline"><strong>Type : </strong><?php echo e(__('Offline')); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if($order->payment_status == 'pending'): ?>
                                                        <div class="dashboard_table__main__priority"><strong><?php echo e(__('Payment Status : ')); ?></strong> <span class="priorityBtn pending"><?php echo e(__('Pending')); ?></span> </div>
                                                        <?php if($order->payment_gateway == 'cash_on_delivery'): ?>
                                                            <span class="text-info"><strong><?php echo e(__('Payment Type: ')); ?></strong> <br>  <?php echo e(__('Cash on Delivery')); ?></span> <br>
                                                            <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cancel-order','data' => ['url' => route('buyer.order.cancel.cod.payment.pending',$order->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cancel-order'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('buyer.order.cancel.cod.payment.pending',$order->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                                        <?php elseif($order->payment_gateway == 'annual_maintenance_charge'): ?>
                                                            <span class="text-info"><strong><?php echo e(__('Payment Type: ')); ?></strong><?php echo e(__('AMC')); ?></span>
                                                            <br>
                                                            <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cancel-order','data' => ['url' => route('buyer.order.cancel.cod.payment.pending',$order->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cancel-order'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('buyer.order.cancel.cod.payment.pending',$order->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if($order->payment_status == 'complete'): ?>
                                                        <div class="dashboard_table__main__priority"><strong><?php echo e(__('Payment Status : ')); ?></strong> <span class="priorityBtn completed"><?php echo e(__('Payment_AMC')); ?></span> </div>
                                                    <?php endif; ?>
                                                    <?php if(empty($order->payment_status)): ?>
                                                        <div class="dashboard_table__main__priority"><strong><?php echo e(__('Payment Status : ')); ?></strong>  <span class="priorityBtn pending"><?php echo e(__('Pending/NA')); ?></span> </div>
                                                    <?php endif; ?>
                                                    
                                                </span>
                                                <span><strong><?php echo e(__('Date : ')); ?></strong>  <?php echo e(Carbon\Carbon::parse( strtotime($order->created_at))->format('d/m/y')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <?php if(request()->path() == 'buyer/orders' || request()->path() == 'customer/orders'): ?>
                                <td>
                                    <div class="dashboard_table__main__date">
                                        <span class="date">
                                            <?php if($order->date === 'No Date Created'): ?>
                                                <?php echo e(__('No Date Created')); ?>

                                            <?php else: ?>
                                                <strong>Date : </strong><?php echo e(Carbon\Carbon::parse( strtotime($order->date))->format('d/m/y')); ?>

                                                <br>
                                                <strong>Time : </strong><span class="time"><?php echo e(__($order->schedule)); ?></span>
                                            <?php endif; ?>
                                        </span>
                                        
                                    </div>
                                </td>
                                <?php endif; ?>

                                <td>
                                    <div class="dashboard_table__main__amount mx-4">
                                        <a href="javascript:void(0)" class="dashboard_table__main__order__contents__author"> <strong class="text-dark"><?php echo e(__('Problem : ')); ?></strong><?php echo e($order->problem_title ?? "NA"); ?> </a>
                                    </div>
                                </td>
                                
                                <!-- payment status start -->
                                
                                <!-- payment status end -->

                                <!-- order complete request start-->
                                <?php if($order->order_complete_request == 0): ?>
                                    <td class="pending"><span class="mx-4"><?php echo e(__('No Request Created')); ?></span></td>
                                <?php endif; ?>
                                <?php if($order->order_complete_request == 1): ?>
                                    <td>
                                      <div class="mx-3">
                                          <span><?php echo e(__('Approve Request')); ?></span> <br>
                                          <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.order-complete-request-approve','data' => ['url' => route('buyer.order.complete.request.approve',$order->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('order-complete-request-approve'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('buyer.order.complete.request.approve',$order->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                          <span class="btn btn-warning btn-sm">
                                         <a href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#declineModal"
                                            data-seller_id="<?php echo e($order->seller_id); ?>"
                                            data-service_id="<?php echo e($order->service_id); ?>"
                                            data-order_id="<?php echo e($order->id); ?>"
                                            class="decline_add_modal"><?php echo e(__('Decline')); ?>

                                         </a>
                                    </span>
                                      </div>
                                    </td>
                                <?php endif; ?>

                                <?php if($order->order_complete_request == 2): ?>
                                    <?php  $review_count = \App\Review::where('order_id',$order->id)->where('type', 1)->where('buyer_id',Auth::guard('web')->user()->id)->get(); ?>
                                    <td>  <div class="dashboard_table__main__priority mx-4 mt-4"><a href="javascript:void(0)" class="priorityBtn completed"><?php echo e(__('Completed')); ?></a> </div>
                                    <!--review section start -->
                                    <?php if($review_count->count() == 0): ?>
                                        <?php if($order->status == 2): ?>
                                                <div class="dashboard_table__main__priority mx-4 mt-2" style="padding-left: 14px">
                                                <a class="review_add_modal"
                                                   href="#"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#reviewModal"
                                                   data-seller_id="<?php echo e($order->seller_id); ?>"
                                                   data-service_id="<?php echo e($order->service_id); ?>"
                                                   data-order_id="<?php echo e($order->id); ?>"
                                                ><i class="las la-star text-success"></i> <?php echo e(__('Review')); ?> </a>
                                             </div>
                                            <?php endif; ?>
                                       <?php else: ?>
                                            <div class="dashboard_table__main__priority mx-4 mt-2" style="padding-left: 21px; color: rgb(255,165,52)">
                                                <a class="review_add_modal" href="#" title="<?php echo e(__('already reviewed')); ?>"> <?php echo e(__('Reviewed')); ?> </a>
                                            </div>
                                    <?php endif; ?>
                                    <!--review section end -->
                                </td>
                                <?php endif; ?>

                                <?php if($order->order_complete_request == 3): ?>
                                    <td>
                                        <div class="mx-4">
                                            <?php if(optional($order->completedeclinehistory)->count() >=1): ?>
                                                <span class="text-danger"><?php echo e(__('Request Decline')); ?></span> <br>
                                                <span class="btn btn-warning"><a href="<?php echo e(route('buyer.order.request.decline.history',$order->id)); ?>"> <?php echo e(__('View History')); ?> </a></span>
                                            <?php endif; ?>
                                        </div>
                                    </td>

                                <?php endif; ?>
                                <!-- order complete request end-->

                                <!-- Order status start -->
                                <td>
                                   <?php if($order->status == 0): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn pending"><?php echo e(__('Pending')); ?></a> </div> <?php endif; ?>
                                   <?php if($order->status == 1): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn active"><?php echo e(__('Active')); ?></a> </div> <?php endif; ?>
                                   <?php if($order->status == 2): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn completed"><?php echo e(__('Completed')); ?></a> </div> <?php endif; ?>
                                   <?php if($order->status == 3): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn delivered"><?php echo e(__('Delivered')); ?></a> </div> <?php endif; ?>
                                   <?php if($order->status == 4): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn cancel"><?php echo e(__('Cancelled')); ?></a> </div> <?php endif; ?>
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
                                                       data-seller_id="<?php echo e($order->seller_id); ?>"
                                                       data-service_id="<?php echo e($order->service_id); ?>"
                                                       data-order_id="<?php echo e($order->id); ?>"
                                                    ><i class="las la-star text-success"></i> <?php echo e(__('Review')); ?> </a>
                                            </li>
                                            <?php endif; ?>
                                            <!--review section end -->

                                            <li><a class="dropdown-item" href="<?php echo e(route('buyer.order.details', $order->id)); ?>"><i class="fa-regular fa-eye text-success"></i><?php echo e(__('View Details')); ?></a></li>
                                           <?php if($order->is_order_online != 1): ?>
                                                <?php if($order->buyer_id != NULL): ?>
                                                 <li> <a class="dropdown-item" href="<?php echo e(route('buyer.support.ticket.new', $order->id)); ?>"><i class="las la-ticket-alt text-success"></i> <?php echo e(__('New Ticket')); ?> </a> </li>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if(!empty($order->online_order_ticket->id)): ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('buyer.support.ticket.view', optional($order->online_order_ticket)->id ?? 0)); ?>">
                                                        <i class="las la-eye-slash text-success"></i> <?php echo e(__('View Ticket')); ?></a>
                                                </li>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <li><a class="dropdown-item" href="<?php echo e(route('buyer.order.invoice.details',$order->id)); ?>" target="_blank"><i class="las la-print text-danger"></i> <?php echo e(__('Print Pdf')); ?> </a></li>

                                            <!-- report section Start -->
                                            <?php if($order->status != 2): ?>
                                            <li><a class="dropdown-item report_add_modal"
                                                   href="#"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#reportModal"
                                                   data-seller_id="<?php echo e($order->seller_id); ?>"
                                                   data-service_id="<?php echo e($order->service_id); ?>"
                                                   data-order_id="<?php echo e($order->id); ?>"
                                                ><i class="lar la-file text-danger"></i> <?php echo e(__('Report')); ?> </a>
                                            </li>
                                            <?php endif; ?>
                                            <!-- report section end -->
                                            <?php
                                                if (request()->path() == 'buyer/job-orders' || request()->path() == 'customer/job-orders'){
                                                    $service_title =  optional($order->job)->title;
                                                }else{
                                                     $service_title =  optional($order->service)->title;
                                                }
                                                $details = __('Service Request Successfully Created');
                                                $address =  optional($order->buyer)->address;
                                            ?>
                                             <li>
                                                 <a class="dropdown-item" href="<?php echo e(get_google_calender($service_title,$order->date,$details, $address)); ?>" target="_blank">
                                                     <i class="las la-calendar text-danger"></i> <?php echo e(__('Add To Google Calendar')); ?> </a>
                                             </li>
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
                                <?php echo $orders->links(); ?>

                            </div>
                        </div>

                    <?php else: ?>
                        <div class="chat_wrapper__details__inner__chat__contents mt-3">
                            <p class="no_data_found_for_buyer_seller_panel">
                                <?php echo e(__('No Orders found')); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- order table section end-->
            </div>
        </div>
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
                        <form action="<?php echo e(route('service.review.from.dashboard')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" id="rating" name="rating" class="form-control form-control-sm">
                            <input type="hidden" id="seller_id" name="seller_id" class="form-control form-control-sm">
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
                                    <div class="form-group m-3">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="media-upload-btn-wrapper">
                                                    <div class="img-wrap"></div>
                                                    <p id="fileLinkOfCustomer"></p>
                                                    <button id="signDocumentBtnOfCustomer" type="button" class="btn btn-info" data-order_customer_file_link="">
                                                        <?php echo e(__('Sign Document')); ?>

                                                    </button>
                                                    <small><?php echo e(__('Sign the document')); ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="media-upload-btn-wrapper" style="padding-top: 5px">
                                                    <div id="timerDisplay">Time left: 3:00</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="media-upload-btn-wrapper">
                                                    <div id="iframeContainerOfCustomer" style="margin-top: 20px;">
                                                        <p><?php echo e(__('Signing Status')); ?></p>
                                                        <p id="fileStatusOfCustomer"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                        <form action="<?php echo e(route('buyer.order.report')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" id="seller_id" name="seller_id" class="form-control form-control-sm">
                            <input type="hidden" id="service_id" name="service_id" class="form-control form-control-sm">
                            <input type="hidden" id="order_id" name="order_id" class="form-control form-control-sm">

                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="ticketTitle" class="label_title"><?php echo e(__('Report Here')); ?></label>
                                        <textarea name="report" cols="30" rows="4"  class="form--control radius-10 textarea-input" placeholder="<?php echo e(__('Report Here')); ?>"></textarea>
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

    <!-- Decline Modal -->
    <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Decline The Request')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('buyer.order.complete.request.decline')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" id="seller_id" name="seller_id" class="form-control form-control-sm">
                            <input type="hidden" id="service_id" name="service_id" class="form-control form-control-sm">
                            <input type="hidden" id="order_id" name="order_id" class="form-control form-control-sm">

                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="ticketTitle" class="label_title"><?php echo e(__('Decline Reason')); ?></label>
                                        <p class="text-info"><?php echo e(__('Tell us why you decline the request in a short details.')); ?></p>
                                        <textarea name="decline_reason" cols="30" rows="4"  class="form--control radius-10 form--message textarea-input" placeholder="<?php echo e(__('Enter decline reason')); ?>"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/js/rating.js')); ?>"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){


                // Order approve after send review
                var openReviewModal = "<?php echo e(\Illuminate\Support\Facades\Session::get('open_review_modal')); ?>";
                var CompleteOrderId = "<?php echo e(\Illuminate\Support\Facades\Session::get('CompleteOrderId')); ?>";
                var seller_id = "<?php echo e(\Illuminate\Support\Facades\Session::get('seller_id')); ?>";
                var service_id = "<?php echo e(\Illuminate\Support\Facades\Session::get('service_id')); ?>";
                var customer_file_link = "<?php echo e(\Illuminate\Support\Facades\Session::get('customer_file_link')); ?>";
                var customer_signing_status = "<?php echo e(\Illuminate\Support\Facades\Session::get('customer_signing_status')); ?>";
                if(openReviewModal === 'yes'){
                    $('.review_add_modal[data-order_id="'+CompleteOrderId+'"]').trigger("click");
                    // $('.review_add_modal[data-order_id="'+CompleteOrderId+'"]').dispatchEvent(new MouseEvent("click"))
                    let myModal = new bootstrap.Modal(document.getElementById('reviewModal'), {
                        keyboard: false
                    });
                    $('#reviewModal input[name="seller_id"]').val(seller_id);
                    $('#reviewModal input[name="service_id"]').val(service_id);
                    $('#reviewModal input[name="order_id"]').val(CompleteOrderId);
                    $('#fileStatusOfCustomer').text(customer_signing_status);
                    fetchUpdatedData();
                    myModal.show();
                }

                // for reviewModal model after click on yes
                document.getElementById('signDocumentBtnOfCustomer').addEventListener('click', function() {
                    if (customer_file_link) {
                        const width = 1000;
                        const height = 800;
                        const left = (screen.width / 2) - (width / 2);
                        const top = (screen.height / 2) - (height / 2);
                        var signWindow = window.open(customer_file_link, 'signDocumentForCustomer', `width=${width},height=${height},top=${top},left=${left},resizable=yes,scrollbars=yes`);
                        // Set the timer duration (in seconds)
                        let timerDuration = 180;
                        const timerDisplay = document.getElementById('timerDisplay');

                        // Update the timer every second
                        const countdownTimer = setInterval(function () {
                            if (timerDuration > 0) {
                                timerDuration--;
                                const minutes = Math.floor(timerDuration / 60);
                                const seconds = timerDuration % 60;
                                timerDisplay.textContent = `Time left: ${minutes}:${seconds.toString().padStart(2, '0')}`;
                            } else {
                                clearInterval(countdownTimer);
                            }
                        }, 1000);

                        // Close the window after 3 minutes (180000 milliseconds)
                        const autoCloseTimer = setTimeout(function () {
                            signWindow.close();
                        }, 180000);

                        // Check if the window is closed manually
                        const checkWindowClosed = setInterval(function () {
                            if (signWindow.closed) {
                                clearInterval(checkWindowClosed);
                                clearInterval(countdownTimer);
                                clearTimeout(autoCloseTimer);
                                timerDisplay.textContent = "Signing window has closed.";
                                fetchUpdatedData();
                            }
                        }, 500);
                    } else {
                        alert('No document link is available.');
                    }
                });

                // fetch updated data using xhr call
                function fetchUpdatedData() {
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', `/providers/serviceprovider/ordersdetailsupdateapi/${CompleteOrderId}`, true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                console.log("XHR Success");
                                const response = JSON.parse(xhr.responseText);
                                const updatedCustomerFileSigningStatus = response.customer_signing_status;
                                console.log("Updated Status", updatedCustomerFileSigningStatus);
                                const customerFileLink = response.customer_file_link;
                                updateDOM(updatedCustomerFileSigningStatus, customerFileLink);
                            } else {
                                console.error('Failed to fetch updated data. Status:', xhr.status);
                            }
                        }
                    };
                    xhr.send();
                }

                // update DOM
                function updateDOM(status, link) {
                    const fileStatusElement = document.querySelector('#fileStatusOfCustomer');
                    fileStatusElement.textContent = status;
                    setFileStatusColor(status);
                    const signDocumentBtnOfCustomer = document.querySelector('#signDocumentBtnOfCustomer');
                    signDocumentBtnOfCustomer.setAttribute('data-order_customer_file_link', link);
                    signDocumentBtnOfCustomer.disabled = !link || status === 'Signed';
                    timerDisplay.textContent = '';
                }

                // set file status color
                function setFileStatusColor(status) {
                    const fileStatusElement = document.querySelector('#fileStatusOfCustomer');
                    if (status === 'Pending') {
                        fileStatusElement.style.color = 'red';
                    } else if (status === 'Signed') {
                        fileStatusElement.style.color = 'green';
                    } else {
                        fileStatusElement.style.color = 'black'; 
                    }
                }

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

                $(document).on('click','.swal_status_change',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure to approve the service request? Once you done you can not revert this !!")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "<?php echo e(__('Yes, Approve it!')); ?>"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
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

                // buyer to seller report
                $(document).on('click', '.report_add_modal', function () {
                    let el = $(this);
                    let seller_id = el.data('seller_id');
                    let service_id = el.data('service_id');
                    let order_id = el.data('order_id');
                    let form = $('#reportModal');
                    form.find('#seller_id').val(seller_id);
                    form.find('#service_id').val(service_id);
                    form.find('#order_id').val(order_id);
                });

                // review
                $(document).on('click', '.review_add_modal', function () {
                    let el = $(this);
                    let seller_id = el.data('seller_id');
                    let service_id = el.data('service_id');
                    let order_id = el.data('order_id');
                    let form = $('#reviewModal');
                    form.find('#seller_id').val(seller_id);
                    form.find('#service_id').val(service_id);
                    form.find('#order_id').val(order_id);
                });

                $("#review").rating({
                    "value": 5,
                    "click": function (e) {
                        $("#rating").val(e.stars);
                    }
                });

                //decline request
                $(document).on('click', '.decline_add_modal', function () {
                    let el = $(this);
                    let seller_id = el.data('seller_id');
                    let service_id = el.data('service_id');
                    let order_id = el.data('order_id');
                    let form = $('#declineModal');
                    form.find('#seller_id').val(seller_id);
                    form.find('#service_id').val(service_id);
                    form.find('#order_id').val(order_id);
                });


            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/buyer/order/partials/service-orders-two.blade.php ENDPATH**/ ?>