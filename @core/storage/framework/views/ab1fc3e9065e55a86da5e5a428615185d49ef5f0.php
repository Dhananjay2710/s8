
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Add Services')); ?>

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
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('summernote.css'); ?>
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
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <style>
        .meta-content .bootstrap-tagsinput .tag {
            margin-right: 2px !important;
            color: #444 !important;
            font-size: 14px!important;
            line-height: 24px !important;
            padding: 3px 10px !important;
            border-radius: 3px !important;
            border: 1px solid #e2e2e2 !important;
        }
        .meta-content .bootstrap-tagsinput {
            width: 100%;
        }
        .close{
            border: none;
        }
        .note-editable{
            height: 200px;
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
                <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h4 class="dashboard_table__title"> <?php echo e(__('Add Service')); ?> </h4>
                                <?php $seller = App\SellerVerify::select('seller_id','status')->where('seller_id',Auth::guard('web')->user()->id)->first() ?>
                                <?php if(is_null($seller)): ?>
                                <div class="notice-board">
                                    <p class="text-danger"><?php echo e(__('You can not add services if you are not verified.')); ?></p>
                                </div>
                                <?php elseif($seller->status != 1): ?>
                                    <div class="notice-board">
                                        <p class="text-danger"><?php echo e(__('You can not add services if you are not verified.')); ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="notice-board mb-0" style="border-left:5px solid #9e9e9e !important;">
                                    <p class="text-secondary"><?php echo e(__('This part is common for both off/on line services. After create service you will redirect
                                    a page where you will create service attributes for offline or online.')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div> <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
                    <?php if(get_static_option('service_create_settings') == 'all_seller' || !is_null($seller) && $seller->status == 1): ?>
                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('add-service', [])->html();
} elseif ($_instance->childHasBeenRendered('iLyJe5E')) {
    $componentId = $_instance->getRenderedChildComponentId('iLyJe5E');
    $componentTag = $_instance->getRenderedChildComponentTagName('iLyJe5E');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('iLyJe5E');
} else {
    $response = \Livewire\Livewire::mount('add-service', []);
    $html = $response->html();
    $_instance->logRenderedChild('iLyJe5E', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
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
        <!-- Dashboard area end -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('summernote.js'); ?>
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
    <script>
        $('.meta-content').show();
    </script>
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
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){

                //media modal hide
                $(document).on('click', '.close', function () {
                    $("#media_upload_modal").modal('hide');
                });

                //Permalink Code
                $('.permalink_label').hide();
                $(document).on('keyup input', '#title', function (e) {
                    var slug = converToSlug($(this).val());
                    var url = "<?php echo e(url('/service/')); ?>/" + slug;
                    $('.permalink_label').show();
                    var data = $('#slug_show').text(url).css('color', 'blue');
                    $('.service_slug').val(slug);

                });

                //Slug Edit Code
                $(document).on('click', '.slug_edit_button', function (e) {
                    e.preventDefault();
                    $('.service_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                function converToSlug(slug){
                    let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                    //remove multiple space to single
                    finalSlug = slug.replace(/  +/g, ' ');
                    // remove all white spaces single or multiple spaces
                    finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                    return finalSlug;
                }

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.service_slug').val();
                    var slug = converToSlug(update_input);
                    var url = "<?php echo e(url('/service-list/')); ?>/" + slug;
                    $('#slug_show').text(url);
                    $('.service_slug').hide();
                });



                // service category and sub category
                $('#category').on('change',function(){
                    var category_id = $(this).val();
                    $.ajax({
                        method:'post',
                        url:"<?php echo e(route('seller.subcategory')); ?>",
                        data:{category_id:category_id},
                        success:function(res){
                            if(res.status=='success'){
                                var alloptions = "<option value=''><?php echo e(__('Select Sub Category')); ?></option>";
                                var allSubCategory = res.sub_categories;
                                $.each(allSubCategory,function(index,value){
                                    alloptions +="<option value='" + value.id + "'>" + value.name + "</option>";
                                });

                                $(".subcategory").html(alloptions);

                            }
                        }
                    })
                })


                // service sub category and child category
                $(document).on('change','#subcategory', function() {
                    var sub_cat_id = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "<?php echo e(route('seller.subcategory.child.category')); ?>",
                        data: {
                            sub_cat_id: sub_cat_id
                        },
                        success: function(res) {

                            if (res.status == 'success') {
                                var alloptions = "<option value=''><?php echo e(__('Select Child Category')); ?></option>";
                                var allList = "<li data-value='' class='option'><?php echo e(__('Select Child Category')); ?></li>";
                                var allChildCategory = res.child_category;

                                $.each(allChildCategory, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.name + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.name + "</li>";
                                });

                                $("#child_category").html(alloptions);
                                $(".child_category_wrapper ul.list").html(allList);
                                $(".child_category_wrapper").find(".current").html("Select Child Category");
                            }
                        }
                    })
                })


                $("#is_service_all_cities").on('change', function() {
                    if ($("#is_service_all_cities").is(':checked')){
                        $('#is_service_all_cities_id').val(1)
                    }else {
                        $('#is_service_all_cities_id').val('')
                    }
                });


                //total price
                $(document).on("change", ".include-price", function() {
                    var sum = 0;
                    $(".include-price").each(function() {
                        if(isNaN($(this).val())){
                            alert('Please Enter Numeric Value only')
                        }else{
                            sum += +$(this).val();
                        }
                    });
                    $("#service_total_price").val(sum);
                });

                // //include quantity
                // $(document).on("change", ".numeric-value", function() {
                //     if(isNaN($(this).val())){
                //         alert('Please Enter Numeric Value only')
                //     }
                // });


                // is service online
                $('.day_review_show_hide').hide()
                $('.faq_show_hide').show()
                $('.online_service_price_show_hide').hide()

                $("#is_service_online").on('change', function() {
                    if ($("#is_service_online").is(':checked')){
                        $('.is_service_online_hide').hide();
                        $('#is_service_online_id').val(1)
                        $('.day_review_show_hide').show()
                        $('.faq_show_hide').show()
                        $('.service-price-show-hide').hide()
                        $('.online_service_price_show_hide').show()
                    }else {
                        $('.is_service_online_hide').show();
                        $('#is_service_online_id').val('')
                        $('.day_review_show_hide').hide()
                        $('.faq_show_hide').hide()
                        $('.service-price-show-hide').show()
                        $('.online_service_price_show_hide').hide()

                    }
                });

            // service attribute js end
                $('#submitBtn').hide();
                // Service Add next previous tab js
                var totalTab = $('#add-service-tab .nav-link').length;
                var tabNavList = $('#add-service-tab .nav-link');
                let currentTabIndex = 1;

                $(document).on('click','#add-service-tab .nav-link', function () {
                    // console.log(totalTab,tabNavList.index($(this)));
                    if((totalTab - 1) === tabNavList.index($(this))){
                        // $('#nextBtn').text("Submit").attr('type', 'submit');
                        $('#nextBtn').hide();
                        $('#submitBtn').show();
                    }else{
                        $('#nextBtn').show();
                        $('#submitBtn').hide();
                    }

                })


                //service next and previous js start
                $(document).on('click','#nextBtn',function(e) {
                    let currentState = $('#add-service-tab .nav-link.active');
                    let currentContent = $('#add-service-tabContent .step.active');
                    currentTabIndex = currentState.index() + 1;

                    if(currentTabIndex === totalTab) {
                        return false;
                    }
                    if(currentTabIndex === totalTab - 1) {
                        // $(this).text("Submit").attr('type', 'submit');
                        $('#nextBtn').hide();
                        $('#submitBtn').show();
                    }else {
                        $('#nextBtn').show();
                        $('#submitBtn').hide();
                    }
                    currentState.removeClass('active show').next().addClass('active show');
                    currentState.next();

                    currentContent.siblings().removeClass('active show')
                    currentContent.removeClass('active show').next().addClass('active show');
                    currentContent.next();

                    currentTabIndex++;
                });

                $(document).on('click','#prevBtn',function(e) {
                    let currentState = $('#add-service-tab .nav-link.active');
                    let currentContent = $('#add-service-tabContent .step.active');

                    currentTabIndex = currentState.index() + 1;
                    if(currentTabIndex === 1) return ;

                    if(currentTabIndex === totalTab) {
                        $('#nextBtn').show();
                        $('#submitBtn').hide();
                    }else {
                        $('#nextBtn').show();
                        $('#submitBtn').hide();
                    }

                    currentState.removeClass('active show').prev().addClass('active show');
                    currentState.prev();

                    currentContent.siblings().removeClass('active show')
                    currentContent.removeClass('active show').prev().addClass('active show');
                    currentContent.prev();

                    currentTabIndex--;
                });
                //service next and previous js end

            })
        })(jQuery);

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/services/partials/add-service-two.blade.php ENDPATH**/ ?>