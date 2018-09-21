
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
                            <h4 class="card-title modalTitle">{{session()->get( 'SEO.vTitle')}}</h4>
                            <h6 class="card-subtitle">{{$vSummary or ''}}</h6>
                        </div>
                        <hr>
                        <form class="form-horizontal">
                            <div class="card-body messageInfo-modal">
                                <h4 class="card-title"></h4>
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">發送者</label>
                                    <div class="col-sm-9">
                                        {{$info->iSource or 'Self'}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label">目標階層</label>
                                    <div class="col-sm-9">
                                        <select class="form-control iHead" id="com2" >
                                            @if(isset($info))
                                            <option value="10" @if($info->iHead<20) selected @endif>網站管理員</option>
                                            <option value="20" @if($info->iHead<30 && $info->iHead>19) selected @endif>1.水庫管理員</option>
                                            <option value="30" @if($info->iHead<40 && $info->iHead>29) selected @endif>2.水庫審查員</option>
                                            <option value="40" @if($info->iHead<50 && $info->iHead>39) selected @endif>3.中央水利署人員</option>
                                            @else
                                                <option value="10" title="只有網站管理員才看到">網站管理員</option>
                                                <option value="20" title="水庫管理員看得到">1.水庫管理員</option>
                                                <option value="30" title="水庫相關人員看得到">2.水庫審查員</option>
                                                <option value="40" title="相關人員看得到">3.中央水利署人員</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">標頭</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vTitle" id="com3" placeholder="" value="{{$info->vTitle or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">概要</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vSummary" id="com4" placeholder="" value="{{ $info->vSummary or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img1" class="col-sm-3 text-right control-label col-form-label">圖片</label>
                                    <div class="col-sm-9">
                                        <a class="btn-image-modal" data-modal="image-form" data-id="">
                                            <img src="{{$info->vImages or url('images/empty.jpg')}}" style="height:140px">
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
    @include('_web._js.crop_image')
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
            current_modal = modal.find('.messageInfo-modal');
            //
            $(".btn-cancel").click(function () {
                history.back();
            });
            //
            $(".btn-doadd").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.iSource = current_modal.find(".iSource").val();
                data.iHead = current_modal.find(".iHead").val();
                data.vTitle = current_modal.find(".vTitle").val();
                data.vSummary = current_modal.find(".vSummary").val();
                data.vImages = current_modal.find("img").attr('src');
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
                data.iSource = current_modal.find(".iSource").val();
                data.iHead = current_modal.find(".iHead").val();
                data.vTitle = current_modal.find(".vTitle").val();
                data.vSummary = current_modal.find(".vSummary").val();
                data.vImages = current_modal.find("img").attr('src');
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