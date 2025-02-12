<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Services')); ?>

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

        .img-wrap-new img {
            height: 100px;
            width: 100px;
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
                                <h4 class="dashboard_table__title"> <?php echo e(__('Edit Service')); ?> </h4>
                                <div class="notice-board info-board">
                                    <p class="text-info"><?php echo e(__('Edit service will need to admin approval to activate.')); ?></p>
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
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('edit-service', ['editServiceId' => $edit_service_id,'edit_service_id' => $edit_service_id])->html();
} elseif ($_instance->childHasBeenRendered('3MqW6jV')) {
    $componentId = $_instance->getRenderedChildComponentId('3MqW6jV');
    $componentTag = $_instance->getRenderedChildComponentTagName('3MqW6jV');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('3MqW6jV');
} else {
    $response = \Livewire\Livewire::mount('edit-service', ['editServiceId' => $edit_service_id,'edit_service_id' => $edit_service_id]);
    $html = $response->html();
    $_instance->logRenderedChild('3MqW6jV', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
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
                            var url = `<?php echo e(url('/service/')); ?>/` + slug;
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
                                $('#is_service_all_cities_id').val(0)
                            }
                        });

                        // service attribute js start
                        $(".add-what-includes").on('click',function(){
                            if ($("#is_service_online").is(':checked')){
                                $('.is_service_online_hide').hide();
                            }
                        })


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
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/services/partials/edit-service-two.blade.php ENDPATH**/ ?>