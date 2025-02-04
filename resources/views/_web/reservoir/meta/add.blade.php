
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
                            {{--<h4 class="card-title">{{$vTitle or ''}}</h4>--}}
                            <h6 class="card-subtitle">{{$vSummary or ''}}</h6>
                        </div>
                        <form class="form-horizontal">
                            <div class="card-body">
                                {{--<h4 class="card-title">Personal Info</h4>--}}
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">蓄水建造物</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vStructure" id="fname" placeholder="蓄水建造物" value="{{$info->vStructure or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">災害潛勢</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vLevel" id="lname" placeholder="災害潛勢" value="{{$info->vLevel or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">壩高(m)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control iHeight" id="lname" placeholder="壩高(m)" value="{{$info->iHeight or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">總蓄水量 (萬m3)	</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control iStoreTotal" id="lname" placeholder="總蓄水量 (萬m3)" value="{{$info->iStoreTotal or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">分級</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vGrade" id="lname" placeholder="sum" value="{{$info->vGrade or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">責任區</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vTrustRegion" id="lname" placeholder="責任區" value="{{$info->vTrustRegion or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">站碼</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vNumber" id="lname" placeholder="站碼" value="{{$info->vNumber or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">NET</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vNet" id="lname" placeholder="NET" value="{{$info->vNet or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">區碼</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vAreaCode" id="lname" placeholder="區碼" value="{{$info->vAreaCode or ''}}">
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
            var modal = $("#edit-modal");
            current_modal = modal;
            //
            $(".btn-cancel").click(function () {
                history.back();
            });
            //
            $(".btn-doadd").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.vStructure = $(".vStructure").val();
                data.vLevel = $(".vLevel").val();
                data.iHeight = $(".iHeight").val();
                data.iStoreTotal = $(".iStoreTotal").val();
                data.vGrade = $(".vGrade").val();
                data.vTrustRegion = $(".vTrustRegion").val();
                data.vNumber = $(".vNumber").val();
                data.vNet = $(".vNet").val();
                data.vAreaCode = $(".vAreaCode").val();
                // data.vImages = "";
                // $(".cropper_image").find('img').each(function () {
                //     if ($(this).attr('id') != "Image") {
                //         //data.vImages = data.vImages + $(this).attr('src') + ";";
                //         data.vImages = data.vImages + $(this).attr('id') + ";";
                //     }
                // });
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
                data.vStructure = $(".vStructure").val();
                data.vLevel = $(".vLevel").val();
                data.iHeight = $(".iHeight").val();
                data.iStoreTotal = $(".iStoreTotal").val();
                data.vGrade = $(".vGrade").val();
                data.vTrustRegion = $(".vTrustRegion").val();
                data.vNumber = $(".vNumber").val();
                data.vNet = $(".vNet").val();
                data.vAreaCode = $(".vAreaCode").val();
                // data.vImages = "";
                // $(".cropper_image").find('img').each(function () {
                //     if ($(this).attr('id') != "Image") {
                //         //data.vImages = data.vImages + $(this).attr('src') + ";";
                //         data.vImages = data.vImages + $(this).attr('id') + ";";
                //     }
                // });
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
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->