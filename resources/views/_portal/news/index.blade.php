
@extends('_template_portal._layouts._1main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" type="text/css" href="{{asset('portal_assets/pc/css/news.css')}}">
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
        <!-- 頁面banner -->
        @forelse($banner as $item)
            <div class="pageBanner" style="background-image: url({{$item->vImages[0] or asset('images/1920x320.png')}})">
                @include('_template_portal._layouts.breadcrumb')
            </div>
        @empty
            <div class="pageBanner" style="background-image: url({{asset('images/1920x320.png')}})">
                @include('_template_portal._layouts.breadcrumb')
            </div>
        @endforelse

        <!-- 最新消息 -->
        <div class="mywrap">
            <section class="news">
                <div class="newsCenter container">
                    <div class="filterBar">
                        <span>{{trans('reservoir')}}</span>
                        <select class="filterList form-control btn-cate">
                            <option value="0">
                                {{trans('_portal.news.all')}}
                            </option>
                            @foreach( $sys_category as $key => $item )
                                <option value="{{$item->iId}}">
                                    {{$item->vCategoryName or ''}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="newsContent"></div>

                    <!-- paginatino -->
                    <div id="pagination" class="text-center"></div>
                </div>
            </section>
        </div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script src="{{asset('portal_assets/pc/js/news.js')}}"></script>
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        $(document).ready(function () {
            var page = 1;
            var category = 0;

            getlist({ "page": page, "category": category });

            $(document).delegate(".pagination a", "click", function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                var page = getPage(url);
                getlist({ "page": page, "category": category });
            });
            //
            function getPage(source) {
                var url = new URL(source);
                var searchURL = url.search;
                searchURL = searchURL.substring(1, searchURL.length);
                for (var key in searchURL.split("&")) {
                    var obj = searchURL.split("&")[key];
                    var name = obj.split("=")[0];
                    var value = obj.split("=")[1];
                    if(name === 'page') {
                        return decodeURI(value);
                    }
                }
                return 1;
            }

            $(".btn-cate").change(function () {
                category = $(this).val();
                getlist({ "page": 1, "category": category });
            });
        });

        function getlist(data) {
            $.ajax({
                url: "{{url('reservoir')}}",
                data: data,
                type: "GET",
                success: function (rtndata) {
                    var html_str = "";
                    $(".newsContent").html(html_str);
                    if (rtndata.status) {
                        for (var key in rtndata.aaData) {
                            var item = rtndata.aaData[key];
                            //if(item.vUrl)
                            //    html_str += '<a href="' + item.vUrl + '" class="newsBox">';
                            //else
                                html_str += '<a href="{{url('news/detail')}}/' + item.iId + '" class="newsBox">';
                            html_str +=         '<div class="imgBox" style="background-image: url(' + item.vImages + ')"></div>';
                            html_str +=         '<div class="articleBox" style="width: 100%;">';
                            if(item.vTitle)
                                html_str +=         '<h3>' + item.vTitle + '</h3>';
                            else
                                html_str +=         '<h3></h3>';
                            if(item.vSummary)
                                html_str +=         '<p class="str">' + item.vSummary + '</p>';
                            else
                                html_str +=         '<p class="str"></p>';
                            html_str +=             '<p class="time">' + item.iStartTime + '</p>';
                            html_str +=         '</div>';
                            html_str +=     '</a>';
                        }
                        $(".newsContent").append(html_str);
                        $("#pagination").html(rtndata.links_html);
                        $('html, body').scrollTop(0);
                    }
                }
            });
        }
    </script>
@endsection
<!-- ================== /inline-js ================== -->