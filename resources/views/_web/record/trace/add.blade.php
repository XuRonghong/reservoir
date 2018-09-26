
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid-theme.min.css')}}" rel="stylesheet">
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.css')}}" rel="stylesheet">
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        @include('_web._layouts.breadcrumb')
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <div class="col-12">
                    <div class="card" id="manage-modal">
                        <div class="card-body">
                            <h4 class="card-title">{{$vSummary or ''}}</h4>
                            <h6 class="card-subtitle">{{session()->get( 'SEO.vTitle')}}</h6>
                        </div>
                        <hr>
                        <form class="form-horizontal">
                            <div class="card-body messageInfo-modal">
                                <h4 class="card-title">壹 、水庫基本資料</h4>
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">一、 概況</label>
                                    <div class="col-sm-9">
                                        水庫名稱：
                                        <input type="text" class="form-control vTitle" id="com1" placeholder="" value="{{$info->vTitle or ''}}">
                                        檢查日期：
                                        <input type="date" class="form-control vDate" id="com1" placeholder="" value="{{$info->vDate or ''}}">
                                        管理機關：
                                        <input type="text" class="form-control vCompany" id="com1" placeholder="" value="{{$info->vCompany or ''}}">
                                        檢查人員：
                                        <input type="text" class="form-control vCheckMan" id="com1" placeholder="" value="{{$info->vCheckMan or ''}}">
                                        位置：
                                        <input type="text" class="form-control vLocation" id="com1" placeholder="" value="{{$info->vLocation or ''}}">
                                        河系（主支流）：
                                        <input type="text" class="form-control vMainFlow" id="com1" placeholder="" value="{{$info->vMainFlow or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label">二、檢查時操作狀況</label>
                                    <div class="col-sm-9">
                                        水庫水位：
                                        <input type="text" class="form-control vTitle" id="com1" placeholder="" value="{{$info->vTitle or ''}}">
                                        水庫蓄水量：
                                        <input type="date" class="form-control vDate" id="com1" placeholder="" value="{{$info->vDate or ''}}">
                                        最高記錄水位：
                                        <input type="text" class="form-control vCompany" id="com1" placeholder="" value="{{$info->vCompany or ''}}">
                                        <br>
                                        <h5>放水量：</h5>
                                        溢洪道<input type="text" class=" vCheckMan" id="com1" placeholder="" value="{{$info->vCheckMan or ''}}">秒立方公尺<br>
                                        出水工<input type="text" class=" vCheckMan" id="com1" placeholder="" value="{{$info->vCheckMan or ''}}">秒立方公尺<br>
                                        渠  道<input type="text" class=" vCheckMan" id="com1" placeholder="" value="{{$info->vCheckMan or ''}}">秒立方公尺<br>
                                        發電廠<input type="text" class=" vCheckMan" id="com1" placeholder="" value="{{$info->vCheckMan or ''}}">秒立方公尺<br>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">三、地質環境</label>
                                    <div class="col-sm-9">
                                        基岩性質：
                                        <input type="text" class="form-control vTitle" id="com1" placeholder="" value="{{$info->vTitle or ''}}">
                                    </div>
                                    <div class="col-sm-9">
                                        <h6>基岩孔隙度：</h6>
                                        <input type="radio" id="com3" name="feature" value="1" />極小
                                        <input type="radio" id="com3" name="feature" value="2" />小
                                        <input type="radio" id="com3" name="feature" value="3" />中
                                        <input type="radio" id="com3" name="feature" value="4" />大
                                    </div>
                                    <div class="col-sm-9">
                                        <h6>基岩節理或劈理：</h6>
                                        <input type="radio" id="com3" name="feature2" value="1" />發達
                                        <input type="radio" id="com3" name="feature2" value="0" />不發達
                                    </div>
                                    <div class="col-sm-9">
                                        <h6>主壩與地層走向：</h6>
                                        <input type="radio" id="com3" name="feature3" value="0" />平行
                                        <input type="radio" id="com3" name="feature3" value="1" />小角度斜交
                                        <input type="radio" id="com3" name="feature3" value="2" />大角度斜交
                                    </div>
                                    <br>
                                    <div class="col-sm-9">
                                        <h6>地層傾斜與主壩關係：</h6>
                                        <input type="radio" id="com3" name="feature3" value="up" />向上游傾斜
                                        <input type="radio" id="com3" name="feature3" value="down" />向下游傾斜
                                    </div>
                                    <div class="col-sm-9">
                                        <h6>附近有無斷層通過：</h6>
                                        <input type="radio" id="com3" name="feature3" value="0" />無
                                        <input type="radio" id="com3" name="feature3" value="1" />有
                                        （
                                            <input type="radio" id="com3" name="feature3" value="10" />活動斷層
                                            <input type="radio" id="com3" name="feature3" value="11" />不活動斷層
                                        ）
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body messageInfo-modal2">
                                <h4 class="card-title">貳、檢查內容</h4>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">一、結構物安全檢查</label>
                                    <h6>（一）壩體</h6>
                                    <div class="col-sm-9">
                                        <b>1.上游坡面：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">1.裂縫</option>
                                            <option value="2" title="">2.沈陷</option>
                                            <option value="3" title="">3.滑動</option>
                                            <option value="4" title="">4.沖蝕溝</option>
                                            <option value="5" title="">5.動物洞穴</option>
                                            <option value="6" title="">6.植物生長</option>
                                        </select>
                                        <br>
                                        <b>坡面拋石保護或植物生長：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-sm-9">
                                        <b>2.下游坡面：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">1.裂縫</option>
                                            <option value="2" title="">2.沈陷</option>
                                            <option value="3" title="">3.滑動</option>
                                            <option value="4" title="">4.沖蝕溝</option>
                                            <option value="5" title="">5.動物洞穴</option>
                                            <option value="6" title="">6.植物生長</option>
                                            <option value="7" title="">待改善</option>
                                        </select>
                                        <br>
                                        <b>滲流情況或濕潤區域：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">正常</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-sm-9">
                                        <b>3.壩座與壩基：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">1.滲漏</option>
                                            <option value="2" title="">2.裂縫</option>
                                            <option value="3" title="">3.移動</option>
                                            <option value="4" title="">4.壩基淘刷</option>
                                        </select>
                                        <br>
                                        <b>壩基排水情形：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">正常</option>
                                            <option value="12" title="">待改善</option>
                                            <option value="13" title="">其他</option>
                                        </select>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-sm-9">
                                        <b>4.壩頂：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">1.龜裂</option>
                                            <option value="2" title="">2.移動</option>
                                            <option value="3" title="">3.沈陷</option>
                                            <option value="4" title="">4.長樹</option>
                                        </select>
                                        <br>
                                        <b>欄杆及護網等安全措施：</b>
                                            <br>
                                            <input type="radio" id="com3" name="feature4" value="1" />有
                                            （
                                            <input type="radio" id="com3" name="feature41" value="11" />良好
                                            <input type="radio" id="com3" name="feature41" value="10" />待改善
                                            ）
                                            <input type="radio" id="com3" name="feature4" value="0" />無
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-sm-9">
                                        <b>5.出水高：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="1" title="">1.足夠</option>
                                            <option value="2" title="">2.不足</option>
                                            <option value="3" title="">3.待檢討</option>
                                        </select>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img1" class="col-sm-3 text-right control-label col-form-label">圖片</label>
                                    <div class="col-sm-9">
                                        <a class="btn-image-modal" data-modal="image-form" data-id="">
                                            <img src="{{$info->vImages or url('images/empty.jpg')}}" style="height:140px">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if(isset($info))
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-dosave" data-id="{{$info->iId or ''}}">Save</button>
                                    @else
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-doadd">Add</button>
                                    @endif
                                    <button type="button" class="btn btn-dark waves-effect waves-light btn-cancel">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection
<!-- /content -->

@section('aside')

@endsection

<!-- ================== page-js ================== -->
@section('page-js')
    <!--This page JavaScript -->
    <script src="{{url('xtreme-admin/dist/js/pages/tables/js-grid-db.js')}}"></script>
    <script src="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.js')}}"></script>
    <script src="{{url('xtreme-admin/dist/js/pages/tables/js-grid-init.js')}} "></script>
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <!-- Public Crop_Image -->
    @include('_web._js.crop_image')
    <!-- end -->
    <!-- Public SummerNote -->
    @include('_web._js.summernote')
    <!-- end -->
    <script type="text/javascript">
        var current_data = [];
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        $(document).ready(function () {
            //
            var modal = $("#manage-modal");
            current_modal = modal.find('.messageInfo-modal');
            //
            $(".btn-cancel").click(function () {
                history.back();
            });
            //
            $(".btn-doadd").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.iSource = current_modal.find(".iSource").val();
                data.iHead = current_modal.find(".iHead").val();
                data.vTitle = current_modal.find(".vTitle").val();
                data.vSummary = current_modal.find(".vSummary").val();
                data.vImages = current_modal.find("img").attr('src');
                //
                $.ajax({
                    url: url_doadd,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            //
                            sendNotifyMessage(rtndata.newid , rtndata.heads_token , current_modal.find(".vTitle").val() , current_modal.find(".vSummary").val());
                            //
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                });
            });
            //
            $(".btn-dosave").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = $(this).data('id');
                data.iSource = current_modal.find(".iSource").val();
                data.iHead = current_modal.find(".iHead").val();
                data.vTitle = current_modal.find(".vTitle").val();
                data.vSummary = current_modal.find(".vSummary").val();
                data.vImages = current_modal.find("img").attr('src');
                //
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            //
                            sendNotifyMessage(rtndata.newid , rtndata.heads_token , current_modal.find(".vTitle").val() , current_modal.find(".vSummary").val());
                            //
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                });
            });
        });
        //
        //送出推播、掛在WEB通知
        function sendNotifyMessage( id , DeliverList , title , message){
            //要送的標題
            // var title = "緊急通知";
            //要送的內文
            // var message = "XX水庫因地震發現裂痕！";
            //需要通知手機的token
            // var token = "fk9IJMONhCs:APA91bGq9zJ9eYS5kXQjgyk2p3UUsRhOxehXBSifmFV65B1kyE6sGDJvtP4uMS8-mpc1XYkjOwHsYfV-1rZdCemh4KK2RrcnDMX7l3riqtwvM8u3o4YhfLIO7nkrLfwAMZm1Qk8WulO9";
            //該則通知的所屬網址 如 http://reservoir.kahap.com/web/message/center/attr/2564
            var url = "http://reservoir.kahap.com/web/message/center" + /attr/ + id;
            //傳送token 找哪些是要收到的機子、A水庫所屬的管理員
            // var DeliverList = [];
            // DeliverList.push(token);//新增token
            /*上方為所需變更之資料*/


            //SERVER密鑰  存資料庫
            var API_SERVER_ACCESS_KEY = "AAAAMUWvMtg:APA91bEnWZfQmcGGl4aFsHscJqTGVWLgIGDTnDNAzuqyt1vYy_uKgsQjlBSvfm3eAAGI7jGZ1P0GgE8QHdmb-H0imVjwiYGFScen_W9hQqTcbBs5p0OjychEovihcrSxydIkjqdZWlpS";

            $.ajax({
                type:"post",
                url:"https://fcm.googleapis.com/fcm/send",
                cache:false,
                headers:{
                    "Content-Type":"application/json",
                    "Authorization":"key="+API_SERVER_ACCESS_KEY
                },
                data:JSON.stringify({
                    "priority":"high",
                    "data":{
                        "Title" : title,
                        "body" : message,
                        "url" : url
                    },
                    "registration_ids":DeliverList
                }),
                success:function(result){
                    JSON.stringify(result);
                },
                error:function(result){
                    JSON.stringify(result);
                }
            });
        }
    </script>
@endsection
<!-- ================== /inline-js ================== -->