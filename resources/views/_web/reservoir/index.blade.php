
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!-- This page plugin CSS -->
    <style type="text/css" rel="stylesheet">
        .btn {
            margin-left: 5px;
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
            <!-- basic table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{--<h4 class="card-title">{{$vTitle or ''}}</h4>--}}
                            {{--<h6 class="card-subtitle">{{$vSummary or ''}}</h6>--}}
                            <div class="table-responsive waitme">
                                <table id="dt_basic" class="table table-striped table-bordered">
                                </table>
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
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var url_dosave_show = "{{ url('web/'.implode( '/', $module ).'/dosaveshow')}}";
        var url_add = "{{ url('web/'.implode( '/', $module ).'/add')}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_edit = "{{ url('web/'.implode( '/', $module ).'/edit')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_dodel = "{{ url('web/'.implode( '/', $module ).'/dodel')}}";
        var url_attributes = "{{ url('web/'.implode( '/', $module ).'/attributes')}}";

        $(document).ready(function () {
            /* BASIC ;*/
            // loading .....
            run_waitMe($('.waitme'));
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                "scrollY": '65vh',
                // 'sServerMethod': 'GET',
                "aoColumns": [
                    {
                        "sTitle": "ID",
                        "mData": "iId",
                        "width": "80px",
                        "sName": "iId",
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {"sTitle": "地區別", "mData": "vRegion", "width": "100px", "sName": "vRegion"},
                    {"sTitle": "名稱", "mData": "vName", "width": "100px", "sName": "vName"},
                    {"sTitle": "詳細地址", "mData": "vLocation", "width": "100%", "sName": "vLocation"},
                    {"sTitle": "壩堰位置", "mData": "vCounty", "width": "200px", "sName": "vCounty"},
                    // {"sTitle": "Type", "mData": "iType", "width": "5%", "sName": "iType"},
                    {"sTitle": "安全值", "mData": "iSafeValue", "width": "100px", "sName": "iSafeValue","bSortable": false,"bSearchable": false},
                    // {"sTitle": "Sum", "mData": "iSum", "width": "8%", "sName": "iSum"},
                    {
                        "sTitle": "圖片",
                        "mData": "vImages",
                        "sName": "vImages",
                        "width": "100px",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            var html_str = "";
                            for (var key in data) {
                                html_str += "<img width='75px' src=" + data[key] + " style='margin:5px;'>";
                            }
                            return html_str;
                        }
                    },
                    {
                        "sTitle": "",
                        "bSortable": false,
                        "bSearchable": false,
                        "width": "200px",
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            switch (row.iStatus) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-success btn-status">已開啟</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-status">未開啟</button>';
                                    break;
                            }
                            btn += '<button class="btn btn-xs btn-default btn-edit" title="修改"><i class="fa fa-pencil" aria-hidden="true">修改</i></button>';
                            btn += '<button class="pull-right btn btn-xs btn-danger btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            // btn += '<button class="btn btn-xs btn-default btn-attributes" title="相關資訊"><i class="fa fa-book" aria-hidden="true"></i></button>';
                            $('.waitme').waitMe('hide');
                            return btn;
                        }
                    },
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
            $('div.dataTables_wrapper div.dataTables_paginate').click(function () {
                run_waitMe($('.waitme'));
            });
            $('#dt_basic_length select').change(function () {
                run_waitMe($('.waitme'));
            });
            setTimeout(function(){ $('.waitme').waitMe('hide') }, 10000);   //逾時10秒關閉讀取
            /* END BASIC */
            //
            $("#dt_basic").on('change', '.irank', function () {
                var id = $(this).closest('tr').attr('id');
                var irank = $(this).val();
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.iRank = irank;
                $.ajax({
                    url: url_dosave_show,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
            //
            $("#dt_basic").on('click', '.btn-status', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.iStatus = "change";
                $.ajax({
                    url: url_dosave_show,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
            //
            $("#dt_basic").on('click', '.btn-edit', function () {
                var id = $(this).closest('tr').attr('id');
                location.href = url_edit + '/' + id;
            });
            //
            $("#dt_basic").on('click', '.btn-del', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                swal({
                    title: "{{trans('_web_alert.del.title')}}",
                    text: "{{trans('_web_alert.del.note')}}",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "{{trans('_web_alert.cancel')}}",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{trans('_web_alert.ok')}}",
                    closeOnConfirm: true
                }, function () {
                    $.ajax({
                        url: url_dodel,
                        data: data,
                        type: "POST",
                        //async: false,
                        success: function (rtndata) {
                            if (rtndata.status) {
                                //toastr.success(rtndata.message,"{{trans('_web_alert.notice')}}")
                                swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                                setTimeout(function () {
                                    table.api().ajax.reload(null, false);
                                }, 100);

                            } else {
                                swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->