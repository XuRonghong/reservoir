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
                            <h2>{{trans('_menu.admin.category.title')}} >></h2>
                            <h2>{{$info->vCategoryName}}</h2>
                            <a class="btn btn-primary btn-sm pull-left btn-goback" style="margin-left:10px"><i class="fa fa-create"></i>{{trans('web.goback')}}</a>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{$info->vCategoryName}} > {{trans('web.admin.category.sub_add')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vCategoryValue" id="vCategoryValue" placeholder="{{trans('web.admin.category.category_value')}}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vCategoryName" id="vCategoryName" placeholder="{{trans('web.admin.category.category_name')}}" required/>
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
                    <h4 class="modal-title" id="myModalLabel">{{$info->vCategoryName}} > {{trans('web.admin.category.sub_edit')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vCategoryValue" id="vCategoryValue" placeholder="{{trans('web.admin.category.category_value')}}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control vCategoryName" id="vCategoryName" placeholder="{{trans('web.admin.category.category_name')}}" required/>
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
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <!-- Public Crop_Image -->
    @include('_template_web._js.crop_image_single_modal')
    <!-- end -->
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/sub_'.$info->iId.'/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/sub_'.$info->iId.'/getlist')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/sub_'.$info->iId.'/dosave')}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/sub_'.$info->iId.'/doadd')}}";
        var url_goback = "{{ url('web/'.implode( '/', $module ))}}";
        $(document).ready(function () {
            //
            $(".btn-goback").click(function () {
                location.href = url_goback;
            })
            /* BASIC ;*/
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                "scrollY": "65vh",
                "aoColumns": [
                    {"sTitle": "Id", "mData": "iId", "sName": "iId"},
                    {
                        "sTitle": "IRank",
                        "mData": "iRank",
                        "sName": "iRank",
                        "bSearchable": false,
                        "width": "30px",
                        "mRender": function (data, type, row) {
                            return '<input class="irank" size="1" type="text" value="' + data + '"></input>';
                        }
                    },
                    {
                        "sTitle": "類別圖片",
                        "mData": "vImages",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return "<img width='75px' src=" + data + ">";
                        }
                    },
                    {"sTitle": "類別代碼", "mData": "vCategoryValue", "sName": "vCategoryValue"},
                    {"sTitle": "類別名稱", "mData": "vCategoryName", "sName": "vCategoryName"},
                    {
                        "sTitle": "狀態",
                        "mData": "iStatus",
                        "sName": "iStatus",
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
                    url: url_dosave,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
                            }, 10);
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
            $("#dt_basic").on('click', '.btn-edit', function () {
                var id = $(this).closest('tr').attr('id');
                var modal = $("#edit-modal");
                current_modal = modal;
                modal.data('id', id);
                modal.find(".vCategoryValue").val(current_data[id].vCategoryValue);
                modal.find(".vCategoryName").val(current_data[id].vCategoryName);
                modal.find("img").attr('src', current_data[id].vImages);
                modal.modal();
            })
            //
            $(".btn-dosave").click(function () {
                var modal = $("#edit-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = modal.data('id');
                data.vCategoryValue = modal.find('.vCategoryValue').val();
                data.vCategoryName = modal.find('.vCategoryName').val();
                data.vImages = modal.find("img").attr('src');
                if (data.vCategoryValue == "") {
                    toastr.error("資料不得為空", "{{trans('_web_alert.notice')}}");
                    modal.find('.vCategoryValue').focus();
                    return false;
                }
                if (data.vCategoryName == "") {
                    toastr.error("資料不得為空", "{{trans('_web_alert.notice')}}");
                    modal.find('.vCategoryName').focus();
                    return false;
                }
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
            })
            //
            $(".btn-add").click(function () {
                var modal = $("#add-modal");
                current_modal = modal;
                modal.modal();
            })
            //
            $(".btn-doadd").click(function () {
                var modal = $("#add-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.vCategoryValue = modal.find('.vCategoryValue').val();
                data.vCategoryName = modal.find('.vCategoryName').val();
                data.vImages = modal.find("img").attr('src');
                if (data.vCategoryValue == "") {
                    toastr.error("資料不得為空", "{{trans('_web_alert.notice')}}");
                    modal.find('.vCategoryValue').focus();
                    return false;
                }
                if (data.vCategoryName == "") {
                    toastr.error("資料不得為空", "{{trans('_web_alert.notice')}}");
                    modal.find('.vCategoryName').focus();
                    return false;
                }
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
