<!DOCTYPE HTML>
<html lang="{{config('app.locale')}}">
    <head>
        @section('page-title')
            <title>{{session('SEO.vTitle' , 'Loreal')}}</title>
        @show

        {{-- All layout meta is here --}}
        @include('_portal._layouts._2meta property')

        @include('_portal._layouts._3style')

        @include('_portal._layouts._4script')

        <!-- ================== page-css ================== -->
        @yield('page-css')
        <!-- ================== /page-css ================== -->
    </head>

    <body>
        @include('_portal._layouts._5header')

        <!-- MAIN CONTENT -->
        @yield('content')
        <!-- END MAIN CONTENT -->

        @include('_portal._layouts._7footer')

    </body>

            <!-- Public var -->
            @include('_portal._js.var')
            <!-- End var -->

            <!-- Public commit -->
            @include('_portal._js.commit')
            <!-- End commit -->

            <!-- ================== page-js ================== -->
            @yield('page-js')
            <!-- ================== /page-js ================== -->

            <!-- ================== inline-js ================== -->
            @yield('inline-js')
            <!-- ================== /inline-js================== -->
</html>