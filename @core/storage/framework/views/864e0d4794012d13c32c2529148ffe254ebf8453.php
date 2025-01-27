
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Service Request Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <?php if(!empty($order_details)): ?>
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">   
                                    <div class="checkbox-inlines">
                                        <label><strong><?php echo e(__('Service Request ID:')); ?> </strong>#<?php echo e($order_details->id); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <button type="button" class="btn btn-info" onclick="goBack()">Go Back</button>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-inlines">
                                        <div id="timerDisplay"></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-inlines">
                                        <div>Signing Status</div>
                                        <centre><div id="fileStatusOfAdmin"></div></centre>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-inlines">
                                        <button id="signDocumentBtnOfAdmin" type="button" class="btn btn-info" data-order_admin_file_link=<?php echo e($order_details->admin_file_link); ?>>
                                            <?php echo e(__('Approved by Signing')); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5><?php echo e(__('Service Provider Details')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Name:')); ?> </strong><?php echo e(optional($order_details->seller)->name); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Email:')); ?> </strong><?php echo e(optional($order_details->seller)->email); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Phone:')); ?> </strong><?php echo e(optional($order_details->seller)->phone); ?></label>
                                </div>
                                <?php if($order_details->is_order_online !=1): ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Address:')); ?> </strong><?php echo e(optional($order_details->seller)->address); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('City:')); ?> </strong><?php echo e(optional(optional($order_details->seller)->city)->service_city); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Area:')); ?> </strong><?php echo e(optional(optional($order_details->seller)->area)->service_area); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Post Code:')); ?> </strong><?php echo e(optional($order_details->seller)->post_code); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Country:')); ?> </strong><?php echo e(optional(optional($order_details->seller)->country)->country); ?></label>
                                </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>   
                </div>
                <?php if($order_details->order_from_job != 'yes'): ?>
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <div class="border-bottom mb-3">
                                    <h5><?php echo e(__('Service Details')); ?></h5>
                                </div>
                                <div class="single-checbox">
                                    <div class="checkbox-inlines">
                                        <label><strong><?php echo e(__('Title:')); ?> </strong><?php echo e(optional($order_details->service)->title); ?></label>
                                    </div>
                                    <br>
                                    <div class="checkbox-inlines">
                                        <?php echo render_image_markup_by_attachment_id(optional($order_details->service)->image,'','thumb'); ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($order_details->order_from_job == 'yes'): ?>
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <div class="border-bottom mb-3">
                                    <h5><?php echo e(__('Job Details')); ?></h5>
                                </div>
                                <div class="single-checbox">
                                    <div class="checkbox-inlines">
                                        <label><strong><?php echo e(__('Title:')); ?> </strong><?php echo e(optional($order_details->job)->title); ?></label>
                                    </div>
                                    <br>
                                    <div class="checkbox-inlines">
                                        <?php echo render_image_markup_by_attachment_id(optional($order_details->job)->image,'','thumb'); ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>


            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5><?php echo e(__('Customer Details')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Name:')); ?> </strong><?php echo e($order_details->name); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Email:')); ?> </strong><?php echo e($order_details->email); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Phone:')); ?> </strong><?php echo e($order_details->phone); ?></label>
                                </div>
                                <?php if($order_details->is_order_online !=1): ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Address:')); ?> </strong><?php echo e($order_details->address); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('City:')); ?> </strong><?php echo e(optional($order_details->service_city)->service_city); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Area:')); ?> </strong><?php echo e(optional($order_details->service_area)->service_area); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Post Code:')); ?> </strong><?php echo e($order_details->post_code); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Country:')); ?> </strong><?php echo e(optional($order_details->service_country)->country); ?></label>
                                </div>
                               <?php endif; ?>
                            </div>

                            <?php if($order_details->is_order_online !=1): ?>
                            <div class="border-bottom mb-3 mt-4">
                                <h5><?php echo e(__('Date & Schedule')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Date:')); ?> </strong><?php echo e($order_details->date); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Schedule:')); ?> </strong><?php echo e($order_details->schedule); ?></label>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="border-bottom mb-3 mt-4">
                                <h5><?php echo e(__('Amount Details')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Package Fee:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->package_fee)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Extra Service:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->extra_service)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Sub Total:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->sub_total)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Tax:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->tax)); ?></label>
                                </div>
                                <?php if(!empty($order_details->coupon_amount)): ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Coupon Amount:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->coupon_amount)); ?></label>
                                </div>
                                <?php endif; ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Total:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->total)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Admin Commission:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->commission_amount)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Payment Method:')); ?> </strong><b class="text-success"><?php echo e(ucwords(str_replace("_", " ", $order_details->payment_gateway))); ?></b></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Payment Status:')); ?> </strong><?php echo e(ucfirst($order_details->payment_status)); ?></label>
                                    <span>
                                        <?php if($order_details->payment_status=='pending'): ?> 
                                        <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-change','data' => ['url' => route('admin.order.change.status',$order_details->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.order.change.status',$order_details->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <?php if($order_details->payment_gateway=='manual_payment'): ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Manual Payment Attachment:')); ?> </strong></label>
                                    <img src="<?php echo e(asset('assets/uploads/manual-payment/'.$order_details->manual_payment_image)); ?>" alt="">
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="border-bottom mb-3 mt-4">
                                <h5><?php echo e(__('Service Request Status')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Service Request Status: ')); ?></strong>
                                        <?php if($order_details->status == 0): ?> <span><?php echo e(__('Pending')); ?></span><?php endif; ?>
                                        <?php if($order_details->status == 1): ?> <span><?php echo e(__('Active')); ?></span><?php endif; ?>
                                        <?php if($order_details->status == 2): ?> <span><?php echo e(__('Completed')); ?></span><?php endif; ?>
                                        <?php if($order_details->status == 3): ?> <span><?php echo e(__('Delivered')); ?></span><?php endif; ?>
                                        <?php if($order_details->status == 4): ?> <span><?php echo e(__('Cancelled')); ?></span><?php endif; ?>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>   
                </div>
                <?php if($order_details->order_from_job != 'yes'): ?>
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="border-bottom mb-3 mt-4">
                                    <h5><?php echo e(__('Include Details')); ?></h5> <br>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <?php if($order_details->is_order_online !=1): ?>
                                            <th><?php echo e(__('Unit Price')); ?></th>
                                            <th><?php echo e(__('Quantity')); ?></th>
                                            <th><?php echo e(__('Total')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $package_fee =0; ?>
                                        <?php $__currentLoopData = $order_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($include->title); ?></td>
                                            <?php if($order_details->is_order_online !=1): ?>
                                            <td><?php echo e(float_amount_with_currency_symbol($include->price)); ?></td>
                                            <td><?php echo e($include->quantity); ?></td>
                                            <td><?php echo e(float_amount_with_currency_symbol($include->price * $include->quantity)); ?></td>
                                            <?php $package_fee += $include->price * $include->quantity ?>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php if($order_details->is_order_online !=1): ?>
                                                <td colspan="3"><strong><?php echo e(__('Package Fee')); ?></strong></td>
                                                <td><strong><?php echo e(float_amount_with_currency_symbol($package_fee)); ?></strong></td>
                                            <?php else: ?>
                                                <td colspan="3"><strong><?php echo e(__('Package Fee ') .float_amount_with_currency_symbol($order_details->package_fee)); ?></strong></td>
                                            <?php endif; ?>

                                        </tr>
                                    </tbody>
                                </table>

                                <?php if($order_additionals->count() >= 1): ?>
                                <h5><?php echo e(__('Additional Services:')); ?></h5> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th><?php echo e(__('Unit Price')); ?></th>
                                            <th><?php echo e(__('Quantity')); ?></th>
                                            <th><?php echo e(__('Total')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $extra_service =0; ?>
                                        <?php $__currentLoopData = $order_additionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($additional->title); ?></td>
                                            <td><?php echo e(float_amount_with_currency_symbol($additional->price)); ?></td>
                                            <td><?php echo e($additional->quantity); ?></td>
                                            <td><?php echo e(float_amount_with_currency_symbol($additional->price * $additional->quantity)); ?></td>
                                            <?php $extra_service += $additional->price * $additional->quantity ?>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td colspan="3"><strong><?php echo e(__('Extra Service')); ?></strong></td>
                                            <td><strong><?php echo e(float_amount_with_currency_symbol($extra_service)); ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php endif; ?>


                                <?php if(optional($order_details->extraSevices)->count() >= 1): ?>
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h5 class="earning-title"><?php echo e(__('Extra Service Details')); ?></h5>
                                                </div>
                                                <span class="info-text d-block mb-4"><?php echo e(__('This is not included in the main service service request calculation')); ?></span>

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Title')); ?></th>
                                                        <th><?php echo e(__('Unit Price')); ?></th>
                                                        <th><?php echo e(__('Quantity')); ?></th>
                                                        <th><?php echo e(__('Amount')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $order_details->extraSevices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($ex_service->title); ?></td>
                                                            <td><?php echo e(float_amount_with_currency_symbol($ex_service->price)); ?></td>
                                                            <td><?php echo e($ex_service->quantity); ?></td>
                                                            <td><?php echo e(float_amount_with_currency_symbol($ex_service->price * $ex_service->quantity)); ?></td>

                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if(!empty($order_details->coupon_code)): ?>
                                <h5><?php echo e(__('Coupon Details:')); ?></h5> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Coupon Code')); ?></th>
                                            <th><?php echo e(__('Coupon Type')); ?></th>
                                            <th><?php echo e(__('Coupon Amount')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e($order_details->coupon_code); ?></td>
                                            <td><?php echo e($order_details->coupon_type); ?></td>
                                            <td>
                                                <?php if(!empty($order_details->coupon_amount)): ?>
                                                <?php echo e(float_amount_with_currency_symbol($order_details->coupon_amount)); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 mt-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if(!empty($order_declines_history->count() >= 1)): ?>
                                <div class="border-bottom mb-3 mt-4">
                                    <h5><?php echo e(__('Service Request Images')); ?></h5>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            
                                            
                                            
                                            <th><?php echo e(__('Image Files')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $order_declines_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                
                                                <td>
                                                    <?php
                                                        $imageIds = explode('|', $history->image); // Split the string by '|'
                                                    ?>
                                                    <?php $__currentLoopData = $imageIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo render_image_markup_by_attachment_id($imageId, '', 'thumb'); ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>   
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
 <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.js'); ?>
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
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){

                $(document).on('click','.swal_status_change',function(e){
                e.preventDefault();
                    Swal.fire({
                    title: '<?php echo e(__("Are you sure to change status?")); ?>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                    });
                });
                
              });
        })(jQuery);

        var orderDetails = <?php echo json_encode($order_details, 15, 512) ?>;
        console.log("Order Details : ", orderDetails.id);
        var admin_file_link = orderDetails.admin_file_link;
        var admin_file_status = orderDetails.admin_signing_status;
        var order_id = orderDetails.id;
       
        var fileStatusOfAdmin = document.getElementById('fileStatusOfAdmin');
        fileStatusOfAdmin.textContent = admin_file_status;
        setFileStatusColor(admin_file_status);
        var timerDisplay = document.getElementById('timerDisplay');
        timerDisplay.textContent = '';
        // for reviewModal model after click on yes
        document.getElementById('signDocumentBtnOfAdmin').addEventListener('click', function() {
            console.log('admin_file_link : ', admin_file_link);
            if (admin_file_link) {
                const width = 1000;
                const height = 800;
                const left = (screen.width / 2) - (width / 2);
                const top = (screen.height / 2) - (height / 2);
                var signWindow = window.open(admin_file_link, 'signDocumentForAdmin', `width=${width},height=${height},top=${top},left=${left},resizable=yes,scrollbars=yes`);
                // Set the timer duration (in seconds)
                let timerDuration = 180;

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
            xhr.open('GET', `/providers/serviceprovider/ordersdetailsupdateapi/${order_id}`, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log("XHR Success");
                        const response = JSON.parse(xhr.responseText);
                        const updatedAdminFileSigningStatus = response.admin_signing_status;
                        console.log("Updated Status", updatedAdminFileSigningStatus);
                        const adminFileLink = response.admin_file_link;
                        updateDOM(updatedAdminFileSigningStatus, adminFileLink);
                    } else {
                        console.error('Failed to fetch updated data. Status:', xhr.status);
                    }
                }
            };
            xhr.send();
        }

        // update DOM
        function updateDOM(status, link) {
            fileStatusOfAdmin.textContent = status;
            setFileStatusColor(status);
            const signDocumentBtnOfAdmin = document.querySelector('#signDocumentBtnOfAdmin');
            signDocumentBtnOfAdmin.setAttribute('data-order_customer_file_link', link);
            signDocumentBtnOfAdmin.disabled = !link || status === 'Signed';
            timerDisplay.textContent = '';
        }

        // set file status color
        function setFileStatusColor(status) {
            if (status === 'Pending') {
                fileStatusOfAdmin.style.color = 'red';
            } else if (status === 'Signed') {
                fileStatusOfAdmin.style.color = 'green';
            } else {
                fileStatusOfAdmin.style.color = 'black'; 
            }
        }
    </script>
    <script>
        function goBack() {
          window.history.back();
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/backend/pages/orders/order-details.blade.php ENDPATH**/ ?>