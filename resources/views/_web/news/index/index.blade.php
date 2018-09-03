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
                    <h4 class="modal-title" id="myModalLabel">新增</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control iCategoryType">
                                    <option value="0">請選擇類別</option>
                                    @foreach($sys_category as $val)
                                        <option value="{{$val->iId}}">{{$val->vCategoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a class="btn-image-modal" data-modal="image-form" data-id="">
                                    <img src="/images/empty.jpg" style="height:140px">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <span class="input-group-addon">開始時間</span><input class="form-control iStartTime"
                                                                                  type="text" placeholder="iStartTime">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <span class="input-group-addon">結束時間</span><input class="form-control iEndTime" type="text"
                                                                                  placeholder="iEndTime">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vTitle" placeholder="標題"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vSummary" placeholder="簡介"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vUrl" placeholder="外部連結 https://"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="summernote vDetail"></div>
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
                    <h4 class="modal-title" id="myModalLabel">編輯</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control iCategoryType">
                                    <option value="0">請選擇類別</option>
                                    @foreach($sys_category as $val)
                                        <option value="{{$val->iId}}">{{$val->vCategoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a class="btn-image-modal" data-modal="image-form" data-id="">
                                    <img src="/images/empty.jpg" style="height:140px">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <span class="input-group-addon">開始時間</span>
                                <input class="form-control iStartTime" value="{{date('Y-m-d',time())}}"
                                       type="text" placeholder="iStartTime">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <span class="input-group-addon">結束時間</span>
                                <input class="form-control iEndTime" value="{{date('Y-m-d',time())}}"
                                       type="text" placeholder="iEndTime">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vTitle" placeholder="標題"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vSummary" placeholder="簡介"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vUrl" placeholder="外部連結 https://"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="summernote vDetail"></div>
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
    <!--  -->
    <!-- Public Crop_Image -->
    @include('_template_web._js.crop_image_single_modal_340175')
    <!-- Public SummerNote -->
    @include('_template_web._js.summernote')
    <!-- end -->
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_dodel = "{{ url('web/'.implode( '/', $module ).'/dodel')}}";
        $(document).ready(function () {
            // Date Range Picker
            $(".iStartTime").datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: "",
                changeMonth: true,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onClose: function (selectedDate) {
                    $(".iEndTime").datepicker("option", "minDate", selectedDate);
                    setdate($(".iStartTime").val(), $(".iEndTime").val());
                },
                beforeShow: function (input, inst) {
                    //inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: input.offsetWidth + 'px'});
                    inst.dpDiv.css({marginTop: '0px', marginLeft: '0px'});
                    $(".iStartTime").css('z-index', 1060);
                }
            });
            $(".iEndTime").datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: "",
                changeMonth: true,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onClose: function (selectedDate) {
                    $(".iStartTime").datepicker("option", "maxDate", selectedDate);
                    setdate($(".iStartTime").val(), $(".iEndTime").val());
                },
                beforeShow: function (input, inst) {
                    //inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: input.offsetWidth + 'px'});
                    inst.dpDiv.css({marginTop: '0px', marginLeft: '0px'});
                    $(".iEndTime").css('z-index', 1060);
                }
            });
            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                "aoColumns": [
                    {"sTitle": "Id", "mData": "iId", "width": "5%", "sName": "iId"},
                    {
                        "sTitle": "類別",
                        "mData": "vCategoryName",
                        "width": "10%",
                        "bSortable": false,
                        "bSearchable": false,
                    },
                    {"sTitle": "標題", "mData": "vTitle", "width": "10%", "sName": "vTitle"},
                    {
                        "sTitle": "圖片",
                        "mData": "vImages",
                        "sName": "vImages",
                        "width": "10%",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return "<img width='100px' src=" + data + ">";
                        }
                    },
                    {"sTitle": "簡介", "mData": "vSummary", "width": "15%", "sName": "vSummary"},
                    {"sTitle": "外部連結", "mData": "vUrl", "width": "5%", "sName": "vUrl"},
                    {
                        "sTitle": "公告時間",
                        "mData": "iStartTime",
                        "sName": "iStartTime",
                        "width": "10%",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return row.iStartTime + "~" + row.iEndTime;
                        }
                    },
                    {
                        "sTitle": "上/下架",
                        "mData": "iStatus",
                        "sName": "iStatus",
                        "width": "5%",
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-danger btn-status">已上架</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-status">未上架</button>';
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
                            btn = '<button class="btn btn-xs btn-default btn-edit" title="修改"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
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
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
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
                                table.api().ajax.reload(null, false);
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
            //
            $("#dt_basic").on('click', '.btn-edit', function () {
                var id = $(this).closest('tr').attr('id');
                modal = $("#edit-modal");
                current_modal = modal;
                modal.data('id', id);
                modal.find(".iCategoryType").val(current_data[id].iCategoryType);
                modal.find(".vTitle").val(current_data[id].vTitle);
                modal.find(".vSummary").val(current_data[id].vSummary);
                modal.find("img").attr('src', current_data[id].vImages);
                modal.find(".vUrl").val(current_data[id].vUrl);
                modal.find(".vDetail").summernote('code', current_data[id].vDetail);
                modal.find(".iStartTime").val(current_data[id].iStartTime);
                modal.find(".iEndTime").val(current_data[id].iEndTime);
                modal.modal();
            });
            //
            $(".btn-dosave").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = modal.data('id');
                data.iCategoryType = modal.find('.iCategoryType').val();
                data.vTitle = modal.find('.vTitle').val();
                data.vSummary = modal.find('.vSummary').val();
                data.vImages = modal.find("img").attr('src');
                data.vUrl = modal.find('.vUrl').val();
                data.vDetail = modal.find('.vDetail').summernote('code');
                data.iStartTime = modal.find(".iStartTime").val();
                data.iEndTime = modal.find(".iEndTime").val();
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
                                table.api().ajax.reload(null, false);
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
                current_modal = modal;
                modal.modal();
            });
            //
            $(".btn-doadd").click(function () {
                var modal = $("#add-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.iCategoryType = modal.find('.iCategoryType').val();
                data.vTitle = modal.find(".vTitle").val();
                data.vSummary = modal.find(".vSummary").val();
                data.vImages = modal.find("img").attr('src');
                data.vUrl = modal.find(".vUrl").val();
                data.vDetail = modal.find('.vDetail').summernote('code');
                data.iStartTime = modal.find(".iStartTime").val();
                data.iEndTime = modal.find(".iEndTime").val();
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
                                table.api().ajax.reload(null, false);
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
