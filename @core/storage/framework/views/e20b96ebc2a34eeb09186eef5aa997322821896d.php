<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Service Provider Profile')); ?>

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
    <!-- Dashboard area Starts -->
    <?php echo $__env->make('frontend.user.seller.partials.sidebar-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__right">
        <!-- buyer header -->
        <?php echo $__env->make('frontend.user.buyer.header.buyer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="dashboard__body">
            <div class="dashboard__inner">
                
                <!-- buyer profile section start-->
                <div class="dashboard_accountProfile mt-4">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-message','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-message'); ?>
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
                    <div class="dashboard__inner__item dashboard_border padding-10 radius-10 bg-white">
                        <div class="dashboard_accountProfile__item">

                            <div class="dashboard_accountProfile__flex">
                                <div class="dashboard_accountProfile__author">
                                    <div class="dashboard_accountProfile__author__flex">
                                        <div class="dashboard_accountProfile__author__thumb">
                                            <a href="javascript:void(0)">
                                                <?php if(!is_null(Auth::guard('web')->user()->image)): ?>
                                                    <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image); ?>

                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('assets/frontend/img/no-image.jpg')); ?>" alt="No Image">
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="dashboard_accountProfile__author__contents">
                                            <h4 class="dashboard_accountProfile__author__title"><a href="javascript:void(0)"><?php echo e(Auth::guard('web')->user()->name); ?></a></h4>
                                            <p class="dashboard_accountProfile__author__para mt-1"><?php echo e(Auth::guard('web')->user()->email); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard_accountProfile__btn">
                                    <a href="#0" class="dashboard_table__title__btn btn-bg-1 radius-5 edit_buyer_profile"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editProfile"
                                    ><i class="fa-regular fa-pen-to-square"></i> <?php echo e(__('Edit Profile')); ?></a>
                                </div>
                            </div>
                            <div class="dashboard_accountProfile__inner profile_border_top">
                                <div class="dashboard_accountProfile__details">
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Phone Number:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e(Auth::guard('web')->user()->phone); ?></span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Country:')); ?> </span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e(optional(optional(Auth::guard('web')->user())->country)->country); ?></span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('City:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e(optional(optional(Auth::guard('web')->user())->city)->service_city); ?></span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Area:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e(optional(optional(Auth::guard('web')->user())->area)->service_area); ?></span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Post Code:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e(Auth::guard('web')->user()->post_code); ?></span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Address:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e(Auth::guard('web')->user()->address); ?></span>
                                    </div>
                                    <?php if(Auth::guard('web')->user()->about != NULL): ?>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('About:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e(Auth::guard('web')->user()->about); ?> </span>
                                    </div>
                                   <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Dashboard area end -->

    <!-- Buyer Profile Edit Modal Start-->
    <div class="modal fade modal-lg" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Edit Profile')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('seller.profile.edit')); ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo e(Auth::guard('web')->user()->id); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="name" class="label_title__postition"><?php echo e(__('Your Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form--control radius-10" name="name" value="<?php echo e(Auth::guard('web')->user()->name); ?>" placeholder="Your Name">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="email" class="label_title__postition"><?php echo e(__('Email')); ?> <span class="text-danger">*</span> </label>
                                        <input type="email" class="form--control radius-10" name="email" value="<?php echo e(Auth::guard('web')->user()->email); ?>" placeholder="Your email">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="phone" class="label_title__postition"><?php echo e(__('Phone')); ?> <span class="text-danger">*</span> </label>
                                        <input type="tel" class="form--control radius-10" name="phone" value="<?php echo e(Auth::guard('web')->user()->phone); ?>" placeholder="Your phone">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="CurrentPassword" class="label_title__postition"><?php echo e(__('Select Country')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="country_id" id="country_id">
                                                <?php if(!empty($countries)): ?>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($country->id); ?>" <?php if($country->id==Auth::guard('web')->user()->country_id): ?> selected <?php endif; ?>><?php echo e($country->country); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="CurrentPassword" class="label_title__postition"><?php echo e(__('Select City')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_city" id="service_city">
                                                <?php if(!empty($cities)): ?>
                                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($city->id); ?>" <?php if($city->id==Auth::guard('web')->user()->service_city): ?> selected <?php endif; ?>><?php echo e($city->service_city); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="CurrentPassword" class="label_title__postition"><?php echo e(__('Select Area')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_area" id="service_area">
                                                <?php if(!empty($areas)): ?>
                                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($area->id); ?>" <?php if($area->id==Auth::guard('web')->user()->service_area): ?> selected <?php endif; ?>><?php echo e($area->service_area); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition"><?php echo e(__('Post Code')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="post_code" value="<?php echo e(Auth::guard('web')->user()->post_code); ?>" placeholder="Post Code">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition"><?php echo e(__('Your Address')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="address" value="<?php echo e(Auth::guard('web')->user()->address); ?>" placeholder="Your Address">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="about" class="label_title__postition"><?php echo e(__('About')); ?></label>
                                        <textarea class="form--control textarea--form textarea-input" name="about" placeholder="<?php echo e(__('Type Your About')); ?>"> <?php echo e(Auth::guard('web')->user()->about); ?> </textarea>
                                    </div>
                                </div>

                                <!-- Social Link -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Facebook Link')); ?> </label>
                                                <input class="form--control" type="text" name="fb_url" value="<?php echo e(Auth::guard('web')->user()->fb_url); ?>" placeholder="<?php echo e(__('Type Your Facebook Link')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Twitter Link')); ?> </label>
                                                <input class="form--control" type="text" name="tw_url"  value="<?php echo e(Auth::guard('web')->user()->tw_url); ?>"  placeholder="<?php echo e(__('Type Your Twiter Link')); ?>">
                                            </div>
                                        </div>
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Google Link')); ?> </label>
                                                <input class="form--control" type="text" name="go_url" value="<?php echo e(Auth::guard('web')->user()->go_url); ?>" placeholder="<?php echo e(__('Type Your Google Link')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Youtube Link')); ?> </label>
                                                <input class="form--control" type="text" name="yo_url"  value="<?php echo e(Auth::guard('web')->user()->yo_url); ?>"  placeholder="<?php echo e(__('Type Your Youtube Link')); ?>">
                                            </div>
                                        </div>
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Linkedin Link')); ?> </label>
                                                <input class="form--control" type="text" name="li_url" value="<?php echo e(Auth::guard('web')->user()->li_url); ?>" placeholder="<?php echo e(__('Type Your Linkedin Link')); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Instagram Link')); ?> </label>
                                                <input class="form--control" type="text" name="in_url"  value="<?php echo e(Auth::guard('web')->user()->in_url); ?>"  placeholder="<?php echo e(__('Type Your Instagram Link')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Dribble  Link')); ?> </label>
                                                <input class="form--control" type="text" name="dr_url" value="<?php echo e(Auth::guard('web')->user()->dr_url); ?>" placeholder="<?php echo e(__('Type Your Dribble Link')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Twitch Link')); ?> </label>
                                                <input class="form--control" type="text" name="twi_url"  value="<?php echo e(Auth::guard('web')->user()->twi_url); ?>"  placeholder="<?php echo e(__('Type Your Twitch Link')); ?>">
                                            </div>
                                        </div>
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Pinterest  Link')); ?> </label>
                                                <input class="form--control" type="text" name="pi_url" value="<?php echo e(Auth::guard('web')->user()->pi_url); ?>" placeholder="<?php echo e(__('Type Your Pinterest Link')); ?>">
                                            </div>
                                        </div>
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Reddit Link')); ?> </label>
                                                <input class="form--control" type="text" name="re_url"  value="<?php echo e(Auth::guard('web')->user()->re_url); ?>"  placeholder="<?php echo e(__('Type Your Reddit Link')); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image,'','thumb'); ?>

                                        </div>
                                        <input type="hidden" id="image" name="image"
                                               value="<?php echo e(Auth::guard('web')->user()->image); ?>">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-bs-toggle="modal"
                                                data-bs-target="#media_upload_modal">
                                            <?php echo e(__('Upload Profile Image')); ?>

                                        </button>
                                    </div>
                                    <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                </div>

                                <div class="single-dashboard-input">
                                    <div class="single-info-input margin-top-30">
                                        <div class="form-group">
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->profile_background); ?>

                                                </div>
                                                <input type="hidden" id="profile_background" name="profile_background"
                                                       value="<?php echo e(Auth::guard('web')->user()->profile_background); ?>">
                                                <button type="button" class="btn btn-info media_upload_form_btn"
                                                        data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                        data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-bs-toggle="modal"
                                                        data-bs-target="#media_upload_modal">
                                                    <?php echo e(__('Upload Background Image')); ?>

                                                </button>
                                            </div>
                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"><?php echo e(__('Update Profile')); ?></button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Buyer Profile Edit Modal End-->
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
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                // modal close
                $('.close').on('click', function (){
                   $('#media_upload_modal').modal('hide');
                });

                $('#country_id').select2({
                    dropdownParent: $('#editProfile')
                });
                $('#service_city').select2({
                    dropdownParent: $('#editProfile')
                });
                $('#service_area').select2({
                    dropdownParent: $('#editProfile')
                });

                $(document).on('click', '.edit_buyer_profile', function(e) {
                    e.preventDefault();
                    $('#editProfile').modal('show');
                    // $('.nice-select').niceSelect('update');
                });

                // media upload modal open submit img after show old modal
               $(document).on('click', '.media_upload_modal_submit_btn', function(e) {
                    e.preventDefault();
                    $('#editProfile').modal('show');
                });

                // change country and get city
                $(document).on('change','#country_id' ,function() {
                    let country_id = $("#country_id").val();
                    $.ajax({
                        method: 'post',
                        url: "<?php echo e(route('user.country.city')); ?>",
                        data: {
                            country_id: country_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''><?php echo e(__('Select City')); ?></option>";
                                var allList = "<li class='option' data-value=''><?php echo e(__('Select City')); ?></li>";
                                var allCity = res.cities;
                                $.each(allCity, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_city + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city + "</li>";
                                });
                                $("#service_city").html(alloptions);
                                $("#service_city").parent().find(".current").html("__('Select City')");
                                $("#service_city").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html("<?php echo e(__('Select Area')); ?>");
                                $(".service_area_wrapper .list").html("");

                                $('#service_city').select2({
                                    dropdownParent: $('#editProfile')
                                });
                            }
                        }
                    })
                })

                $('#service_city').select2({
                  placeholder: `<?php echo e(__('search city')); ?>`,
                  ajax: {
                    type: 'get',
                    url: "<?php echo e(route('user.country.city.ajax.search')); ?>",
                    dataType: 'json',
                    data: function (params) {
                        let country_id = $("#country_id").val();
                        return {
                            q: params.term, // search term
                            country_id: country_id,
                        };
                    },
                    delay: 250,
                    processResults: function (response) {
                        // console.log(response.data);
                      return {
                        results:  $.map(response, function (item) {
                              return {
                                  text: item.service_city,
                                  id: item.id
                              }
                          })
                      };
                    },
                    cache: true
                  }
                });

                // select city and area
                $(document).on('change','#service_city', function() {
                    var city_id = $("#service_city").val();
                    $.ajax({
                        method: 'post',
                        url: "<?php echo e(route('user.city.area')); ?>",
                        data: {
                            city_id: city_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''><?php echo e(__('Select Area')); ?></option>";
                                var allList = "<li data-value='' class='option'><?php echo e(__('Select Area')); ?></li>";
                                var allArea = res.areas;
                                $.each(allArea, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_area + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_area + "</li>";
                                });

                                $("#service_area").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html("<?php echo e(__('Select Area')); ?>");

                                $('#service_area').select2({
                                    dropdownParent: $('#editProfile')
                                });
                            }
                        }
                    });
                });

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/profile/partials/seller-profile-two.blade.php ENDPATH**/ ?>