@extends('_template_portal._layouts._1main')
<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" type="text/css" href="portal_assets/htm/css/search_result.css">
@endsection
<!-- ================== /page-css ================== -->
<!-- content -->
@section('content')
    <!--  -->
    <section>
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('')}}">商城首頁</a></li>
                <li class="active">搜尋結果</li>
            </ol>
            <div class="row search-region">
                <div class="col-sm-12 search-title">
                    搜尋結果 :<span>"{{$keyword}}"</span>
                    <span class="num">(0)</span>
                </div>
                {{--<div class="col-sm-6 col-sm-offset-6 filter-box">--}}
                    {{--<span>熱門程度<i class="fa fa-angle-down" aria-hidden="true"></i></span>--}}
                    {{--<span>價格<i class="fa fa-angle-down" aria-hidden="true"></i></span>--}}
                    {{--<span>上架時間<i class="fa fa-angle-down" aria-hidden="true"></i></span>--}}
                {{--</div>--}}
                <div class="item"></div>
            </div>
        </div>
    </section>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script type="text/javascript" src="/portal_assets/htm/js/index.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var url_keep_doadd = "{{url('keep/doadd')}}";
        var url_cart_doadd = "{{url('cart/doadd')}}";
        $(document).ready(function () {
            //
            getlist({'keyword': "{{$keyword}}"});
            //
            $(".search-region").on("click", ".btn-keep", function () {
                var data = {"_token": "{{ csrf_token() }}"};
                data.vProductCode = $(this).closest('.itemBox').data('code');
                $.ajax({
                    url: url_keep_doadd,
                    type: "POST",
                    data: data,
                    success: function (rtndata) {
                        switch (rtndata.status) {
                            case 1:
                                toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                                break;
                            case 2:
                                toastr.info(rtndata.message, "{{trans('_web_alert.notice')}}")
                                break;
                            default:
                                toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}")
                                break
                        }
                    }
                });
            });
            //
            $(".search-region").on("click", ".btn-cart", function () {
                var data = {"_token": "{{ csrf_token() }}"};
                data.vProductCode = $(this).closest('.itemBox').data('code');
                $.ajax({
                    url: url_cart_doadd,
                    type: "POST",
                    data: data,
                    success: function (rtndata) {
                        switch (rtndata.status) {
                            case 1:
                                toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                                initCartContent();
                                break;
                            case 2:
                                toastr.info(rtndata.message, "{{trans('_web_alert.notice')}}")
                                break;
                            default:
                                toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}")
                                break

                        }
                    }
                });
            });
        });
        function getlist(data) {
            $.ajax({
                url: "{{url('api/search/getlist')}}",
                data: data,
                type: "GET",
                resetForm: true,
                success: function (rtndata) {
                    var html_str = "";
                    var count = 0;
                    if (rtndata.status) {
                        $(".item").html('');
                        for (var key in rtndata.aaData) {
                            var item = rtndata.aaData[key];
                            html_str += '<div class="col-sm-3">';
                            html_str += '<div class="itemBox" data-code="' + item.vProductCode + '">';
                            html_str += '<a href="' + item.url + '">';
                            html_str += '<div class="imgBox"><img src="' + item.vImages + '" alt=""></div>';
                            html_str += '<div class="title">' + item.vProductName + '</div>';
                            html_str += '</a>';
                            html_str += '<div class="price">$' + item.iProductPromoPrice + '</div>';
                            html_str += '<div class="interactions">';
                            html_str += '<span><i class="fa fa-heart-o fa-lg btn-keep" aria-hidden="true"></i></span>';
                            html_str += '<span><i class="fa fa-shopping-cart fa-lg btn-cart" aria-hidden="true"></i></span>';
                            html_str += '</div>';
                            html_str += '</div>';
                            html_str += '</div>';
                            count++;
                        }
                        $(".item").html(html_str);
                        $(".search-region").find('.num').html("(" + count + ")");
                    }
                }
            });
        }
    </script>
@endsection
<!-- ================== /inline-js ================== -->