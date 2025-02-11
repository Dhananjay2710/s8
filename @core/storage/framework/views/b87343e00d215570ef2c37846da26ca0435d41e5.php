
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Service Provider Company')); ?>

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
    <?php if(!empty($companyData)): ?>
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
                                                <?php if(!is_null($companyData->image)): ?>
                                                    <?php echo render_image_markup_by_attachment_id($companyData->image); ?>

                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('assets/frontend/img/no-image.jpg')); ?>" alt="No Image">
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="dashboard_accountProfile__author__contents">
                                            <h4 class="dashboard_accountProfile__author__title"><a href="javascript:void(0)"><?php echo e($companyData->name); ?></a></h4>
                                            <p class="dashboard_accountProfile__author__para mt-1"><?php echo e($companyData->email); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard_accountProfile__btn">
                                    <a href="#0" class="dashboard_table__title__btn btn-bg-1 radius-5 edit_buyer_profile"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editProfile"
                                    ><i class="fa-regular fa-pen-to-square"></i> <?php echo e(__('Edit Company')); ?></a>
                                </div>
                            </div>
                            <div class="dashboard_accountProfile__inner profile_border_top">
                                <div class="dashboard_accountProfile__details">
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Company Name:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e($companyData->name); ?></span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Company Email:')); ?> </span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e($companyData->email); ?></span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Phone Number:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e($companyData->phone); ?></span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Company Address:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e($companyData->address); ?></span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Company Area:')); ?></span>
                                        <?php if(!empty($areas)): ?>
                                            <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($area->id==$companyData->service_area): ?>
                                                    <span class="dashboard_accountProfile__details__para"> <?php echo e($area->service_area); ?> </span>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Company City:')); ?></span>
                                        <?php if(!empty($cities)): ?>
                                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($city->id==$companyData->service_city): ?>
                                                    <span class="dashboard_accountProfile__details__para"> <?php echo e($city->service_city); ?> </span>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Company Country:')); ?></span>
                                        <?php if(!empty($countries)): ?>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($country->id==$companyData->country_id): ?>
                                                    <span class="dashboard_accountProfile__details__para"> <?php echo e($country->country); ?> </span>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Company Post Code:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e($companyData->post_code); ?></span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name"><?php echo e(__('Company GSTIN:')); ?></span>
                                        <span class="dashboard_accountProfile__details__para"><?php echo e($companyData->gstin); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard__right">
        <div class="dashboard__body">
            <div class="dashboard__inner">
                <!-- search section start-->
                <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                    <div class="dashboard__wallet">
                        <form action="<?php echo e(route('seller.company')); ?>" method="GET">
                            <div class="dashboard__headerGlobal__flex">
                                <div class="dashboard__headerGlobal__content">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="dashboard_table__title"><?php echo e(__('Search Team Member')); ?></h4> <i class="las la-angle-down search_by_all"></i>
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
                                <?php if(request()->get('member_id')): ?>  show
                                <?php elseif(request()->get('member_name ')): ?> show
                                <?php elseif(request()->get('member_email ')): ?> show
                                <?php elseif(request()->get('member_phone ')): ?> show
                                <?php endif; ?>
                                "aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="single-settings">
                                                    <div class="single-dashboard-input">
                                                        <div class="row g-4 mt-3">
                                                            
                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="member_name" class="info-title"> <?php echo e(__('Member Name')); ?> </label>
                                                                    <input class="form--control" name="member_name" value="<?php echo e(request()->get('member_name')); ?>" type="text" placeholder="<?php echo e(__('Member Name')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="member_email" class="info-title"> <?php echo e(__('Member Email')); ?> </label>
                                                                    <input class="form--control" name="member_email" value="<?php echo e(request()->get('member_email')); ?>" type="text" placeholder="<?php echo e(__('Member Email')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="member_phone" class="info-title"> <?php echo e(__('Member Phone')); ?> </label>
                                                                    <input class="form--control" name="member_phone" value="<?php echo e(request()->get('member_phone')); ?>" type="text" placeholder="<?php echo e(__('Member Phone')); ?>">
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
                <!-- todolist table section start-->
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <h2 class="dashboard_table__title"> <?php echo e(__('All Team Members')); ?> </h2>
                    <div class="notice-board">
                        <p class="text-danger"><?php echo e(__('Include team members who work under your supervision')); ?></p>
                    </div>
                    <div class="dashboard_table__title__flex">
                        <h4 class="dashboard_table__title">  </h4>
                        <div class="btn-wrapper" data-bs-toggle="modal" data-bs-target="#openTicket">
                            <a href="javascript:void(0)"
                               class="dashboard_table__title__btn btn-bg-1 radius-5"
                               data-bs-toggle="modal"
                               data-bs-target="#addteammembermodel"><i class="fa-solid fa-plus"></i> <?php echo e(__('Add Team Member' )); ?></a>
                        </div>
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
                    <?php if($userDataWithCompany->count() >= 1): ?>
                        <div class="dashboard_table__main custom--table mt-4">
                            <table>
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Sr No.')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Username')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Phone')); ?></th>
                                    <th><?php echo e(__('Area')); ?></th>
                                    <th><?php echo e(__('City')); ?></th>
                                    <th><?php echo e(__('Country')); ?></th>
                                    <th><?php echo e(__('Post Code')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Actions')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($userDataWithCompany)): ?>
                                    <?php $__currentLoopData = $userDataWithCompany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $userData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($index+1); ?></td>
                                            <td><?php echo e($userData->name); ?></td>
                                            <td><?php echo e($userData->username); ?></td>
                                            <td><?php echo e($userData->email); ?></td>
                                            <td><?php echo e($userData->phone); ?></td>
                                            <td><?php echo e(optional($userData->area)->service_area); ?></td>
                                            <td><?php echo e(optional($userData->city)->service_city); ?></td>
                                            <td><?php echo e(optional($userData->country)->country); ?></td>
                                            <td><?php echo e($userData->post_code); ?></td>
                                            <td>
                                                <div class="dashboard-switch-single">
                                                    <?php if($userData->user_status==1): ?>
                                                        <span class="text-success"><?php echo e(__('Active')); ?></span>
                                                    <?php else: ?>
                                                        <span class="text-danger"><?php echo e(__('Inactive')); ?></span>
                                                    <?php endif; ?>
                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-member-status','data' => ['url' => route('seller.company.member.status',$userData->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-member-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.company.member.status',$userData->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dashboard-switch-single">
                                                    <a href="#0" class="edit_member_modal"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editMemberModal"
                                                    data-id="<?php echo e($userData->id); ?>"
                                                    data-name="<?php echo e($userData->name); ?>"
                                                    data-phone="<?php echo e($userData->phone); ?>"
                                                    data-email="<?php echo e(__($userData->email)); ?>"
                                                    data-address="<?php echo e($userData->address); ?>"
                                                    data-service_area="<?php echo e($userData->service_area); ?>"
                                                    data-service_city="<?php echo e($userData->service_city); ?>"
                                                    data-service_country="<?php echo e($userData->service_country); ?>"
                                                    data-post_code="<?php echo e($userData->post_code); ?>"
                                                    >
                                                        <span style="font-size:16px;" class="dash-icon color-1"> <i class="las la-edit"></i> </span>
                                                    </a>
                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-member-delete','data' => ['url' => route('seller.company.member.delete',$userData->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-member-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.company.member.delete',$userData->id))]); ?>
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
                                <?php else: ?>
                                        <td>Data Not Found</td>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="chat_wrapper__details__inner__chat__contents">
                            <h2 class="chat_wrapper__details__inner__chat__contents__para"><?php echo e(__('No Member Found')); ?></h2>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Team member Modal -->
    <div class="modal fade modal-lg" id="addteammembermodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Add Team Member')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('seller.company.add.member')); ?>" method="POST">
                            <input type="hidden" name="companyid" value="<?php echo e($companyData->id); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="memberfullname" class="label_title__postition"><?php echo e(__('Full Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form--control radius-10" name="memberfullname" placeholder="Full Name">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="memberusername" class="label_title__postition"><?php echo e(__('User Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form--control radius-10" name="memberusername" placeholder="User Name">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="memberemail" class="label_title__postition"><?php echo e(__('Email')); ?> <span class="text-danger">*</span> </label>
                                        <input type="email" class="form--control radius-10" name="memberemail" placeholder="Member Email">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="memberphone" class="label_title__postition"><?php echo e(__('Phone Number')); ?> <span class="text-danger">*</span> </label>
                                        <input type="tel" class="form--control radius-10" name="memberphone" placeholder="Member Phone Number">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition"><?php echo e(__('New Password')); ?> <span class="text-danger">*</span> </label>
                                        <input type="password" class="form--control radius-10" name="newpassword" placeholder="New Password">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="confirmPassword" class="label_title__postition"><?php echo e(__('Confirm Password')); ?> <span class="text-danger">*</span> </label>
                                        <input type="password" class="form--control radius-10" name="confirmpassword" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="country" class="label_title__postition"><?php echo e(__('Select Country')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="country_id_add_member" id="country_id_add_member">
                                                <?php if(!empty($countries)): ?>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service city" class="label_title__postition"><?php echo e(__('Select City')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_city_add_member" id="service_city_add_member">
                                                <?php if(!empty($cities)): ?>
                                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($city->id); ?>"><?php echo e($city->service_city); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service area" class="label_title__postition"><?php echo e(__('Select Area')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_area_add_member" id="service_area_add_member">
                                                <?php if(!empty($areas)): ?>
                                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($area->id); ?>"><?php echo e($area->service_area); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"><?php echo e(__('Add Member')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->

    <!-- Seller Company Edit Modal Start-->
    <div class="modal fade modal-lg" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Edit Company')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('seller.company.edit')); ?>" method="POST">
                            <input type="hidden" name="companyid" value="<?php echo e($companyData->id); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="name" class="label_title__postition"><?php echo e(__('Compnay Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form--control radius-10" name="companyname" value="<?php echo e($companyData->name); ?>" placeholder="Company Name">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="email" class="label_title__postition"><?php echo e(__('Company Email')); ?> <span class="text-danger">*</span> </label>
                                        <input type="email" class="form--control radius-10" name="companyemail" value="<?php echo e($companyData->email); ?>" placeholder="Company Email">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="phone" class="label_title__postition"><?php echo e(__('Company Phone Number')); ?> <span class="text-danger">*</span> </label>
                                        <input type="tel" class="form--control radius-10" name="companyphone" value="<?php echo e($companyData->phone); ?>" placeholder="Company Phone Number">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="country" class="label_title__postition"><?php echo e(__('Select Country')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="country_id" id="country_id">
                                                <?php if(!empty($countries)): ?>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($country->id); ?>" <?php if($country->id==$companyData->country_id): ?> selected <?php endif; ?>><?php echo e($country->country); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service city" class="label_title__postition"><?php echo e(__('Select City')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_city" id="service_city">
                                                <?php if(!empty($cities)): ?>
                                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($city->id); ?>" <?php if($city->id==$companyData->service_city): ?> selected <?php endif; ?>><?php echo e($city->service_city); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service area" class="label_title__postition"><?php echo e(__('Select Area')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_area" id="service_area">
                                                <?php if(!empty($areas)): ?>
                                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($area->id); ?>" <?php if($area->id==$companyData->service_area): ?> selected <?php endif; ?>><?php echo e($area->service_area); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition"><?php echo e(__('Company Address')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="companyaddress" value="<?php echo e($companyData->address); ?>" placeholder="Company Address">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition"><?php echo e(__('Post Code')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="companypost_code" value="<?php echo e($companyData->post_code); ?>" placeholder="Company Post Code">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="gstin" class="label_title__postition"><?php echo e(__('GSTIN Number')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="gstin" value="<?php echo e($companyData->gstin); ?>" placeholder="GSTIN Number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            <?php echo render_image_markup_by_attachment_id($companyData->image,'','thumb'); ?>

                                        </div>
                                        <input type="hidden" id="image" name="companyimage"
                                               value="<?php echo e($companyData->image); ?>">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-bs-toggle="modal"
                                                data-bs-target="#media_upload_modal">
                                            <?php echo e(__('Upload Company Image')); ?>

                                        </button>
                                    </div>
                                    <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                </div>

                                <div class="single-dashboard-input">
                                    <div class="single-info-input margin-top-30">
                                        <div class="form-group">
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    <?php echo render_image_markup_by_attachment_id($companyData->profile_background); ?>

                                                </div>
                                                <input type="hidden" id="profile_background" name="company_profile_background"
                                                       value="<?php echo e($companyData->profile_background); ?>">
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
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"><?php echo e(__('Update Company Info')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Seller Company Edit Modal End-->
    <!-- Member Edit Modal -->
    <div class="modal fade modal-lg" id="editMemberModal" tabindex="-1" aria-labelledby="memberUpdateModel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberUpdateModel"><?php echo e(__('Edit Member')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('seller.company.member.edit')); ?>" method="POST">
                            <input type="hidden" name="up_member_id" id = "up_member_id">
                            <?php echo csrf_field(); ?>
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="up_name" class="label_title__postition"><?php echo e(__('Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form--control radius-10" name="up_name" id="up_name" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="up_email" class="label_title__postition"><?php echo e(__('Email')); ?> <span class="text-danger">*</span> </label>
                                        <input type="email" class="form--control radius-10" name="up_email" id="up_email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="up_phone" class="label_title__postition"><?php echo e(__('Phone Number')); ?> <span class="text-danger">*</span> </label>
                                        <input type="tel" class="form--control radius-10" name="up_phone" id="up_phone" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="country" class="label_title__postition"><?php echo e(__('Select Country')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="country_id_update_member" id="country_id_update_member">
                                                <?php if(!empty($countries)): ?>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($country->id); ?>" ><?php echo e($country->country); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service_city" class="label_title__postition"><?php echo e(__('Select City')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_city_update_member" id="service_city_update_member">
                                                <?php if(!empty($cities)): ?>
                                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($city->id); ?>" ><?php echo e($city->service_city); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service_area" class="label_title__postition"><?php echo e(__('Select Area')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_area_update_member" id="service_area_update_member">
                                                <?php if(!empty($areas)): ?>
                                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($area->id); ?>" ><?php echo e($area->service_area); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="up_address" class="label_title__postition"><?php echo e(__('Address')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="up_address" id="up_address" placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="up_post_code" class="label_title__postition"><?php echo e(__('Post Code')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="up_post_code" id="up_post_code" placeholder="Post Code">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"><?php echo e(__('Update Member Info')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="dashboard__right">
        <!-- buyer header -->
        <?php echo $__env->make('frontend.user.buyer.header.buyer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="dashboard__body">
            <div class="dashboard__inner">
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <h2 class="dashboard_table__title"> <?php echo e(__('Add Company/Channel Details')); ?> </h2>
                    <div class="notice-board">
                        <p class="text-danger"><?php echo e(__('If you are associated with a service provider or channel partner, please add your organizations details below. This information will help us better understand your business and streamline our collaboration.')); ?></p>
                    </div>
                    <br>
                    <div class="dashboard_table__title__flex">
                        <h4 class="dashboard_table__title">  </h4>
                        <div class="btn-wrapper" data-bs-toggle="modal" data-bs-target="#openTicket">
                            <a href="javascript:void(0)"
                               class="dashboard_table__title__btn btn-bg-1 radius-5"
                               data-bs-toggle="modal"
                               data-bs-target="#addCompanyModal"><i class="fa-solid fa-plus"></i> <?php echo e(__('Add Company' )); ?></a>
                        </div>
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
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add Modal -->
    <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="couponModal" aria-hidden="true">
        <form action="<?php echo e(route('seller.company.add')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-block ">
                        <div class="row">
                            <div class="col-md-11">
                                <h4 class="modal-title" id="couponModal"><?php echo e(__('Add Company Deatils')); ?></h4>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <small class="text-info"><?php echo e(__('Add your company/channel deatils')); ?></small>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mt-3">
                            <label for="companyname" class="label_title"><?php echo e(__('Company Name')); ?> <span class="text-danger">*</span> </label>
                            <input type="text" name="companyname" id="companyname" class="form-control" placeholder="<?php echo e(__('Company Name')); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="companyemail" class="label_title"><?php echo e(__('Company Email')); ?> <span class="text-danger">*</span> </label>
                            <input type="text" name="companyemail" id="companyemail" class="form-control" placeholder="<?php echo e(__('Company Email')); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="companyphone" class="label_title"><?php echo e(__('Company Phone')); ?> <span class="text-danger">*</span> </label>
                            <input type="text" name="companyphone" id="companyphone" class="form-control" placeholder="<?php echo e(__('Company Phone')); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="companyaddress" class="label_title"><?php echo e(__('Company Address')); ?> <span class="text-danger">*</span> </label>
                            <input type="text" name="companyaddress" id="companyaddress" class="form-control" placeholder="<?php echo e(__('Company Address')); ?>">
                        </div>
                        <div class="form-group mt-3">        
                            <label for="country" class="label_title__postition"><?php echo e(__('Select Country')); ?> <span class="text-danger">*</span> </label>
                            <div class="single-input-select radius-10">
                                <select name="country_id_add" id="country_id_add">
                                    <?php if(!empty($countries)): ?>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>    
                        </div>
                        <div class="form-group mt-3">
                            <label for="service city" class="label_title__postition"><?php echo e(__('Select City')); ?> <span class="text-danger">*</span> </label>
                            <div class="single-input-select radius-10">
                                <select name="service_city_add" id="service_city_add">
                                    <?php if(!empty($cities)): ?>
                                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($city->id); ?>"><?php echo e($city->service_city); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="service area" class="label_title__postition"><?php echo e(__('Select Area')); ?> <span class="text-danger">*</span> </label>
                            <select name="service_area_add" id="service_area_add">
                                <?php if(!empty($areas)): ?>
                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($area->id); ?>"><?php echo e($area->service_area); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="companypostcode" class="label_title"><?php echo e(__('Company Post Code')); ?> <span class="text-danger">*</span> </label>
                            <input type="number" name="companypostcode" id="companypostcode" class="form-control" placeholder="<?php echo e(__('Company Post Code')); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="gstin" class="label_title"><?php echo e(__('GSTIN Number')); ?> <span class="text-danger">*</span> </label>
                            <input type="text" name="gstin" id="gstin" class="form-control" placeholder="<?php echo e(__('GSTIN Number')); ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Add')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>
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
                $('#country_id_add').select2({
                    dropdownParent: $('#addCompanyModal')
                });
                $('#service_city_add').select2({
                    dropdownParent: $('#addCompanyModal')
                });
                $('#service_area_add').select2({
                    dropdownParent: $('#addCompanyModal')
                });
                $('#country_id_add_member').select2({
                    dropdownParent: $('#addteammembermodel')
                });
                $('#service_city_add_member').select2({
                    dropdownParent: $('#addteammembermodel')
                });
                $('#service_area_add_member').select2({
                    dropdownParent: $('#addteammembermodel')
                });

                $('#country_id_update_member').select2({
                    dropdownParent: $('#editMemberModal')
                });
                $('#service_city_update_member').select2({
                    dropdownParent: $('#editMemberModal')
                });
                $('#service_area_update_member').select2({
                    dropdownParent: $('#editMemberModal')
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

                // change country and get city for edit model
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
                });

                // for add model
                $(document).on('change','#country_id_add' ,function() {
                    let country_id = $("#country_id_add").val();
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
                                        "'>" + value.service_city_add + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city_add + "</li>";
                                });
                                $("#service_city_add").html(alloptions);
                                $("#service_city_add").parent().find(".current").html("__('Select City')");
                                $("#service_city_add").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html("<?php echo e(__('Select Area')); ?>");
                                $(".service_area_wrapper .list").html("");

                                $('#service_city_add').select2({
                                    dropdownParent: $('#addCompanyModal')
                                });
                            }
                        }
                    })
                });

                // for add member model
                $(document).on('change','#country_id_add_member' ,function() {
                    let country_id = $("#country_id_add_member").val();
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
                                        "'>" + value.service_city_add + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city_add + "</li>";
                                });
                                $("#service_city_add_member").html(alloptions);
                                $("#service_city_add_member").parent().find(".current").html("__('Select City')");
                                $("#service_city_add_member").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html("<?php echo e(__('Select Area')); ?>");
                                $(".service_area_wrapper .list").html("");

                                $('#service_city_add_member').select2({
                                    dropdownParent: $('#addteammembermodel')
                                });
                            }
                        }
                    })
                });

                // for update member model
                $(document).on('change','#country_id_update_member' ,function() {
                    let country_id = $("#country_id_update_member").val();
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
                                        "'>" + value.service_city_add + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city_add + "</li>";
                                });
                                $("#service_city_update_member").html(alloptions);
                                $("#service_city_update_member").parent().find(".current").html("__('Select City')");
                                $("#service_city_update_member").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html("<?php echo e(__('Select Area')); ?>");
                                $(".service_area_wrapper .list").html("");

                                $('#service_city_update_member').select2({
                                    dropdownParent: $('#editMemberModal')
                                });
                            }
                        }
                    })
                });

                // For edit model
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

                // For add model
                $('#service_city_add').select2({
                  placeholder: `<?php echo e(__('search city')); ?>`,
                  ajax: {
                    type: 'get',
                    url: "<?php echo e(route('user.country.city.ajax.search')); ?>",
                    dataType: 'json',
                    data: function (params) {
                        let country_id = $("#country_id_add").val();
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

                // For add member model
                $('#service_city_add_member').select2({
                  placeholder: `<?php echo e(__('search city')); ?>`,
                  ajax: {
                    type: 'get',
                    url: "<?php echo e(route('user.country.city.ajax.search')); ?>",
                    dataType: 'json',
                    data: function (params) {
                        let country_id = $("#country_id_add_member").val();
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

                // For add update model
                $('#service_city_update_member').select2({
                  placeholder: `<?php echo e(__('search city')); ?>`,
                  ajax: {
                    type: 'get',
                    url: "<?php echo e(route('user.country.city.ajax.search')); ?>",
                    dataType: 'json',
                    data: function (params) {
                        let country_id = $("#country_id_update_member").val();
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

                // select city and area for edit model
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

                // for add model
                $(document).on('change','#service_city_add', function() {
                    var city_id = $("#service_city_add").val();
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

                                $("#service_area_add").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html("<?php echo e(__('Select Area')); ?>");

                                $('#service_area_add').select2({
                                    dropdownParent: $('#addCompanyModal')
                                });
                            }
                        }
                    });
                });

                // for add member model
                $(document).on('change','#service_city_add_member', function() {
                    var city_id_add_member = $("#service_city_add_member").val();
                    $.ajax({
                        method: 'post',
                        url: "<?php echo e(route('user.city.area')); ?>",
                        data: {
                            city_id: city_id_add_member
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

                                $("#service_area_add_member").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html("<?php echo e(__('Select Area')); ?>");

                                $('#service_area_add_member').select2({
                                    dropdownParent: $('#addteammembermodel')
                                });
                            }
                        }
                    });
                });

                // for add member model
                $(document).on('change','#service_city_update_member', function() {
                    var city_id_add_member = $("#service_city_update_member").val();
                    $.ajax({
                        method: 'post',
                        url: "<?php echo e(route('user.city.area')); ?>",
                        data: {
                            city_id: city_id_add_member
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

                                $("#service_area_update_member").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html("<?php echo e(__('Select Area')); ?>");

                                $('#service_area_update_member').select2({
                                    dropdownParent: $('#editMemberModal')
                                });
                            }
                        }
                    });
                });

            });
        })(jQuery);

        $(document).on('click','.member_status_button',function(e){
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__("Are you sure to change status?")); ?>',
                text: '<?php echo e(__("You will change it anytime!")); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('Yes, change it!')); ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.member_form_submit_btn').trigger('click');
                }
            });
        });

        $(document).on('click','.member_delete_button',function(e){
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
                    $(this).next().find('.member_form_submit_btn').trigger('click');
                }
            });
        });

        $(document).on('click','.edit_member_modal',function(e){
            e.preventDefault();
            let member_id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let phone = $(this).data('phone');
            let address = $(this).data('address');
            let service_area = $(this).data('service_area');
            let service_city = $(this).data('service_city');
            let service_country = $(this).data('service_country');
            let post_code = $(this).data('post_code');
            console.log("All Data : ", member_id, name, email, phone, address);
            $('#up_member_id').val(member_id);
            $('#up_name').val(name);
            $('#up_email').val(email);
            $('#up_phone').val(phone);
            $('#up_address').val(address);
            $('#up_service_area').val(service_area);
            $('#up_service_city').val(service_city);
            $('#up_service_country').val(service_country);
            $('#up_post_code').val(post_code);
            $('.nice-select').niceSelect('update');
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/company/partials/seller-company-two.blade.php ENDPATH**/ ?>