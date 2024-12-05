
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Service Provider Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <?php if(!empty($seller_details) && !empty($seller_verification_data)): ?>
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="checkbox-inlines">
                                <label><strong><?php echo e(__('Service Provider ID:')); ?> </strong>#<?php echo e($seller_details->id); ?></label>
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
                                    <label><strong><?php echo e(__('Name:')); ?> </strong><?php echo e($seller_details->name); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Email:')); ?> </strong><?php echo e($seller_details->email); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Phone:')); ?> </strong><?php echo e($seller_details->phone); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Address:')); ?> </strong><?php echo e($seller_details->address); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('City:')); ?> </strong><?php echo e(optional($seller_details->city)->service_city); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Area:')); ?> </strong><?php echo e(optional($seller_details->area)->service_area); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Post Code:')); ?> </strong><?php echo e($seller_details->post_code); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Country:')); ?> </strong><?php echo e(optional($seller_details->country)->country); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('User Verify:')); ?> </strong>
                                        <?php if(optional($seller_details->sellerVerify)->status==1): ?>
                                            <span class="text-warning"><?php echo e(__('Verified')); ?></span>
                                        <?php else: ?>
                                            <span class="text-info"><?php echo e(__('Not Verified')); ?></span>
                                        <?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-change','data' => ['url' => route('admin.frontend.seller.profile.verify',$seller_details->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.frontend.seller.profile.verify',$seller_details->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>   
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom mt-5 mb-3">
                                <h5><?php echo e(__('Service Provider Aadhaar Deatils')); ?></h5>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><strong><?php echo e(__('Index')); ?> </strong></th>
                                        <th><strong><?php echo e(__('Deatils As Per Aadhaar')); ?> </strong></th>
                                        <th><strong><?php echo e(__('Deatils As per Seller')); ?> </strong></th>
                                        <th><strong><?php echo e(__('Status')); ?> </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Number</strong></td>
                                        <td><?php echo e($seller_verification_data['aadhaar_number'] == "" ? "NA" : $seller_verification_data['aadhaar_number']); ?></td>
                                        <td><?php echo e($seller_verification_data['aadhaar_number'] == "" ? "NA" : $seller_verification_data['aadhaar_number']); ?></td>
                                        <td>
                                            <?php if($seller_verification_data['is_aadhaar_verified']!=""): ?>
                                                <?php if($seller_verification_data['is_aadhaar_verified']==1): ?>
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;"><?php echo e(__('Verified')); ?></strong></span>
                                                    
                                                <?php else: ?>
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;"><?php echo e(__('Not Verified')); ?></strong></span>
                                                    
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-info"><strong><?php echo e(__('NA')); ?></strong></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td><?php echo e($seller_verification_data['name_as_per_aadhaar'] == "" ? "NA" : $seller_verification_data['name_as_per_aadhaar']); ?></td>
                                        <td><?php echo e($seller_verification_data['provided_name'] == "" ? "NA" : $seller_verification_data['provided_name']); ?></td>
                                        <td>
                                            <?php if($seller_verification_data['aadhaar_name_match_status']!=""): ?>
                                                <?php if($seller_verification_data['aadhaar_name_match_status']==1): ?>
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;"><?php echo e(__('Matched')); ?></strong></span>
                                                    
                                                <?php else: ?>
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;"><?php echo e(__('Not Matched')); ?></strong></span>
                                                    
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-info"><strong><?php echo e(__('NA')); ?></strong></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address</strong></td>
                                        <td><?php echo e($seller_verification_data['address_as_per_aadhaar'] == "" ? "NA" : $seller_verification_data['address_as_per_aadhaar']); ?></td>
                                        <td><?php echo e($seller_verification_data['provided_address'] == "" ? "NA" : $seller_verification_data['provided_address']); ?></td>
                                        <td>
                                            <?php if($seller_verification_data['aadhaar_address_match_status']!=""): ?>
                                                <?php if($seller_verification_data['aadhaar_address_match_status']==1): ?>
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;"><?php echo e(__('Matched')); ?></strong></span>
                                                    
                                                <?php else: ?>
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;"><?php echo e(__('Not Matched')); ?></strong></span>
                                                    
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-info"><strong><?php echo e(__('NA')); ?></strong></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="border-bottom mt-5 mb-3">
                                <h5><?php echo e(__('Service Provider PAN Deatils')); ?></h5>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><strong><?php echo e(__('Item')); ?> </strong></th>
                                        <th><strong><?php echo e(__('Deatils As Per PAN')); ?> </strong></th>
                                        <th><strong><?php echo e(__('Deatils As per Seller')); ?> </strong></th>
                                        <th><strong><?php echo e(__('Status')); ?> </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Number</strong></td>
                                        <td><?php echo e($seller_verification_data['pan_number'] == "" ? "NA" : $seller_verification_data['pan_number']); ?></td>
                                        <td><?php echo e($seller_verification_data['pan_number'] == "" ? "NA" : $seller_verification_data['pan_number']); ?></td>
                                        <td>
                                            <?php if($seller_verification_data['is_pan_verified']!=""): ?>
                                                <?php if($seller_verification_data['is_pan_verified']==1): ?>
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;"><?php echo e(__('Verified')); ?></strong></span>
                                                    
                                                <?php else: ?>
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;"><?php echo e(__('Not Verified')); ?></strong></span>
                                                    
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-info"><strong><?php echo e(__('NA')); ?></strong></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td><?php echo e($seller_verification_data['name_as_per_pan'] == "" ? "NA" : $seller_verification_data['name_as_per_pan']); ?></td>
                                        <td><?php echo e($seller_verification_data['provided_name'] == "" ? "NA" : $seller_verification_data['provided_name']); ?></td>
                                        <td>
                                            <?php if($seller_verification_data['pan_name_match_status']!=""): ?>
                                                <?php if($seller_verification_data['pan_name_match_status']==1): ?>
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;"><?php echo e(__('Matched')); ?></strong></span>
                                                    
                                                <?php else: ?>
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;"><?php echo e(__('Not Matched')); ?></strong></span>
                                                    
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-info"><strong><?php echo e(__('NA')); ?></strong></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>   
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom mb-3">
                                <h5><?php echo e(__('Service Provider National ID')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <?php echo render_image_markup_by_attachment_id(optional($seller_details->sellerVerify)->national_id,'','large'); ?>

                                </div>
                            </div>   
                            <br>
                            <div class="border-bottom mt-5 mb-3">
                                <h5><?php echo e(__('Service Provider Address')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <?php echo render_image_markup_by_attachment_id(optional($seller_details->sellerVerify)->address,'','large'); ?>

                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="border-bottom mb-3">
                                <h5><?php echo e(__('Service Provider Account Details')); ?></h5>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><strong><?php echo e(__('Item')); ?> </strong></th>
                                        <th><strong><?php echo e(__('Deatils As Per Bank Account')); ?> </strong></th>
                                        <th><strong><?php echo e(__('Status')); ?> </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Account Number</strong></td>
                                        <td><?php echo e($seller_verification_data['account_number'] == "" ? "NA" : $seller_verification_data['account_number']); ?></td>
                                        <td>
                                            <?php if($seller_verification_data['is_account_verified']!=""): ?>
                                                <?php if($seller_verification_data['is_account_verified']==1): ?>
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;"><?php echo e(__('Verified')); ?></strong></span>
                                                    
                                                <?php else: ?>
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;"><?php echo e(__('Not Verified')); ?></strong></span>
                                                    
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-info"><strong><?php echo e(__('NA')); ?></strong></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>IFSC Number</strong></td>
                                        <td><?php echo e($seller_verification_data['ifsc_number'] == "" ? "NA" : $seller_verification_data['ifsc_number']); ?></td>
                                        <td>
                                            <?php if($seller_verification_data['is_account_verified']!=""): ?>
                                                <?php if($seller_verification_data['is_account_verified']==1): ?>
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;" ><?php echo e(__('Matched')); ?></strong></span>
                                                    
                                                <?php else: ?>
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;"><?php echo e(__('Not Matched')); ?></strong></span>
                                                    
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-info"><strong><?php echo e(__('NA')); ?></strong></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Mobile Number</strong></td>
                                        <td><?php echo e($seller_verification_data['mobile_number'] == "" ? "NA" : $seller_verification_data['mobile_number']); ?></td>
                                        <td>
                                            <?php if($seller_verification_data['is_account_verified']!=""): ?>
                                                <?php if($seller_verification_data['is_account_verified']==1): ?>
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;"><?php echo e(__('Matched')); ?></strong></span>
                                                    
                                                <?php else: ?>
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;"><?php echo e(__('Not Matched')); ?></strong></span>
                                                    
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-info"><strong><?php echo e(__('NA')); ?></strong></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td><?php echo e($seller_verification_data['name_as_per_bank_account_number'] == "" ? "NA" : $seller_verification_data['name_as_per_bank_account_number']); ?></td>
                                        <td>
                                            <?php if($seller_verification_data['is_account_verified']!=""): ?>
                                                <?php if($seller_verification_data['is_account_verified']==1): ?>
                                                    <span class="text-info"><strong style="background: green; padding: 6px; color: white;"><?php echo e(__('Matched')); ?></strong></span>
                                                <?php else: ?>
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;"><?php echo e(__('Not Matched')); ?></strong></span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-info"><strong><?php echo e(__('NA')); ?></strong></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    (function($){
    "use strict";
    $(document).ready(function() {
        
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
    
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/backend/frontend-user/seller-details.blade.php ENDPATH**/ ?>