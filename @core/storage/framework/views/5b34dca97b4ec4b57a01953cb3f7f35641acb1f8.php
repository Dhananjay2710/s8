

<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Country Tax')); ?>

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
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('All Country Tax')); ?>  </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Country')); ?></th>
                                <th><?php echo e(__('GST(%)')); ?></th>
                                <th><?php echo e(__('GST Limit')); ?></th>
                                <th><?php echo e(__('TDS(%)')); ?></th>
                                <th><?php echo e(__('TDS Limit')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($data->id); ?></td>
                                        <td><?php echo e(optional($data->country)->country); ?></td>
                                        <td><?php echo e($data->tax); ?></td>
                                        <td><?php echo e($data->gstlimit); ?></td>
                                        <td><?php echo e($data->tds); ?></td>
                                        <td><?php echo e($data->tdslimit); ?></td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slider-delete')): ?>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-popover','data' => ['url' => route('admin.country.tax.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.country.tax.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-coupon-edit')): ?>
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#tax_edit_modal"
                                                   class="btn btn-primary btn-xs mb-3 mr-1 tax_edit_btn"
                                                   data-id="<?php echo e($data->id); ?>"
                                                   data-tax="<?php echo e($data->tax); ?>"
                                                   data-tds="<?php echo e($data->tds); ?>"
                                                   data-gstlimit="<?php echo e($data->gstlimit); ?>"
                                                   data-tdslimit="<?php echo e($data->tdslimit); ?>"
                                                   data-country_id="<?php echo e($data->country_id); ?>">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Add country Tax')); ?>   </h4>
                            </div>
                        </div>
                        <form action="<?php echo e(route('admin.country.tax')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="tab-content margin-top-40">
                                <div class="form-group">
                                    <label for="country_id"><?php echo e(__('Country')); ?></label>
                                    <select name="country_id" class="form-control">
                                        <option value=""><?php echo e(__('Select Country')); ?></option>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tax"><?php echo e(__('GST')); ?>(%)</label>
                                    <input type="number" class="form-control" step="0.05" name="tax" placeholder="<?php echo e(__('Enter gst percentage')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tda"><?php echo e(__('GST Limit')); ?></label>
                                    <input type="number" class="form-control" step="0.05" name="gstlimit" placeholder="<?php echo e(__('Enter gst limit')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tda"><?php echo e(__('TDS')); ?>(%)</label>
                                    <input type="number" class="form-control" step="0.05" name="tds" placeholder="<?php echo e(__('Enter tds percentage')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tda"><?php echo e(__('TDS Limit')); ?></label>
                                    <input type="number" class="form-control" step="0.05" name="tdslimit" placeholder="<?php echo e(__('Enter tds limit')); ?>">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 submit_btn"><?php echo e(__('Submit')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="tax_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Edit Tax')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('admin.country.tax.edit')); ?>" method="post">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="up_id" id="up_id">
                        <div class="form-group">
                            <label for="up_code"><?php echo e(__('GST')); ?>(%)</label>
                            <input type="text" class="form-control" name="tax" id="tax" step="0.05" placeholder="<?php echo e(__('Enter GST')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="up_code"><?php echo e(__('GST Limit')); ?></label>
                            <input type="text" class="form-control" name="gstlimit" id="gstlimit" step="0.05" placeholder="<?php echo e(__('Enter GST Limit')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="up_code"><?php echo e(__('TDS')); ?>(%)</label>
                            <input type="text" class="form-control" name="tds" id="tds" step="0.05" placeholder="<?php echo e(__('Enter TDS')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="up_code"><?php echo e(__('TDS Limit')); ?></label>
                            <input type="text" class="form-control" name="tdslimit" id="tdslimit" step="0.05" placeholder="<?php echo e(__('Enter TDS Limit')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="country_id"><?php echo e(__('Country')); ?></label>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value=""><?php echo e(__('Select Country')); ?></option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button id="update" type="submit" class="btn btn-primary"><?php echo e(__('Save Changes')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.markup','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.markup'); ?>
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

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.js'); ?>
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
    <script src="<?php echo e(asset('assets/common/js/flatpickr.js')); ?>"></script>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $(document).on('click','.tax_edit_btn',function(){
                    let id = $(this).data('id');
                    let tax = $(this).data('tax');
                    let tds = $(this).data('tds');
                    let gstlimit = $(this).data('gstlimit');
                    let tdslimit = $(this).data('tdslimit');
                    let country_id = $(this).data('country_id');
                    let form = $('#tax_edit_modal');
                    form.find('#up_id').val(id);
                    form.find('#tax').val(tax);
                    form.find('#tds').val(tds);
                    form.find('#gstlimit').val(gstlimit);
                    form.find('#tdslimit').val(tdslimit);
                    form.find('#country_id').val(country_id);
                });
            });
        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/backend/pages/tax/tax.blade.php ENDPATH**/ ?>