
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
                            <h4 class="card-title">{{session()->get( 'SEO.vTitle')}}</h4>
                            <h6 class="card-subtitle">{{$vSummary or ''}}</h6>
                        </div>
                        <hr>
                        <form class="form-horizontal">
                            <div class="card-body member-modal">
                                <h4 class="card-title">Personal Info</h4>
                                @if(isset($info))
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">會員編號</label>
                                        <div class="col-sm-9">
                                            {{$info->iUserId or ''}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname1" class="col-sm-3 text-right control-label col-form-label">IP位置</label>
                                        <div class="col-sm-9">
                                            {{$info->vCreateIP or ''}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname2" class="col-sm-3 text-right control-label col-form-label">加入時間</label>
                                        <div class="col-sm-9">
                                            {{$info->iCreateTime or ''}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname22" class="col-sm-3 text-right control-label col-form-label">更新時間</label>
                                        <div class="col-sm-9">
                                            {{$info->iUpdateTime or ''}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname3" class="col-sm-3 text-right control-label col-form-label">登入時間</label>
                                        <div class="col-sm-9">
                                            {{$info->iLoginTime or ''}}
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group row">
                                        <label for="fname1" class="col-sm-3 text-right control-label col-form-label">無資料</label>
                                        <div class="col-sm-9">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
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

        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
