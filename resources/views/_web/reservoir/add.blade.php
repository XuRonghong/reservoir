
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
                    <div class="card"  id="edit-modal">
                        <div class="card-body">
                            <h4 class="card-title">Project Assigning</h4>
                            <h6 class="card-subtitle">This is the basic horizontal form with labels on left and form controls on right in one line. To use add class <code>form-horizontal</code> to the form tag and give class <code>row</code> with form-group.</h6>
                        </div>
                        <hr>
                        <form class="form-horizontal">
                            <div class="card-body">
                                <h4 class="card-title">Personal Info</h4>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">地區別</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vRegion" id="fname" placeholder="地區別" value="{{$info->vRegion or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">水庫或壩堰名稱</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vName" id="lname" placeholder="水庫或壩堰名稱" value="{{$info->vName or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">詳細地址</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vLocation" id="lname" placeholder="詳細地址" value="{{$info->vLocation or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">壩堰位置</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vCounty" id="lname" placeholder="壩堰位置" value="{{$info->vCounty or ''}}">
                                    </div>
                                </div>
                                {{--<div class="form-group row">--}}
                                {{--<label for="lname" class="col-sm-3 text-right control-label col-form-label">sum</label>--}}
                                {{--<div class="col-sm-9">--}}
                                {{--<input type="number" class="form-control iSum" id="lname" placeholder="sum">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                {{--<label for="email1" class="col-sm-3 text-right control-label col-form-label">Email</label>--}}
                                {{--<div class="col-sm-9">--}}
                                {{--<input type="email" class="form-control" id="email1" placeholder="Email Here">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <hr>
                            <div class="card-body">
                                <h4 class="card-title">Info</h4>
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">安全值</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control iSafeValue" id="com1" placeholder="安全值" value="{{$info->iSafeValue or ''}}">
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


                                {{--@if( isset($info))--}}
                                    {{--<div class="form-group" style="min-height:300px;max-width:100%;">--}}
                                        {{--<label class="control-label col-md-1">PC</label>--}}
                                        {{--<div class="btn-image-modal col-md-5 vImages" data-modal="image-form"--}}
                                             {{--data-id="{{$info->vImages}}">--}}
                                            {{--@forelse($info->images as $key => $image)--}}
                                                {{--<div class="image-box">--}}
                                                    {{--<img src="{{$image}}" id="Image">--}}
                                                {{--</div>--}}
                                            {{--@empty--}}
                                                {{--<div class="image-box">--}}
                                                    {{--<img src="{{asset('images/empty.jpg')}}" id="Image">--}}
                                                {{--</div>--}}
                                            {{--@endforelse--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="col-sm-1 col-md-1 col-lg-1 control-label">{{trans('web.images')}}</label>--}}
                                        {{--<div class="col-md-10 cropper_image">--}}
                                            {{--@foreach($info->vImages as $key => $var)--}}
                                                {{--<div class="image-box">--}}
                                                    {{--<img id="{{$key}}" src="{{$var}}"> <a class="image-del">X</a>--}}
                                                {{--</div>--}}
                                            {{--@endforeach--}}
                                            {{--<a class="btn-image-modal" data-modal="image-form" data-id="">--}}
                                                {{--@if(count($info->vImages) < 5)--}}
                                                    {{--<img id="Image" data-data="" src="/images/empty.jpg">--}}
                                                {{--@endif--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--@else--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="col-sm-1 col-md-1 col-lg-1 control-label">{{trans('web.images')}}</label>--}}
                                        {{--<div class="col-md-10 cropper_image">--}}
                                            {{--<a class="btn-image-modal" data-modal="image-form" data-id="">--}}
                                                {{--<img id="Image" data-data="" src="{{url('images/empty.jpg')}}" style="width: 15%">--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--@endif--}}



                                {{--<div class="form-group row">--}}
                                    {{--<label class="col-sm-3 text-right control-label col-form-label">水庫照片</label>--}}
                                    {{--<div class="col-sm-9">--}}
                                        {{--<div class="input-group mb-3">--}}
                                            {{--<div class="input-group-prepend">--}}
                                                {{--<span class="input-group-text">Upload</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="custom-file">--}}
                                                {{--<input type="file" class="custom-file-input vImages" id="inputGroupFile01">--}}
                                                {{--<label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                {{--<label for="abpro" class="col-sm-3 text-right control-label col-form-label">About Project</label>--}}
                                {{--<div class="col-sm-9">--}}
                                {{--<input type="text" class="form-control" id="abpro" placeholder="About Project Here">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if(isset($info))
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-dosave" data-id="{{$info->iId or ''}}">Save</button>
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
        var url_index = "{{ url('web/'.implode( '/', $module ))}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        $(document).ready(function () {
            //
            var modal = $("#edit-modal");
            current_modal = modal;
            //
            $(".btn-cancel").click(function () {
                location.href = url_index;
            });
            //
            $(".btn-doadd").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.vRegion = $(".vRegion").val();
                data.vName = $(".vName").val();
                data.vLocation = $(".vLocation").val();
                data.vCounty = $(".vCounty").val();
                // data.iSum = $(".iSum").val();
                data.iSafeValue = $(".iSafeValue").val();
                // data.vImages = "";
                // $(".cropper_image").find('img').each(function () {
                //     if ($(this).attr('id') != "Image") {
                //         //data.vImages = data.vImages + $(this).attr('src') + ";";
                //         data.vImages = data.vImages + $(this).attr('id') + ";";
                //     }
                // });
                data.vImages = $(".vImages").data('id');
                $(".vImages img").each(function () {
                    if ($(this).attr('id') != "Image" && $(this).attr('id')) {
                        data.vImages = /*data.vImages +*/ $(this).attr('id') + ";";
                    }
                });


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
                data.vRegion = $(".vRegion").val();
                data.vName = $(".vName").val();
                data.vLocation = $(".vLocation").val();
                data.vCounty = $(".vCounty").val();
                // data.iSum = $(".iSum").val();
                data.iSafeValue = $(".iSafeValue").val();
                // data.vImages = "";
                // $(".cropper_image").find('img').each(function () {
                //     if ($(this).attr('id') != "Image") {
                //         //data.vImages = data.vImages + $(this).attr('src') + ";";
                //         data.vImages = data.vImages + $(this).attr('id') + ";";
                //     }
                // });
                data.vImages = $(".vImages").data('id');
                $(".vImages img").each(function () {
                    if ($(this).attr('id') != "Image" && $(this).attr('id')) {
                        data.vImages = /*data.vImages +*/ $(this).attr('id') + ";";
                    }
                });


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