@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style>
        <!--
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
                            <h2>{{trans('_menu.'.implode( '.', $module ).'.title')}}</h2>
                            <a class="btn btn-default btn-sm pull-left btn-add" style="margin-left:10px"><i class="fa fa-create"></i>{{trans('web.add')}}</a>
                        </header>
                        <div class="form-group">
                            <div class="col-md-2">
                                <div class="form-group input-group">
                                    <span class="input-group-addon">開始時間</span><input class="form-control iStartTime" id="iStartTime"
                                                                                      type="text" placeholder="iStartTime">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group input-group">
                                    <span class="input-group-addon">結束時間</span><input class="form-control iEndTime" id="iEndTime" type="text"
                                                                                      placeholder="iEndTime">
                                </div>
                            </div>
                            <a class="btn btn-default btn-sm pull-left btn-search"><i class="fa fa-search"></i></a>
                        </div>
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
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('web.admin.category.add')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control iStoreId" placeholder="店家群組ID" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control iMemberId" placeholder="店家會員ID" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="date" class="form-control iDateTime" placeholder="日期" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" class="form-control iCount" placeholder="次數" required/>
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
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script src="/web_assets/v3/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        $(document).ready(function () {
            if(localStorage.getItem('login.s_time')){
                $(".iStartTime").val(localStorage.getItem('login.s_time'));
                $(".iEndTime").val(localStorage.getItem('login.e_time'));
                ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}"+ "?s_time=" +
                    localStorage.getItem('login.s_time') + "&e_time=" + localStorage.getItem('login.e_time');
                ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}"+ "?s_time=" +
                    localStorage.getItem('login.s_time') + "&e_time=" + localStorage.getItem('login.e_time');
            }
            // Date Range Picker
            $("#iStartTime").datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: "+1w",
                changeMonth: true,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onClose: function (selectedDate) {
                    $("#iEndTime").datepicker("option", "minDate", selectedDate);
                },
                beforeShow: function (input, inst) {
                    //inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: input.offsetWidth + 'px'});
                    inst.dpDiv.css({marginTop: '0px', marginLeft: '0px'});
                    $("#iStartTime").css('z-index', 1060);
                }
            });
            $("#iEndTime").datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: "+1w",
                changeMonth: true,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onClose: function (selectedDate) {
                    $("#iStartTime").datepicker("option", "maxDate", selectedDate);
                },
                beforeShow: function (input, inst) {
                    //inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: input.offsetWidth + 'px'});
                    inst.dpDiv.css({marginTop: '0px', marginLeft: '0px'});
                    $("#iEndTime").css('z-index', 1060);
                }
            });
            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "scrollX": true,
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iStoreId", "width": "15%"},
                    {"sTitle": "店家名稱", "mData": "vStoreName", "width": "15%"},
                    {"sTitle": "累積上線", "mData": "total", "width": "15%"},
                    {
                        "sTitle": "Action",
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            //btn = '<button class="btn btn-xs btn-default btn-edit" title="修改"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                            //btn += '<button class="pull-right btn btn-xs btn-default btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            return btn;
                        }
                    }
                ],
                "sAjaxSource": ajax_source,
                "ajax": ajax_Table,
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
            });
            /* END BASIC */

            $(".btn-search").click(function () {
                var s_time = $("#iStartTime").val();
                var e_time = $("#iEndTime").val();
                ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}" + "?s_time=" + s_time + "&e_time=" + e_time;
                table.api().ajax.url(ajax_source).load();
                localStorage.setItem('login.s_time', s_time);
                localStorage.setItem('login.e_time', e_time);
            });
            //
            $(".btn-add").click(function () {
                var modal = $("#add-modal");
                modal.modal();
            })
            //
            $(".btn-doadd").click(function () {
                var modal = $("#add-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.iStoreId = modal.find('.iStoreId').val();
                data.iMemberId = modal.find('.iMemberId').val();
                data.iDateTime = modal.find('.iDateTime').val();
                data.iCount = modal.find('.iCount').val();
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
            })
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
