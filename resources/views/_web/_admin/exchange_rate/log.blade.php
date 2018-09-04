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
                            <h2>{{trans("_menu.admin.exchange_rate.title")}}</h2>
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
    <!--  -->
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        $(document).ready(function () {
            /* BASIC ;*/
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                "scrollY": "65vh",
                "aoColumns": [
                    {"sTitle": "Id", "mData": "iId", "sName": "iId"},
                    {"sTitle": "RateName", "mData": "vRateName", "sName": "iId"},
                    {"sTitle": "BuyCash", "mData": "fBuyCash", "sName": "iId"},
                    {"sTitle": "SellCash", "mData": "fSellCash", "sName": "iId"},
                    {"sTitle": "BuySpot", "mData": "fBuySpot", "sName": "iId"},
                    {"sTitle": "SellSpot", "mData": "fSellSpot", "sName": "iId"},
                    {"sTitle": "DateTime", "mData": "iDateTime", "sName": "iId"}
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
            $("#dt_basic").on('click', '.btn-edit', function () {
                var id = $(this).closest('tr').attr('id');
                var modal = $("#edit-modal");
                modal.data('id', id);
                modal.find(".iAcType").val(current_data[id].iAcType);
                modal.modal();
            })
            //
            $(".btn-dosave").click(function () {
                var modal = $("#edit-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = modal.data('id');
                data.iAcType = modal.find('.iAcType').val();
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
            $(".btn-update-rate").click(function () {
                window.open('{{url('autorun')}}', 'exchange_rate');
            })
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
