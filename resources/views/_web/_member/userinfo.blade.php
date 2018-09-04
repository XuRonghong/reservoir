@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!--  -->
    <div id="content">
        <!-- Bread crumb is created dynamically -->
        <!-- row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-7 col-md-offset-1 col-lg-offset-2">
                            <div class="well well-light well-sm no-margin no-padding">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div id="myCarousel" class="carousel fade profile-carousel">
                                            <div class="air air-bottom-right padding-10">
                                                {{--<a href="javascript:void(0);" class="btn txt-color-white bg-color-teal btn-sm"><i class="fa fa-check"></i> Follow</a>&nbsp;--}}
                                                {{--<a href="javascript:void(0);" class="btn txt-color-white bg-color-pinkDark btn-sm"><i class="fa fa-link"></i> Connect</a>--}}
                                            </div>
                                            <div class="air air-top-left padding-10">
                                                <h4 class="txt-color-white font-md">{{date('Y/m/d',time())}}</h4>
                                            </div>
                                            <div class="carousel-inner">
                                                <!-- Slide 1 -->
                                                <div class="item active">
                                                    <img src="/web_assets/v3/img/demo/s1.jpg" alt="demo user">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-3 profile-pic">
                                                <img src="{{session('member.info.vUserImage')}}" alt="{{session('member.info.vUserName')}}">
                                            </div>
                                            <div class="col-sm-6">
                                                <h1>{{$info->vUserName}} ({{$info->vUserNameE}})
                                                    <br>
                                                    <small>{{session('member.vAccount')}}</small>
                                                </h1>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-key"></i>&nbsp;&nbsp;<a class="btn txt-color-white bg-color-pinkDark btn-sm btn-password">修改密碼</a>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$info->vUserContact}}</span>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-envelope"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$info->vUserEmail}}</span>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{date('Y/m/d',$info->iUserBirthday)}}</span>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <a class="pull-right btn txt-color-white bg-color-teal btn-sm btn-edit">修改資料</a>
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('web.admin.member.edit')}}</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.username')}}</label>
                            <div class="col-md-10">
                                <input class="form-control vUserName" id="vUserName" placeholder="{{trans('web.admin.member.username')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.username_en')}}</label>
                            <div class="col-md-10">
                                <input class="form-control vUserNameE" id="vUserNameE" placeholder="{{trans('web.admin.member.username_en')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.user_title')}}</label>
                            <div class="col-md-10">
                                <input class="form-control vUserTitle" id="vUserTitle" placeholder="{{trans('web.admin.member.user_title')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.user_id')}}</label>
                            <div class="col-md-10">
                                <input class="form-control vUserID" id="vUserID" placeholder="{{trans('web.admin.member.user_id')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.user_birthday')}}</label>
                            <div class="col-md-10">
                                <input class="form-control datepicker iUserBirthday" data-dateformat="yy/mm/dd" id="iUserBirthday"
                                       placeholder="{{trans('web.admin.member.user_birthday')}}" type="date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.user_email')}}</label>
                            <div class="col-md-10">
                                <input class="form-control vUserEmail" id="vUserEmail" placeholder="{{trans('web.admin.member.user_email')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.user_contact')}}</label>
                            <div class="col-md-10">
                                <input class="form-control vUserContact" id="vUserContact" placeholder="{{trans('web.admin.member.user_contact')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.user_zipcode')}}</label>
                            <div class="col-md-10">
                                <input class="form-control vUserZipCode" id="vUserZipCode" placeholder="{{trans('web.admin.member.user_zipcode')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.user_city')}}</label>
                            <div class="col-md-10">
                                <input class="form-control vUserCity" id="vUserCity" placeholder="{{trans('web.admin.member.user_city')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.user_area')}}</label>
                            <div class="col-md-10">
                                <input class="form-control vUserArea" id="vUserArea" placeholder="{{trans('web.admin.member.user_area')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('web.admin.member.user_address')}}</label>
                            <div class="col-md-10">
                                <input class="form-control vUserAddress" id="vUserAddress" placeholder="{{trans('web.admin.member.user_address')}}" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                    <button type="button" class="btn btn-primary btn-dosave">{{trans('web.dosave')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!--Modals-->
    <div class="modal fade" id="modal_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center" id="modal-title">
                        修改密碼
                    </h4>
                </div>
                <div class="modal-body text-center">
                    <div class="modal-text" id="modal-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control vPassword" id="vPassword" placeholder="請輸入舊密碼" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control vPassword_new" id="vPassword_new" placeholder="請輸入新密碼" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control vPassword_confirm" id="vPassword_confirm" placeholder="確認新密碼" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                        <button type="button" class="btn btn-primary btn-dosave-password">{{trans('web.dosave')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script type="text/javascript" src="/_assets/CryptoJS/rollups/md5.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var url_dosave = "{{ url('web/member/userinfo/dosave')}}";
        $(document).ready(function () {
            // DO NOT REMOVE : GLOBAL FUNCTIONS!
            $(".btn-edit").click(function () {
                var modal = $("#edit-modal");
                modal.find(".vUserName").val("{{$info->vUserName}}");
                modal.find(".vUserNameE").val("{{$info->vUserNameE}}");
                modal.find(".vUserTitle").val("{{$info->vUserTitle}}");
                modal.find(".vUserID").val("{{$info->vUserID}}");
                modal.find(".iUserBirthday").val("{{date('Y-m-d',$info->iUserBirthday)}}");
                modal.find(".vUserEmail").val("{{$info->vUserEmail}}");
                modal.find(".vUserContact").val("{{$info->vUserContact}}");
                modal.find(".vUserZipCode").val("{{$info->vUserZipCode}}");
                modal.find(".vUserCity").val("{{$info->vUserCity}}");
                modal.find(".vUserArea").val("{{$info->vUserArea}}");
                modal.find(".vUserAddress").val("{{$info->vUserAddress}}");
                modal.modal();
            })
            //
            $(".btn-dosave").click(function () {
                var modal = $("#edit-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.vUserName = modal.find('.vUserName').val();
                data.vUserNameE = modal.find('.vUserNameE').val();
                data.vUserTitle = modal.find('.vUserTitle').val();
                data.vUserID = modal.find('.vUserID').val();
                data.iUserBirthday = modal.find('.iUserBirthday').val();
                data.vUserEmail = modal.find('.vUserEmail').val();
                data.vUserContact = modal.find('.vUserContact').val();
                data.vUserZipCode = modal.find('.vUserZipCode').val();
                data.vUserCity = modal.find('.vUserCity').val();
                data.vUserArea = modal.find('.vUserArea').val();
                data.vUserAddress = modal.find('.vUserAddress').val();
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            modal.modal('toggle');
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function () {
                                location.reload();
                            }, 1000)
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            })

            //
            $(".btn-password").click(function () {
                var modal = $('#modal_password');
                modal.modal('show');
            });
            //
            $(".btn-dosave-password").click(function () {
                var obj = $(this).closest('#modal_password');
                if (obj.find("#vPassword").val() == "") {
                    modal_show({title: 'Password', content: 'Password empty'});
                    obj.find("#vPassword").focus();
                    return false;
                }
                if (obj.find("#vPassword_new").val() == "") {
                    modal_show({title: 'Password', content: 'Password empty'});
                    obj.find("#vPassword_new").focus();
                    return false;
                }
                if (obj.find("#vPassword_new").val() != obj.find("#vPassword_confirm").val()) {
                    modal_show({title: 'ConfirmPassword', content: 'Confirm Password Not Good'});
                    return false;
                }
                var data = {"_token": "{{ csrf_token() }}"};
                data.vPassword = CryptoJS.MD5(obj.find("#vPassword").val()).toString(CryptoJS.enc.Base64);
                data.vPasswordNew = CryptoJS.MD5(obj.find("#vPassword_new").val()).toString(CryptoJS.enc.Base64);
                $.ajax({
                    url: "{{url('web/member/userinfo/dosavepassword')}}",
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            modal.modal('toggle');
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function () {
                                location.reload();
                            }, 1000)
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            })
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
