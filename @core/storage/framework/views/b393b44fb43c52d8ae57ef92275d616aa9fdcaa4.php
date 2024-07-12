<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Reports')); ?>

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
    <?php echo $__env->make('frontend.user.buyer.partials.sidebar-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__right">
        <?php echo $__env->make('frontend.user.buyer.header.buyer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="dashboard__body">

            <!-- search section start-->
            <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                <div class="dashboard__wallet">
                    <form action="<?php echo e(route('buyer.order.report.list')); ?>" method="GET">
                    <div class="dashboard__headerGlobal__flex">
                        <div class="dashboard__headerGlobal__content">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h4 class="dashboard_table__title"><?php echo e(__('Search Report Module')); ?></h4> <i class="las la-angle-down search_by_all"></i>
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
                             <?php if(request()->get('order_id')): ?>  show <?php elseif(request()->get('report_id')): ?> show <?php elseif(request()->get('report_date')): ?> show <?php endif; ?>
                             " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="single-settings">
                                                <div class="single-dashboard-input">
                                                    <div class="row g-4 mt-3">
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div class="single-info-input">
                                                                <label for="title" class="info-title"> <?php echo e(__('Service Request ID')); ?> </label>
                                                                <input class="form--control" name="order_id" value="<?php echo e(request()->get('order_id')); ?>" type="text" placeholder="<?php echo e(__('Service Request ID')); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div class="single-info-input">
                                                                <label for="title" class="info-title"> <?php echo e(__('Report ID')); ?> </label>
                                                                <input class="form--control" name="report_id" value="<?php echo e(request()->get('report_id')); ?>" type="text" placeholder="<?php echo e(__('Report ID')); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div class="single-info-input">
                                                                <label for="dead_line" class="info-title"> <?php echo e(__('Created Date Range')); ?> </label>
                                                                <input class="form--control flatpickr_input" value="<?php echo e(request()->get('report_date')); ?>" name="report_date" type="date">
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

            <div class="dashboard__inner mt-3">
                <!-- Report section start-->
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <div class="dashboard_table__title__flex">
                        <h4 class="dashboard_table__title"><?php echo e(__('All Reports')); ?></h4>
                    </div>

                    <?php if($reports->count() >= 1): ?>
                        <div class="dashboard_table__main custom--table mt-4">
                            <table>
                                <thead>
                                <tr>
                                    <th> <?php echo e(__('Service Request ID')); ?> </th>
                                    <th> <?php echo e(__('Report ID')); ?> </th>
                                    <th> <?php echo e(__('Report Details')); ?> </th>
                                    <th> <?php echo e(__('Service Provider Details')); ?> </th>
                                    <th> <?php echo e(__('Conversation')); ?> </th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="dashboard_table__main__orderId"><?php echo e($report->order_id); ?></div>
                                        </td>
                                        <td>
                                            <div class="dashboard_table__main__orderId"><?php echo e($report->id); ?></div>
                                        </td>
                                        <td>
                                            <div class="dashboard_table__main__priority">
                                                <p><strong><?php echo e(__('Report From:')); ?></strong> <?php echo e(ucfirst($report->report_from)); ?></p>
                                                <p><strong><?php echo e(__('Report To:')); ?></strong> <?php echo e(ucfirst($report->report_to)); ?></p>
                                                <p><strong><?php echo e(__('Report Date:')); ?></strong> <?php echo e(date('d-m-Y', strtotime($report->created_at))); ?></p>
                                                <p><strong><?php echo e(__('Description:')); ?></strong>
                                                    <span class="btn btn-info report_description"
                                                          data-bs-toggle="modal"
                                                          data-bs-target="#reportModal"
                                                          data-report="<?php echo e($report->report); ?>">
                                                        <i class="fa-regular fa-eye"></i></span></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dashboard_table__main__status dropdown__status">
                                                <p><strong><?php echo e(__('Name:')); ?></strong> <?php echo e(optional($report->seller)->name); ?></p>
                                                <p><strong><?php echo e(__('Email:')); ?></strong> <?php echo e(optional($report->seller)->email); ?></p>
                                                <p><strong><?php echo e(__('Phone:')); ?></strong> <?php echo e(optional($report->seller)->phone); ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dashboard_table__main__actions">
                                                <a href="<?php echo e(route('buyer.order.report.chat.admin',$report->id)); ?>" class="btn btn-info">
                                                    <?php echo e(__('Chat To Admin')); ?> <i class="fa-regular fa-commenting mx-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="blog-pagination margin-top-55">
                            <div class="custom-pagination mt-4 mt-lg-5">
                                <?php echo $reports->links(); ?>

                            </div>
                        </div>
                    <?php else: ?>
                        <div class="chat_wrapper__details__inner__chat__contents mt-3">
                            <p class="no_data_found_for_buyer_seller_panel">
                                <?php echo e(__('No Reports found')); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                    <!-- reports section end -->
                </div>
            </div>
        </div>
    </div>

        <!-- Report Details Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Report Details')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-form">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="single-input">
                                            <p id="report_description"></p>
                                        </div>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                $('.flatpickr_input').flatpickr({
                    altFormat: "invisible",
                    altInput: false,
                    mode: "range",
                });

                $(document).on('click','.report_description',function(e){
                    let report_description = $(this).data('report');
                    $('#report_description').text(report_description);
                });

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/buyer/report/partials/report-list-two.blade.php ENDPATH**/ ?>