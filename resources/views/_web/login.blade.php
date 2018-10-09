
@extends('_web._layouts.login')

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
                                        @foreach($permission as $key => $value)
                                        <option value="{{$key or 10}}">{{$value or ''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="text-align: center">
                                    <button type="button" class="btn btn-primary doLogin">登入(Login)</button>
                                </div>
                            </form>
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
        //
    });
</script>
@endsection
<!-- ================== /inline-js ================== -->