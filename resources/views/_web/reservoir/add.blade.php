
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
                    <div class="card"  id="manage-modal">
                        <div class="card-body">
                            {{--<h4 class="card-title">{{$vTitle or ''}}</h4>--}}
                            <h6 class="card-subtitle">{{$vSummary or ''}}</h6>
                        </div>
                        <form class="form-horizontal">
                            <div class="card-body">
                                {{--<h4 class="card-title"></h4>--}}
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control iType">
                                            @foreach($reservori_category as $key => $var)
                                                <option value="{{$key or 0}}" @if(isset($info) && $info->iType==$key) selected @endif >
                                                    {{$var or ''}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
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
                            </div>
                            <hr>
                            <div class="card-body">
                                <h4 class="card-title">Info</h4>
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">安全等級</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control iSafeValue" id="com1" placeholder="安全等級" value="{{$info->iSafeValue or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">聯絡資訊1</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" data-name="contact1" placeholder="聯絡人" value="{{$info->contact1 or ''}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" data-name="contact_tel1" placeholder="聯絡電話" value="{{$info->contact_tel1 or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">聯絡資訊2</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" data-name="contact2" placeholder="聯絡人" value="{{$info->contact2 or ''}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" data-name="contact_tel2" placeholder="聯絡電話" value="{{$info->contact_tel2 or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">聯絡資訊3</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" data-name="contact3" placeholder="聯絡人" value="{{$info->contact3 or ''}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" data-name="contact_tel3" placeholder="聯絡電話" value="{{$info->contact_tel3 or ''}}">
                                    </div>
                                </div>
                                {{--<div class="form-group row">--}}
                                    {{--<label class="col-sm-1 col-md-1 col-lg-1 control-label">{{trans('web.images')}}</label>--}}
                                    {{--<div class="col-md-10 cropper_image">--}}
                                        {{--<a class="btn-image-modal" data-modal="image-form" data-id="">--}}
                                            {{--<img id="Image" data-data="" src="{{$info->vUserImage or url('images/empty.jpg')}}" style="height:140px">--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group row">
                                    <label for="img1" class="col-sm-3 text-right control-label col-form-label">{{trans('web.images')}}</label>
                                    <div class="col-sm-9 cropper_image">
                                        @if(isset($info))
                                            @foreach($info->vImages as $key => $var)
                                                <div class="image-box">
                                                    <img id="{{$key}}" src="{{$var}}"> <a class="image-del">X</a>
                                                </div>
                                            @endforeach
                                        <a class="btn-image-modal" data-modal="image-form" data-id="">
                                            @if(count($info->vImages) < 5)
                                                <img id="Image" data-data="" src="{{$info->vUserImage or url('images/empty.jpg')}}" style="height:140px">
                                            @endif
                                        </a>
                                        @else
                                            <a class="btn-image-modal" data-modal="image-form" data-id="">
                                                <img id="Image" data-data="" src="{{$info->vUserImage or url('images/empty.jpg')}}" style="height:140px">
                                            </a>
                                        @endif
                                    </div>
                                </div>
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
            var modal = $("#manage-modal");
            var current_modal = modal;
            //
            $(".btn-cancel").click(function () {
                history.back();
                // location.href = url_index;
            });
            //
            $(".btn-doadd").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.iType = current_modal.find(".iType").val();
                data.vRegion = current_modal.find(".vRegion").val();
                data.vName = current_modal.find(".vName").val();
                data.vLocation = current_modal.find(".vLocation").val();
                data.vCounty = current_modal.find(".vCounty").val();
                data.iSafeValue = current_modal.find(".iSafeValue").val();
                $("[data-name]").each(function(){
                    data[$(this).attr("data-name")]=$(this).val();
                });
                data.vImages = "";
                $(".cropper_image").find('img').each(function () {
                    if ($(this).attr('id') != "Image") {
                        //data.vImages = data.vImages + $(this).attr('src') + ";";
                        data.vImages = data.vImages + $(this).attr('id') + ";";
                    }
                });
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
                data.iType = current_modal.find(".iType").val();
                data.vRegion = current_modal.find(".vRegion").val();
                data.vName = current_modal.find(".vName").val();
                data.vLocation = current_modal.find(".vLocation").val();
                data.vCounty = current_modal.find(".vCounty").val();
                data.iSafeValue = current_modal.find(".iSafeValue").val();
                $("[data-name]").each(function(){
                    data[$(this).attr("data-name")]=$(this).val();
                });
                data.vImages = "";
                $(".cropper_image").find('img').each(function () {
                    if ($(this).attr('id') != "Image") {
                        //data.vImages = data.vImages + $(this).attr('src') + ";";
                        data.vImages = data.vImages + $(this).attr('id') + ";";
                    }
                });
                //
                console.log(data);
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