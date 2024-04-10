<script>
    (function ($){

        $(document).ready(function (){

            //todo: if the wallet checkbox is checked need to show this value as current seleted payment gateway
            $(document).on('click', '.wallet_selected_payment_gateway',function(){
                let wallet_value = $(this).val();
                $('.wallet-payment-gateway-wrapper .wallet_selected_payment_gateway').addClass('selected');
                if($('.wallet_selected_payment_gateway').is(':checked')){
                    $('.payment-gateway-wrapper #order_from_user_wallet').val('wallet');
                }else {
                    $('.payment-gateway-wrapper #order_from_user_wallet').val('');
                }
            });

            $(document).on('click', '.current_balance_selected_gateway',function(){
                $('.payment-gateway-wrapper li').removeClass('active');
                $('.payment-gateway-wrapper li').removeClass('selected');
                $('.current-balance-wrapper .current_balance_selected_gateway').addClass('selected');
                $('.payment-gateway-wrapper #order_from_user_wallet').val('current_balance');
            });


        //new add start
            // select payment gateway
            $(document).on('click', '.paymentGateway_add__item',function(){
                let value = $(this).data('gateway');
                $('#order_from_user_wallet').val(value);

                // manual payment image option show/hide
                if(value == 'manual_payment'){
                    $('.manual_payment_gateway_extra_field').show();
                }else {
                    $('.manual_payment_gateway_extra_field').hide();
                }
            });

            // for wallet
            $(document).on('click', '#wallet_selected_payment_gateway',function(){
                $('.confirm-payment').find('#order_from_user_wallet').val('wallet');
            });

            // select manual payment gateway
            if($('#order_from_user_wallet').val() == 'manual_payment'){
                $('.manual_payment_gateway_extra_field').show();
            }else {
                $('.manual_payment_gateway_extra_field').hide();
            }
        //new add end

        });

    })(jQuery);

</script>