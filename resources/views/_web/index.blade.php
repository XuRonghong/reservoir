@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!--  -->
    <div id="content"></div>
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

        function checkIsApp(){
            // var ID = document.getElementById("IDName").value;
            document.location = "js://checkIsApp?ID="+'{{session('member.iId',0)}}';
        }
    </script>
@endsection
<!-- ================== /inline-js ================== -->
