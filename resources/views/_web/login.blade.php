@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style rel="stylesheet">
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
    <div class="page-wrapper">
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
                            <h4 class="card-title">水庫安全資訊管理系統</h4>
                            <h6 class="card-subtitle"> 電腦版僅「網站系統管理員」可登入 </h6>
                            <form class="m-t-30" action="{{url('home')}}" method="get">
                                <div class="warning"></div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">帳號(Account)</label>
                                    <input type="text" class="form-control vAccount" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Account">
                                    {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">密碼(Password)</label>
                                    <input type="password" class="form-control vPassword" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>使用者權限</label>
                                    <select class="custom-select col-12 iAcType" id="inlineFormCustomSelect">
                                        <option selected>Choose...</option>
                                        <option value="2">網站系統管理員</option>
                                        <option value="10">水庫管理員(各水庫負責人員)</option>
                                        <option value="20">水庫審查人員(審核送審人員)</option>
                                        <option value="30">中央水利署人員</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <a href="javascript:;" class="linkStyle forgetPw">忘記密碼?( Forget Password ? )?</a>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 m-b-15">
                                    <input type="checkbox" class="custom-control-input checkMeOut" id="checkbox0" value="check">
                                    <label class="custom-control-label" for="checkbox0">Check Me Out !</label>
                                </div>
                                <button type="button" class="btn btn-primary doLogin">登入(Login)</button>
                                <div class="success"></div>
                            </form>
                        </div>
                        <div class="card-body loginDiv2">
                            <div class="form-group">
                                <label>系統將會寄發密碼到您的工作信箱</label>
                                <span>帳號</span>
                                <input type="text" placeholder="Account" class="inputStyle forgetId">
                                <button class="backLogin">回登入頁</button>
                                <button class="btn-esend btn-forgotpw">送出</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row forgetpassword">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">水庫安全資訊管理系統</h4>
                            <h6 class="card-subtitle"> 電腦版僅「網站系統管理員」可登入 </h6>
                            <form class="m-t-30" action="{{url('home')}}" method="get">
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
                                <div class="form-group">
                                    <label>選擇您的使用者權限</label>
                                    <select class="custom-select col-12 iAcType2" id="inlineFormCustomSelect">
                                        <option value="0" selected>Choose...</option>
                                        <option value="2">網站系統管理員</option>
                                        <option value="10">水庫管理員(各水庫負責人員)</option>
                                        <option value="20">水庫審查人員(審核送審人員)</option>
                                        <option value="30">中央水利署人員</option>
                                    </select>
                                </div>
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
                        <h4 class="card-title">Sample Basic Forms</h4>
                        <h5 class="card-subtitle"> Bootstrap Elements </h5>
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
                                            <input type="checkbox" class="custom-control-input chkIagree" id="checkbox1" value="check">
                                            <label class="custom-control-label" for="checkbox1">
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
<!-- /content -->

@section('aside')
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
        <div class="customizer-body">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="mdi mdi-wrench font-20"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#chat" role="tab" aria-controls="chat" aria-selected="false"><i class="mdi mdi-message-reply font-20"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="mdi mdi-star-circle font-20"></i></a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 1 -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="p-15 border-bottom">
                        <!-- Sidebar -->
                        <h5 class="font-medium m-b-10 m-t-10">Layout Settings</h5>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="theme-view" id="theme-view">
                            <label class="custom-control-label" for="theme-view">Dark Theme</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input sidebartoggler" name="collapssidebar" id="collapssidebar">
                            <label class="custom-control-label" for="collapssidebar">Collapse Sidebar</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="sidebar-position" id="sidebar-position">
                            <label class="custom-control-label" for="sidebar-position">Fixed Sidebar</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="header-position" id="header-position">
                            <label class="custom-control-label" for="header-position">Fixed Header</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="boxed-layout" id="boxed-layout">
                            <label class="custom-control-label" for="boxed-layout">Boxed Layout</label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Logo Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Navbar BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Navbar Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin6"></a></li>
                        </ul>
                        <!-- Navbar BG -->
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Sidebar Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                </div>
                <!-- End Tab 1 -->
                <!-- Tab 2 -->
                <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="mailbox list-style-none m-t-20">
                        <li>
                            <div class="message-center chat-scroll">
                                <a href="javascript:void(0)" class="message-item" id='chat_user_1' data-user-id='1'>
                                    <span class="user-img"> <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle"> <span class="profile-status online pull-right"></span> </span>
                                    <div class="mail-contnet">
                                        <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_2' data-user-id='2'>
                                    <span class="user-img"> <img src="../../assets/images/users/2.jpg" alt="user" class="rounded-circle"> <span class="profile-status busy pull-right"></span> </span>
                                    <div class="mail-contnet">
                                        <h5 class="message-title">Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_3' data-user-id='3'>
                                    <span class="user-img"> <img src="../../assets/images/users/3.jpg" alt="user" class="rounded-circle"> <span class="profile-status away pull-right"></span> </span>
                                    <div class="mail-contnet">
                                        <h5 class="message-title">Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_4' data-user-id='4'>
                                    <span class="user-img"> <img src="../../assets/images/users/4.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                    <div class="mail-contnet">
                                        <h5 class="message-title">Nirav Joshi</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_5' data-user-id='5'>
                                    <span class="user-img"> <img src="../../assets/images/users/5.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                    <div class="mail-contnet">
                                        <h5 class="message-title">Sunil Joshi</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_6' data-user-id='6'>
                                    <span class="user-img"> <img src="../../assets/images/users/6.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                    <div class="mail-contnet">
                                        <h5 class="message-title">Akshay Kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_7' data-user-id='7'>
                                    <span class="user-img"> <img src="../../assets/images/users/7.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                    <div class="mail-contnet">
                                        <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_8' data-user-id='8'>
                                    <span class="user-img"> <img src="../../assets/images/users/8.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                    <div class="mail-contnet">
                                        <h5 class="message-title">Varun Dhavan</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End Tab 2 -->
                <!-- Tab 3 -->
                <div class="tab-pane fade p-15" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <h6 class="m-t-20 m-b-20">Activity Timeline</h6>
                    <div class="steamline">
                        <div class="sl-item">
                            <div class="sl-left bg-success"> <i class="ti-user"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                                <div class="desc">you can write anything </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-info"><i class="fas fa-image"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Send documents to Clark</div>
                                <div class="desc">Lorem Ipsum is simply </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="../../assets/images/users/2.jpg"> </div>
                            <div class="sl-right">
                                <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span></div>
                                <div class="desc">Contrary to popular belief</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="../../assets/images/users/1.jpg"> </div>
                            <div class="sl-right">
                                <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span></div>
                                <div class="desc">Approve meeting with tiger</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-primary"> <i class="ti-user"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                                <div class="desc">you can write anything </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-info"><i class="fas fa-image"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Send documents to Clark</div>
                                <div class="desc">Lorem Ipsum is simply </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="../../assets/images/users/4.jpg"> </div>
                            <div class="sl-right">
                                <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span></div>
                                <div class="desc">Contrary to popular belief</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="../../assets/images/users/6.jpg"> </div>
                            <div class="sl-right">
                                <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span></div>
                                <div class="desc">Approve meeting with tiger</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tab 3 -->
            </div>
        </div>
    </aside>
    <div class="chat-windows"></div>
@endsection

<!-- ================== page-js ================== -->
@section('page-js')
<!--  -->
<script type="text/javascript">
    function _initial(){
        $('.register').hide();
        $('.customizer').hide();
        $('.chat-windows').hide();
        //重設隱藏
        $('.forgetpassword').hide();
    }

    function check_field_no_empty( type = 'register'){
        if ($(".vAccount").val() === "") {
            $(".vAccount").focus();
            $('.warning').text( $(".vAccount").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
            return false;
        }
        if ($(".vPassword").val() === "") {
            $(".vPassword").focus();
            $('.warning').text( $(".vPassword").siblings('label').text() + '未填' , "{{trans('_web_alert.notice')}}");
            return false;
        }
        //
        if(type==='login'){
            if($('.iAcType').val() === 0) {
                $(".iAcType").focus();
                $('.warning').text($(".iAcType").siblings('label').text() + '未填', "{{trans('_web_alert.notice')}}");
                return false;
            }
            return true;
        }
        //
        if ( $(".vPassword").val().length < 6 || $(".vPassword").val().length > 24) {
            $(".vPassword").focus();
            $('.warning').text( $(".vPassword").attr('placeholder') + '' , "{{trans('_web_alert.notice')}}");
            return false;
        }
        if ($(".vPassword").val() !== $(".vPassword2").val()) {
            $('.warning').text( $(".vPassword2").siblings('label').text() + '錯誤' , "{{trans('_web_alert.notice')}}");
            $(".vPassword2").focus();
            return false;
        }
        if ( ! $(".chkIagree").is(":checked") ) {
            $('.warning').text( $(".chkIagree").siblings('label').text() + '未勾選' , "{{trans('_web_alert.notice')}}");
            $(".chkIagree").focus();
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

            check_field_no_empty();

            var data = {"_token": "{{ csrf_token() }}"};
            data.vAccount = $(".vAccount").val();
            data.vPassword = $(".vPassword").val();
            $.ajax({
                url: "{{url('doRegister')}}",
                data: data,
                type: "POST",
                resetForm: true,
                success: function (rtndata) {
                    // 1
                    if (rtndata.status) {
                        $('.success').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                        setTimeout(function () {
                            location.href = rtndata.rtnurl;
                        }, 1000)
                    // 0
                    } else {
                        $('.warning').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                    }
                },
                error: function ( rtndata ) {
                    $('.warning').text( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                }
            });
        });


        //登入
        $(".doLogin").click(function () {

            check_field_no_empty('login');

            var data = {"_token": "{{ csrf_token() }}"};
            data.vAccount = $(".vAccount").val();
            data.vPassword = $(".vPassword").val();
            $.ajax({
                url: "{{url('doLogin')}}",
                data: data,
                type: "POST",
                resetForm: true,
                success: function (rtndata) {
                    if (rtndata.status) {
                        $('.success').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                        // if ($('input[name=remember]').prop("checked")) {
                        //     localStorage.setItem('account', $(".email").val());
                        //     localStorage.setItem('password', $(".password").val());
                        //     localStorage.setItem('remember', true);
                        // } else {
                        //     localStorage.setItem('account', '');
                        //     localStorage.setItem('password', '');
                        //     localStorage.setItem('remember', false);
                        // }
                        setTimeout(function () {
                            location.href = rtndata.rtnurl;
                        }, 500)
                    } else {
                        $('.warning').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                    }
                },
                error: function ( rtndata ) {
                    $('.warning').text( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                }
            });
        });


        //忘記密碼
        $(".forgetPw").click(function () {
            $('.login').hide();
            var parent = $(this).parents('.forgetpassword');
            parent.show();

            if ( parent.find(".vVerification").val() === "" ) {
                parent.find(".vVerification").focus();
                $('.warning').text( parent.find(".vVerification").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                return false;
            }
            parent.find(".forgetPw").attr('disabled', 'disabled');

            var data = {"_token": "{{ csrf_token() }}"};
            // data.userId = parent.find(".forgeotpw-id").val();
            // data.vAccount = parent.find(".forgeotpw-email").val();
            data.vAccount = parent.find(".forgetId").val();

            $.ajax({
                url: "{{url('doSendVerification')}}",
                data: data,
                type: "POST",
                resetForm: true,
                success: function (rtndata) {
                    if (rtndata.status) {
                        $('.success').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                        parent.find('.login').hide();
                        parent.find('.forgetpassword').css({ display: 'inline-block' });
                    } else {
                        $('.warning').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                    }
                },
                error: function ( rtndata ) {
                    $('.warning').text( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                }
            });
        });


        //重設password
        $(".doResetPw").click(function () {
            var parent = $(this).parents('.forgetpassword');

            if ( parent.find(".vVerification").val() === "") {
                $('.warning').text( parent.find(".vVerification").attr('placeholder') , "{{trans('_web_alert.notice')}}");
                parent.find(".vVerification").focus();
                return false;
            }
            if ( parent.find(".vPasswordNew").val() === "") {
                $('.warning').text( parent.find(".vPasswordNew").attr('placeholder') , "{{trans('_web_alert.notice')}}");
                parent.find(".vPasswordNew").focus();
                return false;
            }
            if ( parent.find(".vPasswordNew").val() !== parent.find(".vPasswordNew2").val()) {
                $('.warning').text( parent.find(".vPasswordNew2").attr('placeholder')+'有誤' , "{{trans('_web_alert.notice')}}");
                parent.find(".vPasswordNew2").focus();
                return false;
            }
            if ( parent.find(".vPasswordNew").val().length < 6 || parent.find(".vPasswordNew").length > 24) {
                $('.warning').text( parent.find(".vPasswordNew2").attr('placeholder') + '長度(6~24)' , "{{trans('_web_alert.notice')}}");
                $(".vPasswordNew2").focus();
                return false;
            }

            var data = {"_token": "{{ csrf_token() }}"};
            data.vVerification = parent.find(".vVerification").val();
            // data.vPassword = CryptoJS.MD5($(".reset-pw").val()).toString(CryptoJS.enc.Base64);
            data.vPassword = $(".vPasswordNew").val();
            $.ajax({
                url: "{{url('doResetPassword')}}",
                data: data,
                type: "POST",
                resetForm: true,
                success: function (rtndata) {
                    if (rtndata.status) {
                        $('.success').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                        setTimeout(function () {
                            location.href = rtndata.rtnurl;
                        }, 500)
                    } else {
                        $('.warning').text( rtndata.message , "{{trans('_web_alert.notice')}}");
                    }
                },
                error: function ( rtndata ) {
                    $('.warning').text( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");
                }
            });
        });
    });
</script>
@endsection
<!-- ================== /inline-js ================== -->