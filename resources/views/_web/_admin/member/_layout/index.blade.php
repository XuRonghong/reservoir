@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style>
        <!--
        #dt_basic tr {
            height: 64px;
        }
        -->
    </style>
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!--  -->
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-editbutton="false"
                         data-widget-fullscreenbutton="false">
                        <!-- widget div-->
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i></span>
                            <h2>{{trans("_menu.".implode( '.', $module ).".title")}}</h2>
                            <a class="btn btn-default btn-sm pull-left btn-add-account" style="margin-left:10px"><i class="fa fa-create"></i>{{trans('web.add')}}</a>
                            <a class="btn btn-warning btn-sm pull-left" style="margin-left:10px" href="{{ url('web/'.implode( '/', $module ).'/excel')}}">{{trans('web.import')}}</a>
                        </header>
                        <div>
                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <table id="dt_basic" class="table table-striped table-bordered table-hover" style="width: 100%;"></table>
                            </div>
                            <!-- end widget content -->
                        </div>
                        <!-- end widget div -->
                    </div>
                </article>
                <!-- WIDGET END -->
            </div>
            <!-- end row -->
        </section>
        <!-- end widget grid -->
    </div>

@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_access = "{{ url('web/'.implode( '/', $module ).'/access')}}";
        $(document).ready(function () {
            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                "scrollY": "60vh",
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId", "sName": "sys_member.iId", "width": "50px", "bSortable": true, "bSearchable": false},
                    {
                        "sTitle": "啟用",
                        "mData": "bActive",
                        "sName": "sys_member.bActive",
                        "bSearchable": false,
                        "bSortable": true,
                        "width": "50px",
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-warning btn-active">已啟用</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-success btn-active">已停用</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {
                        "sTitle": "狀態",
                        "mData": "iStatus",
                        "sName": "sys_member.iStatus",
                        "bSearchable": false,
                        "bSortable": true,
                        "width": "50px",
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-danger btn-status">正常使用</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-status">停權中</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {
                        "sTitle": "Action",
                        "width": "50px",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            btn = '<button class="btn btn-xs btn-default btn-edit-account" title="編輯"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                            return btn;
                        }
                    },
                    {"sTitle": "會員編號", "mData": "iUserId", "sName": "sys_member.iUserId", "width": "50px", "bSortable": true, "bSearchable": true},
                    {"sTitle": "帳號", "mData": "vAccount", "sName": "sys_member.vAccount", "width": "50px", "bSortable": true, "bSearchable": true},
                    {"sTitle": "姓名", "mData": "vUserName", "sName": "sys_member_info.vUserName", "width": "50px", "bSortable": true, "bSearchable": true},
                    {"sTitle": "Email", "mData": "vUserEmail", "sName": "sys_member_info.vUserEmail", "width": "100px", "bSortable": true, "bSearchable": true},
                    {"sTitle": "配送地址", "mData": "vUserAddress", "sName": "sys_member_info.vUserAddress", "width": "300px", "bSortable": true, "bSearchable": true},
                    {"sTitle": "連絡電話", "mData": "vUserContact", "sName": "sys_member_info.vUserContact", "width": "100px", "bSortable": true, "bSearchable": true},
                    {"sTitle": "權限等級", "mData": "iAcType", "sName": "sys_member.iAcType", "width": "100px", "bSortable": false, "bSearchable": false},
                    {"sTitle": "註冊IP", "mData": "vCreateIP", "sName": "sys_member.vCreateIP", "width": "100px", "bSortable": true, "bSearchable": true},
                    {"sTitle": "註冊時間", "mData": "iCreateTime", "sName": "sys_member.iCreateTime", "width": "600px", "bSortable": true, "bSearchable": false},
                ],
                "sAjaxSource": ajax_source,
                "ajax": ajax_Table,
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                }
            });
            /* END BASIC */

            //
            $("#dt_basic").on('click', '.btn-active', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.bActive = "change";
                $.ajax({
                    url: url_dosave,
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
            })

            //
            $("#dt_basic").on('click', '.btn-status', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.iStatus = "change";
                $.ajax({
                    url: url_dosave,
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
            })
            //
            $("#dt_basic").on('click', '.btn-access', function () {
                var id = $(this).closest('tr').attr('id');
                location.href = url_access + "/" + id;
            });
        });
    </script>
    <!-- -->
    @include('_template_web._module.account_add')
    <!--  -->
    <!-- -->
    @include('_template_web._module.account_edit')
    <!--  -->
@endsection
<!-- ================== /inline-js ================== -->
