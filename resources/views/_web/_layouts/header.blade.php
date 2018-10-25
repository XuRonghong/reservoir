
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" onclick="location.reload()" href="">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{url('xtreme-admin/assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="{{url('xtreme-admin/assets/images/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    {{--<img src="{{url('xtreme-admin/assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />--}}
                    <div class="dark-logo" style="color: white; font-family: 'Courier New', Monospace;">水庫安全資訊管理系統</div>
                    <!-- Light Logo text -->
                    {{--<img src="{{url('xtreme-admin/assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" />--}}
                    <div class="light-logo" style="color: white; font-family: '標楷體', Monospace; font-size: small">水庫安全資訊管理系統</div>
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>

            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flag-icon flag-icon-tw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right  animated bounceInDown" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-tw"></i> 中文</a>
                        {{--<a class="dropdown-item" href="#"><i class="flag-icon flag-icon-us"></i> English</a>--}}
                        {{--<a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a>--}}
                        {{--<a class="dropdown-item" href="#"><i class="flag-icon flag-icon-es"></i> Spanish</a>--}}
                        {{--<a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> German</a>--}}
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a title="地震通知" class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-bell font-24 comment-count">
                            {{$comment_total or 0}}
                        </i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                        <span class="with-arrow">
                            <span class="bg-primary"></span>
                        </span>
                        <ul class="list-style-none ulComment">

                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a title="訊息" class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="font-24 mdi mdi-comment-processing message-count">
                            {{$message_total or 0}}
                        </i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                        <span class="with-arrow">
                            <span class="bg-danger"></span>
                        </span>
                        <ul class="list-style-none ulMessage">

                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{session()->get('member.meta.vUserImage' , url('xtreme-admin/assets/images/users/1.jpg'))}}" alt="user" class="rounded-circle" width="31">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow">
                            <span class="bg-primary"></span>
                        </span>
                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                            <div class="">
                                <img src="{{session()->get('member.meta.vUserImage' , url('xtreme-admin/assets/images/users/1.jpg'))}}" alt="user" class="img-circle" width="60">
                            </div>
                            <div class="m-l-10">
                                <h4 class="m-b-0">{{session('member.vAccount' , '')}}</h4>
                                <p class=" m-b-0">{{session('member.meta.vUserEmail' , '')}}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{url('web/member/edit').'/'.session('member.iId' , '')}}">
                            <i class="ti-user m-r-5 m-l-5"></i> My Confidential
                        </a>
                        <a class="dropdown-item" href="{{url('web/member/info/edit').'/'.session('member.meta.iMemberId' , '')}}">
                            <i class="ti-user m-r-5 m-l-5"></i> My Profile
                        </a>
                        {{--<a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>--}}
                        {{--<a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>--}}
                        <div class="dropdown-divider"></div>
                        {{--<a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>--}}
                        <a class="dropdown-item" href="{{url('web/logout')}}"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                        <div class="dropdown-divider"></div>
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>--}}
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->