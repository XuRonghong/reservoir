
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
        var url_attr = "{{ url('web/'.implode( '/', $module ).'/attr')}}";
        var url_sub = "{{ url('web/'.implode( '/', $module ).'/sub')}}";
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
                'bProcessing': true,
                // 'sServerMethod': 'GET',
                "aoColumns": [
                    {
                        "sTitle": "keyValue",
                        "mData": "keyValue",
                        "width": "5%",
                        "sName": "keyValue",
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {"sTitle": "eventTime", "mData": "eventTime", "width": "15%", "sName": "eventTime"},
                    {"sTitle": "id", "mData": "id", "width": "5%", "sName": "id"},
                    // {
                    //     "sTitle": "Reservoir",
                    //     "mData": "vStructure",
                    //     "width": "20%",
                    //     "sName": "vStructure",
                    //     "bSearchable": false,
                    //     "mRender": function (data, type, row) {
                    //         // for(obj in row['reservoir'])
                    //         return data;
                    //     }
                    // },
                    {"sTitle": "NET", "mData": "NET", "width": "5%", "sName": "NET"},
                    {"sTitle": "LOCATION", "mData": "LOCATION", "width": "5%", "sName": "LOCATION"},
                    {"sTitle": "PGA", "mData": "PGA", "width": "5%", "sName": "PGA"},
                    {
                        "sTitle": "",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            btn = '<button class="btn btn-xs btn-default btn-attributes" title="全部資訊"><i class="fa fa-book" aria-hidden="true"></i></button>';
                            // btn += '<button class="btn btn-xs btn-default btn-edit" title="修改"><i class="fa fa-pencil" aria-hidden="true">修改</i></button>';
                            // btn += '<button class="pull-right btn btn-xs btn-default btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
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
            })
            setTimeout(function(){ $('.waitme').waitMe('hide') }, 10000);   //逾時10秒關閉讀取( $('.waitme').waitMe('hide') , 10000);   //逾時10秒關閉讀取
            /* END BASIC */
            //
            $("#dt_basic").on('change', '.irank', function () {
                //var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
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
            $("#dt_basic").on('click', '.btn-active', function () {
                //var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.bActive = "change";
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
                //var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
                location.href = url_edit + '/' + id;
            });
            //
            $("#dt_basic").on('click', '.btn-del', function () {
                //var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.iStatus = "change";
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
            });
            //
            $("#dt_basic").on('click', '.btn-attributes', function () {
                //var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
                location.href = url_attr + '/' + id;
            });
            //
            var ii = 1;
            $('thead>tr>th').each(function () {
                if (ii==2){
                    $(this).click();
                    $(this).click();
                }
                ii++;
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->