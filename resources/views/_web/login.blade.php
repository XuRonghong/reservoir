
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!-- This page plugin CSS -->

    <!--  -->
    <style rel="stylesheet">
        #body01 {
{{--            background: url( '{{url("images/kalen-emsley-99666-unsplash.jpg")}}' );--}}
        }
        .warning {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper" style="margin: 0%">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row login">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body loginDiv1">
                            <h3 class="card-title">水庫安全資訊管理系統</h3>
                            <h6 class="card-subtitle"> 電腦版僅「網站系統管理員」可登入 </h6>
                            <form class="m-t-30" id="login-form1">
                                <div class="warning"></div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">帳號(Account)</label>
                                    <input type="text" class="form-control vAccount" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Account" value="">
                                    {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">密碼(Password)</label>
                                    <input type="password" class="form-control vPassword" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>使用者權限</label>
                                    <select class="custom-select col-12 iAcType" id="inlineFormCustomSelect">
                                        {{--<option value="0" selected>Choose...</option>--}}
                                        <option value="2">網站系統管理員</option>
                                        <option value="10">水庫管理員(各水庫負責人員)</option>
                                        <option value="20">水庫審查人員(審核送審人員)</option>
                                        <option value="30">中央水利署人員</option>
                                    </select>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<a href="javascript:;" class="linkStyle forgetPw">忘記密碼?( Forget Password ? )?</a>--}}
                                {{--</div>--}}
                                {{--<div class="custom-control custom-checkbox mr-sm-2 m-b-15">--}}
                                    {{--<input type="checkbox" class="custom-control-input checkMeOut" id="checkbox0" value="check">--}}
                                    {{--<label class="custom-control-label" for="checkbox0">Check Me Out !</label>--}}
                                {{--</div>--}}
                                {{--<div class="custom-control custom-checkbox mr-sm-2 m-b-15">--}}
                                    {{--<input type="checkbox" class="custom-control-input" id="checkbox1" name="remember" value="">--}}
                                    {{--<label class="custom-control-label" for="checkbox1">Remeber Me</label>--}}
                                {{--</div>--}}
                                <div class="form-group" style="text-align: center">
                                    <button type="button" class="btn btn-primary doLogin">登入(Login)</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body loginDiv2">
                            <div class="form-group">
                                <label>系統將會寄發密碼到您的工作信箱</label>
                                <div class="form-group">
                                    <span>帳號</span>
                                    <input type="text" placeholder="Account" class="inputStyle forgetUs">
                                    {{--<input type="text" placeholder="UserId" class="inputStyle forgetId">--}}
                                    <button class="backLogin">回登入頁</button>
                                    <button class="btn-esend btnVerification">送出驗證碼</button>
                                    <span class="warning"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row forgetpassword">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">水庫安全資訊管理系統</h3>
                            <h6 class="card-subtitle"> 電腦版僅「網站系統管理員」可登入 </h6>
                            <form class="m-t-30" id="login-form2">
                                <div class="warning"></div>
                                <div class="form-group">
                                    <label for="verification">請輸入臨時密碼</label>
                                    <input type="text" class="form-control vVerification" id="verification" aria-describedby="emailHelp" placeholder="請輸入臨時密碼">
                                    {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                                </div>
                                <div class="form-group">
                                    <label for="rePw">請輸入新密碼</label>
                                    <input type="password" class="form-control vPasswordNew" id="rePw" placeholder="請輸入新密碼">
                                </div>
                                <div class="form-group">
                                    <label for="rePw2">再次確認密碼</label>
                                    <input type="password" class="form-control vPasswordNew2" id="rePw2" placeholder="再次輸入新密碼">
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<label>選擇您的使用者權限</label>--}}
                                    {{--<select class="custom-select col-12 iAcType" id="inlineFormCustomSelect2">--}}
                                        {{--<option value="0" selected>Choose...</option>--}}
                                        {{--<option value="2">網站系統管理員</option>--}}
                                        {{--<option value="10">水庫管理員(各水庫負責人員)</option>--}}
                                        {{--<option value="20">水庫審查人員(審核送審人員)</option>--}}
                                        {{--<option value="30">中央水利署人員</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                <button type="button" class="btn btn-primary doResetPw">密碼變更</button>
                                <div class="success"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row register">
                <div class="col-12">
                    <div class="card card-body">
                        <h4 class="card-title">會員註冊</h4>
                        <h5 class="card-subtitle"> 加入會員即可使用服務 </h5>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form>
                                    <div class="warning"></div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">Account</label>
                                        <input type="text" class="form-control vAccount" id="exampleInputEmail111" placeholder="Enter username">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">Email</label>
                                        <input type="email" class="form-control vUserEmail" id="exampleInputEmail12" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword11">Password</label>
                                        <input type="password" class="form-control vPassword" id="exampleInputPassword11" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword12">Confirm Password</label>
                                        <input type="password" class="form-control vPassword2" id="exampleInputPassword12" placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input chkIagree" id="checkbox2" value="check">
                                            <label class="custom-control-label" for="checkbox2">
                                                我同意<a href="javascript:;" class="linkStyle">服務條款</a>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success m-r-10 doSignIn">註冊</button>
                                    <button type="button" class="btn btn-dark doInputReset">重填</button>
                                    <div class="success"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection


<!-- ================== page-js ================== -->
@section('page-js')
    <!--This page plugins -->

    <!--  -->
    <script type="text/javascript">
        function _initial(){
            $('.preloader').hide();
            $('.topbar').hide();
            $('.left-sidebar').hide();
            $('.register').hide();
            $('.customizer').hide();
            $('.chat-windows').hide();
            //重設隱藏
            $('.loginDiv2').hide();
            $('.forgetpassword').hide();
        }

        function check_field_no_empty( module , type ){
            if (module.find(".vAccount").val() === "") {
                module.find(".vAccount").focus();
                module.find('.warning').text( module.find(".vAccount").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                return false;
            }
            if (module.find(".vPassword").val() === "") {
                module.find(".vPassword").focus();
                module.find('.warning').text( module.find(".vPassword").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                return false;
            }
            //
            if(type==='login'){
                if(module.find('.iAcType').val() == 0) {
                    module.find(".iAcType").focus();
                    module.find('.warning').text(module.find(".iAcType").siblings('label').text() + '未選', "{{trans('_web_alert.notice')}}");
                    return false;
                }
                return true;
            }
            //
            if ( module.find(".vPassword").val().length < 6 || module.find(".vPassword").val().length > 24) {
                module.find(".vPassword").focus();
                module.find('.warning').text( module.find(".vPassword").attr('placeholder') + '' , "{{trans('_web_alert.notice')}}");
                return false;
            }
            if (module.find(".vPassword").val() !== module.find(".vPassword2").val()) {
                module.find('.warning').text( module.find(".vPassword2").siblings('label').text() + '錯誤' , "{{trans('_web_alert.notice')}}");
                module.find(".vPassword2").focus();
                return false;
            }
            if ( !module.find(".chkIagree").is(":checked") ) {
                module.find('.warning').text( module.find(".chkIagree").siblings('label').text() + '未勾選' , "{{trans('_web_alert.notice')}}");
                module.find(".chkIagree").focus();
                return false;
            }
            return true;
        }
    </script>
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
<script type="text/javascript">
    $(function () {
        _initial();

        //註冊
        $(".doSignIn").click(function () {
            var module = $('.register');
            if ( !check_field_no_empty( module , 'register'))return;

            var data = {"_token": "{{ csrf_token() }}"};
            data.vAccount = module.find(".vAccount").val();
            data.vPassword = module.find(".vPassword").val();
            $.ajax({
                url: "{{url('web/doRegister')}}",
                data: data,
                type: "POST",
                resetForm: true,
                success: function (rtndata) {
                    // 1
                    if (rtndata.status) {
                        toastr.success( rtndata.message, "{{trans('_web_alert.notice')}}");
                        setTimeout(function () {
                            location.href = rtndata.rtnurl;
                        }, 1000)
                    // 0
                    } else {
                        toastr.error( rtndata.message , "{{trans('_web_alert.notice')}}");
                    }
                },
                error: function ( rtndata ) {
                    toastr.info( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                }
            });
        });

        //登入
        $(".doLogin").click(function () {
            var module = $('.login');
            if ( !check_field_no_empty(module , 'login') )return;

            var data = {"_token": "{{ csrf_token() }}"};
            data.vAccount = module.find(".vAccount").val();
            data.vPassword = module.find(".vPassword").val();
            data.iAcType = module.find('.iAcType').val();
            $.ajax({
                url: "{{$url_dologin}}",
                data: data,
                type: "POST",
                resetForm: true,
                success: function (rtndata) {
                    if (rtndata.status) {
                        toastr.success( rtndata.message , "{{trans('_web_alert.notice')}}");

                        //
                        if (rtndata.isMobile){
                            document.location = "js://checkIsApp?ID=" + rtndata.id;
                        }
                        setTimeout(function () {
                            location.href = rtndata.rtnurl;
                        }, 500)
                    } else {
                        toastr.error( rtndata.message , "{{trans('_web_alert.notice')}}");
                    }
                },
                error: function ( rtndata ) {
                    toastr.info( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                }
            });
        });

        //忘記密碼
        $(".forgetPw").click(function () {
            $('.loginDiv1').hide();
            $('.loginDiv2').show();
        });

        //按"返回"
        $('.backLogin').click(function () {
            $('.loginDiv1').show();
            $('.loginDiv2').hide();
        });

        //寄送驗證碼到信箱重新設定密碼
        $('.btnVerification').click(function () {
            parent = $(this).parents('.login');

            if ( parent.find(".forgetUs").val() === "" ) {
                parent.find(".forgetUs").focus();
                parent.find('.warning').text( parent.find(".forgetUs").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                return false;
            }

            parent.find(".forgetPw").attr('disabled', 'disabled');
            var data = {"_token": "{{ csrf_token() }}"};
            data.iUserId = parent.find(".forgetId").val();
            // data.vAccount = parent.find(".forgeotpw-email").val();
            data.vAccount = parent.find(".forgetUs").val();

            $.ajax({
                url: "{{url('web/doSendVerification')}}",
                data: data,
                type: "POST",
                resetForm: true,
                success: function (rtndata) {
                    if (rtndata.status) {
                        toastr.success( rtndata.message , "{{trans('_web_alert.notice')}}");
                        parent.hide();
                        $('.forgetpassword').css({ display: 'inline-block' });
                    } else {
                        parent.find('.warning').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                    }
                },
                error: function ( rtndata ) {
                    parent.find('.warning').text( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                }
            });
        });

        //重設password
        $(".doResetPw").click(function () {
            var parent = $(this).parents('.forgetpassword');

            if ( parent.find(".vVerification").val() === "") {
                parent.find('.warning').text( parent.find(".vVerification").attr('placeholder') , "{{trans('_web_alert.notice')}}");
                parent.find(".vVerification").focus();
                return false;
            }
            if ( parent.find(".vPasswordNew").val() === "") {
                parent.find('.warning').text( parent.find(".vPasswordNew").attr('placeholder') , "{{trans('_web_alert.notice')}}");
                parent.find(".vPasswordNew").focus();
                return false;
            }
            if ( parent.find(".vPasswordNew").val() !== parent.find(".vPasswordNew2").val()) {
                parent.find('.warning').text( parent.find(".vPasswordNew2").attr('placeholder')+'有誤' , "{{trans('_web_alert.notice')}}");
                parent.find(".vPasswordNew2").focus();
                return false;
            }
            if ( parent.find(".vPasswordNew").val().length < 6 || parent.find(".vPasswordNew").length > 24) {
                parent.find('.warning').text( parent.find(".vPasswordNew2").attr('placeholder') + '長度(6~24)' , "{{trans('_web_alert.notice')}}");
                parent.find(".vPasswordNew2").focus();
                return false;
            }

            var data = {"_token": "{{ csrf_token() }}"};
            data.vVerification = parent.find(".vVerification").val();
            // data.vPasswordNew = CryptoJS.MD5($(".reset-pw").val()).toString(CryptoJS.enc.Base64);
            data.vPasswordNew = parent.find(".vPasswordNew").val();
            $.ajax({
                url: "{{url('web/doResetPassword')}}",
                data: data,
                type: "POST",
                resetForm: true,
                success: function (rtndata) {
                    if (rtndata.status) {
                        parent.find('.success').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                        setTimeout(function () {
                            location.href = rtndata.rtnurl;
                        }, 1000)
                    } else {
                        parent.find('.warning').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                    }
                },
                error: function ( rtndata ) {
                    parent.find('.warning').text( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                }
            });
        });
    });
</script>
@endsection
<!-- ================== /inline-js ================== -->