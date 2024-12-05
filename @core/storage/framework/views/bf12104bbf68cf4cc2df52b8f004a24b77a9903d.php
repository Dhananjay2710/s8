<form enctype="multipart/form-data">
    <div class="mt-3">
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-message','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    </div>
    <input type="hidden" name="current_tab" wire:model="current_tab">
    <input type="hidden" name="is_service_all_cities"  id="is_service_all_cities_id">
    <div class="add-service-wrapper mt-4">
        <!--Nav Bar Tabs markup start -->
        <div wire:ignore class="nav nav-pills" id="add-service-tab"
             role="tablist" aria-orientation="vertical">
            <a class="nav-link <?php if($current_tab === "service-info-tab"): ?> active <?php endif; ?>  stepIndicator" id="service-info-tab"
               data-bs-toggle="pill" href="#service-info" role="tab"
               aria-controls="service-info"
               aria-selected="true"><span class="nav-link-number"><?php echo e(__('1')); ?></span><?php echo e(__('Service Info')); ?></a>
            <a class="nav-link <?php if($current_tab === "service-category-tab"): ?> active <?php endif; ?>  stepIndicator" id="service-category-tab"
               data-bs-toggle="pill" href="#service-category" role="tab"
               aria-controls="service-category"
               aria-selected="true"><span class="nav-link-number"><?php echo e(__('2')); ?></span><?php echo e(__('Service Category')); ?></a>
            <a class="nav-link <?php if($current_tab === "service-attribute-tab"): ?>  active <?php endif; ?> stepIndicator" id="service-attribute-tab" data-bs-toggle="pill"
               href="#service-attribute" role="tab"
               aria-controls="service-attribute"
               aria-selected="false"><span class="nav-link-number"><?php echo e(__('3')); ?></span><?php echo e(__('Service Attributes')); ?></a>
            <a class="nav-link  <?php if($current_tab === "services-meta-tab"): ?> active <?php endif; ?>  stepIndicator" id="services-meta-tab" data-bs-toggle="pill"
               href="#services-meta" role="tab"
               aria-controls="services-meta"
               aria-selected="false"><span class="nav-link-number"><?php echo e(__('4')); ?></span><?php echo e(__('Meta Section')); ?></a>
            <a class="nav-link <?php if($current_tab === "service-media-uploads-tab"): ?> active <?php endif; ?>  stepIndicator" id="service-media-uploads-tab" data-bs-toggle="pill"
               href="#service-media-uploads" role="tab"
               aria-controls="service-media-uploads"
               aria-selected="false"><span class="nav-link-number"><?php echo e(__('5')); ?></span><?php echo e(__('Media Uploads')); ?></a>
            <a class="nav-link <?php if($current_tab === "service-set-availability-tab"): ?> active <?php endif; ?> stepIndicator" id="service-set-availability-tab" data-bs-toggle="pill"
               href="#service-set-availability" role="tab"
               aria-controls="service-set-availability"
               aria-selected="false"><span class="nav-link-number"><?php echo e(__('6')); ?></span><?php echo e(__('Set Availability')); ?></a>
        </div>
        <!--Nav Bar Tabs markup end -->
        <div  class="add-service-content-wrapper mt-4">
            <div class="tab-content add-service-content" id="add-service-tabContent">

                <!-- service Info start -->
                <div  wire:ignore class="tab-pane fade <?php if($current_tab === "service-info-tab"): ?> show active <?php endif; ?> step" id="service-info" role="tabpanel" aria-labelledby="service-info-tab">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="single-dashboard-input">
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="single-info-input">
                                            <label for="title" class="info-title"> <?php echo e(__('Service Title')); ?> <span class="text-danger">*</span> </label>
                                            <input class="form--control" id="title" type="text" placeholder="<?php echo e(__('Add title')); ?>" wire:model.defer="service_edit_title">
                                        </div>
                                        <div class="single-dashboard-input" wire:ignore>
                                            <div class="single-info-input margin-top-30 permalink_label">
                                                <label for="title" class="info-title text-dark"> <?php echo e(__('Permalink')); ?>  <span class="text-danger">*</span>  </label>
                                                <span id="slug_show" style="color: blue;"><?php echo e(url('/service-list/')); ?>/<?php echo e($services['slug']); ?></span>
                                                <span id="slug_edit" class="display-inline"></span>
                                                <button class="btn btn-warning btn-sm slug_edit_button"> <i class="las la-edit"></i> </button>
                                                <input class="form--control service_slug" id="slug" style="display: none" type="text" wire:model.defer="service_edit_slug">
                                                <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none"><?php echo e(__('Update')); ?></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6" wire:ignore>
                                        <div class="single-info-input">
                                            <label for="video" class="info-title"> <?php echo e(__('Service Video Url')); ?> </label>
                                            <input class="form--control" id="video" type="text" placeholder="<?php echo e(__('youtube embed code')); ?>" wire:model.defer="service_edit_video">
                                            <small class="text-danger"><?php echo e(__('must be embed code from youtube.')); ?> <span class="text-dark"><?php echo e(__('Ex. <iframe width="560" height="315" src="https://www.youtube.com"></iframe>')); ?></span> </small>
                                        </div>
                                    </div>

                                    <div class="col-sm-12" wire:ignore>
                                        <div class="single-info-input">
                                            <label for="description" class="info-title"> <?php echo e(__('Service Description')); ?> <span class="text-danger">*</span> <small class="text-info"><?php echo e(__('minimum 150 characters')); ?> </small>  </label>
                                            <textarea id="summernote" class="form--control textarea--form textarea-input" cols="20" rows="2" placeholder="<?php echo e(__('Type Description')); ?>"><?php echo $services->description; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- service Info end-->

                <!-- service Category start-->
                <div wire:ignore  class="tab-pane fade <?php if($current_tab === "service-category-tab"): ?> show active <?php endif; ?> step" id="service-category" role="tabpanel" aria-labelledby="service-category-tab">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="single-dashboard-input">
                                <div class="row g-4">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="single-info-input">
                                            <label for="category" class="info-title"> <?php echo e(__('Select Main Category')); ?> <span class="text-danger">*</span> </label>
                                            <select id="category" class="category" wire:model.defer="category">
                                                <option value=""><?php echo e(__('Select Category')); ?></option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($cat->id); ?>"  <?php if($cat->id == $services['category_id']): ?> selected <?php endif; ?>> <?php echo e($cat->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="single-info-input sub_category_wrapper">
                                            <label for="subcategory" class="info-title"> <?php echo e(__('Select Sub Category')); ?> <span class="text-danger">*</span></label>
                                            <select  id="subcategory" class="subcategory" wire:model.defer="subcategory">
                                                <option <?php if(!empty( $services['subcategory_id'])): ?> value="<?php echo e($services['subcategory_id']); ?>"  <?php else: ?> value="" <?php endif; ?>>
                                                    <?php echo e(optional($services->subcategory)->name); ?>

                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="single-info-input child_category_wrapper">
                                            <label for="child_category" class="info-title"> <?php echo e(__('Select Child Category')); ?> </label>
                                            <select name="child_category" id="child_category" wire:model.defer="child_category">
                                                <option <?php if(!empty( $services->child_category_id)): ?> value="<?php echo e($services->child_category_id); ?>"  <?php else: ?> value="" <?php endif; ?>>
                                                    <?php echo e(optional($services->childcategory)->name); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- service Category end-->

                <!-- service attribute start-->
                <div wire:ignore.self class="tab-pane fade service_tab_hide_show
                     <?php if($current_tab === "service-attribute-tab"): ?> show active <?php endif; ?> step" id="service-attribute"   role="tabpanel" aria-labelledby="service-attribute-tab">
                    <div class="row g-4">
                        <div wire:ignore class="col-xxl-2 col-md-3 col-sm-4" >
                            <div class="service-attribute-wrapper">
                                <!-- incliude service tabs markup start -->
                                <div class="nav nav-pills flex-column" id="add-service-attribute-tab"
                                     role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="included-service-tab"
                                       data-bs-toggle="pill" href="#included-service" role="tab"
                                       aria-controls="included-service"
                                       aria-selected="true">
                                        <span class="nav-link-number"><?php echo e(__('1')); ?></span>
                                        <?php echo e(__('Included Service')); ?></a>
                                    <a class="nav-link" id="additional-service-tab" data-bs-toggle="pill"
                                       href="#additional-service" role="tab"
                                       aria-controls="additional-service"
                                       aria-selected="false">
                                        <span class="nav-link-number"><?php echo e(__('2')); ?></span>
                                        <?php echo e(__('Additional Service')); ?></a>
                                    <a class="nav-link" id="benefit-service-tab" data-bs-toggle="pill"
                                       href="#benefit-service" role="tab"
                                       aria-controls="benefit-service"
                                       aria-selected="false">
                                        <span class="nav-link-number"><?php echo e(__('3')); ?></span>
                                        <?php echo e(__('Benefit')); ?></a>
                                    <a class="nav-link faq_show_hide" id="faq-service-tab" data-bs-toggle="pill"
                                       href="#faq-service" role="tab"
                                       aria-controls="faq-service"
                                       aria-selected="false">
                                        <span class="nav-link-number"><?php echo e(__('4')); ?></span>
                                        <?php echo e(__('Faq')); ?></a>
                                </div>
                                <!-- include service tabs markup end -->

                                <!--service price show start -->
                                <div class="edit-service-wrappers mt-4  ">
                                    <div class="single-dashboard-input service-price-show-hide">
                                        <div class="single-info-input">
                                            <label class="info-title"> <?php echo e(__('Service Price')); ?></label>
                                            <input class="form--control" type="text" value="<?php echo e($services->price); ?>" id="service_total_price" disabled>
                                        </div>
                                    </div>
                                </div>
                                <!--service price show end -->
                            </div>
                        </div>
                        <div class="col-xxl-10 col-md-9 col-sm-8">
                            <div class="row g-4">
                                <div class="col-xl-12">
                                    <div class="tab-content add-service-attribute-content" id="add-service-attribute-tabContent">

                                        <div wire:ignore.self class="tab-pane fade active show" id="included-service" role="tabpanel" aria-labelledby="included-service-tab">
                                            <!-- Include Service start -->
                                            <div class="single-settings">
                                                <div class="dashboard_table__title__flex">
                                                    <div class="dashboard__headerContents__left">
                                                        <h4 class="input-title">  <?php echo e(__('Whats Included This Package')); ?> </h4>
                                                        <div class="online_service mt-3">

                                                            <div class="dashboard-switch-single d-flex gap-1">
                                                                <span class="text-info"><?php echo e(__('Is Service Online')); ?></span>
                                                                <!--1010101010 -->
                                                                <input wire:click="openDiv"  class="custom-switch is_service_online" id="is_service_online" type="checkbox"  wire:model.defer="is_service_online"/>
                                                                <label class="switch-label mt-0" for="is_service_online"></label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- include markup start -->
                                                <div>
                                                    <div class="add-input append-additional-includes mt-4">
                                                        <?php $__currentLoopData = $include_service_inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div wire:ignore.self>
                                                                <div class="single-dashboard-input what-include-element mt-4">
                                                                    <div class="row align-items-center g-4">
                                                                        <div class="col-lg-4 col-sm-6">
                                                                            <div class="single-info-input">
                                                                                <label class="label_title"><?php echo e(__('Title')); ?> <span class="text-danger">*</span> </label>
                                                                                <input class="form--control" type="text" wire:model.defer="include_service_inputs.<?php echo e($key); ?>.include_service_title" placeholder="<?php echo e(__('Service title')); ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class=" <?php if($is_service_online === true ): ?>  d-none  <?php elseif($is_service_online === false): ?> <?php else: ?> <?php if($services->is_service_online == 1): ?>  d-none  <?php endif; ?> <?php endif; ?> col-lg-3 col-sm-6 is_service_online_hide">
                                                                            <div class="single-info-input">
                                                                                <label class="label_title"><?php echo e(__('Unit Price')); ?> <span class="text-danger">*</span> </label>
                                                                                <input class="form--control include-price" type="text" wire:model.defer="include_service_inputs.<?php echo e($key); ?>.include_service_price" placeholder="<?php echo e(__('Add Price')); ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="<?php if($is_service_online === true ): ?>  d-none  <?php elseif($is_service_online === false): ?> <?php else: ?> <?php if($services->is_service_online == 1): ?>  d-none  <?php endif; ?> <?php endif; ?>  col-lg-3 col-sm-6  is_service_online_hide">
                                                                            <div class="single-info-input">
                                                                                <label class="label_title"><?php echo e(__('Quantity')); ?></label>
                                                                                <input class="form--control numeric-value"  value="1"  type="text" placeholder="<?php echo e(__('Add Quantity')); ?>" readonly>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-2 col-sm-6">
                                                                            <button class="<?php if($key == 0): ?> d-none <?php endif; ?> btn btn-danger remove-include mt-3"  wire:click.prevent="removeIncludeService(<?php echo e($key); ?>)"><i class="las la-times"></i></button>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </div>
                                                    <div  wire:ignore class="btn-wrapper mt-3">
                                                        <a href="javascript:void(0)" class="btn-see-more style-02 color-3 hide_service_and_show" wire:click.prevent="addIncludeServices(<?php echo e($i_include); ?>)"> <?php echo e(__('Add More')); ?> </a>
                                                    </div>
                                                </div>
                                                <!-- include markup start -->
                                            </div>
                                            <!-- Include Service end -->

                                            <?php if($services->is_service_online == 1): ?>
                                                <!-- Online Service start -->
                                                <div  wire:ignore class="single-settings day_review_show_hide">
                                                    <div class="single-dashboard-input mt-4">
                                                        <div class="row g-4">
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label class="label_title"><?php echo e(__('Delivery Days')); ?> <span class="text-danger">*</span> </label>
                                                                    <input class="form--control" type="number"  id="service_online_delivery_days" wire:model.defer="services.delivery_days"  placeholder="<?php echo e(__('Delivery Days')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label class="label_title"><?php echo e(__('Revisions')); ?> </label>
                                                                    <input class="form--control" type="number"  id="service_online_revision" wire:model.defer="services.revision"  placeholder="<?php echo e(__('Revision Times')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-settings">
                                                                    <div class="single-dashboard-input">
                                                                        <div class="single-info-input">
                                                                            <label class="label_title"><?php echo e(__('Service Price')); ?> <span class="text-danger">*</span>  </label>
                                                                            <input class="form--control" type="number" wire:model.defer="services.price"   placeholder="<?php echo e(__('Service price')); ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div  wire:ignore class="single-settings day_review_show_hide">
                                                    <div class="single-dashboard-input mt-4">
                                                        <div class="row g-4">
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label class="label_title"><?php echo e(__('Delivery Days')); ?></label>
                                                                    <input class="form--control" type="number"  id="service_online_delivery_days"  wire:model.defer="services.delivery_days" placeholder="<?php echo e(__('Delivery Days')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label class="label_title"><?php echo e(__('Revisions')); ?></label>
                                                                    <input class="form--control" type="number" id="service_online_revision" wire:model.defer="services.revision" placeholder="<?php echo e(__('Revision Times')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-settings">
                                                                    <div class="single-dashboard-input">
                                                                        <div class="single-info-input">
                                                                            <label class="label_title"><?php echo e(__('Service Price')); ?></label>
                                                                            <input class="form--control change_offline_to_online" type="number"  wire:model.defer="services.price" id="service_online_price"
                                                                                   placeholder="<?php echo e(__('Service price')); ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <!-- Online Service end -->
                                        </div>

                                        <!-- Additional Service Start -->
                                        <div wire:ignore.self class="tab-pane fade" id="additional-service" role="tabpanel" aria-labelledby="additional-service-tab">
                                            <div class="single-settings mt-4">
                                                <h4 class="input-title"> <?php echo e(__('Add Additional Services')); ?> </h4>

                                                <div class="append-additional-services mt-4">
                                                    <div class="single-dashboard-input additional-services">
                                                        <!--default additional service markup end -->
                                                        <?php $__currentLoopData = $additional_service_inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_additional_id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div wire:ignore.self >
                                                                <div class="row g-4 mt-5">
                                                                    <div  class="col-xl-3 col-sm-6">
                                                                        <div class="single-info-input">
                                                                            <label class="label_title"><?php echo e(__('Title')); ?> <span class="text-danger">*</span> </label>
                                                                            <input class="form--control" type="text"  wire:model.defer="additional_service_inputs.<?php echo e($key_additional_id); ?>.additional_service_title"  placeholder="<?php echo e(__('Service title')); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 col-sm-6">
                                                                        <div class="single-info-input">
                                                                            <label class="label_title"><?php echo e(__('Unit Price')); ?> <span class="text-danger">*</span> </label>
                                                                            <input class="form--control numeric-value" type="number"  wire:model.defer="additional_service_inputs.<?php echo e($key_additional_id); ?>.additional_service_price" step="0.01"  placeholder="<?php echo e(__('Add Price')); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 col-sm-6">
                                                                        <div class="single-info-input">
                                                                            <label class="label_title"><?php echo e(__('Quantity')); ?></label>
                                                                            <input class="form--control numeric-value" type="text" value="1" placeholder="<?php echo e(__('Add Quantity')); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="single-info-input">
                                                                            <div class="form-group ">
                                                                                <div class="media-upload-btn-wrapper" wire:ignore>
                                                                                    <div class="img-wrap">
                                                                                        <div class="img-wrap-new">
                                                                                            <?php echo render_image_markup_by_attachment_id($value['additional_service_image'] ?? ''); ?>

                                                                                        </div>
                                                                                    </div>
                                                                                    <input type="hidden" id="additional_service_image" wire:model.defer="additional_service_inputs.<?php echo e($key_additional_id); ?>.additional_service_image">
                                                                                    <button data-value="0" type="button" class="new_set_additional_service_image btn btn-info media_upload_form_btn"
                                                                                            data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                                            data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#media_upload_modal">
                                                                                        <?php echo e(__('Upload Image')); ?>

                                                                                    </button>
                                                                                    <small style="font-size: 10px"><?php echo e(__('image format: jpg,jpeg,png')); ?> (<?php echo e(__('recommended size 78x78')); ?>) </small>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 col-sm-2">
                                                                        <span class="<?php if($key_additional_id == 0): ?> d-none <?php endif; ?> btn btn-danger additional-remove" wire:click.prevent="removeAdditionalService(<?php echo e($key_additional_id); ?>)"><i class="las la-times"></i></span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </div>
                                                </div>

                                                <div wire:ignore class="btn-wrapper mt-3">
                                                    <a href="javascript:void(0)" class="btn-see-more style-02 color-3 add-additional-services" wire:click.prevent="addAdditionalService(<?php echo e($i_additional); ?>)"> <?php echo e(__('Add More')); ?> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Additional Service end -->

                                        <!-- Service Benefit Start -->
                                        <div  wire:ignore.self class="tab-pane fade" id="benefit-service" role="tabpanel" aria-labelledby="benefit-service-tab">
                                            <div class="single-settings margin-top-40">
                                                <h4 class="input-title"> <?php echo e(__('Benefit Of This Package')); ?> </h4>
                                                <div class="append-benifits">

                                                    <?php $__currentLoopData = $service_benefit_inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_benefit_id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="single-dashboard-input" wire:ignore.self>
                                                            <div class="row align-items-center g-4">
                                                                <div class="col-xl-10 col-sm-9">
                                                                    <div class="single-info-input mt-3">
                                                                        <input class="form--control" type="text" wire:model.defer="service_benefit_inputs.<?php echo e($key_benefit_id); ?>.benifits" placeholder="<?php echo e(__('Type Here')); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-sm-3">
                                                                    <span class="<?php if($key_benefit_id == 0): ?> d-none <?php endif; ?> btn btn-danger benefit-remove" wire:loading.attr="disabled" wire:click.prevent="removeBenefit(<?php echo e($key_benefit_id); ?>)"><i class="las la-times"></i></span>

                                                               </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </div>
                                                <div class="btn-wrapper mt-3">
                                                    <a href="javascript:void(0)" class="btn-see-more style-02 color-3 service-benefit-add" wire:click.prevent="addBenefit(<?php echo e($i_benefit); ?>)"> <?php echo e(__('Add More')); ?> </a>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Service Benefit end -->

                                        <!-- Service Faqs Start -->
                                        <div  wire:ignore.self class="tab-pane fade" id="faq-service" role="tabpanel" aria-labelledby="faq-service-tab">
                                            <div class="single-settings margin-top-40 faq_show_hide">
                                                <h4 class="input-title"> <?php echo e(__('Faqs')); ?> </h4>
                                                <div class="append-faqs">
                                                    <?php $__currentLoopData = $online_service_faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_faq_id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="row" wire:ignore.self>
                                                            <div class="col-xl-10">
                                                                <div class="single-dashboard-input faqs">
                                                                    <div class="single-info-input mt-3">
                                                                        <label class="label_title"><?php echo e(__('Title')); ?></label>
                                                                        <input class="form--control" type="text" wire:model.defer="online_service_faq.<?php echo e($key_faq_id); ?>.title" placeholder="<?php echo e(__('Faq Title')); ?>">
                                                                    </div>
                                                                    <div class="single-info-input mt-3">
                                                                        <label class="label_title"><?php echo e(__('Description')); ?></label>
                                                                        <textarea class="form--control textarea-input" wire:model.defer="online_service_faq.<?php echo e($key_faq_id); ?>.description" cols="20" rows="2" placeholder="<?php echo e(__('Faq Description')); ?>" style="padding-top: 16px;"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-2">
                                                                <span class="btn btn-danger remove-faqs mt-3 <?php if($key_faq_id == 0): ?> d-none <?php endif; ?>" wire:click.prevent="removeFaq(<?php echo e($key_faq_id); ?>)"><i class="las la-times"></i></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="btn-wrapper mt-3">
                                                    <a href="javascript:void(0)" class="btn-see-more style-02 color-3 service-faqs-add" wire:click.prevent="addFaq(<?php echo e($i_faq); ?>)"> <?php echo e(__('Add More')); ?> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Service Faqs end -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- service attribute end-->

                <!-- service Meta Section start-->
                <div  wire:ignore  class="tab-pane fade <?php if($current_tab === "services-meta-tab"): ?> show active <?php endif; ?> step" id="services-meta" role="tabpanel" aria-labelledby="services-meta-tab">
                    <div class="card">
                        <div class="card-body meta">
                            <h5 class="header-title"><?php echo e(__('Meta Section')); ?></h5>
                            <div class="row g-4 mt-1">
                                <div class="col-xxl-2 col-xl-3 col-sm-4">
                                    <div class="nav nav-pills flex-column" id="v-pills-tab"
                                         role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-home-tab"
                                           data-bs-toggle="pill" href="#v-pills-home" role="tab"
                                           aria-controls="v-pills-home"
                                           aria-selected="true">
                                            <span class="nav-link-number"><?php echo e(__('1')); ?></span>
                                            <?php echo e(__('Service Meta')); ?></a>
                                        <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                           href="#v-pills-profile" role="tab"
                                           aria-controls="v-pills-profile"
                                           aria-selected="false">
                                            <span class="nav-link-number"><?php echo e(__('2')); ?></span>
                                            <?php echo e(__('Facebook Meta')); ?></a>
                                        <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                           href="#v-pills-messages" role="tab"
                                           aria-controls="v-pills-messages"
                                           aria-selected="false">
                                            <span class="nav-link-number"><?php echo e(__('3')); ?></span>
                                            <?php echo e(__('Twitter Meta')); ?></a>
                                    </div>
                                </div>
                                <div class="col-xxl-10 col-xl-9 col-sm-8">
                                    <div class="tab-content meta-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="label_title" for="title"><?php echo e(__('Meta Title')); ?></label>
                                                        <input type="text" class="form-control" id="meta_title"  placeholder="<?php echo e(__('Title')); ?>"  wire:model.defer="meta.meta_title">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group" wire:ignore>
                                                        <label class="label_title" for="slug"><?php echo e(__('Meta Tags')); ?></label>
                                                        <input type="text" class="form-control" name="meta_tags" placeholder="Slug" data-role="tagsinput" id="meta_tags" wire:model.defer="meta.meta_tags">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="label_title" for="title"><?php echo e(__('Meta Description')); ?></label>
                                                        <textarea name="meta_description"  class="form-control textarea-input" cols="20" rows="2" wire:model.defer="meta.meta_description"
                                                                  placeholder="<?php echo e(__('Description')); ?>"> </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                             aria-labelledby="v-pills-profile-tab">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="label_title" for="title"><?php echo e(__('Facebook Meta Title')); ?></label>
                                                        <input type="text" class="form-control" placeholder="<?php echo e(__('Title')); ?>"  wire:model.defer="meta.facebook_meta_tags" name="facebook_meta_tags">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="label_title" for="title"><?php echo e(__('Facebook Meta Description')); ?></label>
                                                        <textarea name="facebook_meta_description" class="form-control textarea-input" cols="20"
                                                                  rows="2" wire:model.defer="meta.facebook_meta_description" placeholder="<?php echo e(__('Description')); ?>"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="label_title" for="image"><?php echo e(__('Facebook Meta Image')); ?></label>
                                                        <div class="media-upload-btn-wrapper">
                                                            <div class="img-wrap">
                                                                <?php echo render_attachment_preview_for_admin($meta['facebook_meta_image'] ?? ''); ?>

                                                            </div>
                                                            <input type="hidden"  name="facebook_meta_image" wire:model.defer="meta.facebook_meta_image" id="facebook_meta_image">
                                                            <button type="button"
                                                                    class="change_service_facebook_image btn btn-info media_upload_form_btn"
                                                                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#media_upload_modal">
                                                                <?php echo e(__('Upload Image')); ?>

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                             aria-labelledby="v-pills-messages-tab">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="label_title" for="title"><?php echo e(__('Twitter Meta Title')); ?></label>
                                                        <input type="text" class="form-control" placeholder="<?php echo e(__('Title')); ?>"
                                                               name="twitter_meta_tags" wire:model.defer="meta.twitter_meta_tags" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="label_title" for="title"><?php echo e(__('Twitter Meta Description')); ?></label>
                                                        <textarea name="twitter_meta_description" class="form-control textarea-input" cols="20"
                                                                  rows="2" wire:model.defer="meta.twitter_meta_description" placeholder="<?php echo e(__('Description')); ?>"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12" wire:ignore>
                                                    <div class="form-group">
                                                        <label class="label_title" for="image"><?php echo e(__('Twitter Meta Image')); ?></label>
                                                        <div class="media-upload-btn-wrapper">
                                                            <div class="img-wrap">
                                                                <?php echo render_attachment_preview_for_admin($meta['twitter_meta_image'] ?? ''); ?>

                                                            </div>
                                                            <input type="hidden" wire:model.defer="meta.twitter_meta_image" name="twitter_meta_image" id="twitter_meta_image">
                                                            <button type="button"
                                                                    class="change_service_twitter_image btn btn-info media_upload_form_btn"
                                                                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#media_upload_modal">
                                                                <?php echo e(__('Upload Image')); ?>

                                                            </button>
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
                </div>
                <!-- service Meta Section end-->

                <!-- service Media Uploads start-->
                <div   wire:ignore class="tab-pane fade <?php if($current_tab === "service-media-uploads-tab"): ?> show active <?php endif; ?> step" id="service-media-uploads" role="tabpanel" aria-labelledby="service-media-uploads-tab">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="single-dashboard-input">
                                <div class="single-dashboard-input">
                                    <div class="single-info-input">
                                        <div class="form-group ">
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    <?php echo render_image_markup_by_attachment_id($services['image'],'','thumb'); ?>

                                                </div>
                                                <input type="hidden" wire:model.defer="services.image" id="service_image" name="service_image">
                                                <button type="button" class="change_service_image btn btn-info media_upload_form_btn"
                                                        data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                        data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-bs-toggle="modal"
                                                        data-bs-target="#media_upload_modal">
                                                    <?php echo e(__('Upload Main Image')); ?>

                                                </button>
                                                <small><?php echo e(__('image format: jpg,jpeg,png')); ?></small> <br>
                                                <small><?php echo e(__('recommended size 1920x1280')); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            <?php echo render_gallery_image_attachment_preview($services['image_gallery'] ?? ''); ?>

                                        </div>
                                        <input type="hidden" wire:model.defer="services.image_gallery" id="image_gallery" name="image_gallery">
                                        <button type="button" class="change_service_gallery_image btn btn-info media_upload_form_btn"
                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                data-bs-toggle="modal"
                                                data-mulitple="true"
                                                data-bs-target="#media_upload_modal">
                                            <?php echo e(__('Upload Gallery Image')); ?>

                                        </button>
                                        <small><?php echo e(__('image format: jpg,jpeg,png')); ?></small> <br>
                                        <small><?php echo e(__('recommended size 1920x1280')); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- service Media Uploads end-->

                <!-- service Set Availability start-->
                <div wire:ignore.self class="tab-pane fade <?php if($current_tab === "service-set-availability-tab"): ?> show active <?php endif; ?> step" id="service-set-availability" role="tabpanel" aria-labelledby="service-set-availability-tab">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="available-all-city-area">
                                        <span class="text-info"><?php echo e(__('Is Available All Cities and Area')); ?></span>
                                        <div class="dashboard-switch-single d-flex">
                                            <input class="custom-switch is_service_all_cities_id" id="is_service_all_cities" type="checkbox" <?php if($services['is_service_all_cities'] == 1): ?> checked value="1" <?php endif; ?> />
                                            <label class="switch-label mt-2" for="is_service_all_cities"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-10 col-md-9 col-sm-8">
                            <div class="row g-4">
                                <div class="col-xl-12">
                                    <div class="tab-content service-set-availability" id="service-set-availabilityContent">
                                        <div wire:ignore.self class="tab-pane fade active show" id="address-service" role="tabpanel" aria-labelledby="address-service-tab">
                                            <div class="single-settings">
                                                <div>
                                                    <div class="add-input append-additional-includes mt-4">
                                                        <?php $__currentLoopData = $post_code_inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div wire:ignore.self>
                                                                <div class="single-dashboard-input what-include-element mt-4">
                                                                    <div class="row align-items-center g-4">
                                                                        <div class="col-lg-4 col-sm-6">
                                                                            <div class="single-info-input">
                                                                                <label class="label_title"><?php echo e(__('Post Code')); ?> <span class="text-danger">*</span> </label>
                                                                                <input class="form--control" type="text" wire:model.defer="post_code_inputs.<?php echo e($key); ?>.service_post_code" placeholder="<?php echo e(__('Post Code')); ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2 col-sm-6">
                                                                            <button class="<?php if($key == 0): ?> d-none <?php endif; ?> btn btn-danger remove-include mt-3"  wire:click.prevent="removeAddressServices(<?php echo e($key); ?>)"><i class="las la-times"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                    <div  wire:ignore class="btn-wrapper mt-3">
                                                        <a href="javascript:void(0)" class="btn-see-more style-02 color-3 hide_service_and_show" wire:click.prevent="addAddressServices(<?php echo e($a_include); ?>)"> <?php echo e(__('Add More')); ?> </a>
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
                <!-- service Set Availability end-->
            </div>
        </div>
    </div>


    <!-- start previous / next buttons -->
    <div  wire:ignore class="col-lg-12">
        <div class="single-settings">
            <div class="btn-wrapper d-flex gap-2 mt-4">
                <button class="dashboard_table__title__btn btn-outline-1 radius-5" id="prevBtn" type="button"><?php echo e(__('Previous')); ?></button>
                <button class="dashboard_table__title__btn btn-bg-1 radius-5" style="border: none" id="nextBtn" type="button"><?php echo e(__('Next')); ?></button>

                <button class="dashboard_table__title__btn btn-bg-1 radius-5"
                        style="border: none; <?php if($hideSubmitButton): ?> display: none <?php endif; ?>"
                        id="submitBtn" type="submit"  wire:loading.attr="disabled"><?php echo e(__('Update Service')); ?></button>
            </div>
        </div>
    </div>
</form>

<!-- for select -->
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {

            // online offline service change
           let online_check = '<?php echo e($services->is_service_online); ?>';
           if(online_check == 1){
               window.livewire.find('<?php echo e($_instance->id); ?>').set('is_service_online', 1)
           }

            Livewire.emit('documentLoaded','working');

            // online service hide and show
            $(".add-what-includes").on('click',function(){
                if ($("#is_service_online").is(':checked')){
                    $('.is_service_online_hide').hide();
                }
            });

            $(document).on('click',"#add-service-tab .nav-link",function(e){
                let el = $(this);
                $('input[name="current_tab"]').val(el.attr('id'));
            });

            $(document).on('click', "#service-attribute-tab" ,function(e){
                $(".service_tab_hide_show").removeClass('d-none');
            });

            // check
            $(document).on("click","#submitBtn", function (e){
                e.preventDefault();
                Livewire.emit("service_category_sub_cat_child_cat",
                    [
                        $('#category').val(),
                        $('#subcategory').val(),
                        $('#child_category').val(),
                        $('#title').val(),
                        $('#video').val(),
                        $('#slug').val(),
                        $('#summernote').val(),
                        $('#service_image').val(),
                        $('#image_gallery').val(),
                        $('#is_service_all_cities_id').val(),
                        $('#is_service_online').val(),
                        $('#facebook_meta_image').val(),
                        $('#twitter_meta_image').val(),
                        $('#meta_tags').val(),


                    ])
            })

            // livewire custom summernote design
            $('#summernote').summernote({
                placeholder: '',
                tabsize: 2,
                focus: true,
                toolbar: [
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ],
                callbacks: {
                    onChange: function (e) {
                    },
                }
            });

            // is service online
            $('.day_review_show_hide').hide()
            $('.faq_show_hide').hide()
            $('.online_service_price_show_hide').hide()

            // if service is online  select checkbox
            <?php if($is_service_online === true): ?>
            $("#is_service_online").prop('checked', true);
            <?php elseif($is_service_online === false): ?>
            $("#is_service_online").prop('checked', false);
            <?php else: ?>
                    <?php if($services->is_service_online == 1): ?>
                    // service online offline vlaue get
                    $(".hide_service_and_show").on('click', function () {
                        let get_value = $("#is_service_online"). val();
                        if(get_value == 1 ){
                            window.livewire.find('<?php echo e($_instance->id); ?>').set('is_service_online', get_value, true)
                        }
                    });

                    // add more and remove button click set value for online offline service
                    $(".remove-include").on('click', function () {
                        let get_value = $("#is_service_online"). val();
                        if(get_value == 1 ){
                            window.livewire.find('<?php echo e($_instance->id); ?>').set('is_service_online', get_value, true)
                        }
                    });

                     $("#is_service_online").prop('checked', true);
                     $("#is_service_online").val(1);

                    // for online service add more click set value delivery day and price
                    let class_name_for_online_delivery_revision = '.hide_service_and_show, .remove-include, .add-additional-services, .additional-remove, .service-benefit-add, .benefit-remove, .service-faqs-add, .remove-faqs';
                    $(class_name_for_online_delivery_revision).on('click', function () {
                        let delivery_days_value = $("#service_online_delivery_days").val();
                        let revision_value = $("#service_online_revision").val();
                        window.livewire.find('<?php echo e($_instance->id); ?>').set('services.delivery_days', delivery_days_value, true)
                        window.livewire.find('<?php echo e($_instance->id); ?>').set('services.revision', revision_value, true)
                    });

                    <?php else: ?>
                     // todo: if service is offline
                    $("#is_service_online").prop('checked', false);
                  <?php endif; ?>

            <?php endif; ?>

            // add more input re-render after set value for category, sub category, child category
            let class_name_for_category = '.is_service_online, .hide_service_and_show, .remove-include, .add-additional-services, .additional-remove, .service-benefit-add, .benefit-remove, .service-faqs-add, .remove-faqs';
            $(class_name_for_category).on('click', function () {
                let cat_get_value = $("#category"). val();
                let sub_cat_get_value = $("#subcategory"). val();
                let child_cat_get_value = $("#child_category"). val();
                window.livewire.find('<?php echo e($_instance->id); ?>').set('category', cat_get_value, true)
                window.livewire.find('<?php echo e($_instance->id); ?>').set('subcategory', sub_cat_get_value, true)
                window.livewire.find('<?php echo e($_instance->id); ?>').set('child_category', child_cat_get_value, true)
            });

            // online service
            if ($("#is_service_online").is(':checked')) {
                $('.is_service_online_hide').hide();
                $('#is_service_online').val(1);
                $('.day_review_show_hide').show();
                $('.faq_show_hide').show();
                $('.service-price-show-hide').hide();
                $('.online_service_price_show_hide').show();
                $('#service_total_price').val('');
            }

            // offline to online service
            $("#is_service_online").on('change', function() {
                if ($("#is_service_online").is(':checked')){
                    $('.is_service_online_hide').hide();
                    $('#is_service_online').val(1)
                    $('.day_review_show_hide').show()
                    $('.faq_show_hide').show()
                    $('.service-price-show-hide').hide()
                    $('.online_service_price_show_hide').show()
                    $('.change_offline_to_online').val('')

                }else {
                    $('.is_service_online_hide').show();
                    $('#is_service_online').val('')
                    $('.day_review_show_hide').hide()
                    $('.faq_show_hide').hide()
                    $('.service-price-show-hide').show()
                    $('.online_service_price_show_hide').hide()

                }
            });



            //  service additional image add
            $(document).on("click",".new_set_additional_service_image", function() {
                // add class for additional image
                $("#media_upload_modal").find('.media_upload_modal_submit_btn').addClass('additional_service_image_id');
                $(document).on("click",".additional_service_image_id", function() {
                    let additionalServicesButton = $(".additional-services button.media_upload_form_btn");
                    additionalServicesButton.each(function (key, value){
                        let image_id = $(this).attr("data-image-ids");
                        window.livewire.find('<?php echo e($_instance->id); ?>').set('additional_service_inputs.'+ key +'.additional_service_image' , image_id, true);
                    });
                    // remove class
                    $("#media_upload_modal").find('.media_upload_modal_submit_btn').removeClass('additional_service_image_id');

                });

            });

        });
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/livewire/edit-service-two.blade.php ENDPATH**/ ?>