
@extends('_template_portal._layouts._1main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" type="text/css" href="{{asset('portal_assets/pc/css/newsDetail.css')}}">
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!--  -->
    <section>
        <!-- 最新消息 -->
        <div class="mywrap">
                <section class="news">
                    <div class="newsCenter container">
                    {{--@include('_template_portal._layouts.breadcrumb')--}}
                        <div class="topBox">
                            <p class="str">{{$info->vCategoryName or ''}}</p>
                            <h2>{{$info->vTitle or ''}}</h2>
                            <p class="time">{{$info->iStartTime or ''}}</p>
                        </div>
                        <div class="editBox">
                            <img src="{{$info->vImages or asset('images/500x500.png')}}" alt="">
                            <p>
                                {!! $info->vDetail or '' !!}
                            </p>
                        </div>
                        @if($pre)
                        <a href="{{url('news/detail/'.$pre->iId)}}" class="pageButton prevPage">
                            <ion-icon name="arrow-round-back"></ion-icon>
                            <div class="picBox" style="background-image: url('{{$pre->vImages or asset('images/80x80.png')}}')">
                                <div class="mask"></div>
                                <span>{{$pre->vTitle or '上一篇'}}</span>
                            </div>
                        </a>
                        @endif
                        @if($next)
                        <a href="{{url('news/detail/'.$next->iId)}}" class="pageButton nextPage">
                            <div class="picBox" style="background-image: url('{{$next->vImages or asset('images/80x80.png')}}')">
                                <div class="mask"></div>
                                <span>{{$next->vTitle or '下一篇'}}</span>
                            </div>
                            <ion-icon name="arrow-round-forward"></ion-icon>
                        </a>
                        @endif
                    </div>
                </section>
            </div>
    </section>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script type="text/javascript" src=""></script>
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->