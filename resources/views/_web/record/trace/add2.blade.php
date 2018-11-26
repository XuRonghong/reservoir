
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid-theme.min.css')}}" rel="stylesheet">
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.css')}}" rel="stylesheet">
    {{----}}
    <link href="{{url('css/trace_table01.css')}}" rel="stylesheet">
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
            <!-- Row -->
            <div class="row">
                <div class="col-12">
                    <div class="card" id="manage-modal">
                        <div class="card-body">
                            <h4 class="card-title vSummary">{{$vSummary or ''}}</h4>
                            <hr>
                        </div>
                        <form class="form-horizontal  trace_table">

                            <div class="card-body messageInfo-modal2  b">
                                <h4 class="card-title Title2">貳、檢查內容</h4>
                                <div class="form-group row  b1">
                                    <label for="com4" class="col-sm-3 text-left control-label col-form-label">一、結構物安全檢查</label>
                                    <div class="col-sm-9  b14">
                                        <br>
                                        <h4>
                                        @foreach($TraceTable['TraceRow1'] as $key => $var)
                                            <input style="width: 40px" class="com41" type="checkbox" name="{{$key or 0}}" value="{{$var or ''}}" />{{$var or ''}}
                                            <br><br>
                                        @endforeach
                                        </h4>
                                    </div>
                                </div>
                                <div class="form-group row  b3">
                                    <label for="com5" class="col-sm-3 text-left control-label col-form-label">二、放水設施安全檢查</label>
                                    <div class="col-sm-9  b14">
                                        <br>
                                        <h4>
                                        @foreach($TraceTable['TraceRow2'] as $key => $var)
                                            <input style="width: 40px" class="com41" type="checkbox" name="{{$key or 0}}" value="{{$var or ''}}" />{{$var or ''}}
                                            <br><br>
                                        @endforeach
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if(isset($info))
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-dosave" data-id="{{$reservoirId or 0}}">SAVE</button>
                                    @else
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-doadd" data-id="{{$reservoirId or 0}}">NEXT</button>
                                    @endif
                                    <button type="button" class="btn btn-dark waves-effect waves-light btn-cancel">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection
<!-- /content -->

@section('aside')

@endsection

<!-- ================== page-js ================== -->
@section('page-js')
    <!--This page JavaScript -->
    <script src="{{url('xtreme-admin/dist/js/pages/tables/js-grid-db.js')}}"></script>
    <script src="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.js')}}"></script>
    <script src="{{url('xtreme-admin/dist/js/pages/tables/js-grid-init.js')}} "></script>
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <script type="text/javascript">
        var current_data = [];
        var url_doadd2 = "{{ url('web/'.implode( '/', $module ).'/doadd2')}}";
        var url_dosave_add2 = "{{ url('web/'.implode( '/', $module ).'/dosave_add2')}}";

        $(document).ready(function () {

            /************************************************
             *  JQuery serializeArray decode :
             */
                <?php if (isset($info)){ ?>
                dd = {!! $info->vDetail !!};
                $.each(dd, function(i, field){
                    $("[name='"+field.name+"']").val(field.value).prop("checked", true);
                });
                <?php } ?>
            /*
             ***********************************************/

            //
            var modal = $("#manage-modal");
            current_modal = modal.find('.messageInfo-modal');
            //
            $(".btn-cancel").click(function () {
                history.back();
            });
            //
            $(".btn-doadd").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.iTargetKey = $(this).data('id');
                /************************************************
                 *  JQuery serializeArray encode :
                 */
                    data.vDetail = JSON.stringify( $('form.trace_table').serializeArray() );
                /*
                 ***********************************************/
                //
                $.ajax({
                    url: url_doadd2,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            //
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
                data.iTargetKey = $(this).data('id');
                /************************************************
                 *  JQuery serializeArray encode :
                 */
                    data.vDetail = JSON.stringify( $('form.trace_table').serializeArray() );
                /*
                 ***********************************************/
                //
                $.ajax({
                    url: url_dosave_add2,
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
    </script>
@endsection
<!-- ================== /inline-js ================== -->