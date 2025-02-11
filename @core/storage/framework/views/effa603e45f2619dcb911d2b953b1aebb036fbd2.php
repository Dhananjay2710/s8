<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Days')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/flatpickr.min.css')); ?>">
    <style>
        .close{ border: none;  }
        .dashboard-switch-single{ font-size: 20px; }
        .swal_delete_button{ color: #da0000 !important; }
        .days_new_style .select2-container {
            z-index: 0;
        }
    </style>
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
    <?php echo $__env->make('frontend.user.seller.partials.sidebar-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__right">
        <?php echo $__env->make('frontend.user.buyer.header.buyer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="dashboard__body">
            <div class="dashboard__inner">
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <h2 class="dashboard_table__title"> <?php echo e(__('Service Days')); ?> </h2>
                    <div class="dashboard_table__title__flex">
                        <form class="total_service_day" action="<?php echo e(route('seller.update.totalday')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="days_new_style">
                                <div class="form_service_day">
                                    <label class="total_day_label label_title mt-2"> <?php echo e(__('Select Service Day')); ?> </label>
                                    <select name="total_day">
                                        <?php if(empty($total_day)): ?>
                                            <?php for($i=1; $i<=30; $i++): ?>{
                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(__('Day')); ?></option>
                                            }
                                            <?php endfor; ?>
                                        <?php else: ?>
                                            <?php for($i=1; $i<=30; $i++): ?>{
                                            <option value="<?php echo e($i); ?>" <?php if($total_day->total_day==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> <?php echo e(__('Day')); ?></option>
                                            }
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="btn-wrapper mx-4 mt-5">
                                    <button type="submit" class="dashboard_table__title__btn btn-bg-1 radius-5" style="border: none"><?php echo e(__('Update' )); ?></button>
                                </div>
                            </div>
                        </form>

                        <div class="btn-wrapper">
                            <a href="javascript:void(0)"
                               class="dashboard_table__title__btn btn-bg-1 radius-5"
                               data-bs-toggle="modal"
                               data-bs-target="#addDayModal"><i class="fa-solid fa-plus"></i> <?php echo e(__('Add Day' )); ?></a>
                        </div>
                    </div>

                    <div class="notice-board">
                        <p class="text-danger"><?php echo e(__('selected days will show while booking an order')); ?></p>
                    </div>

                    <div class="mt-5"> <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
<?php endif; ?> </div>
                    <?php if($days->count() >= 1): ?>
                        <div class="dashboard_table__main custom--table mt-4">
                            <table>
                                <thead>
                                <tr>
                                    <th><?php echo e(__('No')); ?></th>
                                    <th><?php echo e(__('Day')); ?></th>
                                    <th><?php echo e(__('Schedule Time')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e(__($data->day)); ?></td>
                                        <td>
                                            <?php if(isset($data['schedules']) && $data->schedules->count()): ?>
                                                <?php $__currentLoopData = $data['schedules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="btn btn-sm btn-success day_wise_service_schedule"><?php echo e($schedule->schedule); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="dashboard-switch-single">
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.day.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.day.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="chat_wrapper__details__inner__chat__contents">
                            <h2 class="chat_wrapper__details__inner__chat__contents__para"><?php echo e(__('No Days Found')); ?></h2>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addDayModal" tabindex="-1" role="dialog" aria-labelledby="dayModal" aria-hidden="true">
        <form action="<?php echo e(route('seller.add.day')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dayModal"><?php echo e(__('Add New Day')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="day" class="label_title"><?php echo e(__('Day')); ?></label>
                            <select name="day" id="day" class="form-control select2_activation">
                                <option value=""><?php echo e(__('Select Day')); ?></option>
                                <option value="Sat"><?php echo e(__('Saturday')); ?></option>
                                <option value="Sun"><?php echo e(__('Sunday')); ?></option>
                                <option value="Mon"><?php echo e(__('Monday')); ?></option>
                                <option value="Tue"><?php echo e(__('Tuesday')); ?></option>
                                <option value="Wed"><?php echo e(__('Wednesday')); ?></option>
                                <option value="Thu"><?php echo e(__('Thursday')); ?></option>
                                <option value="Fri"><?php echo e(__('Friday')); ?></option>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/common/js/flatpickr.js')); ?>"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                // for modal search
                $('.select2_activation').select2({
                    dropdownParent: $('#addDayModal')
                });

                $(document).on('click','.edit_date_modal',function(e){
                    e.preventDefault();
                    let date_id = $(this).data('id');
                    let date = $(this).data('date');
                    $('#up_id').val(date_id)
                    $('#up_date').val(date)
                });


                $(document).on('click','.swal_delete_button',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure?")); ?>',
                        text: '<?php echo e(__("You would not be able to revert this item!")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "<?php echo e(__('Yes, delete it!')); ?>"
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
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/day-and-schedule/partials/days-two.blade.php ENDPATH**/ ?>