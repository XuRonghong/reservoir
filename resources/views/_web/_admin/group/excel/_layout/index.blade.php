@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style>
        tr .enter-highlight {
            background-color: whitesmoke !important;
        }
        .enter-highlight td {
            background-color: whitesmoke !important;
        }
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
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false">
                        <!-- widget div-->
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i></span>
                            <h2>{{trans('_menu.admin.group.title')}}</h2>
                        </header>
                        <div class="panel panel-primary">
                            <div class="panel-heading">批量匯入系統</div>
                            <div class="panel-body">
                                <div class="row">
                                    <label for="excel_download" class="col-md-1">下載暫存檔:</label>
                                    <div class="col-md-11" name="excel_download">
                                        <a href="{{ url('web/'.implode( '/', $module ).'/download-excel-file/xls')}}">XLS 下載</a> |
                                        <a href="{{ url('web/'.implode( '/', $module ).'/download-excel-file/xlsx')}}">XLSX 下載</a> |
                                        {{--<a href="{{ url('web/'.implode( '/', $module ).'/download-excel-file/csv')}}">Download CSV</a>--}}
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="excel_file" class="col-md-2">上傳資料表:</label>
                                </div>
                                <div class="row">
                                    <form method="POST" action="{{ url('web/'.implode( '/', $module ).'/upload-csv-excel')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                                        {{--<label for="excel_file" class="col-md-2">上傳資料表:</label>--}}
                                        <div class="form-group col-md-9">
                                            <input class="form-control" name="excel_file" type="file">
                                            @if ($errors->has('excel_file'))
                                                <div class="invalid-feedback">
                                                    <p class="alert alert-danger">{{ $errors->first('excel_file') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-1">
                                            <input class="btn btn-primary" type="submit" value="上傳資料">
                                        </div>
                                    </form>
                                    <form method="POST" action="{{ url('web/'.implode( '/', $module ).'/update-csv-excel')}}" accept-charset="UTF-8">
                                        {!! csrf_field() !!}
                                        <div class="form-group col-md-2">
                                            <input class="btn btn-danger" type="submit" value="更新並匯入資料">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div>
                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <table id="dt_basic" class="table table-striped table-bordered table-hover">

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
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="/web_assets/v3/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="/web_assets/v3/js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="/web_assets/v3/js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="/web_assets/v3/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="/web_assets/v3/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var current_data = [];
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        $(document).ready(function () {
            pageSetUp();
            /* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 320
            };
            var i = 0;
            table = $('#dt_basic').DataTable({
                serverSide: true,
                stateSave: true,
                scrollX: true,
                scrollY: "100%",
                ajax: ajax_Table,
                columnDefs: [
                    { width: "50px",targets: i},        //編號
                    { width: "100px",targets: ++i},
                    { width: "50px",targets: ++i},
                    { width: "50px",targets: ++i},
                    { width: "100px",targets: ++i},
                    { width: "100px",targets: ++i},
                    { width: "50px",targets: ++i},
                    { width: "50px",targets: ++i},
                    { width: "50px",targets: ++i},
                    { width: "200px",targets: ++i},
                    { width: "100px",targets: ++i},
                    { width: "200px",targets: ++i},
                    { width: "100px",targets: ++i},
                    { width: "100px",targets: ++i}

                ],
                columns: [
                    // {
                    //     "sTitle": "Action",
                    //     "bSortable": false,
                    //     "bSearchable": false,
                    //     "mRender": function (data, type, row) {
                    //         current_data[row.iId] = row;
                    //         var btn = "無功能";
                    //         btn = '<button class="btn btn-xs btn-default btn-edit" title="編輯"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    //         return btn;
                    //     }
                    // },
                        @foreach( $export as $db_code => $excel_column_name )
                    {
                        "sTitle": "{{$excel_column_name}}", "mData": "{{$db_code}}", "sName": "{{$db_code}}",
                        "mRender": function (data, type, row) {
                            table_result = "";
                            if(row.{{$db_code . '_flag'}} === 'NEW') {
                                table_result = "<div class='data-new'>"+data+"</div>";
                            } else if(row.{{$db_code . '_flag'}} === 'EDIT') {
                                table_result = "<div class='data-edit'>"+data+"</div>";
                            } else if(row.{{$db_code . '_flag'}} === 'SYNCED') {
                                table_result = "<div class='data-synced'>"+data+"</div>";
                            } else {
                                table_result = "<div class='data-failed'>"+data+"</div>";
                            }

                            return table_result;
                        }
                    },
                    @endforeach
                ],
                sDom: "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                autoWidth: true,
                oLanguage: {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                preDrawCallback: function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                    }
                },
                rowCallback: function ( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);

                    $.each($(nRow).find('td'),function(index, target){

                        if($(target).find('.data-failed').length)
                        {
                            $(target).addClass("bg-danger text-danger")
                        }
                        if($(target).find('.data-completed').length)
                        {
                            $(target).addClass("bg-success text-success")
                        }
                        if($(target).find('.data-synced').length)
                        {
                            $(target).addClass("bg-normal text-normal")
                        }
                        if($(target).find('.data-new').length)
                        {
                            $(target).addClass("bg-success text-success")
                        }
                        if($(target).find('.data-edit').length)
                        {
                            $(target).addClass("bg-warning text-warning")
                        }
                    });
                },
                drawCallback: function ( oSettings ) {
                    responsiveHelper_dt_basic.respond();
                }
            });

            // $('#dt_basic tbody').on( 'mouseenter', 'td', function () {
            //     var rowIdx = table.cell(this).index().row;
            //
            //     $( table.rows().nodes() ).removeClass( 'enter-highlight' );
            //     $( table.row( rowIdx ).nodes() ).addClass( 'enter-highlight' );
            // } );
            // $('#dt_basic tbody').on( 'click', 'td', function () {
            //     var rowIdx = table.cell(this).index().row;
            //
            //     $( table.rows().nodes() ).removeClass( 'highlight' );
            //     $( table.row( rowIdx ).nodes() ).addClass( 'highlight' );
            // } );

            //
            $(".btn-edit").on('click', function () {
                var id = $(this).closest('tr').attr('id');
                var modal = $("#edit-modal");
                modal.data('id', id);
                modal.find(".vGroupName").val(current_data[id].vGroupName);
                modal.modal();
            });
            //
            $(".btn-dosave").on('click', function () {
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
            $(".btn-add").on('click', function () {
                var modal = $("#add-modal");
                modal.modal();
            });
            //
            $(".btn-doadd").on('click', function () {
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
