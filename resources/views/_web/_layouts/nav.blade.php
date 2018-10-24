
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
                        <span class="hide-menu">水庫資料</span>
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
                        <span class="hide-menu">水庫規格</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="{{url('web/reservoir/meta')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 總表</span></a></li>
                        <li class="sidebar-item"><a href="{{url('web/reservoir/meta/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 新增</span></a></li>
                        {{--<li class="sidebar-item"><a href="{{url('web/import_excel')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 匯入</span></a></li>--}}
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-border-left"></i>
                        <span class="hide-menu">水庫故事</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="{{url('web/reservoir/story')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 總表</span></a></li>
                        <li class="sidebar-item"><a href="{{url('web/reservoir/story/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 新增</span></a></li>
                        {{--<li class="sidebar-item"><a href="{{url('web/import_excel')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 匯入</span></a></li>--}}
                    </ul>
                </li>
            {{-- End Nast --}}
            </ul>
        </li>
        {{--<li class="nav-small-cap">--}}
            {{--<i class="mdi mdi-dots-horizontal"></i>--}}
            {{--<span class="hide-menu">Extra</span>--}}
        {{--</li>--}}
        @if(session('member.iAcType')<19)
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-border-left"></i>
                <span class="hide-menu">安全管考系統</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="{{url('web/record/trace')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 總表</span></a></li>
                @if(session('member.iAcType')>9)
                <li class="sidebar-item"><a href="{{url('web/record/trace/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 新增</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('web/shakemap2')}}" aria-expanded="false">
                <i class="mdi mdi-content-paste"></i>
                <span class="hide-menu">地震回報系統</span>
            </a>
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('web/index')}}" aria-expanded="false">
                <i class="mdi mdi-content-paste"></i>
                <span class="hide-menu">重要監測運整</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-border-all"></i>
                <span class="hide-menu">系統操作說明</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="{{url('web/instructions')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 總表</span></a></li>
                <li class="sidebar-item"><a href="{{url('web/instructions/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 新增</span></a></li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-border-all"></i>
                <span class="hide-menu">歷史資料</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="{{url('web/history/silt')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 水庫淤積濬渫執行成果</span></a></li>
                <li class="sidebar-item"><a href="{{url('web/history/safe')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 水庫歷屆定期安全評估報告</span></a></li>
                <li class="sidebar-item"><a href="{{url('web/history/other')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu"> 水庫其他重要文件</span></a></li>
            </ul>
        </li>
        @if(session('member.iAcType')<10)
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                    <i class="mdi mdi-border-all"></i>
                    <span class="hide-menu">訊息中心</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item"><a href="{{url('web/message/center')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">全部訊息 </span></a></li>
                    <li class="sidebar-item"><a href="{{url('web/message/center/add')}}" class="sidebar-link"><i class="mdi mdi-border-nono"></i><span class="hide-menu">發送訊息 </span></a></li>
                </ul>
            </li>
        @endif
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
    </ul>
</nav>