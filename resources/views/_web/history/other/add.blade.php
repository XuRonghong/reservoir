
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid-theme.min.css')}}" rel="stylesheet">
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.css')}}" rel="stylesheet">
    <style>
        .btn { margin-left: 20px; }
        select, select option { font-size:18px; font-weight: bold;}
        select, select optgroup { font-size:22px; font-weight: bold;}
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
                    <div class="card waitme"  id="edit-modal">
                        <div class="card-body">
                            {{--<h4 class="card-title">{{$vTitle or ''}}</h4>--}}
                            <h6 class="card-title">{{$vSummary or ''}}</h6>
                        </div>
                        <hr>
                        <form class="form-horizontal" enctype="multipart/form-data">
                            <div class="card-body">
                                {{--<h4 class="card-title"></h4>--}}
                                <div class="form-group row">
                                    <label for="fname1" class="col-sm-3 text-right control-label col-form-label">水庫</label>
                                    <div class="col-sm-9">
                                        <select id="fname1" class="form-control vCode">
                                            <option value=""></option>
                                            @foreach($Reservoir as $key => $value)
                                                <option value="{{$value['vName'] or ''}}" @if(isset($info) && $info->vCode==$value['vName']) selected @endif>
                                                    {{$value['vName'] or ''}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname1" class="col-sm-3 text-right control-label col-form-label">年度</label>
                                    <div class="col-sm-9">
                                        <select id="lname1" class="form-control vData">
                                            <optgroup label="{{substr($Year[0],0,2)}}">
                                            @foreach($Year as $key => $value)
                                                <option value="{{$value or ''}}" @if(isset($info) && $info->vData==$value) selected @endif>
                                                    {{substr($value,0,4)}}
                                                </option>
                                                @if( $key<count($Year)-1 && (intval(($value)/100)!=intval(($Year[$key+1])/100) ))
                                                    </optgroup>
                                                    <optgroup label="{{substr($value+1,0,2)}}">
                                                @endif
                                            @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vTitle" id="fname" placeholder="" value="{{$info->vTitle or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">上傳PDF</label>
                                    <div class="col-sm-9">
                                        <input type="file" accept="application/*" class="form-control uploadfile" id="lname" name="files[]" multiple="multiple" value="{{$info->vFile[0] or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label"></label>
                                    <div class="col-sm-9">
                                        PS: 此編輯頁面，需要重新上傳PDF檔案，否則無法上傳更新資料!!
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
    {{--@include('_web._js.crop_image')--}}
    <!-- end -->
    <!-- Public SummerNote -->
    {{--@include('_web._js.summernote')--}}
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
                // loading .....
                run_waitMe($('.waitme'));
                //
                var file_data = $('.uploadfile').prop('files')[0];
                var data = new FormData();
                data.append("_token", "{{ csrf_token() }}");
                data.append('file', file_data);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "{{url('web/upload_file')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: false,
                    success: function (rtndata) {
                        if (rtndata.status){
                            var fileid = rtndata.fileid;
                            doAdd(fileid);
                        } else {
                            $('.waitme').waitMe('hide');
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    },
                    complete: function () {
                    }
                });
            });
            //
            function doAdd(fileid) {
                var data = {"_token": "{{ csrf_token() }}"};
                data.vTitle = $(".vTitle").val();
                data.vCode = $(".vCode").val();
                data.vData = $(".vData").val();
                data.vFile = fileid;
                $.ajax({
                    url: url_doadd,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        $('.waitme').waitMe('hide');
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    },
                    complete: function () {
                    }
                });
            }
            //
            $(".btn-dosave").click(function () {
                // loading .....
                run_waitMe($('.waitme'));
                //
                id = $(this).data('id');
                //
                var file_data = $('.uploadfile').prop('files')[0];
                var data = new FormData();
                data.append("_token", "{{ csrf_token() }}");
                data.append('file', file_data);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "{{url('web/upload_file')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: false,
                    success: function (rtndata) {
                        if (rtndata.status){
                            var fileid = rtndata.fileid;
                            doSave(id,fileid);
                        } else {
                            $('.waitme').waitMe('hide');
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    },
                    complete: function () {
                    }
                });
            });
            //
            function doSave(id,fileid) {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = id;
                data.vTitle = $(".vTitle").val();
                data.vCode = $(".vCode").val();
                data.vData = $(".vData").val();
                data.vFile = fileid;
                //
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        $('.waitme').waitMe('hide');
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    },
                    complete: function () {
                    }
                });
            }
            //
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->