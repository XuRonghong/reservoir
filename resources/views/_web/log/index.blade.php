
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
    {{--@include('_web._layouts.breadcrumb')--}}
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
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
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
    <!-- Public Crop_Image -->
    {{--    @include('_web._js.crop_image_single_modal_340175')--}}
    <!-- Public SummerNote -->
    {{--    @include('_web._js.summernote')--}}
    <!--  -->
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/login/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/login/getlist')}}";

        function getlist() {
            var data = {"_token": "{{ csrf_token() }}"};
            $.ajax({
                url: ajax_Table,
                type: "GET",
                data: data,
                async: true,
                success: function (rtndata) {
                    var html_str = "";
                    $(".productConetnt").html(html_str);
                    if (rtndata.status) {
                        for (var key in rtndata.aaData) {
                            var obj = rtndata.aaData[key];
                            html_str += '<tr>';
                            html_str += '<td>' + obj.iId + '</td>';
                            html_str += '<td>' + obj.vAction + '</td>';
                            html_str += '<td>' + obj.vAccount + '</td>';
                            html_str += '<td>' + obj.iAcType + '</td>';
                            html_str += '<td>' + obj.vCreateIP + '</td>';
                            html_str += '<td>' + obj.vIP + '</td>';
                            html_str += '<td>' + obj.iDateTime + '</td>';
                            html_str += '</tr>';
                        }
                        if (rtndata.total <= 0) {
                            html_str += '<p class="itemTitle">' + "{{trans('_portal.product.no')}}" + '</p>';
                        }
                        $(".productConetnt").append(html_str);
                        str = rtndata.links_html;
                        $(".pagination").html(str);
                        $('html, body').scrollTop(0);
                    } else {
                        toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                    }
                },
                error: function () {
                    toastr.error('商品資訊沒收到,請再重新整理', "{{trans('_web_alert.notice')}}");
                }
            });
        }

        $(document).ready(function () {
            $('.click-default').click();
            $('.click-default').click();
            // getlist();

            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                // "scrollY": '65vh',
                "aoColumns": [
                    {
                        "sTitle": "ID",
                        "mData": "iId",
                        "width": "5%",
                        "sName": "iId",
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {"sTitle": "來自", "mData": "vAction", "width": "5%", "sName": "vAction"},
                    {"sTitle": "存取權限", "mData": "iStoreId", "width": "10%", "sName": "iStoreId"},
                    {"sTitle": "帳號", "mData": "iMemberId", "width": "5%", "sName": "iMemberId"},
                    {"sTitle": "IP", "mData": "vIP", "width": "5%", "sName": "vIP"},
                    {"sTitle": "登入時間", "mData": "iDateTime", "width": "10%", "sName": "iDateTime"},
                    // {
                    //     "sTitle": "啟用",
                    //     "mData": "bActive",
                    //     "bSearchable": false,
                    //     "mRender": function (data, type, row) {
                    //         var btn = "無狀態";
                    //         switch (data) {
                    //             case 1:
                    //                 btn = '<button class="btn btn-xs btn-danger btn-active">已啟用</button>';
                    //                 break;
                    //             default:
                    //                 btn = '<button class="btn btn-xs btn-primary btn-active">未啟用</button>';
                    //                 break;
                    //         }
                    //         return btn;
                    //     }
                    // },
                ],
                "sAjaxSource": ajax_source,
                "ajax": ajax_Table,
                // "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                //     "t" +
                //     "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "sSearch": 'Search:<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                }
            });
            /* END BASIC */
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->