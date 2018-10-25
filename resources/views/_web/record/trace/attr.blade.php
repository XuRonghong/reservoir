
@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid-theme.min.css')}}" rel="stylesheet">
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.css')}}" rel="stylesheet">
    {{----}}
    <link href="{{url('css/trace_table01.css')}}" rel="stylesheet">
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
                                <div class="form-group row  a1">
                                    <label for="com1" class="col-sm-3 text-left control-label col-form-label">一、 概況</label>
                                    <div class="col-sm-9  a11">
                                        <br>
                                        <div class="t1">水庫名稱：</div>
                                        <input disabled type="text" name="a111" class="form-control a111 reservoir_name" id="com1" placeholder="" value="{{$reservoir_name or ''}}">
                                        <div class="t2">檢查日期：</div>
                                        <input disabled type="date" name="a112" class="form-control a112" id="com1" placeholder="" value="">
                                        <div class="t3">管理機關：</div>
                                        <input disabled type="text" name="a113" class="form-control a113" id="com1" placeholder="" value="">
                                        <div class="t4">檢查人員：</div>
                                        <input disabled type="text" name="a114" class="form-control a114" id="com1" placeholder="" value="">
                                        <div class="t5">位置：</div>
                                        <input disabled type="text" name="a115" class="form-control a115" id="com1" placeholder="" value="">
                                        <div class="t6">河系（主支流）：</div>
                                        <input disabled type="text" name="a116" class="form-control a116" id="com1" placeholder="" value="">
                                        <br>
                                    </div>
                                    {{--</div>--}}
                                    {{--<div class="form-group row  a2">--}}
                                    <label for="com2" class="col-sm-3 text-left control-label col-form-label">二、檢查時操作狀況</label>
                                    <div class="col-sm-9  a21">
                                        <br>
                                        水庫水位：
                                        <input disabled type="text" name="a211" class="form-control " id="com2" placeholder="" value="">
                                        水庫蓄水量：
                                        <input disabled type="date" name="a212" class="form-control " id="com2" placeholder="" value="">
                                        最高記錄水位：
                                        <input disabled type="text" name="a213" class="form-control " id="com2" placeholder="" value="">
                                        <br>
                                        <h5>放水量：</h5>
                                        <div class="form-inline">
                                            <div>溢洪道<input disabled type="text" name="a214" class="form-control " id="com2" placeholder="" value="">秒立方公尺<br></div>
                                            <div>出水工<input disabled type="text" name="a215" class="form-control " id="com2" placeholder="" value="">秒立方公尺<br></div>
                                            <div>渠  道<input disabled type="text" name="a216" class="form-control " id="com2" placeholder="" value="">秒立方公尺<br></div>
                                            <div>發電廠<input disabled type="text" name="a217" class="form-control " id="com2" placeholder="" value="">秒立方公尺<br></div>
                                        </div>
                                        <br>
                                    </div>
                                    {{--</div>--}}
                                    {{--<div class="form-group row  a3">--}}
                                    <label for="com3" class="col-sm-3 text-left control-label col-form-label title13">三、地質環境</label>
                                    <div class="col-sm-9">
                                        <br>
                                        <div class="a31">
                                            基岩性質：
                                            <input disabled type="text" name="a311" class="form-control " id="com3" placeholder="" value="">
                                        </div>
                                        <div class="a32">
                                            基岩孔隙度：
                                            <input disabled type="radio" id="com3" name="a322" value="1" />極小
                                            <input disabled type="radio" id="com3" name="a322" value="2" />小
                                            <input disabled type="radio" id="com3" name="a322" value="3" />中
                                            <input disabled type="radio" id="com3" name="a322" value="4" />大
                                        </div>
                                        <br>
                                        <div class="a33">
                                            基岩節理或劈理：
                                            <input disabled type="radio" id="com3" name="a331" value="1" />發達
                                            <input disabled type="radio" id="com3" name="a331" value="0" />不發達
                                        </div>
                                        <br>
                                        <div class="a34">
                                            主壩與地層走向：
                                            <input disabled type="radio" id="com3" name="a341" value="0" />平行
                                            <input disabled type="radio" id="com3" name="a341" value="1" />小角度斜交
                                            <input disabled type="radio" id="com3" name="a341" value="2" />大角度斜交
                                        </div>
                                        <br>
                                        <div class="a35">
                                            地層傾斜與主壩關係：
                                            <input disabled type="radio" id="com3" name="a351" value="up" />向上游傾斜
                                            <input disabled type="radio" id="com3" name="a351" value="down" />向下游傾斜
                                        </div>
                                        <br>
                                        <div class="a36">
                                            附近有無斷層通過：
                                            <input disabled type="radio" id="com3" name="a361" value="0" />無
                                            <input disabled type="radio" id="com3" name="a361" value="1" />有
                                            （
                                            <input disabled type="radio" id="com3" name="a362" value="10" />活動斷層
                                            <input disabled type="radio" id="com3" name="a362" value="11" />不活動斷層
                                            ）
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="card-body messageInfo-modal2  b">
                                <h4 class="card-title Title2">貳、檢查內容</h4>
                                <div class="form-group row  b1">
                                    <label for="com4" class="col-sm-3 text-left control-label col-form-label">一、結構物安全檢查</label>
                                    <div class="form-group row" id="com4">
                                        <label for="com41" class="col-sm-3 text-left control-label col-form-label">（一）壩體</label>
                                        <div id="com41" class="form-group row b11">
                                            <br>
                                            <div class="col-sm-9">
                                                <b>上游坡面：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b111">
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
                                                <select disabled id="com41" class=" iHead" name="b112">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b12">
                                                <b>下游坡面：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b121">
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
                                                <select disabled id="com41" class="form-sel iHead" name="b122">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b13">
                                                <b>壩座與壩基：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b131">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.滲漏</option>
                                                    <option value="2" title="">2.裂縫</option>
                                                    <option value="3" title="">3.移動</option>
                                                    <option value="4" title="">4.壩基淘刷</option>
                                                </select>
                                                <br>
                                                <b>壩基排水情形：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b132">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                    <option value="13" title="">其他</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b14">
                                                <b>壩頂：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b141">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.龜裂</option>
                                                    <option value="2" title="">2.移動</option>
                                                    <option value="3" title="">3.沈陷</option>
                                                    <option value="4" title="">4.長樹</option>
                                                </select>
                                                <br>
                                                <b>欄杆及護網等安全措施：</b>
                                                <br>
                                                <input disabled type="radio" id="com41" name="b142" value="1" />有
                                                （
                                                <input disabled type="radio" id="com41" name="b143" value="11" />良好
                                                <input disabled type="radio" id="com41" name="b143" value="10" />待改善
                                                ）
                                                <input disabled type="radio" id="com41" name="b142" value="0" />無
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b15">
                                                <b>出水高：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b151">
                                                    <option value="1" title="">1.足夠</option>
                                                    <option value="2" title="">2.不足</option>
                                                    <option value="3" title="">3.待檢討</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b16">
                                                <b>觀測儀器及記錄：</b>

                                                <br>
                                                項目
                                                <input disabled type="text" name="b161" class=" vCheckMan" style="width: 40%" value="" id="com41">
                                                <input disabled type="text" name="b1611" class=" vCheckMan" style="width: 30%" value="" id="com41">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com41" name="b1612" value="1" />有
                                                <input disabled type="radio" id="com41" name="b1612" value="0" />無
                                                <br>

                                                項目
                                                <input disabled type="text" name="b162" class=" vCheckMan" style="width: 40%" value="" id="com41">
                                                <input disabled type="text" name="b1621" class=" vCheckMan" style="width: 30%" value="" id="com41">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com41" name="b1622" value="1" />有
                                                <input disabled type="radio" id="com41" name="b1622" value="0" />無
                                                <br>

                                                項目
                                                <input disabled type="text" name="b163" class=" vCheckMan" style="width: 40%" value="" id="com41">
                                                <input disabled type="text" name="b1631" class=" vCheckMan" style="width: 30%" value="" id="com41">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com41" name="b1632" value="1" />有
                                                <input disabled type="radio" id="com41" name="b1632" value="0" />無
                                                <br>

                                                項目
                                                <input disabled type="text" name="b164" class=" vCheckMan" style="width: 40%" value="" id="com41" >
                                                <input disabled type="text" name="b1641" class=" vCheckMan" style="width: 30%" value="" id="com41" >處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com41" name="b1642" value="1" />有
                                                <input disabled type="radio" id="com41" name="b1642" value="0" />無
                                                <br>

                                                項目
                                                <input disabled type="text" name="b165" class=" vCheckMan" style="width: 40%" value="" id="com41" >
                                                <input disabled type="text" name="b1651" class=" vCheckMan" style="width: 30%" value="" id="com41" >處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com41" name="b1652" value="1" />有
                                                <input disabled type="radio" id="com41" name="b1652" value="0" />無
                                                <br>

                                                <b>建議加設之觀測儀器：</b>
                                                <input disabled type="text" name="b166" class="vCheckMan" style="width: 40%" value="" id="com41" >
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b17">
                                                <b>廊道：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b171">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">裂縫</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">表面剝落</option>
                                                    <option value="4" title="">凹陷</option>
                                                </select>
                                                <br>
                                                <b>滲流及排水情形：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b172">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>混凝土一般狀況：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b173">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>通氣及照明設備：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b174">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>金屬工：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b175">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b176" class=" vCheckMan" style="width: 100%" value="" id="com41" >
                                            </div>
                                        </div>

                                        <label for="com42" class="col-sm-3 text-left control-label col-form-label">（二）溢洪道</label>
                                        <div id="com42" class="form-group row b21">
                                            <br>
                                            <div class="col-sm-9">
                                                <b>入口渠道：</b>
                                                <select disabled class="form-sel iHead" id="com42" name="b211">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">植物生長</option>
                                                    <option value="2" title="">渠道滑動</option>
                                                    <option value="3" title="">漂流物</option>
                                                </select>
                                                <br>邊坡保護：
                                                <select disabled class=" iHead" id="com42" name="b212">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>溢洪道護坦：</b>
                                                <select disabled class="form-sel iHead" id="com42" name="b213">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>溢洪道頂：</b>
                                                <select disabled class=" iHead" id="com42" name="b214">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>溢洪道牆：</b>
                                                <select disabled class=" iHead" id="com42" name="b215">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>溢洪道底板：</b>
                                                <select disabled class=" iHead" id="com42" name="b216">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>附屬設備：</b>
                                                <select disabled class=" iHead" id="com42" name="b217">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">破損待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>下游放水路：</b>
                                                <select disabled class=" iHead" id="com42" name="b218">
                                                    <option value="0" title="">暢通</option>
                                                    <option value="1" title="">被侵佔</option>
                                                    <option value="2" title="">高莖物</option>
                                                    <option value="3" title="">待疏浚</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">固定結構物阻流</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>靜水池：</b>
                                                <select disabled class=" iHead" id="com42" name="b219">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>溢洪道底板：</b>
                                                <input disabled type="radio" id="com42" name="b2110" value="0" />無
                                                <input disabled type="radio" id="com42" name="b2111" value="1" />有
                                                （
                                                <input disabled type="radio" id="com42" name="b2110" value="1" />完整
                                                <input disabled type="radio" id="com42" name="b2110" value="2" />待修補
                                                ）
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>設計洪水量：</b>
                                                <input disabled type="radio" id="com42" name="b2112" value="1" />重新檢討
                                                <input disabled type="radio" id="com42" name="b2112" value="0" />不需檢討
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>排洪能力：</b>
                                                <input disabled type="radio" id="com42" name="b2113" value="1" />足夠
                                                <input disabled type="radio" id="com42" name="b2113" value="2" />不足
                                                <input disabled type="radio" id="com42" name="b2113" value="3" />待檢討
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b2114" class=" vCheckMan" style="width: 100%" value="" id="com42">
                                            </div>
                                        </div>

                                        <label for="com43" class="col-sm-3 text-left control-label col-form-label">（三）取水工及出水工</label>
                                        <div id="com43" class="form-group row b22">
                                            <br>
                                            <div class="col-sm-9">
                                                <b>進水口結構：</b>
                                                <br>
                                                攔污柵：
                                                <input disabled type="radio" id="com43" name="b221" value="0" />無
                                                <input disabled type="radio" id="com43" name="b221" value="1" />待增設
                                                <input disabled type="radio" id="com43" name="b221" value="2" />有
                                                （
                                                <input disabled type="radio" id="com43" name="b222" value="1" />完整
                                                <input disabled type="radio" id="com43" name="b222" value="2" />待修補
                                                <input disabled type="radio" id="com43" name="b222" value="3" />漂流物待清除
                                                ）
                                                <br>
                                                混凝土結構：
                                                <select disabled id="com43" class="iHead" name="b223">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>
                                                閘門結構物：
                                                <select disabled id="com43" class=" iHead" name="b224">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                                金屬工：
                                                <select disabled id="com43" class=" iHead" name="b225">
                                                    <option value="0" title="">完整</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>緊急控制設施：</b>
                                                <br>
                                                <input disabled type="radio" id="com43" name="b226" value="1" />無
                                                <input disabled type="radio" id="com43" name="b226" value="1" />有
                                                （
                                                <input disabled type="radio" id="com43" name="b227" value="1" />完整
                                                <input disabled type="radio" id="com43" name="b227" value="1" />待改善
                                                ）
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>出水管道：</b>
                                                <br>
                                                金屬工：
                                                <select disabled id="com43" class=" iHead" name="b228">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                                混凝土工：
                                                <select disabled id="com43" class=" iHead" name="b229">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>操作設備：</b>
                                                <select disabled id="com43" class="form-sel iHead" name="b2210">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                閘門室：
                                                <select disabled id="com43" class="form-sel iHead" name="b2211">
                                                    <option value="11" title="">良好</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                閘門：
                                                <select disabled id="com43" class="form-sel iHead" name="b2212">
                                                    <option value="11" title="">良好</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                閥門：
                                                <select disabled id="com43" class="form-sel iHead" name="b2213">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                控制系統：
                                                <select disabled id="com43" class="form-sel iHead" name="b2214">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                    <option value="12" title="">其他</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>靜水池：</b>
                                                <select disabled id="com43" class="form-sel iHead" name="b2215">
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
                                            </div>
                                            <div class="col-sm-9">
                                                <b>出水渠道：</b>
                                                <select disabled id="com43" class="form-sel iHead" name="b2216">
                                                    <option value="11" title="">良好</option>
                                                    <option value="3" title="">植物生長</option>
                                                    <option value="1" title="">邊坡不穩定</option>
                                                    <option value="2" title="">護岸待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b2217" class=" vCheckMan" style="width: 100%" value="" id="com43">
                                                <br>
                                            </div>
                                        </div>

                                        <label for="com44" class="col-sm-3 text-left control-label col-form-label">（四）發電設備</label>
                                        <div id="com44" class="form-group row  b23">
                                            <div class="col-sm-9">
                                                <b>進水口結構：</b>
                                                <br>
                                                攔污柵：
                                                <input disabled type="radio" id="com44" name="b231" value="0" />無
                                                <input disabled type="radio" id="com44" name="b231" value="1" />待增設
                                                <input disabled type="radio" id="com44" name="b231" value="2" />有
                                                （
                                                <input disabled type="radio" id="com44" name="b232" value="1" />完整
                                                <input disabled type="radio" id="com44" name="b232" value="2" />待修補
                                                ）
                                                <br>
                                                閘門設備：
                                                <select disabled class=" iHead" id="com44" name="b233">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">待修補</option>
                                                    <option value="3" title="">需維護</option>
                                                </select>
                                                <br>
                                                操作手冊：
                                                <input disabled type="radio" id="com44" name="b234" value="0" />無
                                                <input disabled type="radio" id="com44" name="b234" value="1" />待增補
                                                <input disabled type="radio" id="com44" name="b234" value="2" />有
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>壓力綱管：</b>
                                                <br>
                                                <select disabled class=" iHead" id="com44" name="b235">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">裂縫</option>
                                                    <option value="4" title="">穴蝕</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>發電廠結構：</b>
                                                <br>
                                                <select disabled class=" iHead" id="com44" name="b236">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>尾水道：</b>
                                                <br>
                                                <select disabled class=" iHead" id="com44" name="b237">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>備用電力設備：</b>
                                                <br>
                                                <input disabled type="radio" id="com44" name="b238" value="0" />無
                                                <input disabled type="radio" id="com44" name="b238" value="1" />有
                                                （
                                                <input disabled type="radio" id="com44" name="b239" value="1" />良好
                                                <input disabled type="radio" id="com44" name="b239" value="2" />待修
                                                ）
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b2310" class=" vCheckMan" style="width: 100%" value="" id="com44">
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row  b3">
                                    <label for="com5" class="col-sm-3 text-left control-label col-form-label">二、放水設施安全檢查</label>
                                    <div class="form-group row" id="com5">
                                        <label for="com51" class="col-sm-3 text-left control-label col-form-label">（一）壩體</label>
                                        <div class="form-group row bbb" id="com51">
                                            <div class="col-sm-9  b11">
                                                <b>上游坡面：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b111">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.裂縫</option>
                                                    <option value="2" title="">2.沈陷</option>
                                                    <option value="3" title="">3.滑動</option>
                                                    <option value="4" title="">4.沖蝕溝</option>
                                                    <option value="5" title="">5.動物洞穴</option>
                                                    <option value="6" title="">6.植物生長</option>
                                                </select>
                                                <br>
                                                坡面拋石保護或植物生長：
                                                <select disabled id="com51" class=" iHead" name="b112">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b12">
                                                <b>下游坡面：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b121">
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
                                                滲流情況或濕潤區域：
                                                <select disabled id="com51" class="form-sel iHead" name="b122">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b13">
                                                <b>壩座與壩基：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b131">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.滲漏</option>
                                                    <option value="2" title="">2.裂縫</option>
                                                    <option value="3" title="">3.移動</option>
                                                    <option value="4" title="">4.壩基淘刷</option>
                                                </select>
                                                <br>
                                                壩基排水情形：
                                                <select disabled id="com51" class="form-sel iHead" name="b132">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                    <option value="13" title="">其他</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b14">
                                                <b>壩頂：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b141">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.龜裂</option>
                                                    <option value="2" title="">2.移動</option>
                                                    <option value="3" title="">3.沈陷</option>
                                                    <option value="4" title="">4.長樹</option>
                                                </select>
                                                <br>
                                                欄杆及護網等安全措施：
                                                <input disabled type="radio" id="com51" name="b142" value="1" />有
                                                （
                                                <input disabled type="radio" id="com51" name="b143" value="11" />良好
                                                <input disabled type="radio" id="com51" name="b143" value="10" />待改善
                                                ）
                                                <input disabled type="radio" id="com51" name="b142" value="0" />無
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b15">
                                                <b>出水高：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b151">
                                                    <option value="1" title="">1.足夠</option>
                                                    <option value="2" title="">2.不足</option>
                                                    <option value="3" title="">3.待檢討</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b16">
                                                <b>觀測儀器及記錄：</b>
                                                <br>
                                                項目
                                                <input disabled type="text" name="b161" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input disabled type="text" name="b1611" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com51" name="b1612" value="1" />有
                                                <input disabled type="radio" id="com51" name="b1612" value="0" />無
                                                <br>
                                                項目
                                                <input disabled type="text" name="b162" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input disabled type="text" name="b1621" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com51" name="b1622" value="1" />有
                                                <input disabled type="radio" id="com51" name="b1622" value="0" />無
                                                <br>
                                                項目
                                                <input disabled type="text" name="b163" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input disabled type="text" name="b1631" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com51" name="b1632" value="1" />有
                                                <input disabled type="radio" id="com51" name="b1632" value="0" />無
                                                <br>
                                                項目
                                                <input disabled type="text" name="b164" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input disabled type="text" name="b1641" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com51" name="b1642" value="1" />有
                                                <input disabled type="radio" id="com51" name="b1642" value="0" />無
                                                <br>
                                                項目
                                                <input disabled type="text" name="b165" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input disabled type="text" name="b1651" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com51" name="b1652" value="1" />有
                                                <input disabled type="radio" id="com51" name="b1652" value="0" />無
                                                <br>
                                                <b>建議加設之觀測儀器：</b>
                                                <input disabled type="text" name="b166" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b17">
                                                <b>廊道：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b171">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">裂縫</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">表面剝落</option>
                                                    <option value="4" title="">凹陷</option>
                                                </select>
                                                <br>
                                                滲流及排水情形：
                                                <select disabled id="com51" class="form-sel iHead" name="b172">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                混凝土一般狀況：
                                                <select disabled id="com51" class="form-sel iHead" name="b173">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                通氣及照明設備：
                                                <select disabled id="com51" class="form-sel iHead" name="b174">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                金屬工：
                                                <select disabled id="com51" class="form-sel iHead" name="b175">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b176" class=" vCheckMan" style="width: 100%" value="" id="com51" >
                                                <br>
                                            </div>
                                        </div>
                                        {{--</div>--}}
                                        {{--<div class="form-group row" id="com5">--}}
                                        <label for="com61" class="col-sm-3 text-left control-label col-form-label">（二）閘閥及機電設備</label>
                                        <div class="form-group row  b31">
                                            <br>
                                            <div class="col-sm-9">
                                                <b>檢查：</b>
                                                <input disabled type="radio" id="com61" name="b311" value="1" />有
                                                <input disabled type="radio" id="com61" name="b312" value="0" />無
                                                <br>
                                                <b>定期檢查：</b>
                                                <input disabled type="radio" id="com61" name="b312" value="1" />有
                                                <input disabled type="radio" id="com61" name="b312" value="0" />無
                                                <br>
                                                <b>檢查記錄：</b>
                                                <input disabled type="radio" id="com61" name="b313" value="1" />有
                                                <input disabled type="radio" id="com61" name="b313" value="0" />無
                                                <input disabled type="radio" id="com61" name="b313" value="2" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>動力來源：</b>
                                                <input disabled type="radio" id="com61" name="b313" value="1" />台電
                                                <input disabled type="radio" id="com61" name="b313" value="2" />自備電源
                                                <input disabled type="radio" id="com61" name="b313" value="3" />人力
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>維護：</b>
                                                <select disabled class=" iHead" id="com61" name="b314">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">尚可</option>
                                                    <option value="3" title="">待加強</option>
                                                </select>
                                                <br>
                                                <b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b315" value="2" />有
                                                <input disabled type="radio" id="com61" name="b315" value="1" />無
                                                <input disabled type="radio" id="com61" name="b315" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>暴雨前後之檢查：</b>
                                                <input disabled type="radio" id="com61" name="b316" value="1" />有
                                                <input disabled type="radio" id="com61" name="b316" value="1" />無
                                                ，<br><b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b317" value="1" />有
                                                <input disabled type="radio" id="com61" name="b317" value="1" />無
                                                <input disabled type="radio" id="com61" name="b317" value="1" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>地震前後之檢查：</b>
                                                <input disabled type="radio" id="com61" name="b318" value="1" />無
                                                <input disabled type="radio" id="com61" name="b318" value="1" />有
                                                ，<br><b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b319" value="1" />有
                                                <input disabled type="radio" id="com61" name="b319" value="1" />無
                                                <input disabled type="radio" id="com61" name="b319" value="1" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>啟用年份：</b>
                                                <input disabled type="text" name="b3110" class=" vCheckMan" style="width: 20%" value="" id="com61">年啟用
                                                <br>
                                                <input disabled type="text" id="com61" name="b3111" value="" />已逾齡
                                                <input disabled type="radio" id="com61" name="b3111" value="0" />未逾齡
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>河道放水口：</b>
                                                <input disabled type="radio" id="com61" name="b3112" value="1" />有
                                                <input disabled type="radio" id="com61" name="b3112" value="0" />無
                                                <br>
                                                <b>維護：</b>
                                                <input disabled type="radio" id="com61" name="b3113" value="2" />有
                                                <input disabled type="radio" id="com61" name="b3113" value="1" />無
                                                <input disabled type="radio" id="com61" name="b3113" value="0" />待加強
                                                <br><b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b3114" value="2" />有
                                                <input disabled type="radio" id="com61" name="b3114" value="1" />無
                                                <input disabled type="radio" id="com61" name="b3114" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>定期操作試驗：</b>
                                                <input disabled type="radio" id="com61" name="b3115" value="1" />有
                                                <input disabled type="radio" id="com61" name="b3115" value="0" />無
                                                <br><b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b3116" value="2" />有
                                                <input disabled type="radio" id="com61" name="b3116" value="1" />無
                                                <input disabled type="radio" id="com61" name="b3116" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>其它放水設施：</b>
                                                <input disabled type="radio" id="com61" name="b3117" value="1" />有
                                                <input disabled type="radio" id="com61" name="b3117" value="0" />無
                                                <br>
                                                名稱：<input disabled type="text" name="b3118" class=" vCheckMan" style="width: 40%" value="" id="com61">
                                                <br>
                                                <b>維護：</b>
                                                <select disabled class=" iHead" id="com61" name="b3119">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">尚可</option>
                                                    <option value="3" title="">待加強</option>
                                                </select>
                                                <br><b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b3120" value="2" />有
                                                <input disabled type="radio" id="com61" name="b3120" value="1" />無
                                                <input disabled type="radio" id="com61" name="b3120" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>閘閥之水密性：</b>
                                                <input disabled type="radio" id="com61" name="b3121" value="1" />良好
                                                <input disabled type="radio" id="com61" name="b3121" value="2" />漏水待改善
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>閘閥開度指示器：</b>
                                                <input disabled type="radio" id="com61" name="b3122" value="1" />位置正確
                                                <input disabled type="radio" id="com61" name="b3122" value="2" />偏差待訂正
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>閘閥插板及吊放設備：</b>
                                                <input disabled type="radio" id="com61" name="b3123" value="1" />有
                                                <input disabled type="radio" id="com61" name="b3123" value="0" />無
                                                <br>
                                                <b>維護：</b>
                                                <input disabled type="radio" id="com61" name="b3124" value="1" />良好
                                                <input disabled type="radio" id="com61" name="b3124" value="0" />待改善
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>欄污柵：</b>
                                                <input disabled type="radio" id="com61" name="b3125" value="1" />有
                                                <input disabled type="radio" id="com61" name="b3125" value="0" />無
                                                <br>
                                                <b>維護：</b>
                                                <input disabled type="radio" id="com61" name="b3126" value="1" />良好
                                                <input disabled type="radio" id="com61" name="b3126" value="0" />待改善
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b3127" class=" vCheckMan" style="width: 100%" value="" id="com61">
                                                <br>
                                            </div>
                                        </div>
                                        {{--</div>--}}
                                        {{--<div class="form-group row" id="com5">--}}
                                        <label for="com71" class="col-sm-3 text-left control-label col-form-label">（三）閘閥操作</label>
                                        <div class="form-group row" id="com71">
                                            <div class="col-sm-9  b32">
                                                <b>設置地點與外界隔絕：</b>
                                                <input disabled type="radio" id="com71" name="b321" value="1" />是
                                                <input disabled type="radio" id="com71" name="b321" value="2" />外人可靠近
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b32">
                                                <b>操作規則：</b>
                                                <input disabled type="radio" id="com71" name="b322" value="2" />有
                                                <input disabled type="radio" id="com71" name="b322" value="1" />待訂
                                                <input disabled type="radio" id="com71" name="b322" value="0" />待修正
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b32">
                                                <b>水門啟閉之標準：</b>
                                                <input disabled type="radio" id="com71" name="b323" value="2" />己辦
                                                <input disabled type="radio" id="com71" name="b323" value="1" />辦理中
                                                <input disabled type="radio" id="com71" name="b323" value="0" />待辦
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b32">
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b324" class=" vCheckMan" style="width: 100%" value="" id="com71">
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>

                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if(isset($info->iCheck_message))
                                        @if( $info->iCheck_message < session('member.iAcType') && session('member.iAcType')>19 && session('member.iAcType')<80)
                                        <div style="float: left" class="checkdiv">
                                            <button type="button" class="btn btn-success waves-effect waves-light btn-check" data-id="{{$info->iSource or ''}}">
                                                Check & Send
                                            </button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light btn-refuse" data-id="{{$info->iSource or ''}}">
                                                Refuse
                                            </button>
                                        </div>
                                        @elseif( $info->iCheck_message < session('member.iAcType') && session('member.iAcType')>9 && session('member.iAcType')<20)
                                        <div style="float: left" class="">
                                            <button type="button" class="btn btn-default waves-effect waves-light btn-edit" data-id="{{$info->iId or ''}}">
                                                Edit table
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
                history.back();
            });
            //
            $(".btn-edit").click(function () {
                var id = $(this).data('id');
                location.href = '{{url("web/record/trace/edit")}}' + '/' + id;
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
                            $(".checkdiv").hide();
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
                            $(".checkdiv").hide();
                        } else {
                            toastr.error(rtndata.message, "{{trans('_web_alert.notice')}}");
                            $(".checkdiv").hide();
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
