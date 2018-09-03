
<div class="guideBox">
    <h1>
        {{session('SEO.vTitle')}}
    </h1>
    <p>
        @foreach($breadcrumb as $key => $value)
            <a href="{{$value}}">{{$key}}</a>
            <i class="la la-angle-right"></i>
        @endforeach
    </p>
</div>