
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!-- This page plugin CSS -->
    <style type="text/css" rel="stylesheet">
        .btn {
            margin-left: 10px;
            margin-bottom: 10px;
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
        {{--@include('_web._layouts.breadcrumb')--}}
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{--<h4 class="card-title">{{session()->get( 'SEO.vTitle')}}</h4>--}}
                            {{--<h6 class="card-subtitle">{{$vSummary or ''}}</h6>--}}
                            @if( session('member.iAcType') == 1 )
                                <button type="button" class="btn btn-warning waves-effect waves-light btn-check btn-dodelall" data-id="{{$info->iId or ''}}">
                                    Delete All Comment
                                </button>
                            @endif
                            <div class="table-responsive">
                                <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
                                                <thead>
                                                <tr>
                                                    <th>{{$total or 0}} Message</th>
                                                    <th class="initClick"></th>
                                                </tr>
                                                </thead>
                                                <tbody class="productConetnt">
                                                @foreach($info as $item)
                                                    <tr class="goMess" data-href="{{$item['url'] or ''}}">
                                                        <td >
                                                            <a href="{{$item->url or ''}}">
                                                                {{$item['vTitle'] or ''}}
                                                            </a>
                                                            <br>
                                                            {!! $item['vSummary'] !!}
                                                            <br>
                                                        </td>
                                                        <td width="15%">
                                                            <div style="text-align: right">
                                                                {{$item['iCreateTime'] or ''}}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="zero_config_info" role="status" aria-live="polite">
                                                {{--Showing 1 to 10 of 57 entries--}}
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="zero_config_paginate">
                                                <ul class="pagination">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
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
    <script>
        $(document).ready(function () {
            //
            var init = $('.initClick');
            init.click();
            init.click();

            var table = $('#zero_config').dataTable();
            table.api().bProcessing = true;

            //
            $('.goMess').click(function () {
               url = $(this).data('href');
               location.href = url;
            });

            //
            $('.btn-dodelall').click(function () {
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                swal({
                    title: "{{trans('_web_alert.del.title')}}" + '全部',
                    text: "{{trans('_web_alert.del.note')}}",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "{{trans('_web_alert.cancel')}}",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{trans('_web_alert.ok')}}",
                    closeOnConfirm: true
                }, function () {
                    run_waitMe('body');
                    $.ajax({
                        url: '{{url('web/message/dodelall')}}',
                        data: data,
                        type: "delete",
                        success: function (rtndata) {
                            if (rtndata.status){
                                toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                                setTimeout(function () {
                                    location.reload();
                                    $('body').waitMe('hide');
                                }, 1000);
                            }
                        },
                        error: function (rtndata) {
                            toastr.error(rtndata.responseJSON.message, "{{trans('_web_alert.notice')}}");
                        }
                    });
                });
            });
            //
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->