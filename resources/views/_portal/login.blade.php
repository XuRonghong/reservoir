
@extends('_portal._layouts._1main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" type="text/css" href="{{asset('portal_assets/pc/css/login.css')}}">
    <style>
        header {
            display: none;
        }
    </style>
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!--  -->
    <section>
        <div class="wrap">

            <div class="loginBox">
                <ul class="nav nav-pills identity">
                    <li class="active">
                        <a data-toggle="pill" href="#employee">登入系統</a>
                    </li>
                    {{--<li class="active">--}}
                        {{--<a data-toggle="pill" href="#employee">萊雅員工</a>--}}
                    {{--</li>--}}
                    {{--<li class="">--}}
                        {{--<a data-toggle="pill" href="#company">外部企業</a>--}}
                    {{--</li>--}}
                </ul>

                <div class="loginForm">
                    <div class="logoBox">
                        <img src="{{asset('portal_assets/dist/img/logo2.png')}}" alt="">
                    </div>
                    <div class="tab-content">
                        <!-- 內部員工 -->
                        <div id="employee" class="tab-pane fade in active">
                            <ul class="form-list employee-list">
                                <li>
                                    <span>編號</span>
                                    <input type="text" placeholder="會員編號" class="inputStyle staff-id">
                                </li>
                                <li>
                                    <span>密碼</span>
                                    <input type="password" placeholder="會員密碼" class="inputStyle staff-pw">
                                </li>
                                <li class="split">
                                    <a href="javascript:;" class="linkStyle eForget">忘記密碼?</a>
                                    <button class="btn-eLogin staff-login">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i>登入
                                    </button>
                                </li>
                            </ul>

                            <ul class="form-list forget-list employee-forget">
                                <li class="txt">系統將會寄發密碼到您的工作信箱。</li>
                                <li>
                                    <span>會員編號</span>
                                    <input type="text" placeholder="會員編號" class="inputStyle forgeotpw-id">
                                </li>
                                <li class="btn-group">
                                    <button class="back-eLogin">回登入頁</button>
                                    <button class="btn-esend btn-forgotpw">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>送出
                                    </button>
                                </li>
                            </ul>

                            <ul class="form-list secondStage" id="verification" >
                                <li>
                                    <span>請輸入臨時密碼</span>
                                    <input type="text" class="inputStyle vVerification" placeholder="請輸入臨時密碼" >
                                </li>
                                <li>
                                    <span>請輸入新密碼</span>
                                    <input type="password" class="inputStyle reset-pw" placeholder="請輸入新密碼" >
                                </li>
                                <li>
                                    <span>再次確認密碼</span>
                                    <input type="password" class="inputStyle reset-pw-rpy" placeholder="再次輸入新密碼" >
                                </li>
                                <li class="split">
                                    <button class="btn-cLogin btn-reset">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i>送出
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- 外部企業 -->
                        <div id="company" class="tab-pane fade">
                            <ul class="nav nav-pills companyPanel">
                                <li class="active">
                                    <a data-toggle="pill" href="#comLogin">登入</a>
                                </li>
                                <li class="">
                                    <a data-toggle="pill" href="#register">註冊</a>
                                </li>
                                <li class="myline"></li>
                            </ul>

                            <div class="tab-content">
                                <div id="comLogin" class="tab-pane fade in active">
                                    <ul class="form-list company-list">
                                        <li>
                                            <span>帳號</span>
                                            <input type="text" class="inputStyle login-email" placeholder="公司E-mail" >
                                        </li>
                                        <li>
                                            <span>密碼</span>
                                            <input type="password" class="inputStyle login-pw" placeholder="密碼" >
                                        </li>
                                        <li class="split">
                                            <a href="javascript:;" class="linkStyle cForget forget-pw">忘記密碼?</a>
                                            <button class="btn-login">
                                                <i class="fa fa-sign-in" aria-hidden="true"></i>登入
                                            </button>
                                        </li>
                                    </ul>

                                    <ul class="form-list forget-list company-forget">
                                        <li class="txt">系統將會寄發密碼到您的信箱。</li>
                                        <li>
                                            <span>帳號</span>
                                            <input type="text" class="inputStyle forgeotpw-email" placeholder="密碼寄送郵件">
                                        </li>
                                        <li class="btn-group">
                                            <button class="back-cLogin">回登入頁</button>
                                            <button class="btn-esend btn-forgotpw">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>送出
                                            </button>
                                        </li>
                                    </ul>

                                    <ul class="form-list secondStage" id="verification" >
                                        <li>
                                            <span>請輸入臨時密碼</span>
                                            <input type="text" class="inputStyle vVerification" placeholder="請輸入臨時密碼" >
                                        </li>
                                        <li>
                                            <span>請輸入新密碼</span>
                                            <input type="password" class="inputStyle reset-pw" placeholder="請輸入新密碼" >
                                        </li>
                                        <li>
                                            <span>再次確認密碼</span>
                                            <input type="password" class="inputStyle reset-pw-rpy" placeholder="再次輸入新密碼" >
                                        </li>
                                        <li class="split">
                                            <button class="btn-cLogin btn-reset">
                                                <i class="fa fa-sign-in" aria-hidden="true"></i>送出
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div id="register" class="tab-pane fade">
                                    <ul class="form-list registerList">
                                        <li>
                                            <span>帳&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;號</span>
                                            <input type="text" placeholder="公司E-mail" class="inputStyle input-email">
                                        </li>
                                        {{--<li>--}}
                                            {{--<span>公司</span>--}}
                                            {{--<select class="companyList inputStyle select-company">--}}
                                                {{--<option value="">123</option>--}}
                                            {{--</select>--}}
                                        {{--</li>--}}
                                        <li>
                                            <span>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;碼</span>
                                            <input type="password" placeholder="數字或英文(長度6~16)" class="inputStyle input-pw">
                                        </li>
                                        <li>
                                            <span>確認密碼</span>
                                            <input type="password" placeholder="數字或英文(長度6~16)" class="inputStyle input-pw-rpy">
                                        </li>
                                        <li class="split">
                                            <div>
                                                <input type="checkbox" class="proCheck chk-iagree">
                                                <span>
												我同意
												<a href="javascript:;" class="linkStyle">服務條款</a>
											</span>
                                            </div>
                                            <button class="btn-register">
                                                <i class="fa fa-sign-in" aria-hidden="true"></i>註冊
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script src="{{asset('portal_assets/pc/js/login.js')}}" type="text/javascript"></script>
    <!-- Plugin Customer-->
    <script type="text/javascript" src="{{asset('_assets/CryptoJS/rollups/md5.js')}}"></script>
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <script>
        $(document).ready(function () {

            //重設隱藏
            $('.secondStage').hide();

            //註冊
            $(".btn-register").click(function () {
                if ($(".input-email").val() == "") {
                    $(".input-email").focus();
                    toastr.error( $(".input-email").attr('placeholder') + ' 未  填 ' , "{{trans('_web_alert.notice')}}");
                    return false;
                }
                if ($(".input-pw").val() == "") {
                    $(".input-pw").focus();
                    toastr.error( $(".input-pw").siblings('span').text() + ' 未  填 ' , "{{trans('_web_alert.notice')}}");
                    return false;
                }
                if ( $(".input-pw").val().length < 6 || $(".input-pw").val().length > 16) {
                    toastr.error( $(".input-pw").attr('placeholder') + '' , "{{trans('_web_alert.notice')}}");
                    $(".input-pw").focus();
                    return false;
                }
                if ($(".input-pw").val() != $(".input-pw-rpy").val()) {
                    toastr.error( $(".input-pw-rpy").siblings('span').text() + '錯誤' , "{{trans('_web_alert.notice')}}");
                    $(".input-pw-rpy").focus();
                    return false;
                }
                if ( ! $(".chk-iagree").is(":checked") ) {
                    toastr.error( $(".chk-iagree").siblings('span').text() + '未勾選' , "{{trans('_web_alert.notice')}}");
                    $(".chk-iagree").focus();
                    return false;
                }

                var data = {"_token": "{{ csrf_token() }}"};
                data.vAccount = $(".input-email").val();
                data.vPassword = CryptoJS.MD5($(".input-pw").val()).toString(CryptoJS.enc.Base64);
                $.ajax({
                    url: "{{url('doRegister')}}",
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        // 1
                        if (rtndata.status) {
                            toastr.success( rtndata.message , "{{trans('_web_alert.notice')}}");

                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
                        // 0
                        } else {
                            toastr.error( rtndata.message , "{{trans('_web_alert.notice')}}");
                        }
                    },
                    error: function ( rtndata ) {
                        toastr.error( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                    }
                });
            });

            //登入
            $(".btn-login").click(function () {
                if ($(".login-email").val() == "") {
                    toastr.error( $(".login-email").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                    $(".login-email").focus();
                    return false;
                }
                if ($(".login-pw").val() == "") {
                    toastr.error( $(".login-pw").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                    $(".login-pw").focus();
                    return false;
                }
                var data = {"_token": "{{ csrf_token() }}"};
                data.vAccount = $(".login-email").val();
                data.vPassword = CryptoJS.MD5($(".login-pw").val()).toString(CryptoJS.enc.Base64);
                $.ajax({
                    url: "{{url('doLogin')}}",
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success( rtndata.message , "{{trans('_web_alert.notice')}}");

                            if ($('input[name=remember]').prop("checked")) {
                                localStorage.setItem('account', $(".email").val());
                                localStorage.setItem('password', $(".password").val());
                                localStorage.setItem('remember', true);
                            } else {
                                localStorage.setItem('account', '');
                                localStorage.setItem('password', '');
                                localStorage.setItem('remember', false);
                            }
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 500)
                        } else {
                            toastr.error( rtndata.message , "{{trans('_web_alert.notice')}}");
                        }
                    },
                    error: function ( rtndata ) {
                        toastr.error( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                    }
                });
            });

            //內部登入
            $(".staff-login").click(function () {

                if ($(".staff-id").val() == "") {
                    toastr.error( $(".staff-id").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                    return false;
                }
                if ($(".staff-pw").val() == "") {
                    toastr.error( $(".staff-pw").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                    return false;
                }

                var data = {"_token": "{{ csrf_token() }}"};
                // data.userId =  $(".staff-id").val();
                data.vAccount =  $(".staff-id").val();
                //data.vPassword = CryptoJS.MD5($(".staff-pw").val()).toString(CryptoJS.enc.Base64);
                data.vPassword = $(".staff-pw").val();
                $.ajax({
                    url: "{{url('doLogin')}}",
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success( rtndata.message , "{{trans('_web_alert.notice')}}");

                            if ($('input[name=remember]').prop("checked")) {
                                localStorage.setItem('account', $(".staff-id").val());
                                localStorage.setItem('password', $(".staff-pw").val());
                                localStorage.setItem('remember', true);
                            } else {
                                localStorage.setItem('account', '');
                                localStorage.setItem('password', '');
                                localStorage.setItem('remember', false);
                            }
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 500)
                        } else {
                            toastr.error( rtndata.message , "{{trans('_web_alert.notice')}}");
                        }
                    },
                    error: function ( rtndata ) {
                        toastr.error( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                    }
                });
            });

            //忘記密碼
            $(".btn-forgotpw").click(function () {
                var parent = $(this).parents('.fade');
                
                if ( parent.find(".forgeotpw-email").val() == "" ) {
                    toastr.error( parent.find(".forgeotpw-email").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                    parent.find(".forgeotpw-email").focus();
                    return false;
                }
                parent.find(".btn-forgotpw").attr('disabled', 'disabled');

                var data = {"_token": "{{ csrf_token() }}"};
                // data.userId = parent.find(".forgeotpw-id").val();
                // data.vAccount = parent.find(".forgeotpw-email").val();
                data.vAccount = parent.find(".forgeotpw-id").val();

                $.ajax({
                    url: "{{url('doSendVerification')}}",
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success( rtndata.message , "{{trans('_web_alert.notice')}}");

                            parent.find('.forget-list').hide();
                            parent.find('.secondStage').css({ display: 'inline-block' });

                        } else {
                            toastr.error( rtndata.message , "{{trans('_web_alert.notice')}}");
                        }
                    },
                    error: function ( rtndata ) {
                        toastr.error( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                    }
                });
            });

            $(".btn-forgotpw2").click(function () {
                data = {};
                data.UID = '';
                data.PWD = '';
                {{--data.SB = '{{ urlencode('subject') }}';--}}
                {{--data.MSG = '{{ urlencode('content') }}';--}}
                {{--data.DEST = '{{ urlencode('0960003839') }}';--}}
                {{--data.ST = '';--}}
                $.ajax({
                    //url: 'https://sms.lorealuxe.com/loreal/API21/HTTP/sendSMS.ashx',
                    url: encodeURI('https://sms.lorealuxe.com/loreal/API21/HTTP/getCredit.ashx'),
                    data: data,
                    type: "GET",
                    resetForm: true,
                    dataType: 'text',
                    success: function (rtndata) {
                        {{--if (rtndata.status) {--}}
                        {{--toastr.success( rtndata.message , "{{trans('_web_alert.notice')}}");--}}

                        {{--parent.find('.forget-list').hide();--}}
                        {{--parent.find('.secondStage').css({ display: 'inline-block' });--}}

                        {{--} else {--}}
                        toastr.success( rtndata , "{{trans('_web_alert.notice')}}");
                        // }
                    },
                    error: function (a,b,c) {
                        toastr.error( a+','+b+','+c , "{{trans('_web_alert.notice')}}");
                        // }
                    },
                });
            });

            //重設password
            $(".btn-reset").click(function () {

                var parent = $(this).parents('.fade');

                if ( parent.find(".vVerification").val() == "") {
                    toastr.error( parent.find(".vVerification").attr('placeholder') , "{{trans('_web_alert.notice')}}");
                    parent.find(".vVerification").focus();
                    return false;
                }
                if ( parent.find(".reset-pw").val() == "") {
                    toastr.error( parent.find(".reset-pw").attr('placeholder') , "{{trans('_web_alert.notice')}}");
                    parent.find(".reset-pw").focus();
                    return false;
                }
                if ( parent.find(".reset-pw").val() != parent.find(".reset-pw-rpy").val()) {
                    toastr.error( parent.find(".reset-pw-rpy").attr('placeholder')+'有誤' , "{{trans('_web_alert.notice')}}");
                    parent.find(".reset-pw-rpy").focus();
                    return false;
                }
                if ( parent.find(".reset-pw").val().length < 6 || parent.find(".reset-pw").length > 16) {
                    toastr.error( parent.find(".reset-pw").attr('placeholder') + '長度(6~16)' , "{{trans('_web_alert.notice')}}");
                    $(".input-pw").focus();
                    return false;
                }

                var data = {"_token": "{{ csrf_token() }}"};
                data.vVerification = parent.find(".vVerification").val();
                // data.vPassword = CryptoJS.MD5($(".reset-pw").val()).toString(CryptoJS.enc.Base64);
                data.vPassword = $(".reset-pw").val();
                $.ajax({
                    url: "{{url('doResetPassword')}}",
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success( rtndata.message , "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 500)
                        } else {
                            toastr.error( rtndata.message , "{{trans('_web_alert.notice')}}");
                        }
                    },
                    error: function ( rtndata ) {
                        toastr.error( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                    }
                });
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->