@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style>
        .table1 {
            width: 100%;
        }
        .table1 th {
            text-align: center;
        }
        .table1 td {
            text-align: center;
        }
        .table1 .img1 {
            margin: 10px;
            width: 160px;
            height: 160px;
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
        @include('_web._layouts.breadcrumb')
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

            <table border="1" class="table1" >
                <tr>
                    <th>水庫名稱</th>
                    <th>上視圖</th>
                    <th>剖面圖</th>
                    <th>3D圖</th>
                </tr>
                @foreach($aaData as $key => $value)
                <tr>
                    <td width="150px">{{$value['vName'] or ''}}</td>
                    <td>
                        <img class="img1" src="{{$value['img1'] or ''}}" />
                    </td>
                    <td>
                        <img class="img1" src="{{$value['img2'] or ''}}" />
                    </td>
                    <td>
                        <img class="img1" src="{{$value['img3'] or ''}}" />
                    </td>
                </tr>
                @endforeach
            </table>

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

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        $(document).ready(function() {
            //確認是否使用App開啟

            // DO NOT REMOVE : GLOBAL FUNCTIONS!
            // pageSetUp();

            {{--var api_data_list = "{{url('api/get_data')}}";--}}
            {{--var api_add_data = "{{url('api/putdata')}}";--}}
            {{--var api_edit_data = "{{url('api/editdata/3')}}";--}}
            {{--var api_del_data = "{{url('api/deldata/2')}}";--}}
            {{--// var data = {};--}}
            {{--var data = {"_token": "{{ csrf_token() }}"};--}}
            {{--data.data1 = 1212;--}}
            {{--data.data2 = 'hello world';--}}
            {{--$.ajax({--}}
                {{--url: api_del_data,--}}
                {{--data: data,--}}
                {{--type: "DELETE",--}}
                {{--resetForm: true,--}}
                {{--success: function (rtndata) {--}}
                    {{--toastr.success(rtndata , "{{trans('_web_alert.notice')}}");--}}
                {{--},--}}
                {{--error: function ( rtndata ) {--}}
                    {{--toastr.error( rtndata.responseJSON.message , "{{trans('_web_alert.notice')}}");--}}
                {{--}--}}
            {{--});--}}

        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
