
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!-- This page plugin CSS -->
    <style type="text/css" rel="stylesheet">
        .btn {
            margin-left: 10px;
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
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{--<h4 class="card-title">{{session()->get( 'SEO.vTitle')}}</h4>--}}
                            {{--<h6 class="card-subtitle">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code> $().DataTable();</code>. You can refer full documentation from here <a href="https://datatables.net/">Datatables</a></h6>--}}
                            <div class="table-responsive">
                                <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>來自</th>
                                                        <th>帳號</th>
                                                        <th>存取權限</th>
                                                        <th>創建IP</th>
                                                        <th>登入IP</th>
                                                        <th class="click-default">登入時間</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="productConetnt">
                                                @foreach($info as $item)
                                                    <tr>
                                                        <td>{{$item['iId'] or ''}}</td>
                                                        <td>{{$item['vAction'] or ''}}</td>
                                                        <td>{{$item['vAccount'] or ''}}</td>
                                                        <td>{{$item['iAcType'] or ''}}</td>
                                                        <td>{{$item['vCreateIP'] or ''}}</td>
                                                        <td>{{$item['vIP'] or ''}}</td>
                                                        <td>{{$item['iDateTime'] or ''}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="zero_config_info" role="status" aria-live="polite">
                                                {{--Showing 1 to 10 of 57 entries--}}
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="zero_config_paginate">
                                                <ul class="pagination">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection

@section('aside')
@endsection

<!-- ================== page-js ================== -->
@section('page-js')
    <!--This page plugins -->
    <!--  -->
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/login/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/login/getlist')}}";

        $(document).ready(function () {
            $('.click-default').click();
            $('.click-default').click();
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->