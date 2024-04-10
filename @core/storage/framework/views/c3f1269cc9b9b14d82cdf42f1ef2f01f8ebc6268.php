$('.icp-dd').iconpicker();
     $('.icp-dd').on('iconpickerSelected', function (e) {
    var selectedIcon = e.iconpickerValue;
    $(this).parent().parent().children('input').val(selectedIcon);
});<?php /**PATH /var/www/pinpointplus/s8/@core/resources/views/components/icon-picker.blade.php ENDPATH**/ ?>