
<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <!-- User Profile-->
        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Tables</span></li>
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-border-all"></i><span class="hide-menu">會員 Tables</span></a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="{{url('web/member')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">帳號list </span></a></li>
                <li class="sidebar-item"><a href="{{url('web/member/info')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">User資訊list</span></a></li>
                <li class="sidebar-item"><a href="{{url('web/member/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">新增 </span></a></li>
                {{--<li class="sidebar-item"><a href="{{url('web/member/edit')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">修改 </span></a></li>--}}
                {{--<li class="sidebar-item"><a href="{{url('web/member/')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">刪除</span></a></li>--}}
            </ul>
        </li>
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-border-left"></i><span class="hide-menu">水庫</span></a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="{{url('web/reservoir')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 總表</span></a></li>
                <li class="sidebar-item"><a href="{{url('web/reservoir/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 新增</span></a></li>
                <li class="sidebar-item"><a href="{{url('web/import_excel')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 匯入</span></a></li>
            </ul>
        </li>
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-border-left"></i><span class="hide-menu">水庫Meta</span></a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="{{url('web/reservoir/meta')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 總表</span></a></li>
                <li class="sidebar-item"><a href="{{url('web/reservoir/meta/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 新增</span></a></li>
                {{--<li class="sidebar-item"><a href="{{url('web/import_excel')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 匯入</span></a></li>--}}
            </ul>
        </li>
        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Extra</span></li>
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false"><i class="mdi mdi-content-paste"></i><span class="hide-menu">Documentation</span></a></li>
        {{--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false"><i class="mdi mdi-directions"></i><span class="hide-menu">Log Out</span></a></li>--}}
    </ul>
</nav>