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
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false"
                         data-widget-fullscreenbutton="false">
                        <!-- widget div-->
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i></span>
                            <h2>{{trans('_menu.'.implode( '.', $module ).'.title')}}</h2>
                            <a class="btn btn-default btn-sm pull-left btn-add" style="margin-left:10px"><i class="fa fa-create"></i>{{trans('web.add')}}</a>
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
        <div class="modal-dialog" style="width:70%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('_menu.'.implode( '.', $module ).'.add.title')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control iType">
                                    <option value="0" disabled>--請選擇廣告類型--</option>
                                    <option value="3">滑動廣告</option>
                                    {{--<option value="4">雙條Banner</option>--}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="type3" class="row" style="display: block">
                        <div class="col-md-12">
                            <div id="3-1" class="form-group">
                                <a class="btn-image-modal" data-modal="image-form" data-id="">
                                    <img src="/images/empty.jpg" style="width: 250px;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="type4" class="row" style="display: none">
                        <div class="col-md-6">
                            <div id="4-1" class="form-group">
                                <a class="btn-image-modal" data-modal="image-form" data-id="">
                                    <img src="/images/empty.jpg" style="width: 250px;">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="4-2" class="form-group">
                                <a class="btn-image-modal" data-modal="image-form" data-id="">
                                    <img src="/images/empty.jpg" style="width: 250px;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vTitle" id="vTitle" placeholder="標題"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vSummary" id="vSummary" placeholder="簡介"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vUrl" id="vUrl" placeholder="連結"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <span class="input-group-addon">開始時間</span><input class="form-control iStartTime" id="iStartTime1" type="text" placeholder="iStartTime">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <span class="input-group-addon">結束時間</span><input class="form-control iEndTime" id="iEndTime1" type="text" placeholder="iEndTime">
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
        <div class="modal-dialog" style="width:70%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('_menu.'.implode( '.', $module ).'.edit.title')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control iType">
                                    <option value="0" disabled>--請選擇廣告類型--</option>
                                    <option value="3">滑動廣告</option>
                                    {{--<option value="4">雙條Banner</option>--}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="type31" class="row" style="display: block">
                        <div class="col-md-12">
                            <div id="31-1" class="form-group">
                                <a class="btn-image-modal" data-modal="image-form" data-id="">
                                    <img src="/images/empty.jpg" style="width: 250px;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="type41" class="row" style="display: none">
                        <div class="col-md-6">
                            <div id="41-1" class="form-group">
                                <a class="btn-image-modal" data-modal="image-form" data-id="">
                                    <img src="/images/empty.jpg" style="width: 250px;">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="41-2" class="form-group">
                                <a class="btn-image-modal" data-modal="image-form" data-id="">
                                    <img src="/images/empty.jpg" style="width: 250px;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vTitle" id="vTitle" placeholder="標題"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vSummary" id="vSummary" placeholder="簡介"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vUrl" id="vUrl" placeholder="連結"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <span class="input-group-addon">開始時間</span><input class="form-control iStartTime" id="iStartTime2" type="text" placeholder="iStartTime">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <span class="input-group-addon">結束時間</span><input class="form-control iEndTime" id="iEndTime2" type="text" placeholder="iEndTime">
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
    <!-- Public Crop_Image -->
    @include('_template_web._js.crop_image_single_modal_1920x640')
    <!-- end -->
    <!--  -->
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_dodel = "{{ url('web/'.implode( '/', $module ).'/dodel')}}";
        $(document).ready(function () {
            // Date Range Picker
            $("#iStartTime1").datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: "+1w",
                changeMonth: true,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onClose: function (selectedDate) {
                    $("#iEndTime1").datepicker("option", "minDate", selectedDate);
                },
                beforeShow: function (input, inst) {
                    //inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: input.offsetWidth + 'px'});
                    inst.dpDiv.css({marginTop: '0px', marginLeft: '0px'});
                    $("#iStartTime1").css('z-index', 1060);
                }
            });
            $("#iEndTime1").datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: "+1w",
                changeMonth: true,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onClose: function (selectedDate) {
                    $("#iStartTime1").datepicker("option", "maxDate", selectedDate);
                },
                beforeShow: function (input, inst) {
                    //inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: input.offsetWidth + 'px'});
                    inst.dpDiv.css({marginTop: '0px', marginLeft: '0px'});
                    $("#iEndTime1").css('z-index', 1060);
                }
            });

            // Date Range Picker
            $("#iStartTime2").datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: "+1w",
                changeMonth: true,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onClose: function (selectedDate) {
                    $("#iEndTime2").datepicker("option", "minDate", selectedDate);
                },
                beforeShow: function (input, inst) {
                    //inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: input.offsetWidth + 'px'});
                    inst.dpDiv.css({marginTop: '0px', marginLeft: '0px'});
                    $("#iStartTime2").css('z-index', 1060);
                }
            });
            $("#iEndTime2").datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: "+1w",
                changeMonth: true,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onClose: function (selectedDate) {
                    $("#iStartTime2").datepicker("option", "maxDate", selectedDate);
                },
                beforeShow: function (input, inst) {
                    //inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: input.offsetWidth + 'px'});
                    inst.dpDiv.css({marginTop: '0px', marginLeft: '0px'});
                    $("#iEndTime2").css('z-index', 1060);
                }
            });
            //
            $("#add-modal .iType").change(function () {
                var type = $(this).val();
                switch (type) {
                    case '3':
                        $("#type3").css('display', 'block');
                        $("#type4").css('display', 'none');
                        break;
                    case '4':
                        $("#type3").css('display', 'none');
                        $("#type4").css('display', 'block');
                        break;
                    default:
                        $("#type3").css('display', 'none');
                        $("#type4").css('display', 'none');
                }
            });
            $("#edit-modal .iType").change(function () {
                var type = $(this).val();
                switch (type) {
                    case '3':
                        $("#type31").css('display', 'block');
                        $("#type41").css('display', 'none');
                        break;
                    case '4':
                        $("#type31").css('display', 'none');
                        $("#type41").css('display', 'block');
                        break;
                    default:
                        $("#type31").css('display', 'none');
                        $("#type41").css('display', 'none');
                }
            });

            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                "aoColumns": [
                    {"sTitle": "Id", "mData": "iId", "width": "5%"},
                    {
                        "sTitle": "圖片",
                        "mData": "vImages",
                        "mRender": function (data, type, row) {
                            var html_str = "";
                            for (var key in data) {
                                html_str += "<img src='" + data[key] + "' style='width:100px' > ";
                            }
                            return html_str;
                        }
                    },
                    {"sTitle": "標題", "mData": "vTitle", "width": "10%"},
                    {"sTitle": "簡介", "mData": "vSummary", "width": "10%"},
                    {"sTitle": "連結", "mData": "vUrl", "width": "20%"},
                    {"sTitle": "開始時間", "mData": "iStartTime", "width": "5%"},
                    {"sTitle": "結束時間", "mData": "iEndTime", "width": "5%"},
                    {"sTitle": "更新時間", "mData": "iUpdateTime", "width": "10%"},
                    {
                        "sTitle": "iStatus",
                        "mData": "iStatus",
                        "width": "5%",
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-danger btn-status">停用</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-status">啟用</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {
                        "sTitle": "Action",
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            btn = '<button class="btn btn-xs btn-default btn-edit" title="編輯"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                            btn += '<button class="pull-right btn btn-xs btn-default btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
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
                    "sInfoFiltered": "zh-tw",
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                }
            });
            /* END BASIC */
            //
            $("#dt_basic").on('click', '.btn-show', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.bShow = "change";
                $.ajax({
                    url: url_dosave,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
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
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
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
                                swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                                setTimeout(function () {
                                    table.api().ajax.reload();
                                }, 100);

                            } else {
                                swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                            }
                        }
                    });
                });
            });
            //
            $("#dt_basic").on('click', '.btn-edit', function () {
                var id = $(this).closest('tr').attr('id');
                var modal = $("#edit-modal");
                //
                current_modal = modal;
                //
                modal.data('id', id);
                modal.find(".iType").val(current_data[id].iType);
                switch (current_data[id].iType) {
                    case 3:
                        modal.find("#type31").css('display', 'block');
                        modal.find("#type41").css('display', 'none');
                        modal.find("#type31").find('img').attr('src', current_data[id].vImages);
                        break;
                    case 4:
                        modal.find("#type31").css('display', 'none');
                        modal.find("#type41").css('display', 'block');
                        modal.find("#type41").find("#41-1").find('img').attr('src', current_data[id].vImages[0])
                        modal.find("#type41").find("#41-2").find('img').attr('src', current_data[id].vImages[1])
                        break;
                }
                modal.find(".vTitle").val(current_data[id].vTitle);
                modal.find(".vUrl").val(current_data[id].vUrl);
                modal.find(".vSummary").val(current_data[id].vSummary);
                modal.find(".iStartTime").val(current_data[id].iStartTime);
                modal.find(".iEndTime").val(current_data[id].iEndTime);
                modal.modal();
            });
            //
            $(".btn-dosave").click(function () {
                var modal = $("#edit-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = modal.data('id');
                data.iType = modal.find('.iType').val();
                switch (data.iType) {
                    case '3':
                        data.vImages = modal.find("#31-1").find('img').attr('src');
                        break;
                    case '4':
                        data.vImages = modal.find("#41-1").find('img').attr('src') + ";";
                        data.vImages += modal.find("#41-2").find('img').attr('src');
                        break;
                }
                data.vTitle = modal.find('.vTitle').val();
                data.vUrl = modal.find('.vUrl').val();
                data.vSummary = modal.find('.vSummary').val();
                data.iStartTime = modal.find('.iStartTime').val();
                data.iEndTime = modal.find('.iEndTime').val();
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
                //
                current_modal = modal;
                //
                modal.modal();
            });
            //
            $(".btn-doadd").click(function () {
                var modal = $("#add-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.iType = modal.find('.iType').val();
                switch (data.iType) {
                    case '3':
                        data.vImages = modal.find("#3-1").find('img').attr('src');
                        break;
                    case '4':
                        data.vImages = modal.find("#4-1").find('img').attr('src') + ";";
                        data.vImages += modal.find("#4-2").find('img').attr('src');
                        break;
                }
                data.vTitle = modal.find('.vTitle').val();
                data.vUrl = modal.find('.vUrl').val();
                data.vSummary = modal.find('.vSummary').val();
                data.iStartTime = modal.find('.iStartTime').val();
                data.iEndTime = modal.find('.iEndTime').val();
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
            //
            $("#dt_basic").on('click', '.btn-sub', function () {
                var id = $(this).closest('tr').attr('id');
                location.href = url_sub + '_' + id;
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
