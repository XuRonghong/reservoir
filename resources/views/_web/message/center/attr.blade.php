
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
                            <h3 class="card-title modalTitle">通知</h3>
                            <h6 class="card-subtitle"></h6>
                        </div>
                        {{--<hr>--}}
                        <form class="form-horizontal">
                            <div class="card-body member-modal">
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label>
                                    <div class="col-sm-9" style="text-align: left;">
                                    </div>
                                    <div class="col-sm-9" style="text-align: center;">
                                        <h3>{{$info->vTitle or ''}}</h3>
                                        {{$info->vNumber or ''}}
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">發送者</label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        {{$info->iSource or ''}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">發送時間</label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        {{$info->iStartTime or ''}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">目標階層</label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        @if($info->iHead<20) 網站管理員 @endif
                                        @if($info->iHead<30 && $info->iHead>19) 1.水庫管理員 @endif
                                        @if($info->iHead<40 && $info->iHead>29) 2.水庫審查員 @endif
                                        @if($info->iHead<50 && $info->iHead>39) 3.中央水利署人員 @endif
                                        @if($info->iHead>49) 全體人員 @endif
                                    </div>
                                </div>
                                <br>
                                <br>
                                <h3 class="card-title">詳情</h3>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">內容</label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        @if(isset($info->vSummary))
                                            {!! $info->vSummary !!}
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">細節</label>
                                    <div class="col-sm-9">
                                        {!! $info->vDetail !!}
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">通知分類</label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        {{$info->iType or ''}}
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">誰已讀確認</label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        {{$info->iCheck or ''}}
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">狀態</label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        @if($info->iStatus) 開放
                                        @else 關閉
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">創建時間</label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        {{$info->iCreateTime or ''}}
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">更新時間</label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        {{$info->iUpdateTime or ''}}
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">圖片</label>
                                    <div class="col-sm-9" style="text-align: center;">
                                        <img src="{{$info->vImages or url('images/empty.jpg')}}" style="height:140px">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    {{--@if( $info->iCheck < session('member.iAcType') && session('member.iAcType')>9 && session('member.iAcType')<30)--}}
                                    {{--<button type="button" class="btn btn-success waves-effect waves-light btn-check" data-id="{{$info->iId or ''}}">--}}
                                        {{--Check & Send--}}
                                    {{--</button>--}}
                                    {{--@endif--}}
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
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                })
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
