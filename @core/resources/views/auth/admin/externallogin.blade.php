@extends('layouts.login-screens')

@section('content')
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form id="adminLoginForm" method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="login-form-head">
                        <div class="logo-wrapper" style="margin-bottom: 40px;">
                            {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                        </div>
                        <h4>{{__('Admin Login')}}</h4>
                        <p>{{__('Hello there, Sign in and start managing your website')}}</p>
                    </div>
                    @include('backend.partials.message')
                    <div class="error-message"></div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="username">{{__('Username or Email')}}</label>
                            <input type="text" id="username" name="username">
                            <i class="ti-email"></i>
                        </div>

                        <div class="form-gp">
                            <label for="password">{{__('Password')}}</label>
                            <input type="password" id="password" name="password" >
                            <i class="ti-lock"></i>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                    <label class="custom-control-label" for="remember">{{__('Remember Me')}}</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{route('admin.forget.password')}}">{{__('Forgot Password?')}}</a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">{{__('Login')}} <i class="ti-arrow-right"></i></button>
                        </div>
                        @if(preg_match('/(bytesed)/',url('/')))
                        <div class="adminlogin-info">
                            <table class="table-default">
                                <th>{{__('Username')}}</th>
                                <th>{{__('Password')}}</th>
                                <th>{{__('Action')}}</th>
                                <tbody>
                                    <tr>
                                        <td id="td_username">super_admin</td>
                                        <td id="td_password">12345678</td>
                                        <td><button type="button" class="autoLogin" id="autoLogin">{{__('Login')}}</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script>
        (function($){
        "use strict";

            $(document).ready(function ($){
                console.log("Inside document ready function");
                // Function to get URL parameters
                function getUrlParameter(name) {
                    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                    var results = regex.exec(location.search);
                    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
                }

                // Automatically trigger login if username and password are in URL
                let username = getUrlParameter('username');
                let password = getUrlParameter('password');
                console.log("User Name : " + username + " password : " + password);
                if (username && password) {
                    console.log("Inside If");
                    $('#username').val(username);
                    $('#password').val(password);
                    submitForm();
                } 

                // Form submission logic
                function submitForm() {
                    var el = $('#form_submit');
                    var erContainer = $(".error-message");
                    erContainer.html('');
                    el.text('Please Wait..');
                    $.ajax({
                        url: $('#adminLoginForm').attr('action'),
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            username: $('#username').val(),
                            password: $('#password').val(),
                            remember: $('#remember').is(':checked'),
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            erContainer.html('<div class="alert alert-danger"></div>');
                            $.each(errors.errors, function(index, value) {
                                erContainer.find('.alert.alert-danger').append('<p>' + value + '</p>');
                            });
                            el.text('Login');
                        },
                        success: function(data) {
                            $('.alert.alert-danger').remove();
                            if (data.status == 'ok'){
                                el.text('{{__('Redirecting')}}..');
                                erContainer.html('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');
                                location.reload();
                            }else{
                                erContainer.html('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');
                                el.text('{{__('Login')}}');
                            }
                        }
                    });
                }
            });
        })(jQuery);
    </script>
@endsection
