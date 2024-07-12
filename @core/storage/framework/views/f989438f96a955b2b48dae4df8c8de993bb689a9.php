
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Orders')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('All Orders')); ?>  </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Customer Name')); ?></th>
                                
                                <th><?php echo e(__('Customer Address')); ?></th>
                                <th><?php echo e(__('Service Provider Deatils')); ?></th>
                                <th><?php echo e(__('Total Amount')); ?></th>
                                <th><?php echo e(__('Payment Status')); ?></th>
                                <th><?php echo e(__('Service Request Status')); ?></th>
                                <th><?php echo e(__('Service Request Type')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Status Modal -->
    <div class="modal fade" id="OrderStatusChangeModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="<?php echo e(route('admin.change.order.status')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" class="order_id">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal"><?php echo e(__('Change Service Request Status ')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="status_id"><?php echo e(__('Select Status')); ?></label>
                            <select name="status_id" id="status_id" class="form-control">
                                <option value=""><?php echo e(__('Select Status')); ?></option>
                                <option value="1"><?php echo e(__('Active')); ?></option>
                                <option value="2"><?php echo e(__('Completed')); ?></option>
                                <option value="3"><?php echo e(__('Delivered')); ?></option>
                                <option value="4"><?php echo e(__('Cancel')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo $__env->make('backend.partials.datatable.script-enqueue',['only_js' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){


                //order status change
                $(document).on('click', '.report_add_modal', function () {
                    let el = $(this);
                    let status_id = el.data('status_id');
                    let form = $('#OrderStatusChangeModal');
                    form.find('.order_id').val(status_id);
                });


                $('.table-wrap > table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "<?php echo e(route('admin.orders')); ?>",
                    columns: [
                        {data: 'id', name: 'id'},
                        {
                            data: 'customer_provider_details',
                            name: 'service_provider_details',
                            orderable: true,
                            searchable: true,
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    return `
                                        <table">
                                            <tr>
                                                <td><p>Name : ${data.name}</p>
                                                <p>Email : ${data.email}</p>
                                                <p>Phone : ${data.phone}</p></td>
                                            </tr>
                                        </table>
                                    `;
                                } else {
                                    return data;
                                }
                            }
                        },
                        // {data: 'name', name: '', orderable: true, searchable: true},
                        // {data: 'email', name: '', orderable: true, searchable: true},
                        // {data: 'phone', name: '', orderable: true, searchable: true},
                        {data: 'address', name: '', orderable: true, searchable: true},
                        {
                            data: 'service_provider_details',
                            name: 'service_provider_details',
                            orderable: true,
                            searchable: true,
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    return `
                                        <table">
                                            <tr>
                                                <td><p>Name : ${data.name}</p>
                                                <p>Email : ${data.email}</p>
                                                <p>Phone : ${data.phone}</p></td>
                                            </tr>
                                        </table>
                                    `;
                                } else {
                                    return data;
                                }
                            }
                        },
                        {data: 'amount', name: '', orderable: true, searchable: true},
                        // {data: 'payment_status', name: '',orderable: true, searchable: true},
                        {
                            data: 'payment_status',
                            name: '',
                            orderable: true,
                            searchable: true,
                            render: function(data, type, row) {
                                return data === 'complete' ? 'Payment_AMC' : data;
                            }
                        },
                        {data: 'status', name: ''},
                        {data: 'is_order_online', name: '',orderable: true, searchable: true},
                        {data: 'action', name: '', orderable: false, searchable: true},
                    ]
                });


                $(document).on('click','.order_payment_status_change',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure to change Payment status?")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_cancel_order_submit_btn').trigger('click');
                        }
                    });
                });


            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/backend/pages/orders/index.blade.php ENDPATH**/ ?>