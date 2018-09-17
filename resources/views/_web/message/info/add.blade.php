
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid-theme.min.css')}}" rel="stylesheet">
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.css')}}" rel="stylesheet">
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
                            <h4 class="card-title modalTitle">Member Edit</h4>
                            <h6 class="card-subtitle">This is the basic horizontal form with labels on left and form controls on right in one line. To use add class <code>form-horizontal</code> to the form tag and give class <code>row</code> with form-group.</h6>
                        </div>
                        <hr>
                        <form class="form-horizontal">
                            <div class="card-body memberInfo-modal">
                                <h4 class="card-title">Personal Info</h4>
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">UserName</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vUserName" id="com1" placeholder="" value="{{$info->vUserName or ''}}">
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
                                        <input type="text" class="form-control vUserContact" id="com2" placeholder="" value="{{$info->vUserContact or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">UserAddress</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vUserAddress" id="com3" placeholder="" value="{{$info->vUserAddress or ''}}">
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
                                {{--<div class="form-group row">--}}
                                {{--<label class="col-sm-3 text-right control-label col-form-label">Interested In</label>--}}
                                {{--<div class="col-sm-9">--}}
                                {{--<select class="form-control">--}}
                                {{--<option>Choose Your Option</option>--}}
                                {{--<option>Desiging</option>--}}
                                {{--<option>Development</option>--}}
                                {{--<option>Videography</option>--}}
                                {{--</select>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                {{--<label class="col-sm-3 text-right control-label col-form-label">Budget</label>--}}
                                {{--<div class="col-sm-9">--}}
                                {{--<select class="form-control">--}}
                                {{--<option>Choose Your Option</option>--}}
                                {{--<option>Less then $5000</option>--}}
                                {{--<option>$5000 - $10000</option>--}}
                                {{--<option>$10000 - $20000</option>--}}
                                {{--</select>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if(isset($info))
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-dosave" data-id="{{$info->iMemberId or ''}}">Save</button>
                                    @else
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-doadd">Add</button>
                                    @endif
                                    <button type="button" class="btn btn-dark waves-effect waves-light btn-cancel">Cancel</button>
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
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            All Rights Reserved by Xtreme admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
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
        var url_index = "{{ url('web/'.implode( '/', $module ))}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        $(document).ready(function () {
            //
            var modal = $("#manage-modal");
            current_modal = modal.find('.memberInfo-modal');
            //
            $(".btn-cancel").click(function () {
                location.href = url_index;
            });
            //
            $(".btn-doadd").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
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
                data.vUserName = current_modal.find(".vUserName").val();
                data.vUserEmail = current_modal.find(".vUserEmail").val();
                data.vUserContact = current_modal.find(".vUserContact").val();
                data.vUserAddress = current_modal.find(".vUserAddress").val();
                data.vUserImage = current_modal.find("img").attr('src');
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
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->