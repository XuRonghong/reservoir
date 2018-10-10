
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
                        <hr>
                        <form class="form-horizontal" enctype="multipart/form-data">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">名稱</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vName" id="fname" placeholder="" value="{{$info->vName or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">上傳PDF</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control uploadfile" id="lname" name="files[]" multiple="multiple" >
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
                data = new FormData();
                data.append("_token", "{{ csrf_token() }}");
                data.append("file", $(".uploadfile"));
                //
                var file_data = $('.uploadfile').prop('files')[0];
                var data = new FormData();
                data.append("_token", "{{ csrf_token() }}");
                data.append('file', file_data);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "{{url('web/upload_file_base64')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: false,
                    success: function (rtndata) {
                        if (rtndata.status){
                            var upload_id = rtndata.fileid;
                            doAdd(upload_id);
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                });
            });
            //
            function doAdd(id) {
                var data = {"_token": "{{ csrf_token() }}"};
                data.vName = $(".vName").val();
                data.vFile = id;
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
            }
            //
            $(".btn-dosave").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = $(this).data('id');
                data.vName = $(".vName").val();
                data.vFile = $(".vFile").val();
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
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->