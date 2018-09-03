
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style rel="stylesheet" type="text/css" >
    </style>
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')



@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!-- Plugin Customer-->
    <script type="text/javascript" >

    </script>
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        $(document).ready(function () {

            //判斷會員3個顯示哪個區塊
            var control = '{{$control or ''}}';
            if(control==="resetpw")     //area 3
            {
                //修改密碼
                $('.fixPw').click();
            }
            else if(control==="member")         //area 2
            {
                //會員資料
                $('.mydata').click();    //來先按到會員資料效果
            }

            //更改會員資料
            $(".btn-save").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                //基本資料
                data.vUserName  = $(".vUserName").val();
                data.vUserNameE  = $(".vUserNameE").val();
                data.vDepartment     = $(".vDepartment").val();
                data.vUserTitle  = $(".vUserTitle").val();
                data.vUserID  = $(".vUserID").val();
                data.iUserBirthday  = $(".iUserBirthday").val();
                //聯絡資料
                data.vUserContact = $(".vUserContact").val();
                data.vUserEmail =   $(".vUserEmail").val();
                data.vUserZipCode = $(".zipcode").val();
                data.vUserCity =    $(".vUserCity").val();
                data.vUserArea =    $(".vUserArea").val();
                data.vUserAddress = $(".address").val();

                $.ajax({
                    url: "{{url('member_center/dosave')}}",
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success( rtndata.message , '{{trans('_web_alert.notice')}}');
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 500);
                        } else {
                            toastr.error( rtndata.message , '{{trans('_web_alert.notice')}}');
                        }
                    }
                });
            });

            // 更改密碼
            $(".btn-save-pw").click(function () {
                var old_pw = $(".old_pw");
                var pw = $(".new_pw");
                var pw_rpy = $(".new_pwrpy");

                if( old_pw.val() === ""){
                    toastr.error( old_pw.attr('placeholder')+'{{trans('_portal.noipt')}}',
                        '{{trans('_web_alert.notice')}}');
                    return;
                }
                if( pw.val() === ""){
                    toastr.error( pw.parent('.inputOuter').siblings('span').text()+'{{trans('_portal.noipt')}}',
                        '{{trans('_web_alert.notice')}}');
                    return;
                }
                if( pw.val().length < 6 || pw.val().length > 16){
                    toastr.error(
                        pw.parent('.inputOuter').siblings('span').text() +
                        '{{trans('_portal.member_center.input_than_6')}}' ,
                        '{{trans('_web_alert.notice')}}'
                    );
                    return;
                }
                if( pw_rpy.val() === ""){
                    toastr.error( pw_rpy.attr('placeholder')+'{{trans('_portal.noipt')}}',
                        '{{trans('_web_alert.notice')}}');
                    return;
                }
                if( pw.val() !== pw_rpy.val() ){
                    toastr.error( pw_rpy.attr('placeholder') + ' 不正確 ' , '{{trans('_web_alert.notice')}}');
                    return;
                }

                var data = {"_token": "{{ csrf_token() }}"};
                //data.vPassword      = CryptoJS.MD5( old_pw.val() ).toString(CryptoJS.enc.Base64);
                data.vPassword      =  old_pw.val() ;
                // data.vPasswordNew   = CryptoJS.MD5( pw.val() ).toString(CryptoJS.enc.Base64);
                data.vPasswordNew   =  pw.val() ;
                $.ajax({
                    url: "{{url('member_center/dosavepassword')}}",
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success( rtndata.message , '{{trans('_web_alert.notice')}}');
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 500);
                        } else {
                            toastr.error( rtndata.message , '{{trans('_web_alert.notice')}}');
                        }
                    }
                });
            })
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->