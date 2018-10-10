
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
                            <h4 class="card-title modalTitle">{{$info->vTitle or ''}}</h4>
                            <h6 class="card-subtitle">{{$info->iCreateTime or ''}}</h6>
                        </div>
                        {{--<hr>--}}
                        <form class="form-horizontal">
                            <div class="card-body member-modal">
                                {{--<h3 class="card-title">Detail</h3>--}}
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">內容</label>
                                    <div class="col-sm-9">
                                        @if(isset($info->vSummary))
                                        {!! $info->vSummary !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">PGA</label>
                                    <div class="col-sm-9">
                                        {{$info->PGA or ''}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">震度</label>
                                    <div class="col-sm-9">
                                        {{$info->shake or ''}}
                                    </div>
                                </div>
                                @if( 9 < session('member.iAcType') && session('member.iAcType') < 20)
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        <br>
                                        <h3>
                                            @if(session('member.iAcType') < 19)
                                            <a href="{{url('web/record/trace/add')}}">填寫蓄水庫與引水建造物安全檢查</a>
                                            @else
                                            <h4>待承辦人員填寫完檢查表後審核確認</h4>
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if(isset($info->iCheck))
                                        @if( $info->iCheck < session('member.iAcType') && session('member.iAcType')>9 && session('member.iAcType')<80)
                                        <button type="button" class="btn btn-success waves-effect waves-light btn-check" data-id="{{$info->iId or ''}}">
                                            Check & Send
                                        </button>
                                        @endif
                                    @endif
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
    <script>
        var url_index = "{{ url('web/'.implode( '/', $module ))}}";
        $(document).ready(function () {
            //
            $(".btn-back").click(function () {
                history.back()
            });
            //
            $(".btn-check").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = $(this).data('id');
                $.ajax({
                    url: '{{url('web/message/dosave')}}',
                    type: 'POST',
                    data: data,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            //button hide
                            $(".btn-check").hide();
                            //
                            save_comment_read();
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                })
            });
            /*
            * 儲存"通知訊息"資料為使用者已讀
             */
            function save_comment_read() {
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = $(this).data('id');
                //
                $.ajax({
                    url: '{{url('web/savecomment')}}',
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {

                        } else {
                            {{--toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");--}}
                        }
                    }
                });
            }
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
