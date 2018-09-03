@extends('_template_portal._layouts._1main')
<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" type="text/css" href="/portal_assets/htm/css/about.css">
@endsection
<!-- ================== /page-css ================== -->
<!-- content -->
@section('content')
    <section>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{url('')}}">商城首頁</a></li>
            <li><a href="{{url('member_center')}}">會員中心</a></li>
            <li class="active">關於商城</li>
        </ol>
        <div class="tab-pills">
            <ul class="nav nav-pills nav-justified">
                @foreach($about as $key => $item)
                    <li class="@if($item->iType == $subId) active @endif"><a data-toggle="pill" href="#about{{$item->iType}}">{{$item->vTitle}}</a></li>
                @endforeach
                {{--<li class="active"><a data-toggle="pill" href="#about">關於商城</a></li>--}}
                {{--<li><a data-toggle="pill" href="#privacy">隱私權政策</a></li>--}}
                {{--<li><a data-toggle="pill" href="#terms">服務條款</a></li>--}}
                {{--<li><a data-toggle="pill" href="#lineAt">加入 Line@</a></li>--}}
                {{--<li><a data-toggle="pill" href="#fbFanPage">FB 粉絲專頁</a></li>--}}
                {{--<li><a data-toggle="pill" href="#qna">常見問題</a></li>--}}
            </ul>
        </div>
        <div class="tab-content">
            @foreach($about as $key => $item)
                <div id="about{{$item->iType}}" class="tab-pane fade @if($item->iType == $subId) in active @endif">
                    <p>{!! $item->vDetail !!}</p>
                </div>
            @endforeach
            {{--<div id="about" class="tab-pane fade in active">--}}
                {{--<p>圖文編輯器</p>--}}
            {{--</div>--}}
            {{--<div id="privacy" class="tab-pane fade">--}}
                {{--<p>圖文編輯器</p>--}}
            {{--</div>--}}
            {{--<div id="terms" class="tab-pane fade">--}}
                {{--<p>圖文編輯器</p>--}}
            {{--</div>--}}
            {{--<div id="lineAt" class="tab-pane fade">--}}
                {{--<p>圖文編輯器</p>--}}
            {{--</div>--}}
            {{--<div id="fbFanPage" class="tab-pane fade">--}}
                {{--<p>圖文編輯器</p>--}}
            {{--</div>--}}
            {{--<div id="qna" class="tab-pane fade">--}}
                {{--<div class="toggle" data-toggle="collapse" data-target="#qna_01">--}}
                    {{--<div class="title-region usable">--}}
                        {{--<div class="txt-box">問題的類型標題問題的類型標題問題的類型標題問題的類型標題</div>--}}
                        {{--<p><i class="fa fa-chevron-up" aria-hidden="true"></i>展開</p>--}}
                        {{--<p style=""><i class="fa fa-chevron-down" aria-hidden="true"></i>收合</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div id="qna_01" class="collapse in">--}}
                    {{--<div class="title-region usable">--}}
                        {{--<div class="title-box"><i class="fa fa-caret-right" aria-hidden="true"></i>次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題</div>--}}
                        {{--<div class="txt-box">(內文) 圖文編輯器區塊外框只是示意範圍(不要真的有框線)，請裡面一樣要加上：上下左右padding : 15px</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="toggle" data-toggle="collapse" data-target="#qna_02">--}}
                    {{--<div class="title-region usable">--}}
                        {{--<div class="txt-box">問題的類型標題問題的類型標題問題的類型標題問題的類型標題</div>--}}
                        {{--<p style=""><i class="fa fa-chevron-up" aria-hidden="true"></i>展開</p>--}}
                        {{--<p><i class="fa fa-chevron-down" aria-hidden="true"></i>收合</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div id="qna_02" class="collapse">--}}
                    {{--<div class="title-region usable">--}}
                        {{--<div class="title-box"><i class="fa fa-caret-right" aria-hidden="true"></i>次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題次標題</div>--}}
                        {{--<div class="txt-box">(內文) 圖文編輯器區塊外框只是示意範圍(不要真的有框線)，請裡面一樣要加上：上下左右padding : 15px</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</section>
@endsection
<!-- /content -->
