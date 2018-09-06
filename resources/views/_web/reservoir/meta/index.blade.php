
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!-- This page plugin CSS -->
    <style type="text/css" rel="stylesheet">
        .btn {
            margin-left: 30px;
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
                            <h4 class="card-title">{{session()->get( 'SEO.vTitle')}}</h4>
                            <h6 class="card-subtitle">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code> $().DataTable();</code>. You can refer full documentation from here <a href="https://datatables.net/">Datatables</a></h6>
                            <div class="table-responsive">
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
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var url_dosave_show = "{{ url('web/'.implode( '/', $module ).'/dosaveshow')}}";
        var url_add = "{{ url('web/'.implode( '/', $module ).'/add')}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_edit = "{{ url('web/'.implode( '/', $module ).'/edit')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_dodel = "{{ url('web/'.implode( '/', $module ).'/dodel')}}";
        var url_sub = "{{ url('web/'.implode( '/', $module ).'/sub')}}";
        $(document).ready(function () {
            //
            var modal = $("#edit-modal");
            current_modal = modal;
            //
            $(".btn-cancel").click(function () {
                location.href = url_index;
            });
            //
            $(".btn-doadd").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.vStructure = $(".vStructure").val();
                data.vLevel = $(".vLevel").val();
                data.iHeight = $(".iHeight").val();
                data.iStoreTotal = $(".iStoreTotal").val();
                data.vGrade = $(".vGrade").val();
                data.vTrustRegion = $(".vTrustRegion").val();
                data.vNumber = $(".vNumber").val();
                data.vNet = $(".vNet").val();
                data.vAreaCode = $(".vAreaCode").val();
                // data.vImages = "";
                // $(".cropper_image").find('img').each(function () {
                //     if ($(this).attr('id') != "Image") {
                //         //data.vImages = data.vImages + $(this).attr('src') + ";";
                //         data.vImages = data.vImages + $(this).attr('id') + ";";
                //     }
                // });

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
                data.vStructure = $(".vStructure").val();
                data.vLevel = $(".vLevel").val();
                data.iHeight = $(".iHeight").val();
                data.iStoreTotal = $(".iStoreTotal").val();
                data.vGrade = $(".vGrade").val();
                data.vTrustRegion = $(".vTrustRegion").val();
                data.vNumber = $(".vNumber").val();
                data.vNet = $(".vNet").val();
                data.vAreaCode = $(".vAreaCode").val();
                // data.vImages = "";
                // $(".cropper_image").find('img').each(function () {
                //     if ($(this).attr('id') != "Image") {
                //         //data.vImages = data.vImages + $(this).attr('src') + ";";
                //         data.vImages = data.vImages + $(this).attr('id') + ";";
                //     }
                // });

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
        $(document).ready(function () {
            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                // "scrollY": '65vh',
                "aoColumns": [
                    // {"sTitle": "id", "mData": "iId", "width": "5%", "sName": "iId"},
                    {
                        "sTitle": "ID",
                        "mData": "iId",
                        "width": "35px",
                        "sName": "iId",
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                            // current_data[row.iId] = row;
                            // return '<button class="btn btn-xs btn-default btn-copy" title="複製"><i class="fa fa-copy" aria-hidden="true"></i></button>' + data;
                        }
                    },
                    {
                        "sTitle": "Rank",
                        "mData": "iRank",
                        "sName": "iRank",
                        "bSearchable": false,
                        "width": "30px",
                        "mRender": function (data, type, row) {
                            return '<input class="irank" size="1" type="text" value="' + data + '"></input>';
                        }
                    },
                    {"sTitle": "蓄水建造物", "mData": "vStructure", "width": "5%", "sName": "vStructure"},
                    {"sTitle": "災害潛勢", "mData": "vLevel", "width": "5%", "sName": "vLevel"},
                    {"sTitle": "壩高(m)", "mData": "iHeight", "width": "10%", "sName": "iHeight"},
                    {"sTitle": "總蓄水量 (萬m3)", "mData": "iStoreTotal", "width": "10%", "sName": "iStoreTotal"},
                    {"sTitle": "分級", "mData": "vGrade", "width": "5%", "sName": "vGrade"},
                    {"sTitle": "責任區", "mData": "vTrustRegion", "width": "10%", "sName": "vTrustRegion"},
                    {"sTitle": "站碼", "mData": "vNumber", "width": "10%", "sName": "vNumber"},
                    {"sTitle": "NET", "mData": "vNet", "width": "5%", "sName": "vNet"},
                    {"sTitle": "區碼", "mData": "vAreaCode", "width": "10%", "sName": "vAreaCode"},
                    // {
                    //     "sTitle": "圖片",
                    //     "mData": "vImages",
                    //     "sName": "vImages",
                    //     "width": "10%",
                    //     "bSortable": false,
                    //     "bSearchable": false,
                    //     "mRender": function (data, type, row) {
                    //         return "<img width='100px' src=" + data + ">";
                    //     }
                    // },
                    {
                        "sTitle": "I/O",
                        "mData": "iStatus",
                        "sName": "iStatus",
                        "width": "5%",
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-danger btn-status">已開啟</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-status">未開啟</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {
                        "sTitle": "Action",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            btn = '<button class="btn btn-xs btn-default btn-edit" title="修改"><i class="fa fa-pencil" aria-hidden="true">修改</i></button>';
                            btn += '<button class="pull-right btn btn-xs btn-default btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            return btn;
                        }
                    },
                ],
                "sAjaxSource": ajax_source,
                "ajax": ajax_Table,
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "sSearch": 'Search:<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
            });
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
            $("#dt_basic").on('click', '.btn-status', function () {
                //var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
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
                //var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
                location.href = url_edit + '/' + id;

                {{--var data = {--}}
                    {{--"_token": "{{ csrf_token() }}"--}}
                {{--};--}}
                {{--data.id = id;--}}
                {{--$.ajax({--}}
                    {{--url: url_edit,--}}
                    {{--data: data,--}}
                    {{--type: "GET",--}}
                    {{--//async: false,--}}
                    {{--success: function (rtndata) {--}}
                        {{--if (rtndata.status) {--}}
                            {{--toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")--}}
                            {{--setTimeout(function () {--}}
                                {{--table.api().ajax.reload(null, false);--}}
                            {{--}, 100);--}}
                        {{--} else {--}}
                            {{--swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
            });
            //
            $("#dt_basic").on('click', '.btn-del', function () {
                //var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
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