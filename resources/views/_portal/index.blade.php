
@extends('_portal._layouts._1main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" type="text/css" href="{{asset('portal_assets/pc/css/index.css')}}">
    <style>
        .banner img {
            height: 320px;
        }
    </style>
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!--  -->
    <!-- banner -->
    <div class="banner">
        <div class="swiper-container banner-swiper">
            <div class="swiper-wrapper">
                @if(isset($banner))
                @forelse($banner as $item)
                    <div class="swiper-slide">
                        <a href="{{$item->vUrl or '#'}}">
                            <img src="{{$item->vImages or asset('images/1920x620.png')}}" alt="">
                        </a>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <a href="#">
                            <img src="{{asset('images/1920x620.png')}}" alt="">
                        </a>
                    </div>
                @endforelse
                @endif
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="mywrap">

        <!-- 最新消息 -->
        <section class="news">
            <div class="newsCenter container">
                <div class="gradientTitle">{{trans('_portal.news.title')}}</div>
                @if( $news->count() > 0 )
                <div class="newsContent">
                    <!-- 項目2欄 -->
                    @foreach($news as $item)
                            <a href="{{$item->vUrl or '#'}}" class="newsBox">
                                <div class="imgBox" style=" background-image: url({{$item->vImages or asset('images/500x500.png')}})"></div>
                                <div class="articleBox">
                                    <h3>{{$item->vTitle or ""}}</h3>
                                    <p class="str">{{$item->vSummary or ""}}</p>
                                    <p class="time">{{date('Y-m-d', $item->iStartTime)}}</p>
                                </div>
                            </a>
                    @endforeach
                        @for($i = 0 ; $i < 2 - $news->count() ; $i++)
                        <a class="newsBox"><div class="imgBox"></div></a>
                        @endfor
                </div>
                <div class="seeMore">
                    <a href="{{url('news')}}">{{trans('_portal.news.more')}}</a>
                </div>
                @endif
            </div>
        </section>
    </div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script src="{{asset('portal_assets/pc/js/main.js')}}"></script>
    <script src="{{asset('portal_assets/pc/js/index.js')}}"></script>
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