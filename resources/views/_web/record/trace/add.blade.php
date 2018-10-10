
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
                            {{--<h4 class="card-title">{{$vSummary or ''}}</h4>--}}
                            {{--<h6 class="card-subtitle">{{session()->get( 'SEO.vTitle')}}</h6>--}}
                        </div>
                        <hr>
                        <form class="form-horizontal">
                            <div class="card-body messageInfo-modal1">
                                <h4 class="card-title Title">壹 、水庫基本資料</h4>
                                <div class="form-group row a1">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label title">一、 概況</label>
                                    <div class="col-sm-9 a11">
                                        <div class="t1">水庫名稱：</div>
                                        <input type="text" class="form-control a111" id="com1" placeholder="" value="{{$info->vTitle or ''}}">
                                        <div class="t2">檢查日期：</div>
                                        <input type="date" class="form-control a112" id="com1" placeholder="" value="{{$info->vDate or ''}}">
                                        <div class="t3">管理機關：</div>
                                        <input type="text" class="form-control a113" id="com1" placeholder="" value="{{$info->vCompany or ''}}">
                                        <div class="t4">檢查人員：</div>
                                        <input type="text" class="form-control a114" id="com1" placeholder="" value="{{$info->vCheckMan or ''}}">
                                        <div class="t5">位置：</div>
                                        <input type="text" class="form-control a115" id="com1" placeholder="" value="{{$info->vLocation or ''}}">
                                        <div class="t6">河系（主支流）：</div>
                                        <input type="text" class="form-control a116" id="com1" placeholder="" value="{{$info->vMainFlow or ''}}">
                                    </div>
                                </div>
                                <div class="form-group row a2">
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label title">二、檢查時操作狀況</label>
                                    <div class="col-sm-9 a21">
                                        水庫水位：
                                        <input type="text" class="form-control vTitle" id="com1" placeholder="" value="{{$info->vTitle or ''}}">
                                        水庫蓄水量：
                                        <input type="date" class="form-control vDate" id="com1" placeholder="" value="{{$info->vDate or ''}}">
                                        最高記錄水位：
                                        <input type="text" class="form-control vCompany" id="com1" placeholder="" value="{{$info->vCompany or ''}}">
                                        <br>
                                        <h5>放水量：</h5>
                                        <div class="form-inline">
                                            <div>溢洪道<input type="text" class="form-control a111" id="com1" placeholder="" value="{{$info->vCheckMan or ''}}">秒立方公尺<br></div>
                                            <div>出水工<input type="text" class="form-control a111" id="com1" placeholder="" value="{{$info->vCheckMan or ''}}">秒立方公尺<br></div>
                                            <div>渠  道<input type="text" class="form-control a111" id="com1" placeholder="" value="{{$info->vCheckMan or ''}}">秒立方公尺<br></div>
                                            <div>發電廠<input type="text" class="form-control a111" id="com1" placeholder="" value="{{$info->vCheckMan or ''}}">秒立方公尺<br></div>
                                        </div>

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
                                <h4 class="card-title title">貳、檢查內容</h4>
                                <div class="form-group row b1">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label ">一、結構物安全檢查</label>
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
                                    <div class="col-sm-9">
                                        <b>6.觀測儀器及記錄：</b>
                                        <br>
                                        項目
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <input type="text" class=" vCheckMan" style="width: 30%" value="{{$info->vCheckMan or ''}}">處
                                        <br>紀錄：
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="0" />無
                                        <br>
                                        項目
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <input type="text" class=" vCheckMan" style="width: 30%" value="{{$info->vCheckMan or ''}}">處
                                        <br>紀錄：
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="0" />無
                                        <br>
                                        項目
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <input type="text" class=" vCheckMan" style="width: 30%" value="{{$info->vCheckMan or ''}}">處
                                        <br>紀錄：
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="0" />無
                                        <br>
                                        項目
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <input type="text" class=" vCheckMan" style="width: 30%" value="{{$info->vCheckMan or ''}}">處
                                        <br>紀錄：
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="0" />無
                                        <br>
                                        項目
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <input type="text" class=" vCheckMan" style="width: 30%" value="{{$info->vCheckMan or ''}}">處
                                        <br>紀錄：
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="0" />無
                                        <br>
                                        <b>建議加設之觀測儀器：</b>
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-sm-9">
                                        <b>7.廊道：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">裂縫</option>
                                            <option value="2" title="">移動</option>
                                            <option value="3" title="">表面剝落</option>
                                            <option value="4" title="">凹陷</option>
                                        </select>
                                        <br>
                                        <b>滲流及排水情形：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">正常</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <b>混凝土一般狀況：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">正常</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <b>通氣及照明設備：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">正常</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <b>金屬工：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <b>※重要事項記述：</b>
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <br>
                                        <br>
                                    </div>
                                    <h6>（二）溢洪道</h6>
                                    <div class="col-sm-9">
                                        <b>1.入口渠道：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">植物生長</option>
                                            <option value="2" title="">渠道滑動</option>
                                            <option value="3" title="">漂流物</option>
                                        </select>
                                        <br>
                                        <b>邊坡保護：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <b>2.溢洪道護坦：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">表面剝落</option>
                                            <option value="2" title="">裂縫</option>
                                            <option value="3" title="">凹陷</option>
                                            <option value="2" title="">移動</option>
                                            <option value="3" title="">接縫滲水</option>
                                        </select>
                                        <br>
                                        <b>3.溢洪道頂：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">表面剝落</option>
                                            <option value="2" title="">裂縫</option>
                                            <option value="3" title="">凹陷</option>
                                            <option value="2" title="">移動</option>
                                            <option value="3" title="">接縫滲水</option>
                                        </select>
                                        <br>
                                        <b>4.溢洪道牆：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">表面剝落</option>
                                            <option value="2" title="">裂縫</option>
                                            <option value="3" title="">凹陷</option>
                                            <option value="2" title="">移動</option>
                                            <option value="3" title="">接縫滲水</option>
                                        </select>
                                        <br>
                                        <b>5.溢洪道底板：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">表面剝落</option>
                                            <option value="2" title="">裂縫</option>
                                            <option value="3" title="">凹陷</option>
                                            <option value="2" title="">移動</option>
                                            <option value="3" title="">接縫滲水</option>
                                        </select>
                                        <br>
                                        <b>6.附屬設備：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">破損待修</option>
                                        </select>
                                        <br>
                                        <b>7.下游放水路：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">暢通</option>
                                            <option value="1" title="">被侵佔</option>
                                            <option value="2" title="">高莖物</option>
                                            <option value="3" title="">待疏浚</option>
                                            <option value="2" title="">裂縫</option>
                                            <option value="3" title="">固定結構物阻流</option>
                                        </select>
                                        <br>
                                        <b>8.靜水池：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">表面剝落</option>
                                            <option value="2" title="">裂縫</option>
                                            <option value="3" title="">凹陷</option>
                                            <option value="2" title="">移動</option>
                                            <option value="3" title="">接縫滲水</option>
                                        </select>
                                        <br>
                                        <b>9.溢洪道底板：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        （
                                        <input type="radio" id="com3" name="feature4" value="1" />完整
                                        <input type="radio" id="com3" name="feature4" value="1" />待修補
                                        ）
                                        <br>
                                        <b>10.設計洪水量：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />重新檢討
                                        <input type="radio" id="com3" name="feature4" value="0" />不需檢討
                                        <br>
                                        <b>11.排洪能力：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />足夠
                                        <input type="radio" id="com3" name="feature4" value="0" />不足
                                        <input type="radio" id="com3" name="feature4" value="0" />待檢討
                                        <br>
                                        <b>※重要事項記述：</b>
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <h6>（三）取水工及出水工</h6>
                                    <div class="col-sm-9">
                                        <b>1.進水口結構：</b><br>
                                        <b>攔污柵：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />待增設
                                        <br>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        （
                                        <input type="radio" id="com3" name="feature4" value="1" />完整
                                        <input type="radio" id="com3" name="feature4" value="1" />待修補
                                        <input type="radio" id="com3" name="feature4" value="1" />漂流物待清除
                                        ）
                                        <br>
                                        <b>混凝土結構：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">表面剝落</option>
                                            <option value="2" title="">裂縫</option>
                                            <option value="3" title="">凹陷</option>
                                            <option value="2" title="">移動</option>
                                            <option value="3" title="">接縫滲水</option>
                                        </select>
                                        <br>
                                        <b>閘門結構物：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">滲漏</option>
                                            <option value="2" title="">待修補</option>
                                        </select>
                                        <br>
                                        <b>金屬工：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="2" title="">待修補</option>
                                        </select>
                                        <br>
                                        <br>
                                        <b>2.緊急控制設施：</b><br>
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        （
                                        <input type="radio" id="com3" name="feature4" value="1" />完整
                                        <input type="radio" id="com3" name="feature4" value="1" />待改善
                                        ）
                                        <br>
                                        <b>3.出水管道：</b>
                                        <br>
                                        <b>金屬工：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">穴蝕</option>
                                            <option value="2" title="">待修補</option>
                                        </select>
                                        <br>
                                        <b>混凝土工：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="1" title="">滲漏</option>
                                            <option value="2" title="">待修補</option>
                                        </select>
                                        <br>
                                        <b>4.操作設備：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <b>閘門室：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="1" title="">滲漏</option>
                                            <option value="1" title="">穴蝕</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <b>閘門：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="1" title="">滲漏</option>
                                            <option value="1" title="">穴蝕</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <b>閥門：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="12" title="">待改善</option>
                                        </select>
                                        <br>
                                        <b>控制系統：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="12" title="">待改善</option>
                                            <option value="12" title="">其他</option>
                                        </select>
                                        <br>
                                        <br>
                                        <b>5.靜水池：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="0" title="">完整</option>
                                            <option value="3" title="">雜物</option>
                                            <option value="1" title="">表面剝落</option>
                                            <option value="2" title="">裂縫</option>
                                            <option value="2" title="">移動</option>
                                            <option value="3" title="">接縫滲水</option>
                                            <option value="2" title="">回填方待修補</option>
                                            <option value="2" title="">材料老化</option>
                                            <option value="1" title="">穴蝕</option>
                                        </select>
                                        <br>
                                        <br>
                                        <b>6.出水渠道：</b>
                                        <select class="form-sel iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="3" title="">植物生長</option>
                                            <option value="1" title="">邊坡不穩定</option>
                                            <option value="2" title="">護岸待修</option>
                                        </select>
                                        <br>
                                        <br>
                                        <b>※重要事項記述：</b>
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <h6>（四）發電設備</h6>
                                <div class="col-sm-9">
                                    <b>1.進水口結構：</b><br>
                                    <b>攔污柵：</b>
                                    <input type="radio" id="com3" name="feature4" value="1" />無
                                    <input type="radio" id="com3" name="feature4" value="1" />待增設
                                    <input type="radio" id="com3" name="feature4" value="1" />有
                                    （
                                    <input type="radio" id="com3" name="feature4" value="1" />完整
                                    <input type="radio" id="com3" name="feature4" value="1" />待修補
                                    ）
                                    <br>
                                    <b>閘門設備：</b>
                                    <select class=" iHead" id="com2" >
                                        <option value="11" title="">良好</option>
                                        <option value="2" title="">待修補</option>
                                        <option value="3" title="">需維護</option>
                                    </select>
                                    <br>
                                    <b>操作手冊：</b>
                                    <input type="radio" id="com3" name="feature4" value="1" />無
                                    <input type="radio" id="com3" name="feature4" value="1" />待增補
                                    <input type="radio" id="com3" name="feature4" value="1" />有
                                    <br>
                                    <b>2.壓力綱管：</b><br>
                                    <select class=" iHead" id="com2" >
                                        <option value="11" title="">良好</option>
                                        <option value="2" title="">移動</option>
                                        <option value="2" title="">裂縫</option>
                                        <option value="1" title="">穴蝕</option>
                                    </select>
                                    <br>
                                    <b>3.發電廠結構：</b><br>
                                    <select class=" iHead" id="com2" >
                                        <option value="11" title="">良好</option>
                                        <option value="2" title="">待修</option>
                                    </select>
                                    <br>
                                    <b>4.尾水道：</b><br>
                                    <select class=" iHead" id="com2" >
                                        <option value="11" title="">良好</option>
                                        <option value="2" title="">待修</option>
                                    </select>
                                    <br>
                                    <b>5.備用電力設備：</b><br>
                                    <input type="radio" id="com3" name="feature4" value="1" />無
                                    <input type="radio" id="com3" name="feature4" value="1" />有
                                    （
                                    <input type="radio" id="com3" name="feature4" value="1" />良好
                                    <input type="radio" id="com3" name="feature4" value="1" />待修
                                    ）
                                    <br>
                                    <br>
                                    <b>※重要事項記述：</b>
                                    <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">二、放水設施安全檢查</label>

                                    <h6>（一）閘閥及機電設備</h6>
                                    <div class="col-sm-9">
                                        <b>1.檢查：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <br>
                                        <b>定期檢查：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <br>
                                        <b>檢查記錄：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />不全
                                        <br>
                                        <br>
                                        <b>2.動力來源：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />台電
                                        <input type="radio" id="com3" name="feature4" value="1" />自備電源
                                        <input type="radio" id="com3" name="feature4" value="1" />人力
                                        <br>
                                        <br>
                                        <b>3.維護：</b><br>
                                        <select class=" iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="2" title="">尚可</option>
                                            <option value="2" title="">待加強</option>
                                        </select>
                                        <br>
                                        <b>記錄：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />不全
                                        <br><br>
                                        <b>4.暴雨前後之檢查：</b><br>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <br>，紀錄
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />不全
                                        <br><br>
                                        <b>5.地震前後之檢查：</b><br>
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <br>，紀錄
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />不全
                                        <br>
                                        <br><br>
                                        <b>6.啟用年份：</b>
                                        <input type="text" class=" vCheckMan" style="width: 20%" value="{{$info->vCheckMan or ''}}">年啟用
                                        <input type="text" id="com3" name="feature4" value="1" />已逾齡
                                        <input type="radio" id="com3" name="feature4" value="1" />未逾齡
                                        <br>
                                        <b>7.河道放水口：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <br>
                                        <b>維護：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <option value="2" title="">待加強</option>
                                        <br>
                                        <b>記錄：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />不全
                                        <br>

                                        <b>8.定期操作試驗：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <br>，紀錄
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />不全
                                        <br>
                                        <br>
                                        <b>9.其它放水設施：</b>
                                        <input type="radio" id="com3" name="feature4" value="有" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <br>
                                        名稱：<input type="text" class=" vCheckMan" style="width: 20%" value="{{$info->vCheckMan or ''}}">
                                        <br>
                                        <b>維護：</b>
                                        <select class=" iHead" id="com2" >
                                            <option value="11" title="">良好</option>
                                            <option value="2" title="">尚可</option>
                                            <option value="2" title="">待加強</option>
                                        </select>
                                        <br>
                                        紀錄
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <input type="radio" id="com3" name="feature4" value="1" />不全
                                        <br>
                                        <b>10.閘閥之水密性：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />良好
                                        <input type="radio" id="com3" name="feature4" value="1" />漏水待改善
                                        <br>
                                        <b>11.閘閥開度指示器：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />位置正確
                                        <input type="radio" id="com3" name="feature4" value="1" />偏差待訂正
                                        <br>
                                        <b>12.閘閥插板及吊放設備：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <br>
                                        <b>維護：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />良好
                                        <input type="radio" id="com3" name="feature4" value="1" />待改善
                                        <br>
                                        <br>
                                        <b>13.欄污柵：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />無
                                        <br>
                                        <b>維護：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />良好
                                        <input type="radio" id="com3" name="feature4" value="1" />待改善
                                        <br>
                                        <br>
                                        <b>※重要事項記述：</b>
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <br>
                                        <br>
                                        <br>
                                    </div>

                                    <h6>（二）閘閥操作</h6>
                                    <div class="col-sm-9">
                                        <b>1.設置地點與外界隔絕：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />是
                                        <input type="radio" id="com3" name="feature4" value="1" />外人可靠近
                                        <br>
                                        <b>2.操作規則：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />有
                                        <input type="radio" id="com3" name="feature4" value="1" />待訂
                                        <input type="radio" id="com3" name="feature4" value="1" />待修正
                                        <br>
                                        <b>3.水門啟閉之標準：</b>
                                        <input type="radio" id="com3" name="feature4" value="1" />己辦
                                        <input type="radio" id="com3" name="feature4" value="1" />辦理中
                                        <input type="radio" id="com3" name="feature4" value="1" />待辦
                                        <br>
                                        <br>
                                        <br>
                                        <b>※重要事項記述：</b>
                                        <input type="text" class=" vCheckMan" style="width: 40%" value="{{$info->vCheckMan or ''}}">
                                        <br>
                                        <br>
                                        <br>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    {{--@if(isset($info->iCheck))--}}
                                        @if( session('member.iAcType') && session('member.iAcType')>9 && session('member.iAcType')<20)
                                            <button type="button" class="btn btn-info waves-effect waves-light btn-doadd">
                                                Add & Send
                                            </button>
                                        @elseif( isset($info) && $info->iCheck_message < session('member.iAcType') && session('member.iAcType')>19 && session('member.iAcType')<80)
                                            <button type="button" class="btn btn-success waves-effect waves-light btn-check" data-id="{{$info->iSource or ''}}">
                                                Check & Send
                                            </button>
                                        @endif
                                    {{--@endif--}}
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
                // data.iSource = current_modal.find(".iSource").val();
                // data.iHead = current_modal.find(".iHead").val();
                // data.vTitle = current_modal.find(".vTitle").val();
                // data.vSummary = current_modal.find(".vSummary").val();
                // data.vImages = current_modal.find("img").attr('src');
                //
                data.vDetail = getInputToJson();
                //
                $.ajax({
                    url: url_doadd,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
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
            $(".btn-check").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = $(this).data('id');
                $.ajax({
                    url: url_dosave,
                    type: 'POST',
                    data: data,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            //button hide
                            $(".btn-check").hide();
                            //
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                })
            });


            //
            $(".btn-dosave").click(function () {
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = $(this).data('id');
                // data.iSource = current_modal.find(".iSource").val();
                // data.iHead = current_modal.find(".iHead").val();
                // data.vTitle = current_modal.find(".vTitle").val();
                // data.vSummary = current_modal.find(".vSummary").val();
                // data.vImages = current_modal.find("img").attr('src');
                //
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
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

        function getInputToJson()
        {
            return {
                'a': {
                    'title': '壹 、水庫基本資料',
                    'a1': {
                        'title': '一、 概況',
                        'a11': {
                            'title': '水庫名稱',
                            'data': $('.a11').val()
                        },
                        'a12': {
                            'title': '檢查日期',
                            'data': $('.a12').val()
                        },
                        'a13': {
                            'title': '管理機關',
                            'data': $('.a13').val()
                        },
                        'a14': {
                            'title': '檢查人員',
                            'data': $('.a14').val()
                        },
                    },
                    'a2': {
                        'title': '二、檢查時操作狀況',
                        'a21': {
                            'title': '水庫水位',
                            'data': $('.a21').val(),
                            'foot': '公尺'
                        },
                        'a22': {
                            'title': '水庫蓄水量',
                            'data': $('.a22').val(),
                            'foot': '萬立方公尺'
                        },
                        'a23': {
                            'title': '最高記錄水位',
                            'data': $('.a23').val(),
                            'foot': '公尺'
                        },
                        'a24': {
                            'title': '放水量',
                            'a241': {
                                'title': '溢洪道',
                                'data': $('.a241').val(),
                                'foot': '秒立方公尺'
                            },
                            'a242': {
                                'title': '出水工',
                                'data': $('.a242').val(),
                                'foot': '秒立方公尺'
                            },
                            'a243': {
                                'title': '渠  道',
                                'data': $('.a243').val(),
                                'foot': '秒立方公尺'
                            },
                            'a244': {
                                'title': '發電廠',
                                'data': $('.a244').val(),
                                'foot': '秒立方公尺'
                            },
                        },
                    }
                },
                'b': {
                    'title': '貳、檢查內容',
                    'b1': {
                        'title': '一、結構物安全檢查',
                        'b11': {
                            'title': '（一）壩體',
                            'b1101': {
                                'title': '1.上游坡面：',
                                'data': $('.b1101').val(),
                            },
                            'b1102': {
                                'title': '2.下游坡面：',
                                'data': $('.b1102').val(),
                                'b11021': {
                                    'title': '滲流情況或濕潤區域',
                                    'data': $('.b11021').val(),
                                }
                            },
                            'b1103': {
                                'title': '3.壩座與壩基：',
                                'data': $('.b1103').val(),
                                'b11031': {
                                    'title': '壩基排水情形',
                                    'data': $('.b11031').val(),
                                }
                            },
                            'b1104': {
                                'title': '4.壩頂：',
                                'data': $('.b1104').val(),
                                'b11041': {
                                    'title': '欄杆及護網等安全措施',
                                    'data': $('.b11041').val(),
                                }
                            },
                            'b1105': {
                                'title': '5.出水高：',
                                'data': $('.b1105').val(),
                            },
                            'b1106': {
                                'title': '6.廊道：',
                                'data': $('.b1106').val(),
                                'b11061': {
                                    'title': '滲流及排水情形',
                                    'data': $('.b11061').val(),
                                },
                                'b11062': {
                                    'title': '混凝土一般狀況',
                                    'data': $('.b11062').val(),
                                },
                                'b11063': {
                                    'title': '通氣及照明設備',
                                    'data': $('.b11063').val(),
                                },
                                'b11064': {
                                    'title': '金屬工',
                                    'data': $('.b11064').val(),
                                },
                            },
                            'b1107': {
                                'title': '※重要事項記述：',
                                'data': $('.b1107').val(),
                            }
                        },
                        'b12':{
                            'title': '（二）溢洪道',
                            'b1201':{
                                'title': '1.入口渠道：',
                                'data': $('.b1201').val(),
                                'b12011':{
                                    'title':'邊坡保護',
                                    'data': $('.b12011').val()
                                },
                            },
                            'b1202':{
                                'title': '2.溢洪道護坦：',
                                'data': $('.b1202').val(),
                            },
                            'b1203':{
                                'title': '3.溢洪道頂：',
                                'data': $('.b1203').val(),
                            },
                            'b1204':{
                                'title': '4.溢洪道牆：',
                                'data': $('.b1205').val(),
                            },
                            'b1205':{
                                'title': '5.溢洪道底板：',
                                'data': $('.b1205').val(),
                            },
                            'b1206':{
                                'title': '6.附屬設備：',
                                'data': $('.b1206').val(),
                            },
                            'b1207':{
                                'title': '7.下游放水路：',
                                'data': $('.b1207').val(),
                            },
                            'b1208':{
                                'title': '8.靜水池：',
                                'data': $('.b1208').val(),
                            },
                            'b1209':{
                                'title': '9.緊急排洪設施：',
                                'data': $('.b1209').val(),
                            },
                            'b1210':{
                                'title': '10.設計洪水量：',
                                'data': $('.b1210').val(),
                            },
                            'b1211':{
                                'title': '11.排洪能力：',
                                'data': $('.b1211').val(),
                            },
                            'b1212':{
                                'title': '※重要事項記述：',
                                'data': $('.b1212').val(),
                            }
                        },
                        'b13':{
                            'title': '（三）取水工及出水工',
                            'b1301':{
                                'title': '1.進水口結構：',
                                'b13011': {
                                    'title': '混凝土結構：',
                                    'data': $('.b13011').val()
                                },
                                'b13012': {
                                    'title': '閘門結構物：',
                                    'data': $('.b13012').val()
                                },
                                'b13013': {
                                    'title': '金屬工：',
                                    'data': $('.b13013').val()
                                },
                            },
                            'b1302':{
                                'title': '2.緊急控制設施：',
                                'data': $('.b1302'),
                            },
                            'b1303':{
                                'title': '3.出水管道',
                                'b13031': {
                                    'title': '金屬工：',
                                    'data': $('.b13031').val()
                                },
                                'b13032': {
                                    'title': '混凝土工：',
                                    'data': $('.b13032').val()
                                },
                            },
                            'b1304':{
                                'title': '4.操作設備',
                                'b13041': {
                                    'title': '閘門室：',
                                    'data': $('.b13041').val()
                                },
                                'b13042': {
                                    'title': '閘門：',
                                    'data': $('.b13042').val()
                                },
                                'b13043': {
                                    'title': '閥門：',
                                    'data': $('.b13043').val()
                                },
                                'b13044': {
                                    'title': '控制系統：',
                                    'data': $('.b13044').val()
                                },
                            },
                            'b1305':{
                                'title': '5.靜水池',
                                'data': $('.b1305').val(),
                            },
                            'b1306':{
                                'title': '6.出水渠道',
                                'data': $('.b1306').val(),
                            },
                            'b1307':{
                                'title': '※重要事項記述：',
                                'data': $('.b1307').val(),
                            },
                        },
                        'b14':{
                            'title': '（四）發電設備',
                            'b1401':{
                                'title': '1.進水口結構：',
                                'b14011':{
                                    'title': '欄污柵：',
                                    'data': $('.b14011').val()
                                },
                                'b14012':{
                                    'title': '閘門設備：',
                                    'data': $('.b14012').val()
                                },
                                'b14013':{
                                    'title': '操作手冊：',
                                    'data': $('.b14013').val()
                                },
                            },
                            'b1402':{
                                'title': '2.壓力綱管：',
                                'data': $('.b1402').val(),
                            },
                            'b1403':{
                                'title': '3.發電廠結構：',
                                'data': $('.b1403').val(),
                            },
                            'b1404':{
                                'title': '4.尾水道：',
                                'data': $('.b1404').val(),
                            },
                            'b1405':{
                                'title': '5.備用電力設備：',
                                'data': $('.b1405').val(),
                            },
                            'b1406':{
                                'title': '※重要事項記述： ',
                                'data': $('.b1406').val(),
                            },
                        }
                    },
                    'b2': {
                        'title': '二、放水設施安全檢查',
                        'b21': {
                            'title': '（一）閘閥及機電設備',
                            'b2101':{
                                'title': '1.定期檢查：',
                                'data': $('.b2101').val(),
                                'b21011':{
                                    'title': '檢查紀錄',
                                    'data': $('.b21011').val(),
                                }
                            },
                            'b2102':{
                                'title': '2.動力來源:',
                                'data': $('.b2102').val(),
                            },
                            'b2103':{
                                'title': '3.維護:',
                                'data': $('.b2103').val(),
                                'b21031':{
                                    'title': '記錄：',
                                    'data': $('.b21031').val(),
                                }
                            },
                            'b2104':{
                                'title': '4.地震前後之檢查:',
                                'data': $('.b2104').val(),
                                'b21041':{
                                    'title': '記錄：',
                                    'data': $('.b21041').val(),
                                }
                            },
                            'b2105':{
                                'title': '5.河道放水口:',
                                'data': $('.b2105').val(),
                                'b21051':{
                                    'title': '維護：',
                                    'data': $('.b21051').val(),
                                },
                                'b21052':{
                                    'title': '記錄：',
                                    'data': $('.b21052').val(),
                                }
                            },
                            'b2106':{
                                'title': '6.閘閥之水密性:',
                                'data': $('.b2106').val(),
                            },
                            'b2107':{
                                'title': '7.閘閥開度指示器:',
                                'data': $('.b2107').val(),
                            },
                            'b2108':{
                                'title': '8.閘閥插板及吊放設備:',
                                'data': $('.b2108').val(),
                                'b21081':{
                                    'title': '維護：',
                                    'data': $('.b21081').val(),
                                },
                            },
                            'b2109':{
                                'title': '9.欄污柵:',
                                'data': $('.b2109').val(),
                                'b21091':{
                                    'title': '維護：',
                                    'data': $('.b21091').val(),
                                },
                            },
                            'b2110':{
                                'title': '7※重要事項記述：',
                                'data': $('.b2110').val(),
                            },
                        },
                        'b22':{
                            'title': '（二）警報系統及警告設施',
                            'b2201':{
                                'title': '1.警報系統動力來源：',
                                'data': $('.b2201').val(),
                            },
                            'b2202':{
                                'title': '2.使用狀況：',
                                'data': $('.b2202').val(),
                            },
                            'b2203':{
                                'title': '3.警報時與治安單位聯繫：時間：',
                                'data': $('.b2203').val(),
                                'b22031':{
                                    'title': '記錄：',
                                    'data': $('.b22031').val(),
                                },
                            },
                            'b2204':{
                                'title': '4.危險部分設置圍籬：',
                                'data': $('.b2204').val(),
                            },
                            'b2205':{
                                'title': '※重要事項記述：',
                                'data': $('.b2205').val(),
                            },
                        },
                        'b23':{
                            'title': '（三）通訊設備:',
                            'b2301':{
                                'title': '1.保養維護情況：',
                                'data': $('.b2301').val(),
                            },
                            'b2302':{
                                'title': '2.損壞時可否迅速保持暢通：',
                                'data': $('.b2302').val(),
                            },
                            'b2303':{
                                'title': '3.通訊故障時之緊急傳遞方法：',
                                'data': $('.b2303').val(),
                            },
                            'b2304':{
                                'title': '※重要事項記述：',
                                'data': $('.b2304').val(),
                            }
                        },
                        'b24':{
                            'title': '（四）照明設備: ',
                            'b2401':{
                                'title': '1.設備：',
                                'data': $('.b2401').val(),
                            },
                            'b2402':{
                                'title': '2.維護：',
                                'data': $('.b2402').val(),
                            },
                            'b2403':{
                                'title': '※重要事項記述：',
                                'data': $('.b2403').val(),
                            }
                        },
                        'b25':{
                            'title': '（五）管理人力配備及責任',
                            'b2501':{
                                'title': '1.配備：',
                                'data': $('.b2501').val(),
                            },
                            'b2502':{
                                'title': '2.專人駐守：',
                                'data': $('.b2502').val(),
                            },
                            'b2503':{
                                'title': '3.閘閥、機電設備維護操作專門人員：',
                                'data': $('.b2503').val(),
                            },
                            'b2504':{
                                'title': '4.值班人員及配置：',
                                'data': $('.b2504').val(),
                            },
                            'b2505':{
                                'title': '5.操作管理人員作業時間：',
                                'data': $('.b2505').val(),
                            },
                            'b2506':{
                                'title': '※重要事項記述：',
                                'data': $('.b2506').val(),
                            }
                        }
                    },
                    'b3':{
                        'title': '三、水庫周邊環境檢查',
                        'b31':{
                            'title': '1.邊坡性質：',
                            'data': $('.b31').val()
                        },
                        'b32':{
                            'title': '2.邊坡穩定性：',
                            'data': $('.b32').val()
                        },
                        'b33':{
                            'title': '3.崩塌情形：',
                            'data': $('.b33').val()
                        },
                        'b34':{
                            'title': '4.覆蓋情形：',
                            'data': $('.b34').val()
                        },
                        'b35':{
                            'title': '5.滲漏情形：',
                            'data': $('.b35').val()
                        },
                        'b36':{
                            'title': '※重要事項記述：',
                            'data': $('.b36').val()
                        }
                    },
                    'b4':{
                        'title': '四、其他',
                        'b41':{
                            'title': '1.緊急應變措施計畫：',
                            'data': $('.b41').val()
                        },
                        'b42':{
                            'title': '2.通達道路：',
                            'data': $('.b42').val()
                        },
                        'b43':{
                            'title': '※重要事項記述：',
                            'data': $('.b43').val()
                        },
                    },
                    'b5':{
                        'title': '五、綜合檢查結果',
                        'b51':{
                            'title': '1.水庫、水壩安全狀況：',
                            'data': $('.b51').val()
                        },
                        'b52':{
                            'title': '2.水庫、水壩災害風險程度：',
                            'data': $('.b52').val()
                        },
                        'b53':{
                            'title': '3.應行注意改善事項：' +
                                '（若屬緊急事項應予註明，並立即採取緊急應變措施）',
                            'data': $('.b53').val()
                        },
                        'b54':{
                            'title': '※注意事項：',
                            'data': $('.b54').val()
                        },
                    }
                },
            }

        }
    </script>
@endsection
<!-- ================== /inline-js ================== -->