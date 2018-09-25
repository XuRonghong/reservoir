
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
                            <h4 class="card-title modalTitle">{{session()->get( 'SEO.vTitle')}}</h4>
                            <h6 class="card-subtitle">{{$vSummary or ''}}</h6>
                        </div>
                        <hr>
                        <form class="form-horizontal">
                            <div class="card-body messageInfo-modal">
                                <h4 class="card-title"></h4>
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">發送者</label>
                                    <div class="col-sm-9">
                                        {{$info->iSource or 'Self'}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label">目標階層</label>
                                    <div class="col-sm-9">
                                        <select class="form-control iHead" id="com2" >
                                            @if(isset($info))
                                            <option value="10" @if($info->iHead<20) selected @endif>網站管理員</option>
                                            <option value="20" @if($info->iHead<30 && $info->iHead>19) selected @endif>1.水庫管理員</option>
                                            <option value="30" @if($info->iHead<40 && $info->iHead>29) selected @endif>2.水庫審查員</option>
                                            <option value="40" @if($info->iHead<50 && $info->iHead>39) selected @endif>3.中央水利署人員</option>
                                            @else
                                                <option value="10" title="只有網站管理員才看到">網站管理員</option>
                                                <option value="20" title="水庫管理員看得到">1.水庫管理員</option>
                                                <option value="30" title="水庫相關人員看得到">2.水庫審查員</option>
                                                <option value="40" title="相關人員看得到">3.中央水利署人員</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">標頭</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vTitle" id="com3" placeholder="" value="{{$info->vTitle or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">概要</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control vSummary" id="com4" placeholder="" value="{{ $info->vSummary or ''}}">
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