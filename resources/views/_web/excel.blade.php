@extends('_template_web._layouts.main')

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
        // DO NOT REMOVE : GLOBAL FUNCTIONS!
        pageSetUp();
    });
</script>
@endsection
<!-- ================== /inline-js ================== -->
