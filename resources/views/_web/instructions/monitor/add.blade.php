
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
                        <hr>
                        <form class="form-horizontal">
                            <div class="card-body memberInfo-modal">
                                {{--<h4 class="card-title">Personal Info</h4>--}}
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Reservoir</label>
                                    <div class="col-sm-9">
                                        <select class="form-control iReservoir">
                                            @foreach($reservoir as $key => $var)
                                                <option value="{{$var->iId or 0}}" @if(isset($info) && $info->iReservoir==$var->iId) selected @endif >
                                                    {{$var->vName or ''}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img1" class="col-sm-3 text-right control-label col-form-label">Picture 1</label>
                                    <div class="col-sm-9">
                                        <a class="btn-image-modal1" data-modal="image-form" data-id="1">
                                            <img id="{{$info->vFileId[0] or 'img1'}}" class="img1" src="{{$info->vFile[0] or url('images/empty.jpg')}}" style="height:140px">
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img2" class="col-sm-3 text-right control-label col-form-label">Picture 2</label>
                                    <div class="col-sm-9">
                                        <a class="btn-image-modal2" data-modal="image-form" data-id="2">
                                            <img id="{{$info->vFileId[1] or 'img2'}}" class="img2" src="{{$info->vFile[1] or url('images/empty.jpg')}}" style="height:140px">
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img3" class="col-sm-3 text-right control-label col-form-label">Picture 3</label>
                                    <div class="col-sm-9">
                                        <a class="btn-image-modal3" data-modal="image-form" data-id="3">
                                            <img id="{{$info->vFileId[2] or 'img3'}}" class="img3" src="{{$info->vFile[2] or url('images/empty.jpg')}}" style="height:140px">
                                        </a>
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
    @include('_web._js.crop_image_noAspectRatio')
    <!-- end -->
    <!-- Public SummerNote -->
    @include('_web._js.summernote')
    <!-- end -->
    <script type="text/javascript">
        var current_data = [];
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        $(document).ready(function () {
            //
            var modal = $("#manage-modal");
            current_modal = modal.find('.memberInfo-modal');
            //
            $(".btn-cancel").click(function () {
                history.back();
            });
            //
            $(".btn-doadd").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.iReservoir = current_modal.find(".iReservoir").val();
                data.vImage1 = current_modal.find(".img1").attr('id');
                data.vImage2 = current_modal.find(".img2").attr('id');
                data.vImage3 = current_modal.find(".img3").attr('id');
                //
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
                data.iReservoir = current_modal.find(".iReservoir").val();
                data.vImage1 = current_modal.find(".img1").attr('id');
                data.vImage2 = current_modal.find(".img2").attr('id');
                data.vImage3 = current_modal.find(".img3").attr('id');
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