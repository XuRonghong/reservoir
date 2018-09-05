
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!-- This page plugin CSS -->
    <style type="text/css" rel="stylesheet">
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
        var url_attributes = "{{ url('web/'.implode( '/', $module ).'/attributes')}}";
        var url_sub = "{{ url('web/'.implode( '/', $module ).'/sub')}}";
        $(document).ready(function () {
            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                "scrollY": '65vh',
                "aoColumns": [
                    {
                        "sTitle": "ID",
                        "mData": "iMemberId",
                        "width": "35px",
                        "sName": "iMemberId",
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                            // current_data[row.iId] = row;
                            // return '<button class="btn btn-xs btn-default btn-copy" title="複製"><i class="fa fa-copy" aria-hidden="true"></i></button>' + data;
                        }
                    },
                    {"sTitle": "使用者名稱", "mData": "vUserName", "width": "5%", "sName": "vUserName"},
                    {"sTitle": "使用者信箱", "mData": "vUserEmail", "width": "5%", "sName": "vUserEmail"},
                    {"sTitle": "連絡電話", "mData": "vUserContact", "width": "10%", "sName": "vUserContact"},
                    {"sTitle": "聯絡地址", "mData": "vUserAddress", "width": "10%", "sName": "vUserAddress"},
                    {
                        "sTitle": "Action",
                        "width": "90px",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            btn = '<button class="btn btn-xs btn-default btn-edit" title="修改"><i class="fa fa-pencil" aria-hidden="true">修改</i></button>';
                            // btn += '<button class="pull-right btn btn-xs btn-default btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            // btn += '<button class="btn btn-xs btn-default btn-attributes" title="相關資訊"><i class="fa fa-book" aria-hidden="true"></i></button>';
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
            /* END BASIC */
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
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->