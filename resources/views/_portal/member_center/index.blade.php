
@extends('_template_portal._layouts._1main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" type="text/css" href="{{asset('portal_assets/pc/css/staff.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('portal_assets/dist/jqUi/jquery-ui.min.css')}}">
    <style rel="stylesheet" type="text/css" >
        .dataBox {
            width: 100%;
        }
        .dataBox span {
            margin-left: 10%;
        }
        .dataBox .inputOuter {
            margin-left: 10%;
        }
        .dataBox p {
            margin-left: 10%;
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

    <div class="mywrap">
        <div class="wrapCenter container">

            <!-- 工能列 -->
            <div class="funBox">
                <ul class="nav nav-pills funList">
                    <li class="order @if($control=="order") active @endif">
                        <a data-toggle="pill" href="#order">
                            {{trans('_portal.order.title')}}
                        </a>
                    </li>
                    <li class="mydata @if($control=="member") active @endif">
                        <a data-toggle="pill" href="#mydata">
                            {{trans('_portal.member_center.menu.personal')}}
                        </a>
                    </li>
                    <li class="fixPw @if($control=="resetpw") active @endif">
                        <a data-toggle="pill" href="#pw">
                            {{trans('_portal.member_center.reset_password')}}
                        </a>
                    </li>
                    <li class="siginOut logout">
                        <a href="javascript:">
                            {{trans('_portal.home.index.logout')}}
                        </a>
                    </li>
                    <li class="myline"></li>
                </ul>
            </div>

            <!-- 工能內容 -->
            <div class="funContent">
                <div class="tab-content">

                    <div id="order" class="tab-pane @if($control=="order") fade in active @else fade @endif">
                        <div class="searchBar">
                            <div class="timeBox">
                                <span>{{trans('_portal.order.time_range')}}</span>
                                <input value="{{session( 'order_startTime', 0 )}}" type="text"
                                       class="form-control startTime" placeholder="{{trans('_portal.order.time_start')}}">
                                <span>{{trans('_portal.order.time_range_0')}}</span>
                                <input value="{{session( 'order_endTime', 0)}}" type="text"
                                       class="form-control endTime" placeholder="{{trans('_portal.order.time_end')}}">
                            </div>
                            <div class="sortBox">
                                <span>{{trans('_portal.order.sort_mode')}}</span>
                                <select class="form-control time-sort">
                                    <option @if(session( 'order_sort')==1)selected @endif value="1">
                                        {{trans('_portal.order.new_old')}}
                                    </option>
                                    <option @if(session( 'order_sort')==2)selected @endif value="2">
                                        {{trans('_portal.order.old_new')}}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="modeGroup"></div>

                        <!-- paginatino -->
                        <div id="pagination" class="text-center"></div>

                    </div>

                    <div id="mydata" class="tab-pane @if($control=="member") fade in active @else fade @endif">
                        <div class="dataBox">
                            <div class="dataHeader">{{trans('_portal.member_center.basic.title')}}</div>
                            <div class="dataBody">
                                <div>
                                    <span>{{trans('_portal.member_center.basic.number')}}</span>
                                    <p class="iUserId">{{$member['iUserId'] or ''}}</p>
                                </div>
                                <div>
                                    <span>{{trans('_portal.member_center.basic.name')}}</span>
                                    <div class="inputOuter">
                                        <input type="text" class="inputStyle vUserName" value="{{$member['vUserName'] or ''}}">
                                    </div>
                                </div>
                                <div>
                                    <span>英文姓名</span>
                                    <div class="inputOuter">
                                        <input type="text" class="inputStyle vUserNameE" value="{{$member['vUserNameE'] or ''}}">
                                    </div>
                                </div>
                                {{--<div>--}}
                                    {{--<span>公司</span>--}}
                                    {{--<p>{{$member_company or ''}}</p>--}}
                                {{--</div>--}}
                                <div>
                                    <span>{{trans('_portal.member_center.basic.department')}}</span>
                                    <div class="inputOuter">
                                        <input type="text" class="inputStyle vDepartment" value="{{$member['vDepartment'] or ''}}" disabled>
                                    </div>
                                </div>
                                {{--<div>--}}
                                    {{--<span>稱呼</span>--}}
                                    {{--<div class="inputOuter">--}}
                                        {{--<input type="text" class="inputStyle vUserTitle" value="{{$member['vUserTitle'] or ''}}">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--<span>身份證字號(護照號碼)</span>--}}
                                    {{--<div class="inputOuter">--}}
                                        {{--<input type="text" class="inputStyle vUserID" value="{{$member['vUserID'] or ''}}">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--<span>生日</span>--}}
                                    {{--<div class="inputOuter">--}}
                                        {{--<input type="date" class="inputStyle iUserBirthday" value="{{$member['iUserBirthday'] or ''}}">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <div class="dataBox">
                            <div class="dataHeader">{{trans('_portal.member_center.contact.title')}}</div>
                            <div class="dataBody">
                                <div>
                                    <span>{{trans('_portal.member_center.contact.phone')}}</span>
                                    <div class="inputOuter">
                                        <input type="text" class="inputStyle vUserContact" value="{{$member['vUserContact'] or ''}}">
                                    </div>
                                </div>
                                <div>
                                    <span>{{trans('_portal.member_center.contact.email')}}</span>
                                    <div class="inputOuter">
                                        <input type="text" class="inputStyle vUserEmail"
                                               value="{{$member['vUserEmail'] or ''}}" style="width: 50%">
                                    </div>
                                </div>
                                <div>
                                    <span>配送地址</span>
                                    <p class="vUserAddress">{{$member['vUserAddress'] or ''}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="btnBox">
                            <button class=" btn-save">
                                <ion-icon name="save"></ion-icon>
                                <span>{{trans('_portal.member_center.save')}}</span>
                            </button>
                        </div>
                    </div>

                    <div id="pw" class="tab-pane @if($control=="resetpw") fade in active @else fade @endif">
                        <div class="dataBox">
                            <div class="dataHeader">{{trans('_portal.member_center.reset_password')}}</div>
                            <div class="dataBody">
                                <div>
                                    <span>{{trans('_portal.member_center.reset_pw_old')}}</span>
                                    <div class="inputOuter">
                                        <input type="password" class="inputStyle old_pw"
                                               placeholder="{{trans('_portal.member_center.reset_pw_old')}}">
                                    </div>
                                </div>
                                <div>
                                    <span>{{trans('_portal.member_center.reset_pw_new')}}</span>
                                    <div class="inputOuter">
                                        <input type="password" class="inputStyle new_pw"
                                               placeholder="{{trans('_portal.member_center.input_than_6')}}">
                                    </div>
                                </div>
                                <div>
                                    <span>{{trans('_portal.member_center.reset_pw_new2')}}</span>
                                    <div class="inputOuter">
                                        <input type="password" class="inputStyle new_pwrpy"
                                               placeholder="{{trans('_portal.member_center.reset_pw_new2_title')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btnBox">
                            <button class="btn-save-pw">
                                <ion-icon name="save"></ion-icon>
                                <span>{{trans('_portal.member_center.save')}}</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script type="text/javascript" src="{{asset('portal_assets/pc/js/staff.js')}}"></script>
    <script type="text/javascript" src="{{asset('portal_assets/dist/jqUi/jquery-ui.min.js')}}"></script>
    <!-- Plugin Customer-->
    <script type="text/javascript" src="{{asset('_assets/CryptoJS/rollups/md5.js')}}"></script>
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        $(document).ready(function () {
            //在會員中心按到訂單時
            $('.order').click(function () {
                //字串中含有order字串
                if (location.href.toString().indexOf('order') == -1){
                    location.href = '{{url('member_center/order')}}';
                }
            });


            //判斷會員3個顯示哪個區塊
            var control = '{{$control or ''}}';
            if(control==="resetpw")     //area 3
            {
                //修改密碼
                $('.fixPw').click();
            }
            else if(control==="order")      //area 1
            {
                //有訂單編號
                var num = '{{$order_num or 0}}';
                //訂單資料
                getlist({ "order_num": num , });

                $(document).delegate(".pagination a", "click", function(event) {
                    event.preventDefault();
                    var url = $(this).attr('href');
                    var page = getPage(url);
                    getlist({ "order_num": num , "page": page, });
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

                //時間區間搜尋
                $(".startTime").change(function () {
                    startTime = $(this).val();
                    endTime = $(".endTime").val();
                    sort = $('.time-sort').val();
                    getlist({ "order_num": num, "startTime": startTime, "endTime": endTime, "sort": sort });
                });
                $(".endTime").change(function () {
                    startTime = $(".startTime").val();
                    endTime = $(this).val();
                    sort = $('.time-sort').val();
                    getlist({ "order_num": num, "startTime": startTime, "endTime": endTime, "sort": sort });
                });

                //排序搜尋
                $(".time-sort").change(function () {
                    sort = $(this).val();
                    startTime = $(".startTime").val();
                    endTime = $(".endTime").val();
                    getlist({ "order_num": num, "startTime": startTime, "endTime": endTime, "sort": sort });
                });
            }
            else if(control==="member")         //area 2
            {
                //會員資料
                $('.mydata').click();    //來先按到會員資料效果
            }

            //更改會員資料
            $(".btn-save").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                //基本資料
                data.vUserName  = $(".vUserName").val();
                data.vUserNameE  = $(".vUserNameE").val();
                data.vDepartment     = $(".vDepartment").val();
                data.vUserTitle  = $(".vUserTitle").val();
                data.vUserID  = $(".vUserID").val();
                data.iUserBirthday  = $(".iUserBirthday").val();
                //聯絡資料
                data.vUserContact = $(".vUserContact").val();
                data.vUserEmail =   $(".vUserEmail").val();
                data.vUserZipCode = $(".zipcode").val();
                data.vUserCity =    $(".vUserCity").val();
                data.vUserArea =    $(".vUserArea").val();
                data.vUserAddress = $(".address").val();

                $.ajax({
                    url: "{{url('member_center/dosave')}}",
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success( rtndata.message , '{{trans('_web_alert.notice')}}');
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 500);
                        } else {
                            toastr.error( rtndata.message , '{{trans('_web_alert.notice')}}');
                        }
                    }
                });
            });

            // 更改密碼
            $(".btn-save-pw").click(function () {
                var old_pw = $(".old_pw");
                var pw = $(".new_pw");
                var pw_rpy = $(".new_pwrpy");

                if( old_pw.val() == ""){
                    toastr.error( old_pw.attr('placeholder')+'{{trans('_portal.noipt')}}',
                        '{{trans('_web_alert.notice')}}');
                    return;
                }
                if( pw.val() == ""){
                    toastr.error( pw.parent('.inputOuter').siblings('span').text()+'{{trans('_portal.noipt')}}',
                        '{{trans('_web_alert.notice')}}');
                    return;
                }
                if( pw.val().length < 6 || pw.val().length > 16){
                    toastr.error(
                        pw.parent('.inputOuter').siblings('span').text() +
                        '{{trans('_portal.member_center.input_than_6')}}' ,
                        '{{trans('_web_alert.notice')}}'
                    );
                    return;
                }
                if( pw_rpy.val() == ""){
                    toastr.error( pw_rpy.attr('placeholder')+'{{trans('_portal.noipt')}}',
                        '{{trans('_web_alert.notice')}}');
                    return;
                }
                if( pw.val() != pw_rpy.val() ){
                    toastr.error( pw_rpy.attr('placeholder') + ' 不正確 ' , '{{trans('_web_alert.notice')}}');
                    return;
                }

                var data = {"_token": "{{ csrf_token() }}"};
                //data.vPassword      = CryptoJS.MD5( old_pw.val() ).toString(CryptoJS.enc.Base64);
                data.vPassword      =  old_pw.val() ;
                // data.vPasswordNew   = CryptoJS.MD5( pw.val() ).toString(CryptoJS.enc.Base64);
                data.vPasswordNew   =  pw.val() ;
                $.ajax({
                    url: "{{url('member_center/dosavepassword')}}",
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success( rtndata.message , '{{trans('_web_alert.notice')}}');
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 500);
                        } else {
                            toastr.error( rtndata.message , '{{trans('_web_alert.notice')}}');
                        }
                    }
                });
            })
        });

        //訂單顯示
        function getlist(data) {
            $.ajax({
                url: "{{url('member_center/getlist')}}",
                type: "GET",
                data: data,
                async: true,
                success: function (rtndata) {
                    var html_str = "";
                    $("#order > .modeGroup").html(html_str);
                    if (rtndata.status) {
                        html_str += '<p class="orderCount">共'+ rtndata.count +'筆</p>';
                        for (var key in rtndata.aaData) {
                            var obj = rtndata.aaData[key];
                                html_str += '<div class="modeBox">';
                                html_str += '<div class="modeHeader">';
                                html_str += '<p class="orderDate">' + obj.date + '</p>';
                                html_str += '<p class="amount">NT$'+obj.iMoneyTotal+'</p>';
                                html_str += '</div>';
                                html_str += '<div class="modeBody">';
                                html_str += '<table>';
                                for (var key2 in obj.meta) {
                                    var meta = obj.meta[key2];
                                    html_str += '<tr>';
                                    html_str += '<td width="15%">';
                                    html_str += '<img src="'+meta.vImages+'" alt="">';
                                    html_str += '</td>';
                                    html_str += '<td width="30%">';
                                    html_str += '<p class="title">'+meta.vProductName+'</p>';
                                    html_str += '<p class="type">'+meta.vProductNum+'</p>';
                                    html_str += '</td>';
                                    html_str += '<td width="20%">NT$'+meta.iProductPromoPrice+'</td>';
                                    html_str += '<td width="20%">X'+meta.iCount+'</td>';
                                    html_str += '<td width="15%" class="total">NT$'+meta.iTotal+'</td>';
                                    html_str += '</tr>';
                                }
                                html_str += '</table>';
                                html_str += '<ul class="freight">';
                                html_str += '<li>';
                                html_str += '<div>運費-郵寄</div>';
                                html_str += '<div>NT$'+obj.iShipmentFee+'</div>';
                                html_str += '</li>';
                                html_str += '<li>';
                                html_str += '<div>{{trans("_portal.order.status")}}</div>';
                                html_str += '<div>';
                                if(obj.iStatus==0)
                                    html_str += '{{trans("_portal.order.status_.0")}}';
                                else if(obj.iStatus==2)
                                    html_str += '{{trans("_portal.order.status_.2")}}';
                                else if(obj.iStatus==3)
                                    html_str += '{{trans("_portal.order.status_.3")}}';
                                else if(obj.iStatus==4)
                                    html_str += '{{trans("_portal.order.status_.4")}}';
                                else if(obj.iStatus==5)
                                    html_str += '{{trans("_portal.order.status_.5")}}';
                                else if(obj.iStatus==6)
                                    html_str += '{{trans("_portal.order.status_.6")}}';
                                else if(obj.iStatus==1)
                                    html_str += '{{trans("_portal.order.status_.1")}}';
                                html_str += '</div>';
                                html_str += '</li>';
                                html_str += '</ul>';
                                html_str += '</div>';
                                html_str += '</div>';
                        }
                        if (rtndata.count <= 0){
                            html_str += '<p class="itemTitle">' + '{{trans("_portal.order.no")}}' + '</p>';
                        }
                        $("#order > .modeGroup").append(html_str);
                        $("#order > #pagination").html(rtndata.links_html);
                        $('html, body').scrollTop(0);
                    } else {
                        toastr.error( rtndata.message , "{{trans('_web_alert.notice')}}");
                    }
                },
                error: function () {
                    toastr.error( '更新失敗,請重新整理' , "{{trans('_web_alert.notice')}}");
                }
            });
        }
    </script>
@endsection
<!-- ================== /inline-js ================== -->