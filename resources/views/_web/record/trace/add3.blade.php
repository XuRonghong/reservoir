
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
                            <h4 class="card-title vSummary">{{$vSummary or ''}}</h4>
                            <hr>
                        </div>
                        <form class="form-horizontal  trace_table">
                            <div class="card-body messageInfo-modal1  a">
                                <h4 class="card-title  a1_title">壹 、水庫基本資料</h4>
                                <div class="form-group row  a1">
                                    <label for="com1" class="col-sm-3 text-left control-label col-form-label  a11_title">一、 概況</label>
                                    <div class="col-sm-9  a11">
                                        <br>
                                        <div class="t1">水庫名稱：</div>
                                        <input type="text" name="a111" class="form-control a111 reservoir_name" id="com1" value="{{$reservoir_name or ''}}">
                                        <div class="t2">檢查日期：</div>
                                        <input type="date" name="a112" class="form-control a112" >
                                        <div class="t3">管理機關：</div>
                                        <input type="text" name="a113" class="form-control a113" >
                                        <div class="t4">檢查人員：</div>
                                        <input type="text" name="a114" class="form-control a114" >
                                        <div class="t5">位置：</div>
                                        <input type="text" name="a115" class="form-control a115" >
                                        <div class="t6">河系（主支流）：</div>
                                        <input type="text" name="a116" class="form-control a116" >
                                        <br>
                                    </div>

                                    <label for="com2" class="col-sm-3 text-left control-label col-form-label  a12_title">二、檢查時操作狀況</label>
                                    <div class="col-sm-9  a12">
                                        <br>
                                        水庫水位：
                                        <input type="text" name="a121" class="form-control a121" id="com2" >
                                        水庫蓄水量：
                                        <input type="date" name="a122" class="form-control a122" >
                                        最高記錄水位：
                                        <input type="text" name="a123" class="form-control a123" >
                                        <br>
                                        <h5>放水量：</h5>
                                        <div class="form-inline">
                                            <div>溢洪道<input type="text" name="a124" class="form-control " >秒立方公尺<br></div>
                                            <div>出水工<input type="text" name="a125" class="form-control " >秒立方公尺<br></div>
                                            <div>渠  道<input type="text" name="a126" class="form-control " >秒立方公尺<br></div>
                                            <div>發電廠<input type="text" name="a127" class="form-control " >秒立方公尺<br></div>
                                        </div>
                                        <br>
                                    </div>

                                    <label for="com3" class="col-sm-3 text-left control-label col-form-label  a13_title">三、地質環境</label>
                                    <div class="col-sm-9  a13">
                                        <br>
                                        <div class="a131">
                                            基岩性質：
                                            <input type="text" name="a131" class="form-control " id="com3" placeholder="" value="">
                                        </div>
                                        <div class="a132">
                                            基岩孔隙度：
                                            <input type="radio" id="com3" name="a132" value="1" />極小
                                            <input type="radio" id="com3" name="a132" value="2" />小
                                            <input type="radio" id="com3" name="a132" value="3" />中
                                            <input type="radio" id="com3" name="a132" value="4" />大
                                        </div>
                                        <br>
                                        <div class="a133">
                                            基岩節理或劈理：
                                            <input type="radio" id="com3" name="a133" value="1" />發達
                                            <input type="radio" id="com3" name="a133" value="0" />不發達
                                        </div>
                                        <br>
                                        <div class="a134">
                                            主壩與地層走向：
                                            <input type="radio" id="com3" name="a134" value="0" />平行
                                            <input type="radio" id="com3" name="a134" value="1" />小角度斜交
                                            <input type="radio" id="com3" name="a134" value="2" />大角度斜交
                                        </div>
                                        <br>
                                        <div class="a135">
                                            地層傾斜與主壩關係：
                                            <input type="radio" id="com3" name="a135" value="up" />向上游傾斜
                                            <input type="radio" id="com3" name="a135" value="down" />向下游傾斜
                                        </div>
                                        <br>
                                        <div class="a136">
                                            附近有無斷層通過：
                                            <input type="radio" id="com3" name="a136" value="0" />無
                                            <input type="radio" id="com3" name="a136" value="1" />有
                                            （
                                            <input type="radio" id="com3" name="a137" value="10" />活動斷層
                                            <input type="radio" id="com3" name="a137" value="11" />不活動斷層
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
                                    <div class="form-group row  b11" id="com4">
                                        <label for="com41" class="col-sm-3 text-left control-label col-form-label  b111_title">（一）壩體</label>
                                        <div id="com41" class="form-group row b111 BBB">
                                            <br>
                                            <div class="col-sm-9  b1111">
                                                <b>上游坡面：</b>
                                                <select id="com41" class="form-sel iHead" name="b1111">
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
                                                <select id="com41" class=" iHead" name="b1121">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b1113">
                                                <b>下游坡面：</b>
                                                <select id="com41" class="form-sel iHead" name="b1113">
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
                                                <select id="com41" class="form-sel iHead" name="b1114">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b1115">
                                                <b>壩座與壩基：</b>
                                                <select id="com41" class="form-sel iHead" name="b1115">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.滲漏</option>
                                                    <option value="2" title="">2.裂縫</option>
                                                    <option value="3" title="">3.移動</option>
                                                    <option value="4" title="">4.壩基淘刷</option>
                                                </select>
                                                <br>
                                                <b>壩基排水情形：</b>
                                                <select id="com41" class="form-sel iHead" name="b1116">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                    <option value="13" title="">其他</option>
                                                </select>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b1117">
                                                <b>壩頂：</b>
                                                <select id="com41" class="form-sel iHead" name="b1117">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.龜裂</option>
                                                    <option value="2" title="">2.移動</option>
                                                    <option value="3" title="">3.沈陷</option>
                                                    <option value="4" title="">4.長樹</option>
                                                </select>
                                                <br>
                                                <b>欄杆及護網等安全措施：</b>
                                                    <br>
                                                    <input type="radio" id="com41" name="b1118" value="1" />有
                                                    （
                                                    <input type="radio" id="com41" name="b11181" value="11" />良好
                                                    <input type="radio" id="com41" name="b11181" value="10" />待改善
                                                    ）
                                                    <input type="radio" id="com41" name="b1118" value="0" />無
                                                    <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b1119">
                                                <b>出水高：</b>
                                                <select id="com41" class="form-sel iHead" name="b1119">
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
                                                <input type="text" name="b111911" class=" vCheckMan" style="width: 40%" value="" id="com41">
                                                <input type="text" name="b111912" class=" vCheckMan" style="width: 30%" value="" id="com41">處
                                                <br>紀錄：
                                                <input type="radio" id="com41" name="b111913" value="1" />有
                                                <input type="radio" id="com41" name="b111913" value="0" />無
                                                <br>

                                                項目
                                                <input type="text" name="b111914" class=" vCheckMan" style="width: 40%" value="" id="com41">
                                                <input type="text" name="b111915" class=" vCheckMan" style="width: 30%" value="" id="com41">處
                                                <br>紀錄：
                                                <input type="radio" id="com41" name="b111916" value="1" />有
                                                <input type="radio" id="com41" name="b111916" value="0" />無
                                                <br>

                                                項目
                                                <input type="text" name="b111917" class=" vCheckMan" style="width: 40%" value="" id="com41">
                                                <input type="text" name="b111918" class=" vCheckMan" style="width: 30%" value="" id="com41">處
                                                <br>紀錄：
                                                <input type="radio" id="com41" name="b111919" value="1" />有
                                                <input type="radio" id="com41" name="b111919" value="0" />無
                                                <br>

                                                項目
                                                <input type="text" name="b1119191" class=" vCheckMan" style="width: 40%" value="" id="com41" >
                                                <input type="text" name="b1119192" class=" vCheckMan" style="width: 30%" value="" id="com41" >處
                                                <br>紀錄：
                                                <input type="radio" id="com41" name="b1119193" value="1" />有
                                                <input type="radio" id="com41" name="b1119193" value="0" />無
                                                <br>

                                                項目
                                                <input type="text" name="b1119194" class=" vCheckMan" style="width: 40%" value="" id="com41" >
                                                <input type="text" name="b1119195" class=" vCheckMan" style="width: 30%" value="" id="com41" >處
                                                <br>紀錄：
                                                <input type="radio" id="com41" name="b1119196" value="1" />有
                                                <input type="radio" id="com41" name="b1119196" value="0" />無
                                                <br>

                                                <b>建議加設之觀測儀器：</b>
                                                <input type="text" name="b1119197" class="vCheckMan" style="width: 40%" value="" id="com41" >
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b11192">
                                                <b>廊道：</b>
                                                    <select id="com41" class="form-sel iHead" name="b111921">
                                                        <option value="0" title="">完整</option>
                                                        <option value="1" title="">裂縫</option>
                                                        <option value="2" title="">移動</option>
                                                        <option value="3" title="">表面剝落</option>
                                                        <option value="4" title="">凹陷</option>
                                                    </select>
                                                    <br>
                                                    <b>滲流及排水情形：</b>
                                                    <select id="com41" class="form-sel iHead" name="b111922">
                                                        <option value="11" title="">正常</option>
                                                        <option value="12" title="">待改善</option>
                                                    </select>
                                                    <br>
                                                    <b>混凝土一般狀況：</b>
                                                    <select id="com41" class="form-sel iHead" name="b111923">
                                                        <option value="11" title="">正常</option>
                                                        <option value="12" title="">待改善</option>
                                                    </select>
                                                    <br>
                                                    <b>通氣及照明設備：</b>
                                                    <select id="com41" class="form-sel iHead" name="b111924">
                                                        <option value="11" title="">正常</option>
                                                        <option value="12" title="">待改善</option>
                                                    </select>
                                                    <br>
                                                    <b>金屬工：</b>
                                                    <select id="com41" class="form-sel iHead" name="b111925">
                                                        <option value="11" title="">良好</option>
                                                        <option value="12" title="">待改善</option>
                                                    </select>
                                                    <br>
                                                    <b>※重要事項記述：</b>
                                                    <input type="text" name="b111926" class=" vCheckMan" style="width: 100%" value="" id="com41" >
                                            </div>
                                        </div>

                                        <label for="com42" class="col-sm-3 text-left control-label col-form-label  b112_title">（二）溢洪道</label>
                                        <div id="com42" class="form-group row b112 BBB">
                                            <br>
                                            <div class="col-sm-9">
                                                <b>入口渠道：</b>
                                                <select class="form-sel iHead" id="com42" name="b1121">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">植物生長</option>
                                                    <option value="2" title="">渠道滑動</option>
                                                    <option value="3" title="">漂流物</option>
                                                </select>
                                                <br>邊坡保護：
                                                <select class=" iHead" id="com42" name="b1122">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>溢洪道護坦：</b>
                                                <select class="form-sel iHead" id="com42" name="b1123">
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
                                                <select class=" iHead" id="com42" name="b1124">
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
                                                <select class=" iHead" id="com42" name="b1125">
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
                                                <select class=" iHead" id="com42" name="b1126">
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
                                                <select class=" iHead" id="com42" name="b1127">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">破損待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>下游放水路：</b>
                                                <select class=" iHead" id="com42" name="b1128">
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
                                                <select class=" iHead" id="com42" name="b1129">
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
                                                <input type="radio" id="com42" name="b11291" value="0" />無
                                                <input type="radio" id="com42" name="b11292" value="1" />有
                                                （
                                                <input type="radio" id="com42" name="b11291" value="1" />完整
                                                <input type="radio" id="com42" name="b11291" value="2" />待修補
                                                ）
                                                <br>
                                            </div>
                                            <div class="col-sm-9" >
                                                <b>設計洪水量：</b>
                                                <input type="radio" id="com42" name="b11293" value="1" />重新檢討
                                                <input type="radio" id="com42" name="b11293" value="0" />不需檢討
                                                <br>
                                            </div>
                                            <div class="col-sm-9" >
                                                <b>排洪能力：</b>
                                                <input type="radio" id="com42" name="b11294" value="1" />足夠
                                                <input type="radio" id="com42" name="b11294" value="2" />不足
                                                <input type="radio" id="com42" name="b11294" value="3" />待檢討
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input type="text" name="b11295" class=" vCheckMan" style="width: 100%" value="" id="com42">
                                            </div>
                                        </div>

                                        <label for="com43" class="col-sm-3 text-left control-label col-form-label  b113_title">（三）取水工及出水工</label>
                                        <div id="com43" class="form-group row b113 BBB">
                                            <br>
                                            <div class="col-sm-9">
                                                <b>進水口結構：</b>
                                                <br>
                                                攔污柵：
                                                <input type="radio" id="com43" name="b1131" value="0" />無
                                                <input type="radio" id="com43" name="b1131" value="1" />待增設
                                                <input type="radio" id="com43" name="b1131" value="2" />有
                                                （
                                                <input type="radio" id="com43" name="b1132" value="1" />完整
                                                <input type="radio" id="com43" name="b1132" value="2" />待修補
                                                <input type="radio" id="com43" name="b1132" value="3" />漂流物待清除
                                                ）
                                                <br>
                                                混凝土結構：
                                                <select id="com43" class="iHead" name="b1133">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">表面剝落</option>
                                                    <option value="2" title="">裂縫</option>
                                                    <option value="3" title="">凹陷</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">接縫滲水</option>
                                                </select>
                                                <br>
                                                閘門結構物：
                                                <select id="com43" class=" iHead" name="b1134">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                                金屬工：
                                                <select id="com43" class=" iHead" name="b1135">
                                                    <option value="0" title="">完整</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>緊急控制設施：</b>
                                                <br>
                                                <input type="radio" id="com43" name="b1136" value="1" />無
                                                <input type="radio" id="com43" name="b1136" value="1" />有
                                                （
                                                <input type="radio" id="com43" name="b1137" value="1" />完整
                                                <input type="radio" id="com43" name="b1137" value="1" />待改善
                                                ）
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>出水管道：</b>
                                                <br>
                                                金屬工：
                                                <select id="com43" class=" iHead" name="b1138">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                                混凝土工：
                                                <select id="com43" class=" iHead" name="b1139">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="2" title="">待修補</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>操作設備：</b>
                                                <select id="com43" class="form-sel iHead" name="b11391">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                閘門室：
                                                <select id="com43" class="form-sel iHead" name="b11392">
                                                    <option value="11" title="">良好</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                閘門：
                                                <select id="com43" class="form-sel iHead" name="b11393">
                                                    <option value="11" title="">良好</option>
                                                    <option value="1" title="">滲漏</option>
                                                    <option value="1" title="">穴蝕</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                閥門：
                                                <select id="com43" class="form-sel iHead" name="b11394">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                控制系統：
                                                <select id="com43" class="form-sel iHead" name="b11395">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                    <option value="12" title="">其他</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>靜水池：</b>
                                                <select id="com43" class="form-sel iHead" name="b11396">
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
                                                <select id="com43" class="form-sel iHead" name="b11397">
                                                    <option value="11" title="">良好</option>
                                                    <option value="3" title="">植物生長</option>
                                                    <option value="1" title="">邊坡不穩定</option>
                                                    <option value="2" title="">護岸待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input type="text" name="b11398" class=" vCheckMan" style="width: 100%" value="" id="com43">
                                                <br>
                                            </div>
                                        </div>

                                        <label for="com44" class="col-sm-3 text-left control-label col-form-label  b114_title">（四）發電設備</label>
                                        <div id="com44" class="form-group row b114 BBB">
                                            <div class="col-sm-9">
                                                <b>進水口結構：</b>
                                                <br>
                                                攔污柵：
                                                <input type="radio" id="com44" name="b1141" value="0" />無
                                                <input type="radio" id="com44" name="b1141" value="1" />待增設
                                                <input type="radio" id="com44" name="b1141" value="2" />有
                                                （
                                                <input type="radio" id="com44" name="b1142" value="1" />完整
                                                <input type="radio" id="com44" name="b1142" value="2" />待修補
                                                ）
                                                <br>
                                                閘門設備：
                                                <select class=" iHead" id="com44" name="b1143">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">待修補</option>
                                                    <option value="3" title="">需維護</option>
                                                </select>
                                                <br>
                                                操作手冊：
                                                <input type="radio" id="com44" name="b1144" value="0" />無
                                                <input type="radio" id="com44" name="b1144" value="1" />待增補
                                                <input type="radio" id="com44" name="b1144" value="2" />有
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>壓力綱管：</b>
                                                <br>
                                                <select class=" iHead" id="com44" name="b1145">
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
                                                <select class=" iHead" id="com44" name="b1146">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>尾水道：</b>
                                                <br>
                                                <select class=" iHead" id="com44" name="b1147">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">待修</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>備用電力設備：</b>
                                                <br>
                                                <input type="radio" id="com44" name="b1148" value="0" />無
                                                <input type="radio" id="com44" name="b1148" value="1" />有
                                                （
                                                <input type="radio" id="com44" name="b1149" value="1" />良好
                                                <input type="radio" id="com44" name="b1149" value="2" />待修
                                                ）
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input type="text" name="b11491" class=" vCheckMan" style="width: 100%" value="" id="com44">
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row  b2">
                                    <label for="com5" class="col-sm-3 text-left control-label col-form-label b21_title">二、放水設施安全檢查</label>
                                    <div class="form-group row  b21" id="com5">
                                        <label for="com51" class="col-sm-3 text-left control-label col-form-label b211_title">（一）壩體</label>
                                        <div class="form-group row bbb BBB  b211" id="com51">
                                            <div class="col-sm-9 b2111">
                                                <b>上游坡面：</b>
                                                <select id="com51" class="form-sel iHead" name="b21111">
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
                                                <select id="com51" class=" iHead" name="b21112">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2112">
                                                <b>下游坡面：</b>
                                                <select id="com51" class="form-sel iHead" name="b21121">
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
                                                <select id="com51" class="form-sel iHead" name="b21122">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2113">
                                                <b>壩座與壩基：</b>
                                                <select id="com51" class="form-sel iHead" name="b21131">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.滲漏</option>
                                                    <option value="2" title="">2.裂縫</option>
                                                    <option value="3" title="">3.移動</option>
                                                    <option value="4" title="">4.壩基淘刷</option>
                                                </select>
                                                <br>
                                                壩基排水情形：
                                                <select id="com51" class="form-sel iHead" name="b21132">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                    <option value="13" title="">其他</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2114">
                                                <b>壩頂：</b>
                                                <select id="com51" class="form-sel iHead" name="b21141">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">1.龜裂</option>
                                                    <option value="2" title="">2.移動</option>
                                                    <option value="3" title="">3.沈陷</option>
                                                    <option value="4" title="">4.長樹</option>
                                                </select>
                                                <br>
                                                欄杆及護網等安全措施：
                                                <input type="radio" id="com51" name="b21142" value="1" />有
                                                （
                                                <input type="radio" id="com51" name="b21143" value="11" />良好
                                                <input type="radio" id="com51" name="b21143" value="10" />待改善
                                                ）
                                                <input type="radio" id="com51" name="b21142" value="0" />無
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2115">
                                                <b>出水高：</b>
                                                <select id="com51" class="form-sel iHead" name="b21151">
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
                                                <input type="text" name="b21161" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input type="text" name="b21162" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input type="radio" id="com51" name="b21163" value="1" />有
                                                <input type="radio" id="com51" name="b21163" value="0" />無
                                                <br>
                                                項目
                                                <input type="text" name="b21164" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input type="text" name="b21165" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input type="radio" id="com51" name="b21166" value="1" />有
                                                <input type="radio" id="com51" name="b21166" value="0" />無
                                                <br>
                                                項目
                                                <input type="text" name="b21167" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input type="text" name="b21168" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input type="radio" id="com51" name="b21169" value="1" />有
                                                <input type="radio" id="com51" name="b21169" value="0" />無
                                                <br>
                                                項目
                                                <input type="text" name="b211691" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input type="text" name="b211692" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input type="radio" id="com51" name="b211693" value="1" />有
                                                <input type="radio" id="com51" name="b211693" value="0" />無
                                                <br>
                                                項目
                                                <input type="text" name="b211694" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <input type="text" name="b211695" class=" vCheckMan" style="width: 30%" value="" id="com51">處
                                                <br>紀錄：
                                                <input type="radio" id="com51" name="b211696" value="1" />有
                                                <input type="radio" id="com51" name="b211696" value="0" />無
                                                <br>
                                                <b>建議加設之觀測儀器：</b>
                                                <input type="text" name="b211697" class=" vCheckMan" style="width: 40%" value="" id="com51">
                                                <br>
                                            </div>
                                            <div class="col-sm-9 b2117">
                                                <b>廊道：</b>
                                                <select id="com51" class="form-sel iHead" name="b21171">
                                                    <option value="0" title="">完整</option>
                                                    <option value="1" title="">裂縫</option>
                                                    <option value="2" title="">移動</option>
                                                    <option value="3" title="">表面剝落</option>
                                                    <option value="4" title="">凹陷</option>
                                                </select>
                                                <br>
                                                滲流及排水情形：
                                                <select id="com51" class="form-sel iHead" name="b21172">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                混凝土一般狀況：
                                                <select id="com51" class="form-sel iHead" name="b21173">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                通氣及照明設備：
                                                <select id="com51" class="form-sel iHead" name="b21174">
                                                    <option value="11" title="">正常</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                金屬工：
                                                <select id="com51" class="form-sel iHead" name="b21175">
                                                    <option value="11" title="">良好</option>
                                                    <option value="12" title="">待改善</option>
                                                </select>
                                                <br>
                                                <b>※重要事項記述：</b>
                                                <input type="text" name="b21176" class=" vCheckMan" style="width: 100%" value="" id="com51" >
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
                                                <input type="radio" id="com61" name="b2121" value="1" />有
                                                <input type="radio" id="com61" name="b2121" value="0" />無
                                                <br>
                                                <b>定期檢查：</b>
                                                <input type="radio" id="com61" name="b2122" value="1" />有
                                                <input type="radio" id="com61" name="b2122" value="0" />無
                                                <br>
                                                <b>檢查記錄：</b>
                                                <input type="radio" id="com61" name="b2123" value="1" />有
                                                <input type="radio" id="com61" name="b2123" value="0" />無
                                                <input type="radio" id="com61" name="b2123" value="2" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>動力來源：</b>
                                                <input type="radio" id="com61" name="b2124" value="1" />台電
                                                <input type="radio" id="com61" name="b2124" value="2" />自備電源
                                                <input type="radio" id="com61" name="b2124" value="3" />人力
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>維護：</b>
                                                <select class=" iHead" id="com61" name="b2125">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">尚可</option>
                                                    <option value="3" title="">待加強</option>
                                                </select>
                                                <br>
                                                <b>記錄：</b>
                                                <input type="radio" id="com61" name="b2126" value="2" />有
                                                <input type="radio" id="com61" name="b2126" value="1" />無
                                                <input type="radio" id="com61" name="b2126" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>暴雨前後之檢查：</b>
                                                <input type="radio" id="com61" name="b2127" value="1" />有
                                                <input type="radio" id="com61" name="b2127" value="1" />無
                                                ，<br><b>記錄：</b>
                                                <input type="radio" id="com61" name="b2128" value="1" />有
                                                <input type="radio" id="com61" name="b2128" value="1" />無
                                                <input type="radio" id="com61" name="b2128" value="1" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>地震前後之檢查：</b>
                                                <input type="radio" id="com61" name="b2129" value="1" />無
                                                <input type="radio" id="com61" name="b2129" value="1" />有
                                                ，<br><b>記錄：</b>
                                                <input type="radio" id="com61" name="b21291" value="1" />有
                                                <input type="radio" id="com61" name="b21291" value="1" />無
                                                <input type="radio" id="com61" name="b21291" value="1" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>啟用年份：</b>
                                                <input type="text" name="b21292" class=" vCheckMan" style="width: 20%" value="" id="com61">年啟用
                                                <br>
                                                <input type="text" id="com61" name="b21293" value="" />已逾齡
                                                <input type="radio" id="com61" name="b21294" value="0" />未逾齡
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>河道放水口：</b>
                                                <input type="radio" id="com61" name="b21295" value="1" />有
                                                <input type="radio" id="com61" name="b21295" value="0" />無
                                                <br>
                                                <b>維護：</b>
                                                <input type="radio" id="com61" name="b21296" value="2" />有
                                                <input type="radio" id="com61" name="b21296" value="1" />無
                                                <input type="radio" id="com61" name="b21296" value="0" />待加強
                                                <br><b>記錄：</b>
                                                <input type="radio" id="com61" name="b21297" value="2" />有
                                                <input type="radio" id="com61" name="b21297" value="1" />無
                                                <input type="radio" id="com61" name="b21297" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>定期操作試驗：</b>
                                                <input type="radio" id="com61" name="b21298" value="1" />有
                                                <input type="radio" id="com61" name="b21298" value="0" />無
                                                <br><b>記錄：</b>
                                                <input type="radio" id="com61" name="b21299" value="2" />有
                                                <input type="radio" id="com61" name="b21299" value="1" />無
                                                <input type="radio" id="com61" name="b21299" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>其它放水設施：</b>
                                                <input type="radio" id="com61" name="b212991" value="1" />有
                                                <input type="radio" id="com61" name="b212991" value="0" />無
                                                <br>
                                                名稱：<input type="text" name="b212992" class=" vCheckMan" style="width: 40%" value="" id="com61">
                                                <br>
                                                <b>維護：</b>
                                                <select class=" iHead" id="com61" name="b212993">
                                                    <option value="1" title="">良好</option>
                                                    <option value="2" title="">尚可</option>
                                                    <option value="3" title="">待加強</option>
                                                </select>
                                                <br><b>記錄：</b>
                                                <input type="radio" id="com61" name="b212994" value="2" />有
                                                <input type="radio" id="com61" name="b212994" value="1" />無
                                                <input type="radio" id="com61" name="b212994" value="0" />不全
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>閘閥之水密性：</b>
                                                <input type="radio" id="com61" name="b212995" value="1" />良好
                                                <input type="radio" id="com61" name="b212995" value="2" />漏水待改善
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>閘閥開度指示器：</b>
                                                <input type="radio" id="com61" name="b212996" value="1" />位置正確
                                                <input type="radio" id="com61" name="b212996" value="2" />偏差待訂正
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>閘閥插板及吊放設備：</b>
                                                <input type="radio" id="com61" name="b212997" value="1" />有
                                                <input type="radio" id="com61" name="b212997" value="0" />無
                                                <br>
                                                <b>維護：</b>
                                                <input type="radio" id="com61" name="b212998" value="1" />良好
                                                <input type="radio" id="com61" name="b212998" value="0" />待改善
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>欄污柵：</b>
                                                <input type="radio" id="com61" name="b212999" value="1" />有
                                                <input type="radio" id="com61" name="b212999" value="0" />無
                                                <br>
                                                <b>維護：</b>
                                                <input type="radio" id="com61" name="b2129991" value="1" />良好
                                                <input type="radio" id="com61" name="b2129991" value="0" />待改善
                                                <br>
                                            </div>
                                            <div class="col-sm-9">
                                                <b>※重要事項記述：</b>
                                                <input type="text" name="b2129992" class=" vCheckMan" style="width: 100%" value="" id="com61">
                                                <br>
                                            </div>
                                        </div>
                                    {{--</div>--}}
                                    {{--<div class="form-group row" id="com5">--}}
                                        <label for="com71" class="col-sm-3 text-left control-label col-form-label">（三）閘閥操作</label>
                                        <div class="form-group row BBB  b213" id="com71">
                                            <div class="col-sm-9  b2131">
                                                <b>設置地點與外界隔絕：</b>
                                                <input type="radio" id="com71" name="b2131" value="1" />是
                                                <input type="radio" id="com71" name="b2131" value="2" />外人可靠近
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b2132">
                                                <b>操作規則：</b>
                                                <input type="radio" id="com71" name="b2132" value="2" />有
                                                <input type="radio" id="com71" name="b2132" value="1" />待訂
                                                <input type="radio" id="com71" name="b2132" value="0" />待修正
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b2133">
                                                <b>水門啟閉之標準：</b>
                                                <input type="radio" id="com71" name="b2133" value="2" />己辦
                                                <input type="radio" id="com71" name="b2133" value="1" />辦理中
                                                <input type="radio" id="com71" name="b2133" value="0" />待辦
                                                <br>
                                            </div>
                                            <div class="col-sm-9  b2134">
                                                <b>※重要事項記述：</b>
                                                <input type="text" name="b2134" class=" vCheckMan" style="width: 100%" value="" id="com71">
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>

                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if( session('member.iAcType') && session('member.iAcType')>9 && session('member.iAcType')<20)
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-doadd">
                                            Add & Send
                                        </button>
                                    @elseif( isset($info) && $info->iCheck_message < session('member.iAcType') && session('member.iAcType')>19 && session('member.iAcType')<80)
                                        <button type="button" class="btn btn-success waves-effect waves-light btn-check" data-id="{{$info->iSource or ''}}">
                                            Check & Send
                                        </button>
                                    {{--@elseif( session('member.iAcType') < 10 )--}}
                                        {{--<button type="button" class="btn btn-info waves-effect waves-light btn-doadd">--}}
                                            {{--Add & Send--}}
                                        {{--</button>--}}
                                        {{--<button type="button" class="btn btn-warning waves-effect waves-light btn-dosave" data-id="{{$info->iId or ''}}">--}}
                                            {{--Save--}}
                                        {{--</button>--}}
                                    @endif
                                    <button type="button" class="btn btn-dark waves-effect waves-light btn-cancel">BACK</button>
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
        var url_doadd3 = "{{ url('web/'.implode( '/', $module ).'/doadd3')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_dosave2 = "{{ url('web/'.implode( '/', $module ).'/dosave2')}}";
        $(document).ready(function () {


            /************************************************
             *  JQuery serializeArray decode :
             */


                <?php if (isset($memberAccess)){ ?>

                    $('.BBB').hide();
                    $('.BBB').prev('label').hide();

                    dd = {!! $memberAccess->vDetail !!};
                    $.each(dd, function(i, field){
                        $("[name='"+field.name+"']").parents('.BBB').show();
                        $("[name='"+field.name+"']").parents('.BBB').prev('label').show();
                    });
                <?php } ?>


                <?php if (isset($info)){ ?>
                    dd = {!! $info->vDetail !!};
                    $.each(dd, function(i, field){
                        $("[name='"+field.name+"']").val(field.value);
                    });
                <?php } ?>
            /*
             ***********************************************/

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

                data.reservoir = $('.reservoir_name').val();
                /************************************************
                 *  JQuery serializeArray encode :
                 */
                    data.vDetail = JSON.stringify( $('form.trace_table').serializeArray() );
                /*
                 ***********************************************/
                //
                $.ajax({
                    url: url_doadd3,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            //
                            sendNotifyMessage(rtndata.newid , rtndata.heads_token , $('.reservoir_name').val() , $(".vSummary").val());
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

                data.reservoir = $('.reservoir_name').val();
                /************************************************
                 *  JQuery serializeArray encode :
                 */
                    data.vDetail = JSON.stringify( $('form.trace_table').serializeArray() );
                /*
                 ***********************************************/
                //
                $.ajax({
                    url: url_dosave2,
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
            var url = "http://reservoir.kahap.com/web/record/trace" + /attr/ + id;
            //傳送token 找哪些是要收到的機子、A水庫所屬的管理員
            // var DeliverList = [];
            // DeliverList.push(token);//新增token
            /*上方為所需變更之資料*/

            $.ajax({
                type:"post",
                url:"https://fcm.googleapis.com/fcm/send",
                cache:false,
                headers: {!! urldecode($sendNotifyMessageHeaders) !!},
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



        /*
        -----之前設計的JSON存資料方式，現在無用了
         */
        function getInputToJson()
        {
            var data = {
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
            };
            return JSON.stringify(data);
        }
    </script>
@endsection
<!-- ================== /inline-js ================== -->