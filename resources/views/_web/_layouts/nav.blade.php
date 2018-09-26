
<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <!-- User Profile-->
        <li class="nav-small-cap">
            <i class="mdi mdi-dots-horizontal"></i>
            <span class="hide-menu">Table</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-border-left"></i>
                <span class="hide-menu">管理查詢系統</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level margin-left-10">
            {{-- Nast --}}
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-border-left"></i>
                        <span class="hide-menu">水庫</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="{{url('web/reservoir')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 總表</span></a></li>
                        <li class="sidebar-item"><a href="{{url('web/reservoir/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 新增</span></a></li>
                        @if(session('member.iAcType')<10)
                            <li class="sidebar-item"><a href="{{url('web/import_excel')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 匯入</span></a></li>
                        @endif
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-border-left"></i>
                        <span class="hide-menu">水庫Meta</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="{{url('web/reservoir/meta')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 總表</span></a></li>
                        <li class="sidebar-item"><a href="{{url('web/reservoir/meta/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 新增</span></a></li>
                        {{--<li class="sidebar-item"><a href="{{url('web/import_excel')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 匯入</span></a></li>--}}
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="{{url('web/reservoir/story')}}" aria-expanded="false">
                        <i class="mdi mdi-border-left"></i>
                        <span class="hide-menu">水庫故事</span>
                    </a>
                </li>
            {{-- End Nast --}}
            </ul>
        </li>
        {{--<li class="nav-small-cap">--}}
            {{--<i class="mdi mdi-dots-horizontal"></i>--}}
            {{--<span class="hide-menu">Extra</span>--}}
        {{--</li>--}}
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('web/shakemap2')}}" aria-expanded="false">
                <i class="mdi mdi-content-paste"></i>
                <span class="hide-menu">安全管考系統</span>
            </a>
        </li>
        @if(session('member.iAcType')<10)
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                    <i class="mdi mdi-border-left"></i>
                    <span class="hide-menu">地震回報系統</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item"><a href="{{url('web/message/center')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 總表</span></a></li>
                    <li class="sidebar-item"><a href="{{url('web/message/center/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 新增</span></a></li>
                    <li class="sidebar-item"><a href="{{url('web/event')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> Event</span></a></li>
                </ul>
            </li>
        @endif
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('web/shakemap')}}" aria-expanded="false">
                <i class="mdi mdi-content-paste"></i>
                <span class="hide-menu">重要監測運整</span>
            </a>
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('web/trace')}}" aria-expanded="false">
                <i class="mdi mdi-content-paste"></i>
                <span class="hide-menu">系統操作說明</span>
            </a>
        </li>
        @if(session('member.iAcType')<10)
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-border-all"></i>
                <span class="hide-menu">系統管理員</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="{{url('web/member')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">帳號list </span></a></li>
                <li class="sidebar-item"><a href="{{url('web/member/info')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">User資訊list</span></a></li>
                <li class="sidebar-item"><a href="{{url('web/member/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">新增 </span></a></li>
                {{--<li class="sidebar-item"><a href="{{url('web/member/')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">刪除</span></a></li>--}}
            </ul>
        </li>
        @endif
        @if(session('member.iAcType')==1)
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-border-all"></i>
                <span class="hide-menu">LOG</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="{{url('web/log/login')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">登入紀錄</span></a></li>
                <li class="sidebar-item"><a href="{{url('web/log/edit')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">修改紀錄</span></a></li>
            </ul>
        </li>
        @endif
        {{--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false"><i class="mdi mdi-directions"></i><span class="hide-menu">Log Out</span></a></li>--}}
    </ul>
</nav>