<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Tickets')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/flatpickr.min.css')); ?>">
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

                <!-- search section start-->
                <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                    <div class="dashboard__wallet">
                        <form action="<?php echo e(route('seller.support.ticket')); ?>" method="GET">
                            <div class="dashboard__headerGlobal__flex">
                                <div class="dashboard__headerGlobal__content">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="dashboard_table__title"><?php echo e(__('Search Ticket Module')); ?></h4> <i class="las la-angle-down search_by_all"></i>
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
                                 <?php if(request()->get('order_id')): ?>  show <?php elseif(request()->get('ticket_id')): ?> show <?php elseif(request()->get('ticket_date')): ?> show <?php endif; ?>
                                " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="single-settings">
                                                    <div class="single-dashboard-input">
                                                        <div class="row g-4 mt-3">
                                                            <div class="col-lg-2 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="ticket_id" class="info-title"> <?php echo e(__('Ticket ID')); ?> </label>
                                                                    <input class="form--control" name="ticket_id" value="<?php echo e(request()->get('ticket_id')); ?>" type="text" placeholder="<?php echo e(__('Ticket ID')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="order_id" class="info-title"> <?php echo e(__('Order ID')); ?> </label>
                                                                    <input class="form--control" name="order_id" value="<?php echo e(request()->get('order_id')); ?>" type="text" placeholder="<?php echo e(__('Order ID')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="title" class="info-title"> <?php echo e(__('Title')); ?> </label>
                                                                    <input class="form--control" name="title" value="<?php echo e(request()->get('title')); ?>" type="text" placeholder="<?php echo e(__('Title')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="dead_line" class="info-title"> <?php echo e(__('Created Date Range')); ?> </label>
                                                                    <input class="form--control flatpickr_input"  name="ticket_date" type="text" value="<?php echo e(request()->get('ticket_date')); ?>" placeholder="<?php echo e(__('Created Date Range')); ?>">
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

                <!-- Tickets table section start-->
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <div class="dashboard_table__title__flex">
                        <h4 class="dashboard_table__title"><?php echo e(__('All Tickets')); ?></h4>
                        <div class="btn-wrapper" data-bs-toggle="modal" data-bs-target="#openTicket">
                            <a href="javascript:void(0)"
                               class="dashboard_table__title__btn btn-bg-1 radius-5"
                               data-bs-toggle="modal"
                               data-bs-target="#ticketModal"><i class="fa-solid fa-plus"></i> <?php echo e(__('Create Ticket For A Order' )); ?></a>
                        </div>
                    </div>

                    <?php if($tickets->count() >= 1): ?>
                    <div class="dashboard_table__main custom--table mt-4">
                        <table>
                            <thead>
                            <tr>
                                <th><?php echo e(__('Ticket Name/ID')); ?></th>
                                <th><?php echo e(__('Order ID')); ?></th>
                                <th><?php echo e(__('Priority')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="dashboard_table__main__ticket">
                                        <a href="<?php echo e(route('seller.support.ticket.view', $data->id)); ?>">
                                        <h5 class="dashboard_table__main__ticket__title"><?php echo e($data->title); ?></h5>
                                        <span class="dashboard_table__main__ticket__id mt-2"> <?php echo e(__('Ticket ID:')); ?> <?php echo e($data->id); ?></span>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="dashboard_table__main__orderId"><?php echo e($data->order_id); ?></div>
                                </td>
                                <td>
                                    <div class="dashboard_table__main__priority">
                                        <?php if($data->priority=='low'): ?> <a href="javascript:void(0)" class="priorityBtn pending"><?php echo e(__(ucfirst($data->priority))); ?></a><?php endif; ?>
                                        <?php if($data->priority=='high'): ?> <a href="javascript:void(0)" class="priorityBtn high"><?php echo e(__(ucfirst($data->priority))); ?></a><?php endif; ?>
                                        <?php if($data->priority=='medium'): ?> <a href="javascript:void(0)" class="priorityBtn medium"><?php echo e(__(ucfirst($data->priority))); ?></a><?php endif; ?>
                                        <?php if($data->priority=='urgent'): ?> <a href="javascript:void(0)" class="priorityBtn high"><?php echo e(__(ucfirst($data->priority))); ?></a><?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="dashboard_table__main__status dropdown__status">
                                        <?php if($data->status === 'open'): ?>
                                            <a href="<?php echo e(route('seller.support.ticket.view', $data->id)); ?>" class="dashboard_table__main__status__select dropdown__status__main Open"> <?php echo e(__('open')); ?></a>
                                             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.buyer-ticket-status-two','data' => ['url' => route('seller.support.ticket.status.change',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('buyer-ticket-status-two'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.support.ticket.status.change',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        <?php else: ?>
                                            <a href="javascript:void(0)" class="dashboard_table__main__status__select dropdown__status__main Close">
                                                <?php echo e(__(ucfirst($data->status))); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="dashboard_table__main__actions">
                                        <a href="<?php echo e(route('seller.support.ticket.view', $data->id)); ?>" class="icon"><i class="fa-regular fa-eye"></i></a>
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ticket-delete-popup','data' => ['url' => route('seller.support.ticket.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ticket-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.support.ticket.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        <a href="javascript:void(0)"
                                           class="icon edit edit_priority_modal"
                                           data-bs-toggle="modal"
                                           data-bs-target="#editPriorityModal"
                                           data-id="<?php echo e($data->id); ?>"
                                           data-priority="<?php echo e($data->priority); ?>"
                                        > <i class="fa-regular fa-pen-to-square"></i>
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
                                <?php echo $tickets->links(); ?>

                            </div>
                        </div>

                    <?php else: ?>
                        <div class="chat_wrapper__details__inner__chat__contents">
                            <h2 class="chat_wrapper__details__inner__chat__contents__para"><?php echo e(__('No Tickets Found')); ?></h2>
                        </div>
                    <?php endif; ?>
                <!-- Tickets table section end -->
            </div>
        </div>
      </div>
    </div>

        <!-- priority Ticket Modal -->
        <div class="modal fade" id="editPriorityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Change Priority')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-form">
                            <form action="<?php echo e(route('seller.support.ticket.priority.change')); ?>" method="post">
                                <input type="hidden" id="ticket_id" name="ticket_id">
                                <?php echo csrf_field(); ?>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="up_day_id"><?php echo e(__('Select Status')); ?></label>
                                            <select name="priority" id="priority" class="form-control nice-select">
                                                <option value="low"><?php echo e(__('Low')); ?></option>
                                                <option value="medium"><?php echo e(__('Medium')); ?></option>
                                                <option value="high"><?php echo e(__('High')); ?></option>
                                                <option value="urgent"><?php echo e(__('Urgent')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"><?php echo e(__('Save changes')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Open Ticket Modal -->
    <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Open a Ticket')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('seller.support.ticket.new')); ?>" method="post">
                            <?php echo csrf_field(); ?>

                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="ticketTitle" class="label_title"><?php echo e(__('Ticket title')); ?></label>
                                        <input type="text" name="title" value="<?php echo e(@old('title')); ?>" id="ticketTitle" class="form--control radius-10" placeholder="<?php echo e(__('e.g. I got into a problem')); ?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="ticketTitle" class="label_title"><?php echo e(__('Subject')); ?></label>
                                        <input type="text" name="subject" value="<?php echo e(@old('subject')); ?>" id="ticketTitle" class="form--control radius-10"
                                               placeholder="<?php echo e(__('Subject')); ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="ticketTitle" class="label_title"><?php echo e(__('Select Order')); ?></label>
                                        <div class="single-input-select radius-10">
                                            <select class="select2_activation" name="order_id">
                                                <option value=""><?php echo e(__('Select Order')); ?></option>
                                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($order->id); ?>"><?php echo e(__('Order ID#')); ?> <?php echo e($order->id); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="ticketTitle" class="label_title"><?php echo e(__('Priority type')); ?></label>
                                        <div class="single-input-select radius-10">
                                            <select class="select2_activation" name="priority" id="priority">
                                                <option value="low"><?php echo e(__('Low')); ?></option>
                                                <option value="medium"><?php echo e(__('Medium')); ?></option>
                                                <option value="high"><?php echo e(__('High')); ?></option>
                                                <option value="urgent"><?php echo e(__('Urgent')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="ticketTitle" class="label_title"><?php echo e(__('Description')); ?></label>
                                        <textarea name="description" placeholder="<?php echo e(__('Type Description')); ?>" cols="10" rows="2" class="form--control radius-10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"><?php echo e(__('Save changes')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/common/js/flatpickr.js')); ?>"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                // date range
                $('.flatpickr_input').flatpickr({
                    altFormat: "invisible",
                    altInput: false,
                    mode: "range",
                });

                // for toggle dropdown menu
                $('.dropdown__status__list > .dropdown__status__list__option').click(function () {
                    window.location = $(this).attr('href');
                });

                // for modal search
                $('.select2_activation').select2({
                    dropdownParent: $('#ticketModal')
                });

                //priority change
                $(document).on('click', '.edit_priority_modal', function(e) {
                    e.preventDefault();
                    let ticket_id = $(this).data('id');
                    let priority = $(this).data('priority');

                    $('#ticket_id').val(ticket_id);
                    $('#priority').val(priority);
                    $('.nice-select').niceSelect('update');
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

                $(document).on('click','.swal_status_button',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure to close status?")); ?>',
                        text: '<?php echo e(__("You will not able to open it!")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "<?php echo e(__('Yes, change it!')); ?>"
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
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/support-ticket/partials/tickets-two.blade.php ENDPATH**/ ?>