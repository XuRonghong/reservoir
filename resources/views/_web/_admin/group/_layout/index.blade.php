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
                            <h2>{{trans('_menu.admin.group.title')}}</h2>
                            <a class="btn btn-default btn-sm pull-left btn-add" style="margin-left:10px"><i class="fa fa-create"></i>{{trans('web.add')}}</a>
                            <a class="btn btn-warning btn-sm pull-left" style="margin-left:10px" href="{{ url('web/'.implode( '/', $module ).'/excel')}}">{{trans('web.import')}}</a>
                        </header>
                        <div>
                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <table id="dt_basic" class="table table-striped table-bordered table-hover" style="width: 100%;">
                                </table>
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
    <!-- Modal -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('web.admin.group.add')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vGroupName" id="vGroupName" placeholder="{{trans('web.admin.group.group_name')}}" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                    <button type="button" class="btn btn-primary btn-doadd">{{trans('web.doadd')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('web.admin.group.edit')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vGroupName" id="vGroupName" placeholder="{{trans('web.admin.group.group_name')}}" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                    <button type="button" class="btn btn-primary btn-dosave">{{trans('web.dosave')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Modal -->
    <div class="modal fade" id="include-member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 65%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('web.include_group_manager')}}</h4>
                </div>
                <div class="modal-body" style="overflow: hidden;">
                    <!-- widget content -->
                    <table id="dt_member" class="table table-striped table-bordered table-hover" style="width: 100%;">
                    </table>
                    <!-- end widget content -->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var current_data = [];
        var member_data = [];
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        $(document).ready(function () {
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                "scrollY": "65vh",
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId", "sName": "iId"},
                    {
                        "sTitle": "負責人",
                        "mData": "vUserName",
                        "sName": "vUserName",
                        "bSortable": true,
                        "bSearchable": true,
                        "mRender": function (data, type, row) {
                            var btn = "無";
                            if (data == '0') {
                                btn += '<button class="btn btn-xs btn-danger btn-manager-change" style="margin-left: 10px">新增</button>';
                            } else {
                                btn = data;
                                btn += '<button class="btn btn-xs btn-danger btn-manager-change" style="margin-left: 10px">更換</button>';
                            }
                            return btn;
                        }
                    },
                    {"sTitle": "群組名稱", "mData": "vGroupName", "sName": "vGroupName"},
                    //{"sTitle": "建立時間", "mData": "iCreateTime", "sName": "iCreateTime"},
                    {
                        "sTitle": "狀態",
                        "mData": "iStatus",
                        "sName": "iStatus",
                        "bSortable": true,
                        "bSearchable": true,
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-danger btn-status">停權</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-status">復權</button>';
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
                            btn = '<button class="btn btn-xs btn-default btn-edit" title="編輯"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
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
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                }
            });
            /* END BASIC */
            /* BASIC ;*/
            var dt_id = "#dt_member";
            var table_member = $(dt_id).dataTable({
                "serverSide": true,
                "stateSave": true,
                "aoColumns": [
                    {"sTitle": "iId", "mData": "iId", "sName": "iId"},
                    {"sTitle": "帳號", "mData": "vAccount", "sName": "vAccount"},
                    {"sTitle": "使用者名稱", "mData": "vUserName", "sName": "vUserName"},
                    {
                        "sTitle": "Action",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            member_data[row.iId] = row;
                            var btn = "";
                            btn += '<button class="btn btn-xs btn-default btn-include" title="確定">確定</button>';
                            return btn;
                        }
                    }
                ],
                "sAjaxSource": "{{ url('web/'.implode( '/', $module ).'/getmember')}}",
                "ajax": "{{ url('web/'.implode( '/', $module ).'/getmember')}}",
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
                                table.api().ajax.reload();
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            })
            //
            $("#dt_basic").on('click', '.btn-manager-change', function () {
                var id = $(this).closest('tr').attr('id');
                var modal = $("#include-member");
                modal.data('id', id);
                modal.modal();
            })
            //
            $("#dt_member").on('click', '.btn-include', function () {
                var id = $("#include-member").data('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.iManagerId = $(this).closest('tr').attr('id');
                $.ajax({
                    url: url_dosave,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            $("#include-member").modal('toggle');
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                            setTimeout(function () {
                                table.api().ajax.reload();
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
                var modal = $("#edit-modal");
                modal.data('id', id);
                modal.find(".vGroupName").val(current_data[id].vGroupName);
                modal.modal();
            });
            //
            $(".btn-dosave").click(function () {
                var modal = $("#edit-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = modal.data('id');
                data.vGroupName = modal.find('.vGroupName').val();
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            modal.modal('toggle');
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function () {
                                table.api().ajax.reload();
                            }, 1000)
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
            //
            $(".btn-add").click(function () {
                var modal = $("#add-modal");
                modal.modal();
            });
            //
            $(".btn-doadd").click(function () {
                var modal = $("#add-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.vGroupName = modal.find('.vGroupName').val();
                $.ajax({
                    url: url_doadd,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            modal.modal('toggle');
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function () {
                                table.api().ajax.reload();
                            }, 1000)
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
