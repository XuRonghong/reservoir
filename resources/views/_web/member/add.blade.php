
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid-theme.min.css')}}" rel="stylesheet">
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.css')}}" rel="stylesheet">
    <style>
        .btn {
            margin-left: 20px;
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
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
    @include('_web._layouts.breadcrumb')
    <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <div class="col-12">
                    <div class="card" id="manage-modal">
                        <div class="card-body">
                            <h4 class="card-title modalTitle">Member Add </h4>
                            <h6 class="card-subtitle">This is the basic horizontal form with labels on left and form controls on right in one line. To use add class <code>form-horizontal</code> to the form tag and give class <code>row</code> with form-group.</h6>
                        </div>
                        <hr>
                        <form class="form-horizontal">
                            <div class="card-body member-modal">
                                <h4 class="card-title">沒有要更改密碼,不需填寫</h4>
                                @if(isset($info))
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">帳號</label>
                                        <div class="col-sm-9">
                                            {{$info->vAccount or ''}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname1" class="col-sm-3 text-right control-label col-form-label">舊密碼</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control vPassword" id="lname1" placeholder="密碼" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname2" class="col-sm-3 text-right control-label col-form-label">新密碼</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control vPassword1" id="lname2" placeholder="密碼" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname22" class="col-sm-3 text-right control-label col-form-label">確認新密碼</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control vPassword2" id="lname22" placeholder="確認密碼" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname3" class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="button" class="btn btn-danger waves-effect waves-light btn-doresetpw" data-id="{{$info->iId or ''}}">更改密碼</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group row">
                                        <label for="fname1" class="col-sm-3 text-right control-label col-form-label">帳號</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control vAccount" id="fname1" placeholder="帳號" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname4" class="col-sm-3 text-right control-label col-form-label">密碼</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control vPassword1" id="lname4" placeholder="密碼" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname5" class="col-sm-3 text-right control-label col-form-label">確認密碼</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control vPassword2" id="lname5" placeholder="確認密碼" value="">
                                        </div>
                                    </div>
                                @endif
                                @if(session('member.iAcType')<10 && session('member.iAcType')>1)
                                <h4 class="card-title">管理</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">權限</label>
                                    <div class="col-sm-9">
                                        <select class="form-control iAcType">
                                            {{--<option value="0" selected>Choose...</option>--}}
                                            <option value="2">網站系統管理員</option>
                                            <option value="10">水庫管理員(各水庫負責人員)</option>
                                            <option value="20">水庫審查人員(審核送審人員)</option>
                                            <option value="30">中央水利署人員</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <hr>
                            <div class="card-body memberInfo-modal">
                                <h4 class="card-title">Info</h4>
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">UserName</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vUserName" id="com1" placeholder="UserName" value="{{$info->vUserName or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email1" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control vEmail" id="email1" placeholder="Email Here" value="{{$info->vUserEmail or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label">UserContact</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vUserContact" id="com2" placeholder="UserContact" value="{{$info->vUserContact or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">UserAddress</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vUserAddress" id="com3" placeholder="UserAddress" value="{{$info->vUserAddress or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img1" class="col-sm-3 text-right control-label col-form-label">UserPicture</label>
                                    <div class="col-sm-9">
                                        <a class="btn-image-modal" data-modal="image-form" data-id="">
                                            <img src="{{$info->vUserImage or url('images/empty.jpg')}}" style="height:140px">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if(isset($info))
                                        @if(session('member.iAcType')<10)
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-dosave" data-id="{{$info->iId or ''}}">Save</button>
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-next">Next</button>
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-doadd">Add</button>
                                    @endif
                                    <button type="button" class="btn btn-dark waves-effect waves-light btn-cancel">Cancel</button>
                                    <button type="button" class="btn btn-dark waves-effect waves-light btn-back">Back</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Row -->
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
@endsection

<!-- ================== page-js ================== -->
@section('page-js')
    <!--This page JavaScript -->
    <script src="{{url('xtreme-admin/dist/js/pages/tables/js-grid-db.js')}}"></script>
    <script src="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.js')}}"></script>
    <script src="{{url('xtreme-admin/dist/js/pages/tables/js-grid-init.js')}} "></script>
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <!-- Public Crop_Image -->
    @include('_web._js.crop_image')
    <!-- end -->
    <!-- Public SummerNote -->
    @include('_web._js.summernote')
    <!-- end -->
    <script type="text/javascript">
        var current_data = [];
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_doresetpw = "{{ url('web/'.implode( '/', $module ).'/dosavepassword')}}";
        $(document).ready(function () {
            //
            var modal = $("#manage-modal");
            current_modal = modal.find('.member-modal');
            next_modal = modal.find('.memberInfo-modal');
            next_modal.hide();
            modal.find('.btn-doadd').hide();
            modal.find('.btn-back').hide();
            //
            $(".btn-cancel").click(function () {
                // location.href = url_index;
                history.back();
            });
            //
            $(".btn-back").click(function () {
                next_modal.hide();
                current_modal.show();
                modal.find('.btn-doadd').hide();
                modal.find('.btn-next').show();
                modal.find('.btn-back').hide();
                modal.find('.btn-cancel').show();
                modal.find('.modalTitle').text('Member Add');
            });
            //
            $(".btn-next").click(function () {
                modal.find('.modalTitle').text('Member Information Add');
                current_modal.hide();
                next_modal.show();
                modal.find('.btn-doadd').show();
                modal.find('.btn-next').hide();
                modal.find('.btn-back').show();
                modal.find('.btn-cancel').hide();
                current_modal = modal;
            });
            //
            $(".btn-doadd").click(function () {
                check_field_no_empty(modal);
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.vAccount = current_modal.find(".vAccount").val();
                data.vPassword1 = current_modal.find(".vPassword1").val();
                data.vPassword2 = current_modal.find(".vPassword2").val();
                data.iAcType = current_modal.find(".iAcType").val();
                // data.iSum = $(".iSum").val();
                data.vUserName = current_modal.find(".vUserName").val();
                data.vUserEmail = current_modal.find(".vUserEmail").val();
                data.vUserContact = current_modal.find(".vUserContact").val();
                data.vUserAddress = current_modal.find(".vUserAddress").val();
                data.vUserImage = current_modal.find("img").attr('src');
                //
                $.ajax({
                    url: url_doadd,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                });
            });
            //
            $(".btn-dosave").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = $(this).data('id');
                data.iAcType = $(".iAcType").val();
                //
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                });
            });
            //
            $(".btn-doresetpw").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = $(this).data('id');
                data.vPassword = current_modal.find(".vPassword").val();
                data.vPassword1 = current_modal.find(".vPassword1").val();
                data.vPasswordNew = current_modal.find(".vPassword2").val();
                if (data.vPassword1 != data.vPasswordNew) {
                    toastr.error('確認密碼錯誤', "{{trans('_web_alert.notice')}}");
                    return ;
                }
                $.ajax({
                    url: url_doresetpw,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    },
                    error: function (rtndata) {
                        toastr.error(rtndata, "{{trans('_web_alert.notice')}}");
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
                    }
                });
            });
            //
            $(".iAcType").change(function () {
                swal({
                    title: '提醒',//"{{trans('_web_alert.del.title')}}",
                    text: '更改權限的話,某些權限的功能可能無法使用.\n' +
                        '(網頁版只有網站管理員可以登入)',//"{{trans('_web_alert.del.note')}}",
                    type: "warning",
                    showCancelButton: false,
                    cancelButtonText: "{{trans('_web_alert.cancel')}}",
                    confirmButtonColor: "#0c9b00",
                    confirmButtonText: "{{trans('_web_alert.ok')}}",
                    closeOnConfirm: true
                }, );
            });
        });

        function check_field_no_empty( module ){
            if (module.find(".vAccount").val() === "") {
                module.find(".vAccount").focus();
                toastr.info( module.find(".vAccount").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                return false;
            }
            if (module.find(".vPassword1").val() === "") {
                module.find(".vPassword1").focus();
                toastr.info( module.find(".vPassword1").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                return false;
            }
            if (module.find(".vUserName").val() === "") {
                module.find(".vUserName").focus();
                toastr.info( module.find(".vUserName").attr('placeholder') + '未填' , "{{trans('_web_alert.notice')}}");
                return false;
            }
            return true;
        }
    </script>
@endsection
<!-- ================== /inline-js ================== -->