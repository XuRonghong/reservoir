
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid-theme.min.css')}}" rel="stylesheet">
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.css')}}" rel="stylesheet">
    <style>
        .btn {
            margin-left: 20px;
        }
        select {
            width: 150px;
            margin-left: 20px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
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
                        </div>
                        <hr>
                        <form class="form-horizontal  trace_table">
                            <div class="card-body messageInfo-modal1  a">
                                <h4 class="card-title Title1">壹 、水庫基本資料</h4>
                                <div class="form-group row a1">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label title11">一、 概況</label>
                                    <div class="col-sm-9 a11">
                                        <div class="t1">水庫名稱：</div>
                                        <input type="text" name="a111" class="form-control a111 reservoir_name" id="com1" placeholder="" value="{{$reservoir_name or ''}}">
                                        <div class="t2">檢查日期：</div>
                                        <input type="date" name="a112" class="form-control a112" id="com1" placeholder="" value="">
                                        <div class="t3">管理機關：</div>
                                        <input type="text" name="a113" class="form-control a113" id="com1" placeholder="" value="">
                                        <div class="t4">檢查人員：</div>
                                        <input type="text" name="a114" class="form-control a114" id="com1" placeholder="" value="">
                                        <div class="t5">位置：</div>
                                        <input type="text" name="a115" class="form-control a115" id="com1" placeholder="" value="">
                                        <div class="t6">河系（主支流）：</div>
                                        <input type="text" name="a116" class="form-control a116" id="com1" placeholder="" value="">
                                    </div>
                                </div>
                                <div class="form-group row a2">
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label title12">二、檢查時操作狀況</label>
                                    <div class="col-sm-9 a21">
                                        水庫水位：
                                        <input type="text" name="a211" class="form-control " id="com1" placeholder="" value="">
                                        水庫蓄水量：
                                        <input type="date" name="a212" class="form-control " id="com1" placeholder="" value="">
                                        最高記錄水位：
                                        <input type="text" name="a213" class="form-control " id="com1" placeholder="" value="">
                                        <br>
                                        <h5>放水量：</h5>
                                        <div class="form-inline">
                                            <div>溢洪道<input type="text" name="a214" class="form-control " id="com1" placeholder="" value="">秒立方公尺<br></div>
                                            <div>出水工<input type="text" name="a215" class="form-control " id="com1" placeholder="" value="">秒立方公尺<br></div>
                                            <div>渠  道<input type="text" name="a216" class="form-control " id="com1" placeholder="" value="">秒立方公尺<br></div>
                                            <div>發電廠<input type="text" name="a217" class="form-control " id="com1" placeholder="" value="">秒立方公尺<br></div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row a3">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label title13">三、地質環境</label>
                                    <br>
                                    <div class="col-sm-9 a31">
                                        基岩性質：
                                        <input type="text" name="a311" class="form-control " id="com1" placeholder="" value="">
                                    </div>
                                    <br>
                                    <div class="col-sm-9 a32">
                                        <h6>基岩孔隙度：</h6>
                                        <input type="radio" id="com2" name="a322" value="1" />極小
                                        <input type="radio" id="com2" name="a322" value="2" />小
                                        <input type="radio" id="com2" name="a322" value="3" />中
                                        <input type="radio" id="com2" name="a322" value="4" />大
                                    </div>
                                    <br>
                                    <div class="col-sm-9 a33">
                                        <h6>基岩節理或劈理：</h6>
                                        <input type="radio" id="com3" name="a331" value="1" />發達
                                        <input type="radio" id="com3" name="a331" value="0" />不發達
                                    </div>
                                    <br>
                                    <div class="col-sm-9 a34">
                                        <h6>主壩與地層走向：</h6>
                                        <input type="radio" id="com4" name="a341" value="0" />平行
                                        <input type="radio" id="com4" name="a341" value="1" />小角度斜交
                                        <input type="radio" id="com4" name="a341" value="2" />大角度斜交
                                    </div>
                                    <br>
                                    <div class="col-sm-9 a35">
                                        <h6>地層傾斜與主壩關係：</h6>
                                        <input type="radio" id="com5" name="a351" value="up" />向上游傾斜
                                        <input type="radio" id="com5" name="a351" value="down" />向下游傾斜
                                    </div>
                                    <br>
                                    <div class="col-sm-9 a36">
                                        <h6>附近有無斷層通過：</h6>
                                        <input type="radio" id="com6" name="a361" value="0" />無
                                        <input type="radio" id="com6" name="a361" value="1" />有
                                        （
                                        <input type="radio" id="com6" name="a362" value="10" />活動斷層
                                        <input type="radio" id="com6" name="a362" value="11" />不活動斷層
                                        ）
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <hr>

                            <div class="card-body messageInfo-modal2  b">
                                <h4 class="card-title title1">貳、檢查內容</h4>
                                <div class="form-group row b1">
                                    <label for="com21" class="col-sm-3 text-right control-label col-form-label title11">一、結構物安全檢查</label>

                                    <div class="form-group row " style="margin-left: 80px">
                                        <h5>（一）壩體</h5>
                                        <div class="form-group row " style="padding-left: 20px">
                                            <div class="col-sm-9  b11">
                                                <b>1.上游坡面：</b>
                                                <select class="form-sel iHead" id="com21" name="b111">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.裂縫</option>
                                                    <option value="2" title="">2.沈陷</option>
                                                    <option value="3" title="">3.滑動</option>
                                                    <option value="4" title="">4.沖蝕溝</option>
                                                    <option value="5" title="">5.動物洞穴</option>
                                                    <option value="6" title="">6.植物生長</option>
                                                </select>
                                                <br>
                                                <div  style="padding-left: 20px;">
                                                    <b>坡面拋石保護或植物生長：</b>
                                                    <select class=" iHead" id="com22" name="b112">
                                                        <option value="11" title="">良好</option>
                                                        <option value="12" title="">待改善</option>
                                                    </select>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="col-sm-9  b12">
                                                <b>2.下游坡面：</b>
                                                <select class="form-sel iHead" id="com23" name="b121">
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
                                                <div  style="padding-left: 20px;">
                                                    <b>滲流情況或濕潤區域：</b>
                                                    <select class="form-sel iHead" id="com24" name="b122">
                                                        <option value="11" title="">正常</option>
                                                        <option value="12" title="">待改善</option>
                                                    </select>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="col-sm-9  b13">
                                                <b>3.壩座與壩基：</b>
                                                <select class="form-sel iHead" id="com25" name="b131">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.滲漏</option>
                                                    <option value="2" title="">2.裂縫</option>
                                                    <option value="3" title="">3.移動</option>
                                                    <option value="4" title="">4.壩基淘刷</option>
                                                </select>
                                                <br>
                                                <div  style="padding-left: 20px;">
                                                    <b>壩基排水情形：</b>
                                                    <select class="form-sel iHead" id="com26" name="b132">
                                                        <option value="11" title="">正常</option>
                                                        <option value="12" title="">待改善</option>
                                                        <option value="13" title="">其他</option>
                                                    </select>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="col-sm-9  b14">
                                                <b>4.壩頂：</b>
                                                <select class="form-sel iHead" id="com27" name="b141">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.龜裂</option>
                                                    <option value="2" title="">2.移動</option>
                                                    <option value="3" title="">3.沈陷</option>
                                                    <option value="4" title="">4.長樹</option>
                                                </select>
                                                <br>
                                                <div  style="padding-left: 20px;">
                                                    <b>欄杆及護網等安全措施：</b>
                                                    <input type="radio" id="com28" name="b142" value="1" />有
                                                    （
                                                    <input type="radio" id="com29" name="b143" value="11" />良好
                                                    <input type="radio" id="com29" name="b143" value="10" />待改善
                                                    ）
                                                    <input type="radio" id="com28" name="b142" value="0" />無
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="col-sm-9  b15">
                                                <b>5.出水高：</b>
                                                <select class="form-sel iHead" id="com30" name="b151">
                                                    <option value="1" title="">1.足夠</option>
                                                    <option value="2" title="">2.不足</option>
                                                    <option value="3" title="">3.待檢討</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b16">
                                                <b>6.觀測儀器及記錄：</b>
                                                <br>
                                                <div  style="padding-left: 20px;">
                                                    項目
                                                    <input type="text" name="b161" class=" vCheckMan" style="width: 40%" value="">
                                                    <input type="text" name="b1611" class=" vCheckMan" style="width: 30%" value="">處
                                                    <br>紀錄：
                                                    <input type="radio" id="com31" name="b1612" value="1" />有
                                                    <input type="radio" id="com31" name="b1612" value="0" />無
                                                    <br>

                                                    項目
                                                    <input type="text" name="b162" class=" vCheckMan" style="width: 40%" value="">
                                                    <input type="text" name="b1621" class=" vCheckMan" style="width: 30%" value="">處
                                                    <br>紀錄：
                                                    <input type="radio" id="com32" name="b1622" value="1" />有
                                                    <input type="radio" id="com32" name="b1622" value="0" />無
                                                    <br>

                                                    項目
                                                    <input type="text" name="b163" class=" vCheckMan" style="width: 40%" value="">
                                                    <input type="text" name="b1631" class=" vCheckMan" style="width: 30%" value="">處
                                                    <br>紀錄：
                                                    <input type="radio" id="com33" name="b1632" value="1" />有
                                                    <input type="radio" id="com33" name="b1632" value="0" />無
                                                    <br>

                                                    項目
                                                    <input type="text" name="b164" class=" vCheckMan" style="width: 40%" value="">
                                                    <input type="text" name="b1641" class=" vCheckMan" style="width: 30%" value="">處
                                                    <br>紀錄：
                                                    <input type="radio" id="com34" name="b1642" value="1" />有
                                                    <input type="radio" id="com34" name="b1642" value="0" />無
                                                    <br>

                                                    項目
                                                    <input type="text" name="b165" class=" vCheckMan" style="width: 40%" value="">
                                                    <input type="text" name="b1651" class=" vCheckMan" style="width: 30%" value="">處
                                                    <br>紀錄：
                                                    <input type="radio" id="com35" name="b1652" value="1" />有
                                                    <input type="radio" id="com35" name="b1652" value="0" />無
                                                    <br>

                                                    <b>建議加設之觀測儀器：</b>
                                                    <input type="text" name="b166" class=" vCheckMan" style="width: 40%" value="">
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="col-sm-9  b17">
                                            <b>7.廊道：</b>
                                            <select class="form-sel iHead" id="com40" name="b171">
                                                <option value="0" title="">完整</option>
                                                <option value="1" title="">裂縫</option>
                                                <option value="2" title="">移動</option>
                                                <option value="3" title="">表面剝落</option>
                                                <option value="4" title="">凹陷</option>
                                            </select>
                                            <br>
                                            <div  style="padding-left: 20px">
                                                <b>滲流及排水情形：</b>
                                                <select class="form-sel iHead" id="com41" name="b172">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>混凝土一般狀況：</b>
                                                <select class="form-sel iHead" id="com42" name="b173">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>通氣及照明設備：</b>
                                                <select class="form-sel iHead" id="com43" name="b174">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>金屬工：</b>
                                                <select class="form-sel iHead" id="com44" name="b175">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>※重要事項記述：</b>
                                                <input type="text" name="b176" class=" vCheckMan" style="width: 40%" value="">
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                        </div>

                                        <h5>（二）溢洪道</h5>
                                        <div class="form-group row " style="padding-left: 20px">
                                            <div class="col-sm-9  b21">
                                                <b>1.入口渠道：</b>
                                                <select class="form-sel iHead" id="com21" name="b211">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">植物生長</option>
                                                    <option value="2" title="">渠道滑動</option>
                                                    <option value="3" title="">漂流物</option>
                                                </select>
                                                <br>

                                                <b>邊坡保護：</b>
                                                <select class=" iHead" id="com21" name="b212">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>

                                                <b>2.溢洪道護坦：</b>
                                                <select class="form-sel iHead" id="com21" name="b213">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>

                                                <b>3.溢洪道頂：</b>
                                                <select class=" iHead" id="com21" name="b214">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>

                                                <b>4.溢洪道牆：</b>
                                                <select class=" iHead" id="com21" name="b215">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>

                                                <b>5.溢洪道底板：</b>
                                                <select class=" iHead" id="com21" name="b216">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>

                                                <b>6.附屬設備：</b>
                                                <select class=" iHead" id="com21" name="b217">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">破損待修</option>
                                                </select>
                                                <br>

                                                <b>7.下游放水路：</b>
                                                <select class=" iHead" id="com21" name="b218">
                                                    <option value="0" title="">暢通</option>
                                                    <option value="1" title="">被侵佔</option>
                                                    <option value="2" title="">高莖物</option>
                                                    <option value="3" title="">待疏浚</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">固定結構物阻流</option>
                                                </select>
                                                <br>

                                                <b>8.靜水池：</b>
                                                <select class=" iHead" id="com21" name="b219">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>

                                                <b>9.溢洪道底板：</b>
                                                <input type="radio" id="com21" name="b2110" value="0" />無
                                                <input type="radio" id="com21" name="b2111" value="1" />有
                                                （
                                                <input type="radio" id="com21" name="b2110" value="1" />完整
                                                <input type="radio" id="com21" name="b2110" value="2" />待修補
                                                ）
                                                <br>

                                                <b>10.設計洪水量：</b>
                                                <input type="radio" id="com21" name="b2112" value="1" />重新檢討
                                                <input type="radio" id="com21" name="b2112" value="0" />不需檢討
                                                <br>

                                                <b>11.排洪能力：</b>
                                                <input type="radio" id="com21" name="b2113" value="1" />足夠
                                                <input type="radio" id="com21" name="b2113" value="2" />不足
                                                <input type="radio" id="com21" name="b2113" value="3" />待檢討
                                                <br>

                                                <b>※重要事項記述：</b>
                                                <input type="text" name="b2114" class=" vCheckMan" style="width: 40%" value="">
                                                <br>
                                                <br>
                                                <br>
                                            </div>
                                        </div>

                                        <h5>（三）取水工及出水工</h5>
                                        <div class="form-group row " style="padding-left: 20px">
                                            <div class="col-sm-9  b22">
                                                <b>1.進水口結構：</b>
                                                <br>
                                                <b>攔污柵：</b>
                                                <input type="radio" id="com70" name="b221" value="0" />無
                                                <input type="radio" id="com70" name="b221" value="1" />待增設
                                                <input type="radio" id="com70" name="b221" value="2" />有
                                                （
                                                <input type="radio" id="com71" name="b222" value="1" />完整
                                                <input type="radio" id="com71" name="b222" value="2" />待修補
                                                <input type="radio" id="com71" name="b222" value="3" />漂流物待清除
                                                ）
                                                <br>

                                                <b>混凝土結構：</b>
                                                <select class=" iHead" id="com72" name="b223">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>

                                                <b>閘門結構物：</b>
                                                <select class=" iHead" id="com73" name="b224">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>

                                                <b>金屬工：</b>
                                                <select class=" iHead" id="com74" name="b225">
                                                    <option value="0" title="">完整</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>

                                                <br>
                                                <b>2.緊急控制設施：</b>
                                                <br>
                                                <input type="radio" id="com75" name="b226" value="1" />無
                                                <input type="radio" id="com75" name="b226" value="1" />有
                                                （
                                                <input type="radio" id="com76" name="b227" value="1" />完整
                                                <input type="radio" id="com76" name="b227" value="1" />待改善
                                                ）
                                                <br>

                                                <b>3.出水管道：</b>
                                                <br>
                                                <b>金屬工：</b>
                                                <select class=" iHead" id="com77" name="b228">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>

                                                <b>混凝土工：</b>
                                                <select class=" iHead" id="com78" name="b229">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>

                                                <b>4.操作設備：</b>
                                                <select class="form-sel iHead" id="com80" name="b2210">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>

                                                <b>閘門室：</b>
                                                <select class="form-sel iHead" id="com81" name="b2211">
                                                    <option value="11" title="">良好</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>

                                                <b>閘門：</b>
                                                <select class="form-sel iHead" id="com82" name="b2212">
                                                    <option value="11" title="">良好</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>

                                                <b>閥門：</b>
                                                <select class="form-sel iHead" id="com83" name="b2213">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>

                                                <b>控制系統：</b>
                                                <select class="form-sel iHead" id="com84" name="b2214">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                    <option value="12" title="">其他</option>
                                                </select>
                                                <br>

                                                <br>
                                                <b>5.靜水池：</b>
                                                <select class="form-sel iHead" id="com85" name="b2215">
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
                                                <select class="form-sel iHead" id="com86" name="b2216">
                                                    <option value="11" title="">良好</option>
                                                    <option value="3" title="">植物生長</option>
                                                    <option value="1" title="">邊坡不穩定</option>
                                                    <option value="2" title="">護岸待修</option>
                                                </select>
                                                <br>

                                                <br>
                                                <b>※重要事項記述：</b>
                                                <input type="text" name="b2217" class=" vCheckMan" style="width: 40%" value="">
                                                <br>
                                                <br>
                                                <br>
                                            </div>
                                        </div>

                                        <h5>（四）發電設備</h5>
                                        <div class="form-group row " style="padding-left: 20px">
                                            <div class="col-sm-9  b23">
                                            <b>1.進水口結構：</b><br>
                                            <b>攔污柵：</b>
                                            <input type="radio" id="com3" name="b231" value="0" />無
                                            <input type="radio" id="com3" name="b231" value="1" />待增設
                                            <input type="radio" id="com3" name="b231" value="2" />有
                                            （
                                            <input type="radio" id="com3" name="b232" value="1" />完整
                                            <input type="radio" id="com3" name="b232" value="2" />待修補
                                            ）
                                            <br>

                                            <b>閘門設備：</b>
                                            <select class=" iHead" id="com2" name="b233">
                                                <option value="1" title="">良好</option>
                                                <option value="2" title="">待修補</option>
                                                <option value="3" title="">需維護</option>
                                            </select>
                                            <br>

                                            <b>操作手冊：</b>
                                            <input type="radio" id="com3" name="b234" value="0" />無
                                            <input type="radio" id="com3" name="b234" value="1" />待增補
                                            <input type="radio" id="com3" name="b234" value="2" />有
                                            <br>

                                            <b>2.壓力綱管：</b><br>
                                            <select class=" iHead" id="com2" name="b235">
                                                <option value="1" title="">良好</option>
                                                <option value="2" title="">移動</option>
                                                <option value="3" title="">裂縫</option>
                                                <option value="4" title="">穴蝕</option>
                                            </select>
                                            <br>

                                            <b>3.發電廠結構：</b><br>
                                            <select class=" iHead" id="com2" name="b236">
                                                <option value="1" title="">良好</option>
                                                <option value="2" title="">待修</option>
                                            </select>
                                            <br>

                                            <b>4.尾水道：</b><br>
                                            <select class=" iHead" id="com2" name="b237">
                                                <option value="1" title="">良好</option>
                                                <option value="2" title="">待修</option>
                                            </select>
                                            <br>

                                            <b>5.備用電力設備：</b><br>
                                            <input type="radio" id="com3" name="b238" value="0" />無
                                            <input type="radio" id="com3" name="b238" value="1" />有
                                            （
                                            <input type="radio" id="com3" name="b239" value="1" />良好
                                            <input type="radio" id="com3" name="b239" value="2" />待修
                                            ）
                                            <br>

                                            <br>
                                            <b>※重要事項記述：</b>
                                            <input type="text" name="b2310" class=" vCheckMan" style="width: 40%" value="">
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row b3">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label title23">二、放水設施安全檢查</label>

                                    <div class="form-group row " style="margin-left: 80px">
                                        <h5>（一）閘閥及機電設備</h5>
                                        <div class="col-sm-9  b31">
                                            <b>1.檢查：</b>
                                            <input type="radio" id="com3" name="b311" value="1" />有
                                            <input type="radio" id="com3" name="b312" value="0" />無
                                            <br>
                                            <b>定期檢查：</b>
                                            <input type="radio" id="com3" name="b312" value="1" />有
                                            <input type="radio" id="com3" name="b312" value="0" />無
                                            <br>
                                            <b>檢查記錄：</b>
                                            <input type="radio" id="com3" name="b313" value="1" />有
                                            <input type="radio" id="com3" name="b313" value="0" />無
                                            <input type="radio" id="com3" name="b313" value="2" />不全
                                            <br>
                                            <br>
                                            <b>2.動力來源：</b>
                                            <input type="radio" id="com3" name="b313" value="1" />台電
                                            <input type="radio" id="com3" name="b313" value="2" />自備電源
                                            <input type="radio" id="com3" name="b313" value="3" />人力
                                            <br>
                                            <br>
                                            <b>3.維護：</b><br>
                                            <select class=" iHead" id="com2" name="b314">
                                                <option value="1" title="">良好</option>
                                                <option value="2" title="">尚可</option>
                                                <option value="3" title="">待加強</option>
                                            </select>
                                            <br>
                                            <b>記錄：</b>
                                            <input type="radio" id="com3" name="b315" value="2" />有
                                            <input type="radio" id="com3" name="b315" value="1" />無
                                            <input type="radio" id="com3" name="b315" value="0" />不全
                                            <br>
                                            <br>
                                            <b>4.暴雨前後之檢查：</b><br>
                                            <input type="radio" id="com3" name="b316" value="1" />有
                                            <input type="radio" id="com3" name="b316" value="1" />無
                                            <br>，紀錄
                                            <input type="radio" id="com3" name="b317" value="1" />有
                                            <input type="radio" id="com3" name="b317" value="1" />無
                                            <input type="radio" id="com3" name="b317" value="1" />不全
                                            <br>
                                            <br>
                                            <b>5.地震前後之檢查：</b><br>
                                            <input type="radio" id="com3" name="b318" value="1" />無
                                            <input type="radio" id="com3" name="b318" value="1" />有
                                            <br>，紀錄
                                            <input type="radio" id="com3" name="b319" value="1" />有
                                            <input type="radio" id="com3" name="b319" value="1" />無
                                            <input type="radio" id="com3" name="b319" value="1" />不全
                                            <br>
                                            <br>

                                            <br>
                                            <b>6.啟用年份：</b>
                                            <input type="text" name="b3110" class=" vCheckMan" style="width: 20%" value="">年啟用
                                            <br>
                                            <input type="text" id="com3" name="b3111" value="" />已逾齡
                                            <input type="radio" id="com3" name="b3111" value="0" />未逾齡
                                            <br>

                                            <b>7.河道放水口：</b>
                                            <input type="radio" id="com3" name="b3112" value="1" />有
                                            <input type="radio" id="com3" name="b3112" value="0" />無
                                            <br>

                                            <b>維護：</b>
                                            <input type="radio" id="com3" name="b3113" value="2" />有
                                            <input type="radio" id="com3" name="b3113" value="1" />無
                                            <input type="radio" id="com3" name="b3113" value="0" />待加強
                                            <br>

                                            <b>記錄：</b>
                                            <input type="radio" id="com3" name="b3114" value="2" />有
                                            <input type="radio" id="com3" name="b3114" value="1" />無
                                            <input type="radio" id="com3" name="b3114" value="0" />不全
                                            <br>

                                            <b>8.定期操作試驗：</b>
                                            <input type="radio" id="com3" name="b3115" value="1" />有
                                            <input type="radio" id="com3" name="b3115" value="0" />無
                                            <br>，紀錄
                                            <input type="radio" id="com3" name="b3116" value="2" />有
                                            <input type="radio" id="com3" name="b3116" value="1" />無
                                            <input type="radio" id="com3" name="b3116" value="0" />不全
                                            <br>
                                            <br>

                                            <b>9.其它放水設施：</b>
                                            <input type="radio" id="com3" name="b3117" value="1" />有
                                            <input type="radio" id="com3" name="b3117" value="0" />無
                                            <br>

                                            名稱：<input type="text" name="b3118" class=" vCheckMan" style="width: 20%" value="">
                                            <br>
                                            <b>維護：</b>
                                            <select class=" iHead" id="com2" name="b3119">
                                                <option value="1" title="">良好</option>
                                                <option value="2" title="">尚可</option>
                                                <option value="3" title="">待加強</option>
                                            </select>
                                            <br>
                                            紀錄
                                            <input type="radio" id="com3" name="b3120" value="2" />有
                                            <input type="radio" id="com3" name="b3120" value="1" />無
                                            <input type="radio" id="com3" name="b3120" value="0" />不全
                                            <br>
                                            <b>10.閘閥之水密性：</b>
                                            <input type="radio" id="com3" name="b3121" value="1" />良好
                                            <input type="radio" id="com3" name="b3121" value="2" />漏水待改善
                                            <br>
                                            <b>11.閘閥開度指示器：</b>
                                            <input type="radio" id="com3" name="b3122" value="1" />位置正確
                                            <input type="radio" id="com3" name="b3122" value="2" />偏差待訂正
                                            <br>
                                            <b>12.閘閥插板及吊放設備：</b>
                                            <input type="radio" id="com3" name="b3123" value="1" />有
                                            <input type="radio" id="com3" name="b3123" value="0" />無
                                            <br>
                                            <b>維護：</b>
                                            <input type="radio" id="com3" name="b3124" value="1" />良好
                                            <input type="radio" id="com3" name="b3124" value="0" />待改善
                                            <br>
                                            <br>
                                            <b>13.欄污柵：</b>
                                            <input type="radio" id="com3" name="b3125" value="1" />有
                                            <input type="radio" id="com3" name="b3125" value="0" />無
                                            <br>
                                            <b>維護：</b>
                                            <input type="radio" id="com3" name="b3126" value="1" />良好
                                            <input type="radio" id="com3" name="b3126" value="0" />待改善
                                            <br>
                                            <br>
                                            <b>※重要事項記述：</b>
                                            <input type="text" name="b3127" class=" vCheckMan" style="width: 40%" value="">
                                            <br>
                                            <br>
                                            <br>
                                        </div>

                                        <h5>（二）閘閥操作</h5>
                                        <div class="col-sm-9  b32">
                                        <b>1.設置地點與外界隔絕：</b>
                                        <input type="radio" id="com3" name="b321" value="1" />是
                                        <input type="radio" id="com3" name="b321" value="2" />外人可靠近
                                        <br>
                                        <b>2.操作規則：</b>
                                        <input type="radio" id="com3" name="b322" value="2" />有
                                        <input type="radio" id="com3" name="b322" value="1" />待訂
                                        <input type="radio" id="com3" name="b322" value="0" />待修正
                                        <br>
                                        <b>3.水門啟閉之標準：</b>
                                        <input type="radio" id="com3" name="b323" value="2" />己辦
                                        <input type="radio" id="com3" name="b323" value="1" />辦理中
                                        <input type="radio" id="com3" name="b323" value="0" />待辦
                                        <br>
                                        <br>
                                        <br>
                                        <b>※重要事項記述：</b>
                                        <input type="text" name="b324" class=" vCheckMan" style="width: 40%" value="">
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if(isset($info->iCheck_message))
                                        @if( $info->iCheck_message < session('member.iAcType') && session('member.iAcType')>9 && session('member.iAcType')<80)
                                        <div style="float: left">
                                            <button type="button" class="btn btn-success waves-effect waves-light btn-check" data-id="{{$info->iId or ''}}">
                                                Check & Send
                                            </button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light btn-refuse" data-id="{{$info->iId or ''}}">
                                                Refuse
                                            </button>
                                        </div>
                                        @endif
                                    @endif
                                    <button type="button" class="btn btn-dark waves-effect waves-light btn-back">Back</button>
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
    <script>
        var current_data = [];
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        $(document).ready(function () {
            //
            $(".btn-back").click(function () {
                history.back()
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
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                })
            });
            //
            $(".btn-refuse").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = $(this).data('id');
                data.refuse = true;
                $.ajax({
                    url: url_dosave,
                    type: 'POST',
                    data: data,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}");
                            //button hide
                            $(".btn-check").hide();
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                })
            });

            /************************************************
            *  JQuery serializeArray decode :
             */
                dd = {!! $info->vDetail !!};
                $.each(dd, function(i, field){
                    $("[name='"+field.name+"']").val(field.value);
                });
            /*
             ***********************************************/
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
