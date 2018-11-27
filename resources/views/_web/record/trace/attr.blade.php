
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
                            <h3 class="card-title text-center">{{$vSummary or ''}}</h3>
                        </div>
                        <form class="form-horizontal  trace_table">
                            <div class="card-body messageInfo-modal1  a">
                                <h4 class="card-title  a1_title">壹 、水庫基本資料</h4>
                                <div class="form-group row  a1">
                                    <label for="com1" class="col-sm-3 text-left control-label col-form-label  a11_title">一、 概況</label>
                                    <div class="col-sm-9  a11">
                                        <br>
                                        <div class="t1">水庫名稱：</div>
                                        <input disabled type="text" name="a111" class="form-control a111 reservoir_name" id="com1" value="{{$reservoir_name or ''}}" data-id="{{$reservoir_id or ''}}">
                                        <div class="t2">檢查日期：</div>
                                        <input disabled type="date" name="a112" class="form-control a112" >
                                        <div class="t3">管理機關：</div>
                                        <input disabled type="text" name="a113" class="form-control a113" >
                                        <div class="t4">檢查人員：</div>
                                        <input disabled type="text" name="a114" class="form-control a114" >
                                        <div class="t5">位置：</div>
                                        <input disabled type="text" name="a115" class="form-control a115" >
                                        <div class="t6">河系（主支流）：</div>
                                        <input disabled type="text" name="a116" class="form-control a116" >
                                        <br>
                                    </div>

                                    <label for="com2" class="col-sm-3 text-left control-label col-form-label  a12_title">二、檢查時操作狀況</label>
                                    <div class="col-sm-9  a12">
                                        <br>
                                        水庫水位：
                                        <input disabled type="text" name="a121" class="form-control a121" id="com2" >
                                        水庫蓄水量：
                                        <input disabled type="text" name="a122" class="form-control a122" >
                                        最高記錄水位：
                                        <input disabled type="text" name="a123" class="form-control a123" >
                                        <br>
                                        <h5>放水量：</h5>
                                        <div class="form-inline">
                                            <div>溢洪道<input disabled type="text" name="a124" class="form-control " >秒立方公尺<br></div>
                                            <div>出水工<input disabled type="text" name="a125" class="form-control " >秒立方公尺<br></div>
                                            <div>渠  道<input disabled type="text" name="a126" class="form-control " >秒立方公尺<br></div>
                                            <div>發電廠<input disabled type="text" name="a127" class="form-control " >秒立方公尺<br></div>
                                        </div>
                                        <br>
                                    </div>

                                    <label for="com3" class="col-sm-3 text-left control-label col-form-label  a13_title">三、地質環境</label>
                                    <div class="col-sm-9  a13">
                                        <br>
                                        <div class="a131">
                                            基岩性質：
                                            <input disabled type="text" name="a131" class="form-control " id="com3" placeholder="" value="">
                                        </div>
                                        <div class="a132">
                                            基岩孔隙度：
                                            <input disabled type="radio" id="com3" name="a132" value="1" />極小
                                            <input disabled type="radio" id="com3" name="a132" value="2" />小
                                            <input disabled type="radio" id="com3" name="a132" value="3" />中
                                            <input disabled type="radio" id="com3" name="a132" value="4" />大
                                        </div>
                                        <br>
                                        <div class="a133">
                                            基岩節理或劈理：
                                            <input disabled type="radio" id="com3" name="a133" value="1" />發達
                                            <input disabled type="radio" id="com3" name="a133" value="0" />不發達
                                        </div>
                                        <br>
                                        <div class="a134">
                                            主壩與地層走向：
                                            <input disabled type="radio" id="com3" name="a134" value="0" />平行
                                            <input disabled type="radio" id="com3" name="a134" value="1" />小角度斜交
                                            <input disabled type="radio" id="com3" name="a134" value="2" />大角度斜交
                                        </div>
                                        <br>
                                        <div class="a135">
                                            地層傾斜與主壩關係：
                                            <input disabled type="radio" id="com3" name="a135" value="up" />向上游傾斜
                                            <input disabled type="radio" id="com3" name="a135" value="down" />向下游傾斜
                                        </div>
                                        <br>
                                        <div class="a136">
                                            附近有無斷層通過：
                                            <input disabled type="radio" id="com3" name="a136" value="0" />無
                                            <input disabled type="radio" id="com3" name="a136" value="1" />有
                                            （
                                            <input disabled type="radio" id="com3" name="a137" value="10" />活動斷層
                                            <input disabled type="radio" id="com3" name="a137" value="11" />不活動斷層
                                            ）
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="card-body messageInfo-modal2  b">
                                <h4 class="card-title  b1_title">貳、檢查內容</h4>
                                <div class="form-group row  b1">
                                    <label for="com4" class="col-sm-3 text-left control-label col-form-label  b11_title">一、結構物安全檢查</label>
                                    <div class="form-group row AAA b11" id="com4">
                                        <label for="com41" class="col-sm-3 text-left control-label col-form-label  b111_title">（一）壩</label>
                                        <div id="com41" class="form-group row b111 BBB">
                                            <br>
                                            <div class="col-sm-9  b1111">
                                                <b>上游坡面：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b1111">
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
                                                <select disabled id="com41" class="form-sel iHead" name="b1112">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b1113">
                                                <b>下游坡面：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b1113">
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
                                                <select disabled id="com41" class="form-sel iHead" name="b1114">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b1115">
                                                <b>壩座與壩基：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b1115">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.滲漏</option>
                                                    <option value="2" title="">2.裂縫</option>
                                                    <option value="3" title="">3.移動</option>
                                                    <option value="4" title="">4.壩基淘刷</option>
                                                </select>
                                                <br>
                                                <b>壩基排水情形：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b1116">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                    <option value="13" title="">其他</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b1117">
                                                <b>壩頂：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b1117">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.龜裂</option>
                                                    <option value="2" title="">2.移動</option>
                                                    <option value="3" title="">3.沈陷</option>
                                                    <option value="4" title="">4.長樹</option>
                                                </select>
                                                <br>
                                                <b>欄杆及護網等安全措施：</b>
                                                <br>
                                                <input disabled type="radio" id="com41" name="b1118" value="1" />有
                                                （
                                                <input disabled type="radio" id="com41" name="b11181" value="11" />良好
                                                <input disabled type="radio" id="com41" name="b11181" value="10" />待改善
                                                ）
                                                <input disabled type="radio" id="com41" name="b1118" value="0" />無
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b1119">
                                                <b>出水高：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b1119">
                                                    <option value="1" title="">1.足夠</option>
                                                    <option value="2" title="">2.不足</option>
                                                    <option value="3" title="">3.待檢討</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b11191">
                                                <b>觀測儀器及記錄：</b>

                                                <br>
                                                項目
                                                <input disabled type="text" name="b111911" class=" vCheckMan" style="width: 40%" value="" id="com41">
                                                <input disabled type="text" name="b111912" class=" vCheckMan" style="width: 30%" value="" id="com41">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com41" name="b111913" value="1" />有
                                                <input disabled type="radio" id="com41" name="b111913" value="0" />無
                                                <br>

                                                項目
                                                <input disabled type="text" name="b111914" class=" vCheckMan" style="width: 40%" value="" id="com41">
                                                <input disabled type="text" name="b111915" class=" vCheckMan" style="width: 30%" value="" id="com41">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com41" name="b111916" value="1" />有
                                                <input disabled type="radio" id="com41" name="b111916" value="0" />無
                                                <br>

                                                項目
                                                <input disabled type="text" name="b111917" class=" vCheckMan" style="width: 40%" value="" id="com41">
                                                <input disabled type="text" name="b111918" class=" vCheckMan" style="width: 30%" value="" id="com41">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com41" name="b111919" value="1" />有
                                                <input disabled type="radio" id="com41" name="b111919" value="0" />無
                                                <br>

                                                項目
                                                <input disabled type="text" name="b1119191" class=" vCheckMan" style="width: 40%" value="" id="com41" >
                                                <input disabled type="text" name="b1119192" class=" vCheckMan" style="width: 30%" value="" id="com41" >處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com41" name="b1119193" value="1" />有
                                                <input disabled type="radio" id="com41" name="b1119193" value="0" />無
                                                <br>

                                                項目
                                                <input disabled type="text" name="b1119194" class=" vCheckMan" style="width: 40%" value="" id="com41" >
                                                <input disabled type="text" name="b1119195" class=" vCheckMan" style="width: 30%" value="" id="com41" >處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com41" name="b1119196" value="1" />有
                                                <input disabled type="radio" id="com41" name="b1119196" value="0" />無
                                                <br>

                                                <b>建議加設之觀測儀器：</b>
                                                <input disabled type="text" name="b1119197" class="vCheckMan" style="width: 40%" value="" id="com41" >
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b11192">
                                                <b>廊道：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b111921">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">裂縫</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">表面剝落</option>
                                                    <option value="4" title="">凹陷</option>
                                                </select>
                                                <br>
                                                <b>滲流及排水情形：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b111922">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>混凝土一般狀況：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b111923">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>通氣及照明設備：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b111924">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>金屬工：</b>
                                                <select disabled id="com41" class="form-sel iHead" name="b111925">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b111926" class=" vCheckMan" style="width: 100%" value="" id="com41" >
                                            </div>
                                        </div>

                                        <label for="com42" class="col-sm-3 text-left control-label col-form-label  b112_title">（二）溢洪道</label>
                                        <div id="com42" class="form-group row b112 BBB">
                                            <br>
                                            <div class="col-sm-9">
                                                <b>入口渠道：</b>
                                                <select disabled class="form-sel iHead" id="com42" name="b1121">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">植物生長</option>
                                                    <option value="2" title="">渠道滑動</option>
                                                    <option value="3" title="">漂流物</option>
                                                </select>
                                                <br>邊坡保護：
                                                <select disabled class=" iHead" id="com42" name="b1122">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>溢洪道護坦：</b>
                                                <select disabled class="form-sel iHead" id="com42" name="b1123">
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
                                                <select disabled class=" iHead" id="com42" name="b1124">
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
                                                <select disabled class=" iHead" id="com42" name="b1125">
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
                                                <select disabled class=" iHead" id="com42" name="b1126">
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
                                                <select disabled class=" iHead" id="com42" name="b1127">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">破損待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>下游放水路：</b>
                                                <select disabled class=" iHead" id="com42" name="b1128">
                                                    <option value="0" title="">暢通</option>
                                                    <option value="1" title="">被侵佔</option>
                                                    <option value="2" title="">高莖物</option>
                                                    <option value="3" title="">待疏浚</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">固定結構物阻流</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9" >
                                                <b>靜水池：</b>
                                                <select disabled class=" iHead" id="com42" name="b1129">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9" >
                                                <b>緊急排洪設施：</b>
                                                <input disabled type="radio" id="com42" name="b11291" value="0" />無
                                                <input disabled type="radio" id="com42" name="b11292" value="1" />有
                                                （
                                                <input disabled type="radio" id="com42" name="b11291" value="1" />完整
                                                <input disabled type="radio" id="com42" name="b11291" value="2" />待修補
                                                ）
                                                <br>
                                            </div>
                                            <div class="col-sm-9" >
                                                <b>設計洪水量：</b>
                                                <input disabled type="radio" id="com42" name="b11293" value="1" />重新檢討
                                                <input disabled type="radio" id="com42" name="b11293" value="0" />不需檢討
                                                <br>
                                            </div>
                                            <div class="col-sm-9" >
                                                <b>排洪能力：</b>
                                                <input disabled type="radio" id="com42" name="b11294" value="1" />足夠
                                                <input disabled type="radio" id="com42" name="b11294" value="2" />不足
                                                <input disabled type="radio" id="com42" name="b11294" value="3" />待檢討
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b11295" class=" vCheckMan" style="width: 100%" value="" id="com42">
                                            </div>
                                        </div>

                                        <label for="com43" class="col-sm-3 text-left control-label col-form-label  b113_title">（三）取水工及出水工</label>
                                        <div id="com43" class="form-group row b113 BBB">
                                            <br>
                                            <div class="col-sm-9">
                                                <b>進水口結構：</b>
                                                <br>
                                                攔污柵：
                                                <input disabled type="radio" id="com43" name="b1131" value="0" />無
                                                <input disabled type="radio" id="com43" name="b1131" value="1" />待增設
                                                <input disabled type="radio" id="com43" name="b1131" value="2" />有
                                                （
                                                <input disabled type="radio" id="com43" name="b1132" value="1" />完整
                                                <input disabled type="radio" id="com43" name="b1132" value="2" />待修補
                                                <input disabled type="radio" id="com43" name="b1132" value="3" />漂流物待清除
                                                ）
                                                <br>
                                                混凝土結構：
                                                <select disabled id="com43" class="iHead" name="b1133">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>
                                                閘門結構物：
                                                <select disabled id="com43" class=" iHead" name="b1134">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                                金屬工：
                                                <select disabled id="com43" class=" iHead" name="b1135">
                                                    <option value="0" title="">完整</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>緊急控制設施：</b>
                                                <br>
                                                <input disabled type="radio" id="com43" name="b1136" value="1" />無
                                                <input disabled type="radio" id="com43" name="b1136" value="1" />有
                                                （
                                                <input disabled type="radio" id="com43" name="b1137" value="1" />完整
                                                <input disabled type="radio" id="com43" name="b1137" value="1" />待改善
                                                ）
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>出水管道：</b>
                                                <br>
                                                金屬工：
                                                <select disabled id="com43" class=" iHead" name="b1138">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                                混凝土工：
                                                <select disabled id="com43" class=" iHead" name="b1139">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>操作設備：</b>
                                                <select disabled id="com43" class="form-sel iHead" name="b11391">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                閘門室：
                                                <select disabled id="com43" class="form-sel iHead" name="b11392">
                                                    <option value="11" title="">良好</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                閘門：
                                                <select disabled id="com43" class="form-sel iHead" name="b11393">
                                                    <option value="11" title="">良好</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                閥門：
                                                <select disabled id="com43" class="form-sel iHead" name="b11394">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                控制系統：
                                                <select disabled id="com43" class="form-sel iHead" name="b11395">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                    <option value="12" title="">其他</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>靜水池：</b>
                                                <select disabled id="com43" class="form-sel iHead" name="b11396">
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
                                                <select disabled id="com43" class="form-sel iHead" name="b11397">
                                                    <option value="11" title="">良好</option>
                                                    <option value="3" title="">植物生長</option>
                                                    <option value="1" title="">邊坡不穩定</option>
                                                    <option value="2" title="">護岸待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b11398" class=" vCheckMan" style="width: 100%" value="" id="com43">
                                                <br>
                                            </div>
                                        </div>

                                        <label for="com44" class="col-sm-3 text-left control-label col-form-label  b114_title">（四）發電設備</label>
                                        <div id="com44" class="form-group row b114 BBB">
                                            <div class="col-sm-9">
                                                <b>進水口結構：</b>
                                                <br>
                                                攔污柵：
                                                <input disabled type="radio" id="com44" name="b1141" value="0" />無
                                                <input disabled type="radio" id="com44" name="b1141" value="1" />待增設
                                                <input disabled type="radio" id="com44" name="b1141" value="2" />有
                                                （
                                                <input disabled type="radio" id="com44" name="b1142" value="1" />完整
                                                <input disabled type="radio" id="com44" name="b1142" value="2" />待修補
                                                ）
                                                <br>
                                                閘門設備：
                                                <select disabled class=" iHead" id="com44" name="b1143">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">待修補</option>
                                                    <option value="3" title="">需維護</option>
                                                </select>
                                                <br>
                                                操作手冊：
                                                <input disabled type="radio" id="com44" name="b1144" value="0" />無
                                                <input disabled type="radio" id="com44" name="b1144" value="1" />待增補
                                                <input disabled type="radio" id="com44" name="b1144" value="2" />有
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>壓力綱管：</b>
                                                <br>
                                                <select disabled class=" iHead" id="com44" name="b1145">
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
                                                <select disabled class=" iHead" id="com44" name="b1146">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>尾水道：</b>
                                                <br>
                                                <select disabled class=" iHead" id="com44" name="b1147">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>備用電力設備：</b>
                                                <br>
                                                <input disabled type="radio" id="com44" name="b1148" value="0" />無
                                                <input disabled type="radio" id="com44" name="b1148" value="1" />有
                                                （
                                                <input disabled type="radio" id="com44" name="b1149" value="1" />良好
                                                <input disabled type="radio" id="com44" name="b1149" value="2" />待修
                                                ）
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b11491" class=" vCheckMan" style="width: 100%" value="" id="com44">
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row  b2">
                                    <label for="com5" class="col-sm-3 text-left control-label col-form-label b21_title">二、放水設施安全檢查</label>
                                    <div class="form-group row AAA b21" id="com5">
                                        <label for="com51" class="col-sm-3 text-left control-label col-form-label b211_title">（一）壩體</label>
                                        <div class="form-group row bbb BBB  b211" id="com51">
                                            <div class="col-sm-9 b2111">
                                                <b>上游坡面：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b21111">
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
                                                <select disabled id="com51" class="form-sel iHead" name="b21112">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2112">
                                                <b>下游坡面：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b21121">
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
                                                <select disabled id="com51" class="form-sel iHead" name="b21122">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2113">
                                                <b>壩座與壩基：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b21131">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.滲漏</option>
                                                    <option value="2" title="">2.裂縫</option>
                                                    <option value="3" title="">3.移動</option>
                                                    <option value="4" title="">4.壩基淘刷</option>
                                                </select>
                                                <br>
                                                壩基排水情形：
                                                <select disabled id="com51" class="form-sel iHead" name="b21132">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                    <option value="13" title="">其他</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2114">
                                                <b>壩頂：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b21141">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.龜裂</option>
                                                    <option value="2" title="">2.移動</option>
                                                    <option value="3" title="">3.沈陷</option>
                                                    <option value="4" title="">4.長樹</option>
                                                </select>
                                                <br>
                                                欄杆及護網等安全措施：
                                                <input disabled type="radio" id="com51" name="b21142" value="1" />有
                                                （
                                                <input disabled type="radio" id="com51" name="b21143" value="11" />良好
                                                <input disabled type="radio" id="com51" name="b21143" value="10" />待改善
                                                ）
                                                <input disabled type="radio" id="com51" name="b21142" value="0" />無
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2115">
                                                <b>出水高：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b21151">
                                                    <option value="1" title="">1.足夠</option>
                                                    <option value="2" title="">2.不足</option>
                                                    <option value="3" title="">3.待檢討</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2116">
                                                <b>觀測儀器及記錄：</b>
                                                <br>
                                                項目
                                                <input disabled type="text" name="b21161" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input disabled type="text" name="b21162" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com51" name="b21163" value="1" />有
                                                <input disabled type="radio" id="com51" name="b21163" value="0" />無
                                                <br>
                                                項目
                                                <input disabled type="text" name="b21164" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input disabled type="text" name="b21165" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com51" name="b21166" value="1" />有
                                                <input disabled type="radio" id="com51" name="b21166" value="0" />無
                                                <br>
                                                項目
                                                <input disabled type="text" name="b21167" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input disabled type="text" name="b21168" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com51" name="b21169" value="1" />有
                                                <input disabled type="radio" id="com51" name="b21169" value="0" />無
                                                <br>
                                                項目
                                                <input disabled type="text" name="b211691" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input disabled type="text" name="b211692" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com51" name="b211693" value="1" />有
                                                <input disabled type="radio" id="com51" name="b211693" value="0" />無
                                                <br>
                                                項目
                                                <input disabled type="text" name="b211694" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input disabled type="text" name="b211695" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input disabled type="radio" id="com51" name="b211696" value="1" />有
                                                <input disabled type="radio" id="com51" name="b211696" value="0" />無
                                                <br>
                                                <b>建議加設之觀測儀器：</b>
                                                <input disabled type="text" name="b211697" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2117">
                                                <b>廊道：</b>
                                                <select disabled id="com51" class="form-sel iHead" name="b21171">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">裂縫</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">表面剝落</option>
                                                    <option value="4" title="">凹陷</option>
                                                </select>
                                                <br>
                                                滲流及排水情形：
                                                <select disabled id="com51" class="form-sel iHead" name="b21172">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                混凝土一般狀況：
                                                <select disabled id="com51" class="form-sel iHead" name="b21173">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                通氣及照明設備：
                                                <select disabled id="com51" class="form-sel iHead" name="b21174">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                金屬工：
                                                <select disabled id="com51" class="form-sel iHead" name="b21175">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b21176" class=" vCheckMan" style="width: 100%" value="" id="com51" >
                                                <br>
                                            </div>
                                        </div>
                                        {{--</div>--}}
                                        {{--<div class="form-group row" id="com5">--}}
                                        <label for="com61" class="col-sm-3 text-left control-label col-form-label">（二）閘閥及機電設備</label>
                                        <div class="form-group row BBB  b212">
                                            <br>
                                            <div class="col-sm-9">
                                                <b>檢查：</b>
                                                <input disabled type="radio" id="com61" name="b2121" value="1" />有
                                                <input disabled type="radio" id="com61" name="b2121" value="0" />無
                                                <br>
                                                <b>定期檢查：</b>
                                                <input disabled type="radio" id="com61" name="b2122" value="1" />有
                                                <input disabled type="radio" id="com61" name="b2122" value="0" />無
                                                <br>
                                                <b>檢查記錄：</b>
                                                <input disabled type="radio" id="com61" name="b2123" value="1" />有
                                                <input disabled type="radio" id="com61" name="b2123" value="0" />無
                                                <input disabled type="radio" id="com61" name="b2123" value="2" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>動力來源：</b>
                                                <input disabled type="radio" id="com61" name="b2124" value="1" />台電
                                                <input disabled type="radio" id="com61" name="b2124" value="2" />自備電源
                                                <input disabled type="radio" id="com61" name="b2124" value="3" />人力
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>維護：</b>
                                                <select disabled class=" iHead" id="com61" name="b2125">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">尚可</option>
                                                    <option value="3" title="">待加強</option>
                                                </select>
                                                <br>
                                                <b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b2126" value="2" />有
                                                <input disabled type="radio" id="com61" name="b2126" value="1" />無
                                                <input disabled type="radio" id="com61" name="b2126" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>暴雨前後之檢查：</b>
                                                <input disabled type="radio" id="com61" name="b2127" value="1" />有
                                                <input disabled type="radio" id="com61" name="b2127" value="1" />無
                                                ，<br><b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b2128" value="1" />有
                                                <input disabled type="radio" id="com61" name="b2128" value="1" />無
                                                <input disabled type="radio" id="com61" name="b2128" value="1" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>地震前後之檢查：</b>
                                                <input disabled type="radio" id="com61" name="b2129" value="1" />無
                                                <input disabled type="radio" id="com61" name="b2129" value="1" />有
                                                ，<br><b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b21291" value="1" />有
                                                <input disabled type="radio" id="com61" name="b21291" value="1" />無
                                                <input disabled type="radio" id="com61" name="b21291" value="1" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>啟用年份：</b>
                                                <input disabled type="text" name="b21292" class=" vCheckMan" style="width: 20%" value="" id="com61">年啟用
                                                <br>
                                                <input disabled type="text" id="com61" name="b21293" value="" />已逾齡
                                                <input disabled type="radio" id="com61" name="b21294" value="0" />未逾齡
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>河道放水口：</b>
                                                <input disabled type="radio" id="com61" name="b21295" value="1" />有
                                                <input disabled type="radio" id="com61" name="b21295" value="0" />無
                                                <br>
                                                <b>維護：</b>
                                                <input disabled type="radio" id="com61" name="b21296" value="2" />有
                                                <input disabled type="radio" id="com61" name="b21296" value="1" />無
                                                <input disabled type="radio" id="com61" name="b21296" value="0" />待加強
                                                <br><b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b21297" value="2" />有
                                                <input disabled type="radio" id="com61" name="b21297" value="1" />無
                                                <input disabled type="radio" id="com61" name="b21297" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>定期操作試驗：</b>
                                                <input disabled type="radio" id="com61" name="b21298" value="1" />有
                                                <input disabled type="radio" id="com61" name="b21298" value="0" />無
                                                <br><b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b21299" value="2" />有
                                                <input disabled type="radio" id="com61" name="b21299" value="1" />無
                                                <input disabled type="radio" id="com61" name="b21299" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>其它放水設施：</b>
                                                <input disabled type="radio" id="com61" name="b212991" value="1" />有
                                                <input disabled type="radio" id="com61" name="b212991" value="0" />無
                                                <br>
                                                名稱：<input disabled type="text" name="b212992" class=" vCheckMan" style="width: 40%" value="" id="com61">
                                                <br>
                                                <b>維護：</b>
                                                <select disabled class=" iHead" id="com61" name="b212993">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">尚可</option>
                                                    <option value="3" title="">待加強</option>
                                                </select>
                                                <br><b>記錄：</b>
                                                <input disabled type="radio" id="com61" name="b212994" value="2" />有
                                                <input disabled type="radio" id="com61" name="b212994" value="1" />無
                                                <input disabled type="radio" id="com61" name="b212994" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>閘閥之水密性：</b>
                                                <input disabled type="radio" id="com61" name="b212995" value="1" />良好
                                                <input disabled type="radio" id="com61" name="b212995" value="2" />漏水待改善
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>閘閥開度指示器：</b>
                                                <input disabled type="radio" id="com61" name="b212996" value="1" />位置正確
                                                <input disabled type="radio" id="com61" name="b212996" value="2" />偏差待訂正
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>閘閥插板及吊放設備：</b>
                                                <input disabled type="radio" id="com61" name="b212997" value="1" />有
                                                <input disabled type="radio" id="com61" name="b212997" value="0" />無
                                                <br>
                                                <b>維護：</b>
                                                <input disabled type="radio" id="com61" name="b212998" value="1" />良好
                                                <input disabled type="radio" id="com61" name="b212998" value="0" />待改善
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>欄污柵：</b>
                                                <input disabled type="radio" id="com61" name="b212999" value="1" />有
                                                <input disabled type="radio" id="com61" name="b212999" value="0" />無
                                                <br>
                                                <b>維護：</b>
                                                <input disabled type="radio" id="com61" name="b2129991" value="1" />良好
                                                <input disabled type="radio" id="com61" name="b2129991" value="0" />待改善
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b2129992" class=" vCheckMan" style="width: 100%" value="" id="com61">
                                                <br>
                                            </div>
                                        </div>
                                        {{--</div>--}}
                                        {{--<div class="form-group row" id="com5">--}}
                                        <label for="com71" class="col-sm-3 text-left control-label col-form-label">（三）閘閥操作</label>
                                        <div class="form-group row BBB  b213" id="com71">
                                            <div class="col-sm-9  b2131">
                                                <b>設置地點與外界隔絕：</b>
                                                <input disabled type="radio" id="com71" name="b2131" value="1" />是
                                                <input disabled type="radio" id="com71" name="b2131" value="2" />外人可靠近
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b2132">
                                                <b>操作規則：</b>
                                                <input disabled type="radio" id="com71" name="b2132" value="2" />有
                                                <input disabled type="radio" id="com71" name="b2132" value="1" />待訂
                                                <input disabled type="radio" id="com71" name="b2132" value="0" />待修正
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b2133">
                                                <b>水門啟閉之標準：</b>
                                                <input disabled type="radio" id="com71" name="b2133" value="2" />己辦
                                                <input disabled type="radio" id="com71" name="b2133" value="1" />辦理中
                                                <input disabled type="radio" id="com71" name="b2133" value="0" />待辦
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b2134">
                                                <b>※重要事項記述：</b>
                                                <input disabled type="text" name="b2134" class=" vCheckMan" style="width: 100%" value="" id="com71">
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

                //水庫安全檢查表之填寫項目大項標題
                <?php if (isset($TraceTable)){ ?>
                    dd = <?php echo $TraceTable ?>;
                    $.each(dd['TraceRow1'], function(i, field){
                        $("[name='"+i+"']").parents('.BBB').prev('label').text(field);
                    });
                    $.each(dd['TraceRow2'], function(i, field){
                        $("[name='"+i+"']").parents('.BBB').prev('label').text(field);
                    });
                <?php } ?>

                    //每個水庫的喜好設定值
                    <?php if (isset($memberAccess)){ ?>
                    $('.AAA').hide();
                    $('.AAA').prev('label').hide();
                        $('.BBB').hide();
                        $('.BBB').prev('label').hide();

                    dd = <?php echo $memberAccess->vDetail ?>;
                    $.each(dd, function(i, field){
                        $("[name='"+field.name+"']").parents('.AAA').show();
                        $("[name='"+field.name+"']").parents('.AAA').prev('label').show();
                            $("[name='"+field.name+"']").parents('.BBB').show();
                            $("[name='"+field.name+"']").parents('.BBB').prev('label').show();
                    });
                    <?php } ?>


                //審查表編輯
                <?php if (isset($info)){ ?>
                    dd = <?php echo $info->vDetail ?>;
                    $.each(dd, function(i, field){
                        var _input  = $("[name='"+field.name+"']");
                        //單選題特殊處理
                        if( _input.attr('type') === 'radio'){
                            _input.filter('[value='+field.value+']').prop('checked', true);
                        } else {
                            _input.val(field.value);
                        }
                    });
                <?php } ?>
            /*
             ***********************************************/

        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
