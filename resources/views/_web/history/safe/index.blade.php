
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
                            <h6 class="card-title">
                                {{$vSummary or ''}}
                                <a href="{{$add_url or ''}}" class="btn btn-info waves-effect waves-light btn-doadd" style="float: right; margin-right: 40px; margin-top: -10px; width: 12%;height: 40px;">新增</a>
                            </h6>
                            <hr>
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
        var url_add = "{{ url('web/'.implode( '/', $module ).'/add')}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_edit = "{{ url('web/'.implode( '/', $module ).'/edit')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_dosave_show = "{{ url('web/'.implode( '/', $module ).'/dosaveshow')}}";
        var url_dodel = "{{ url('web/'.implode( '/', $module ).'/dodel')}}";

        $(document).ready(function () {
            /* BASIC ;*/
            // loading .....
            run_waitMe($('.waitme'));
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                "scrollY": '55vh',
                // 'bProcessing': true,
                'sServerMethod': 'GET',
                "aoColumns": [
                    {
                        "sTitle": "發送者",
                        "mData": "iMemberId",
                        "width": "70px",
                        "sName": "iMemberId",
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {
                        "sTitle": "年度*",
                        "mData": "vData",
                        "width": "60px",
                        "sName": "vData",
                        "bSortable": true,
                        "bSearchable": true,
                        "mRender": function (data, type, row) {
                            // return data;
                            data2=data;
                            if (data=='')data='-';
                            return '<input class="isEdit vData" data-id="vData" size="10" style="width: 100%; display: none;" type="text" value="' + data2 + '"></input>'+'<div class="aaa">'+data+'</div>';
                        }
                    },
                    {
                        "sTitle": "Title (點擊即可修改)",
                        "mData": "vTitle",
                        "sName": "vTitle",
                        "bSearchable": true,
                        "width": "300px",
                        "mRender": function (data, type, row) {
                            data2=data;
                            if (data=='')data='-';
                            return '<input class="isEdit vTitle" data-id="vTitle" size="10" style="width: 100%; display: none;" type="text" value="' + data2 + '"></input>'+'<div class="aaa">'+data+'</div>';
                        }
                    },
                    {
                        "sTitle": "File",
                        "mData": "vFile",
                        "sName": "vFile",
                        "bSearchable": false,
                        "width": "40px",
                        "mRender": function (data, type, row) {
                            return '<a class="btn btn-xs btn-danger" href="'+data+'"><h6><i class="fa fa-file-pdf" aria-hidden="true"></i></h6></a>';
                        }
                    },
                    {
                        "sTitle": "水庫*",
                        "mData": "vCode",
                        "width": "120px",
                        "sName": "vCode",
                        "bSearchable": true,
                        "mRender": function (data, type, row) {
                            // return data;
                            data2=data;
                            if (data=='')data='-';
                            return '<input class="isEdit vCode" data-id="vCode" size="10" style="width: 100%; display: none;" type="text" value="' + data2 + '"></input>'+'<div class="aaa">'+data+'</div>';
                        }
                    },
                    {
                        "sTitle": "",
                        "bSortable": false,
                        "bSearchable": false,
                        'width': '100px',
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            btn = "<div style='text-align: right;'>";
                            // switch (row.iStatus) {
                            //     case 1:
                            //         btn = '<button class="btn btn-xs btn-success btn-status">已開啟</button>';
                            //         break;
                            //     default:
                            //         btn = '<button class="btn btn-xs btn-primary btn-status">未開啟</button>';
                            //         break;
                            // }
                            btn += '<button class="btn btn-xs btn-default btn-edit" title="修改"><i class="fa fa-pencil" aria-hidden="true">修改</i></button>';
                            btn += '<button class="pull-right btn btn-xs btn-danger btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            btn += '</div>';
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
                },
            });
            $('div.dataTables_wrapper div.dataTables_paginate').click(function () {
                run_waitMe($('.waitme'));
                setTimeout(function(){ $('.waitme').waitMe('hide') }, 1000);   //逾時1秒關閉讀取
            });
            $('#dt_basic_length select').change(function () {
                run_waitMe($('.waitme'));
                setTimeout(function(){ $('.waitme').waitMe('hide') }, 1000);   //逾時1秒關閉讀取
            });
            setTimeout(function(){ $('.waitme').waitMe('hide') }, 10000);   //逾時10秒關閉讀取
            /* END BASIC */
            //
            $("#dt_basic").on('change', '.irank', function () {
                run_waitMe($('.waitme'));
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
                        $('.waitme').waitMe('hide');
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
            // 按一下進入編輯模式
            $("#dt_basic").on('click', '.aaa', function () {
                $('div.aaa').show();
                $('input.isEdit').hide();
                $(this).parent().find('input.isEdit').show();
                $(this).hide();
            });
            // 編輯完成退回瀏覽模式
            $("#dt_basic").on('change', '.isEdit', function () {
                //
                toastr.info('Wait me', "等我一下...");
                //
                $(this).hide();
                $(this).parent().find('.aaa').show();
                //
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data[$(this).data('id')] = $(this).val();
                //
                $.ajax({
                    url: url_dosave_show,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        // $('.waitme').waitMe('hide');
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
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: url_dodel,
                        data: data,
                        type: "POST",
                        //async: false,
                        success: function (rtndata) {
                            if (rtndata.status) {
                                {{--toastr.success(rtndata.message,"{{trans('_web_alert.notice')}}");--}}
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
            $('iRank').click();
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->