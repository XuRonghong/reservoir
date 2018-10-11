<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <title>{{session()->get( 'SEO.vTitle' , 'Kahap')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('xtreme-admin/assets/images/favicon.png')}}">
    <!-- Custom CSS -->
    <link href="{{url('xtreme-admin/dist/css/style.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- dataTables -->
    <link rel="stylesheet" href="{{url('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{url('css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{url('xtreme-admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">

    <!-- This page plugin CSS -->
    @yield('page-css')

    {{-- sudo view --}}
    @if(session('member.iAcType')==1)
        <style rel="stylesheet" type="text/css">
            #main-wrapper[data-layout=vertical] .topbar .navbar-collapse[data-navbarbg=skin1], #main-wrapper[data-layout=vertical] .topbar[data-navbarbg=skin1], #main-wrapper[data-layout=horizontal] .topbar .navbar-collapse[data-navbarbg=skin1], #main-wrapper[data-layout=horizontal] .topbar[data-navbarbg=skin1] {
                background-color: #d69d00;
            }
        </style>
    @endif
    <style>
        .margin-left-10 li {
            margin-left: 5%;
        }
        #main-wrapper {
            width: 480px;
            height: 715px;
            text-align: center;
        }
    </style>
</head>
<body id="body01">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- HEADER -->
        @include('_web._layouts.header')
        <!-- END HEADER -->

        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->

        <!-- MAIN PANEL -->

            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <!-- End Sidebar navigation -->

                    <!-- NAVIGATION : This navigation is also responsive-->
                    <!-- Public nav -->
                    @include('_web._layouts.nav')
                    <!-- end nav -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->

            <!-- MAIN CONTENT -->
            @yield('content')
            <!-- END MAIN CONTENT -->

            <!-- FOOTER -->
            @include('_web._layouts.footer')
            <!-- END FOOTER -->

        <!-- END MAIN PANEL -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    @yield('aside')


    <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{url('xtreme-admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{url('xtreme-admin/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('xtreme-admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- apps -->
    <script src="{{url('xtreme-admin/dist/js/app.min.js')}}"></script>
    <script src="{{url('xtreme-admin/dist/js/app.init.boxed.js')}}"></script>
    <script src="{{url('xtreme-admin/dist/js/app-style-switcher.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{url('xtreme-admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{url('xtreme-admin/assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{url('xtreme-admin/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{url('xtreme-admin/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{url('xtreme-admin/dist/js/custom.min.js')}}"></script>


    <script src="{{url('js/sweetalert.min.js')}}"></script>
    <script src="{{url('js/toastr.min.js')}}"></script>

    <script src="{{url('xtreme-admin/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{url('xtreme-admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>


    <!-- Public var -->
    @include('_web._js.var')
    <!-- Public commit -->
    @include('_web._js.commit')

    <!-- Your GOOGLE ANALYTICS CODE Below -->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
        _gaq.push(['_trackPageview']);

        $(function () {
            //
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        });
    </script>

    <!-- ================== page-js ================== -->
    @yield('page-js')

    <!-- ================== inline-js ================== -->
    @yield('inline-js')
</body>
</html>