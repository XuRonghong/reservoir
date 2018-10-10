<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <title>{{session()->get( 'SEO.vTitle' , 'Kahap')}}</title>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
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


    <link type="text/css" rel="stylesheet" href="{{asset('css/waitMe.css')}}">


    <!-- This page plugin CSS -->
    @yield('page-css')

    {{-- sudo view --}}
    @if(session('member.iAcType')==1)
        <style rel="stylesheet" type="text/css">
            #main-wrapper[data-layout=vertical] .topbar .navbar-collapse[data-navbarbg=skin6],
            #main-wrapper[data-layout=vertical] .topbar[data-navbarbg=skin6],
            #main-wrapper[data-layout=horizontal] .topbar .navbar-collapse[data-navbarbg=skin6],
            #main-wrapper[data-layout=horizontal] .topbar[data-navbarbg=skin6] {
                background-color: #d69d00;
            }
        </style>
    @endif
    <style>
        .margin-left-10 li {
            margin-left: 3%;
        }
        * {
            font-family: "微軟正黑體",Arial!important;
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

        $(document).ready(function () {
            //
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);


            // ajax to new message
            get_new_message();          //針對地震通知 get1 comment
            get_message_on_upbar();     //針對系統訊息 get2 message

            //upbar reload on click
            // $('.topbartoggler').click(function () {
            $(this).click(function () {
                //有 click event 觸發刷新上方列的訊息通知
                get_new_message();
                get_message_on_upbar();
            });

            //click message
            $('.message-count').click(function () {
                //若點擊後標示已讀訊息 並重新標記未讀訊息數量
                save_message();
                get_message_on_upbar();
            });

        });

        /*
        * 新增最新的地震資料並且撈取訊息通知
         */
        function get_new_message() {
            var data = {"_token": "{{ csrf_token() }}"};
            // data.iId = $(this).data('id');
            //
            $.ajax({
                url: '{{url('web/addmessage')}}',
                type: "POST",
                data: data,
                resetForm: true,
                success: function (rtndata) {
                    var html_str = "";
                    if (rtndata.status) {
                        //撈取最新的訊息通知
                        get_comment_on_upbar();
                    } else {
                        {{--toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");--}}
                    }
                }
            });
        }

        /*
        * 儲存"通知訊息"資料為使用者已讀
         */
        function save_message() {
            var data = {"_token": "{{ csrf_token() }}"};
            data.iId = $(this).data('id');
            //
            $.ajax({
                url: '{{url('web/savemessage')}}',
                type: "POST",
                data: data,
                resetForm: true,
                success: function (rtndata) {
                    var html_str = "";
                    if (rtndata.status) {
                        get_message_on_upbar();
                    } else {
                        {{--toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");--}}
                    }
                }
            });
        }

        <!-- upperbar for comment -->
        /*
        * 上方列針對"通知"刷新功能
         */
        function get_comment_on_upbar() {
            var data = {"_token": "{{ csrf_token() }}"};
            // data.iId = $(this).data('id');
            //
            $.ajax({
                url: '{{url('web/getcomment')}}',
                type: "POST",
                data: data,
                resetForm: true,
                success: function (rtndata) {
                    var html_str = "";
                    if (rtndata.status) {
                        //
                        html_str += '<li>';
                        html_str +=     '<div class="drop-title text-white bg-danger">';
                        html_str +=         '<h4 class="m-b-0 m-t-5">' + rtndata.total + ' New</h4>';
                        html_str +=         '<span class="font-light">Messages</span>';
                        html_str +=     '</div>';
                        html_str += '</li>';
                        html_str += '<li>';
                        html_str +=     '<div class="message-center message-body">';
                        //
                        for (var key in rtndata.aaData) {
                            if (key > 4) break;  //顯示5筆資料
                            var obj = rtndata.aaData[key];
                            html_str += '<a href="' + obj.url + '" class="message-item">';
                            html_str +=     '<span class="user-img">';
                            html_str +=         '<img src="' + obj.vImages + '" alt="user" class="rounded-circle">';
                            html_str +=         '<span class="profile-status online pull-right"></span>';
                            html_str +=     '</span>';
                            html_str +=     '<div class="mail-contnet">';
                            html_str +=         '<h5 class="message-title">' + obj.vTitle + '</h5>';
                            html_str +=         '<span class="mail-desc">' + obj.vSummary + '</span>';
                            html_str +=         '<span class="time" style="text-align: right;">' + obj.iCreateTime + '</span>';
                            html_str +=     '</div>';
                            html_str += '</a>';
                        }
                        html_str +=     '</div>';
                        html_str += '</li>';
                        html_str += '<li>';
                        html_str +=     '<a class="nav-link text-center link" href="{{url('web/message')}}"> <b>看更多訊息</b> <i class="fa fa-angle-right"></i> </a>';
                        html_str += '</li>';
                        $(".ulComment").html(html_str);
                        $('.comment-count').text(rtndata.total);
                    } else {
                        {{--toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");--}}
                    }
                }
            });
        }

        <!-- upperbar for message -->
        /*
        * 上方列針對"訊息"刷新功能
         */
        function get_message_on_upbar() {
            var data = {"_token": "{{ csrf_token() }}"};
            // data.iId = $(this).data('id');
            //
            $.ajax({
                url: '{{url('web/getmessage')}}',
                type: "POST",
                data: data,
                resetForm: true,
                success: function (rtndata) {
                    var html_str = "";
                    if (rtndata.status) {
                        //
                        html_str += '<li>';
                        html_str +=     '<div class="drop-title text-white bg-danger">';
                        html_str +=         '<h4 class="m-b-0 m-t-5">' + rtndata.total + ' New</h4>';
                        html_str +=         '<span class="font-light">Messages</span>';
                        html_str +=     '</div>';
                        html_str += '</li>';
                        html_str += '<li>';
                        html_str +=     '<div class="message-center message-body">';
                        //
                        for (var key in rtndata.aaData) {
                            if (key > 4) break;  //顯示5筆資料
                            var obj = rtndata.aaData[key];
                            html_str += '<a href="' + obj.url + '" class="message-item">';
                            html_str +=     '<span class="user-img">';
                            html_str +=         '<img src="' + obj.vImages + '" alt="user" class="rounded-circle">';
                            html_str +=         '<span class="profile-status online pull-right"></span>';
                            html_str +=     '</span>';
                            html_str +=     '<div class="mail-contnet">';
                            html_str +=         '<h5 class="message-title">' + obj.vTitle + '</h5>';
                            html_str +=         '<span class="mail-desc">' + obj.vSummary + '</span>';
                            html_str +=         '<span class="time" style="text-align: right;">' + obj.iCreateTime + '</span>';
                            html_str +=     '</div>';
                            html_str += '</a>';
                        }
                        html_str +=     '</div>';
                        html_str += '</li>';
                        html_str += '<li>';
                        html_str +=     '<a class="nav-link text-center link" href="{{url('web/message/center')}}"> <b>看更多訊息</b> <i class="fa fa-angle-right"></i> </a>';
                        html_str += '</li>';
                        $(".ulMessage").html(html_str);
                        $('.message-count').text(rtndata.total_see);
                    } else {
                        {{--toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");--}}
                    }
                }
            });
        }
    </script>

    {{--  loading ....  --}}
    {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>--}}
    <script src="{{asset('js/waitMe.js')}}"></script>
    <script>
        // none, bounce, rotateplane, stretch, orbit,
        // roundBounce, win8, win8_linear or ios
        function run_waitMe(selector='body', effect='roundBounce'){
            $(selector).waitMe({
                //none, rotateplane, stretch, orbit, roundBounce, win8,
                //win8_linear, ios, facebook, rotation, timer, pulse,
                //progressBar, bouncePulse or img
                effect: effect,
                //place text under the effect (string).
                text: 'Please waiting...',
                //background for container (string).
                bg: 'rgba(255,255,255,0.7)',
                //color for background animation and text (string).
                color: '#000',
                //max size
                maxSize: '',
                //wait time im ms to close
                waitTime: -1,
                //url to image
                source: '',
                //or 'horizontal'
                textPos: 'vertical',
                //font size
                fontSize: '',
                // callback
                onClose: function() {}
            });
        }
    </script>

    <!-- ================== page-js ================== -->
    @yield('page-js')

    <!-- ================== inline-js ================== -->
    @yield('inline-js')
</body>
</html>