
@extends('_template_portal._layouts._1main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" type="text/css" href="{{asset('portal_assets/pc/css/cart.css')}}">
    <style>
        img {
            width: 50px;
        }
    </style>
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

    <!-- 商品種類 -->
    <div class="mywrap">
        <section class="cart">
            <div class="cartCenter container">
                <table class="cartTable">
                    <thead>
                    <tr>
                        <th width="30%">品名</th>
                        <th width="20%">規格</th>
                        <th width="15%">單價</th>
                        <th width="25%">數量</th>
                        <th width="10%">總金額</th>
                    </tr>
                    </thead>
                    <tbody class="tbody">
                    @if(isset($cart))
                        @foreach( $cart as $item)
                        <tr id="modebody{{$item['iId'] or ''}}" class="cartlist1"
                            data-id="{{$item['iId'] or ''}}"
                            data-volume="{{$item['iProductVolume'] or ''}}">
                            <td>
                                <div class="proBox">
                                    <div class="la la-times btn-del"
                                         data-id="{{$item['iId'] or ''}}"
                                         data-total="{{$item['iProductTotalPrice'] or ''}}">
                                        <i class=""></i>
                                    </div>
                                    <a href="{{$item['vProductUrl'] or '#'}}">
                                        <img src="{{$item['vImages'] or 'http://placehold.jp/500x500.png?text=img'}}" alt="">
                                        <span>{{$item['vProductName'] or ''}}</span>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <select class="format iSpecId">
                                    <option value="{{$item['iSpecId'] or 0}}">
                                        {{$item['vSpecTitle'] or ''}}
                                    </option>
                                    @foreach($item['Specification'] as $spec)
                                        @if($spec['iId']!=$item['iSpecId'])
                                        <option value="{{$spec['iId'] or 0}}">
                                            {{$spec['vSpecTitle'] or ''}}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td style="text-align: right;">
                                @foreach($item['Specification'] as $spec)
                                    @if($spec['iId']==$item['iSpecId'])
                                    <div class="product_price">
                                        NT${{$spec['iSpecPrice'] or ''}}
                                    </div>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <div class="wan-spinner count2">
                                    <a href="javascript:void(0)" class="minus">-</a>
                                    <input type="text" value="{{$item['iCount'] or '0'}}" class="pdtQty">
                                    <a href="javascript:void(0)" class="plus">+</a>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                NT${{$item['iProductTotalPrice'] or ''}}
                            </td>
                        </tr>
                        {{--</div>--}}
                        @endforeach
                    @endif
                    </tbody>
                </table>

                <ul class="feeList">
                    <li>
                        <div>
                            <span class="totalItem">{{$cart->count()}}</span> 項商品
                        </div>
                        <div style="width: 20%; text-align: right;">
                            <span>NT$</span>
                            <span class="amount">{{$cart_total or 0}}</span>
                        </div>
                    </li>
                    <li>
                        <div>{{trans('_portal.cart.shipment')}}</div>
                        <div style="width: 20%; text-align: right;">
                            <span>NT$</span>
                            <span class="fare">{{$shipping['iShipment'] or 0}}</span>
                        </div>
                    </li>
                    <li>
                        <div>共計</div>
                        <div style="width: 20%; text-align: right;">
                            <span>NT$</span>
                            <span class="sum"></span>
                        </div>
                    </li>
                </ul>

                <div class="btnBox">
                    <p>
                        <i class="la la-info-circle"></i>
                        {{trans('_portal.cart.action')}}
                    </p>
                    {{--<a href="{{url('order')}}">--}}
                        <button class="btn-settle" data-href="{{url('order')}}">
                            <ion-icon ios="ios-card" md="md-card"></ion-icon>
                            <span>{{trans('_portal.cart.settle')}}</span>
                        </button>
                    {{--</a>--}}
                </div>

            </div>
        </section>
    </div>

@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script type="text/javascript" src="{{asset('portal_assets/pc/js/cart.js')}}"></script>
{{--    <script type="text/javascript" src="{{asset('portal_assets/dist/BS3/bootstrap.min.js')}}"></script>--}}
    <!-- Plugin Customer-->
{{--    <script type="text/javascript" src="{{asset('_assets/CryptoJS/rollups/md5.js')}}"></script>--}}
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        cart_total = '{{$cart_total or 0}}';    //購物車總金額
        cart_total = parseInt(cart_total);

        $(document).ready(function () {
            //去結帳
            $('.btn-settle').click(function () {
                doCheckSpec( $(this).data('href') ); //確認庫存狀況
            });

            //計數器
            max = "{{$product_info['iProductVolume'] or '5'}}";
            $(".count2").WanSpinner({
                start: 1,
                step: 1,
                maxValue: max,
                minValue: 1,
                inputWidth: 50,
            });

            //顏色有改變..
            $('.iSpecId').change(function () {
                var cart_id = $(this).parents('.cartlist1').data('id');
                var product_volume = $(this).parents('.cartlist1').data('volume');

                var spec_id = $(this).val();
                var countQty = $(this).parents('.cartlist1').find('.pdtQty');
                editCart('', cart_id , spec_id , countQty , product_volume ) ;
            });
            //數量有改變..
            $('.pdtQty').change(function () {
                var cart_id = $(this).parents('.cartlist1').data('id');
                var product_volume = $(this).parents('.cartlist1').data('volume');

                var spec_id = $(this).parents('.cartlist1').find('.iSpecId').val();
                var countQty = $(this);
                editCart('', cart_id , spec_id , countQty , product_volume ) ;
            });
            //往上加..
            $('.plus').click(function () {
                var cart_id = $(this).parents('.cartlist1').data('id');
                var product_volume = $(this).parents('.cartlist1').data('volume');

                var spec_id = $(this).parents('.cartlist1').find('.iSpecId').val();
                var countQty = $(this).parents('.cartlist1').find('.pdtQty');
                editCart('', cart_id , spec_id , countQty , product_volume , 1) ;
            });
            //往下加..
            $('.minus').click(function () {
                var cart_id = $(this).parents('.cartlist1').data('id');
                var product_volume = $(this).parents('.cartlist1').data('volume');

                var spec_id = $(this).parents('.cartlist1').find('.iSpecId').val();
                var countQty = $(this).parents('.cartlist1').find('.pdtQty');
                editCart('', cart_id , spec_id , countQty , product_volume , -1) ;
            });

            var addfare = parseInt( $('.fare').text() );      //運費物件
            addfare = parseInt(addfare);
            addfare = addfare + cart_total ;
            $('.sum').text(  addfare );

            //刪除
            $('.btn-del').click(function () {
                var cart_id = $(this).data('id');
                var total = $(this).data('total');
                delCart( '', cart_id, total );
            });
        });

        function delCart ( action , cart_id , total ) {
            var modeGroup = $('#modebody'+cart_id);
            var totalItem = $('.totalItem');
            var amount = $('.amount');      //購物車總金額物件
            var sum = $('.sum');      //購物車總金額加運費物件
            var fare = parseInt( $('.fare').text() );      //運費物件
            cart_total = cart_total - total;    //每刪除一件重新計算

            var data = {"_token": "{{ csrf_token() }}"};
            data.action = action;
            data.iId = cart_id;
            $.ajax({
                url: "{{url('cart/dodel')}}",
                type: "POST",
                data: data,
                success: function (rtndata) {
                    switch (rtndata.status) {
                        case 1:
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            modeGroup.hide();
                            amount.text(cart_total ? cart_total : 0);
                            sum.text( cart_total ? (cart_total+fare) : 0 );
                            totalItem.text( parseInt(totalItem.text()) - 1 );
                            break;
                        case 2:
                            toastr.info(rtndata.message, "{{trans('_web_alert.notice')}}");
                            break;
                        default:
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                            break
                    }
                }
            });
            return true;
        }

        function editCart( action , cart_id , spec_id , countQty , product_volume , number=0 ) {
            var data = {"_token": "{{ csrf_token() }}"};
            data.iId = cart_id;
            data.iSpecId = spec_id;
            data.iCount = parseInt( countQty.val() ) + number ;
            data.volume = product_volume;

            $.ajax({
                url: "{{url('cart/dosave')}}",
                type: "POST",
                data: data,
                success: function (rtndata) {
                    switch (rtndata.status) {
                        case 1:
                            location.reload();
                            break;
                        case 2:
                            toastr.info(rtndata.message, "{{trans('_web_alert.notice')}}");
                            location.reload();
                            break;
                        case 3:
                            toastr.info(rtndata.message, "{{trans('_web_alert.notice')}}");
                            countQty.val(rtndata.count);
                            break;
                        default:
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                            break
                    }
                }
            });
            return true;
        }

        function doCheckSpec( url ) {
            var data = {"_token": "{{ csrf_token() }}"};
            data.url = url;
            $.ajax({
                url: "{{url('order/docheckspec')}}",
                type: "POST",
                data: data,
                success: function (rtndata) {
                    switch (rtndata.status) {
                        case 1:
                            location.href = rtndata.url;
                            break;
                        case 2:
                            toastr.info(rtndata.message, "{{trans('_web_alert.notice')}}");
                            location.reload();
                            break;
                        default:
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                            break
                    }
                }
            });
            return true;
        }
    </script>
@endsection
<!-- ================== /inline-js ================== -->