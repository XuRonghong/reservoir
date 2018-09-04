@extends('_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!-- This page plugin CSS -->
    <link href="xtreme-admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
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
    </div>
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
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Zero Configuration</h4>
                        <h6 class="card-subtitle">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code> $().DataTable();</code>. You can refer full documentation from here <a href="https://datatables.net/">Datatables</a></h6>
                        <div class="table-responsive">
                            <table id="dt_basic" class="table table-striped table-bordered">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
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
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
        <div class="customizer-body">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="mdi mdi-wrench font-20"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#chat" role="tab" aria-controls="chat" aria-selected="false"><i class="mdi mdi-message-reply font-20"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="mdi mdi-star-circle font-20"></i></a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 1 -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="p-15 border-bottom">
                        <!-- Sidebar -->
                        <h5 class="font-medium m-b-10 m-t-10">Layout Settings</h5>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="theme-view" id="theme-view">
                            <label class="custom-control-label" for="theme-view">Dark Theme</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input sidebartoggler" name="collapssidebar" id="collapssidebar">
                            <label class="custom-control-label" for="collapssidebar">Collapse Sidebar</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="sidebar-position" id="sidebar-position">
                            <label class="custom-control-label" for="sidebar-position">Fixed Sidebar</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="header-position" id="header-position">
                            <label class="custom-control-label" for="header-position">Fixed Header</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="boxed-layout" id="boxed-layout">
                            <label class="custom-control-label" for="boxed-layout">Boxed Layout</label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Logo Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Navbar BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Navbar Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin6"></a></li>
                        </ul>
                        <!-- Navbar BG -->
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Sidebar Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                </div>
                <!-- End Tab 1 -->
                <!-- Tab 2 -->
                <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="mailbox list-style-none m-t-20">
                        <li>
                            <div class="message-center chat-scroll">
                                <a href="javascript:void(0)" class="message-item" id='chat_user_1' data-user-id='1'>
                                    <span class="user-img"> <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle"> <span class="profile-status online pull-right"></span> </span>
                                    <span class="mail-contnet">
                                        <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </span>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_2' data-user-id='2'>
                                    <span class="user-img"> <img src="../../assets/images/users/2.jpg" alt="user" class="rounded-circle"> <span class="profile-status busy pull-right"></span> </span>
                                    <span class="mail-contnet">
                                        <h5 class="message-title">Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </span>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_3' data-user-id='3'>
                                    <span class="user-img"> <img src="../../assets/images/users/3.jpg" alt="user" class="rounded-circle"> <span class="profile-status away pull-right"></span> </span>
                                    <span class="mail-contnet">
                                        <h5 class="message-title">Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </span>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_4' data-user-id='4'>
                                    <span class="user-img"> <img src="../../assets/images/users/4.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                    <span class="mail-contnet">
                                        <h5 class="message-title">Nirav Joshi</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </span>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_5' data-user-id='5'>
                                    <span class="user-img"> <img src="../../assets/images/users/5.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                    <span class="mail-contnet">
                                        <h5 class="message-title">Sunil Joshi</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </span>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_6' data-user-id='6'>
                                    <span class="user-img"> <img src="../../assets/images/users/6.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                    <span class="mail-contnet">
                                        <h5 class="message-title">Akshay Kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </span>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_7' data-user-id='7'>
                                    <span class="user-img"> <img src="../../assets/images/users/7.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                    <span class="mail-contnet">
                                        <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </span>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item" id='chat_user_8' data-user-id='8'>
                                    <span class="user-img"> <img src="../../assets/images/users/8.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                    <span class="mail-contnet">
                                        <h5 class="message-title">Varun Dhavan</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </span>
                                </a>
                                <!-- Message -->
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End Tab 2 -->
                <!-- Tab 3 -->
                <div class="tab-pane fade p-15" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <h6 class="m-t-20 m-b-20">Activity Timeline</h6>
                    <div class="steamline">
                        <div class="sl-item">
                            <div class="sl-left bg-success"> <i class="ti-user"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                                <div class="desc">you can write anything </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-info"><i class="fas fa-image"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Send documents to Clark</div>
                                <div class="desc">Lorem Ipsum is simply </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="../../assets/images/users/2.jpg"> </div>
                            <div class="sl-right">
                                <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span></div>
                                <div class="desc">Contrary to popular belief</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="../../assets/images/users/1.jpg"> </div>
                            <div class="sl-right">
                                <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span></div>
                                <div class="desc">Approve meeting with tiger</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-primary"> <i class="ti-user"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                                <div class="desc">you can write anything </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-info"><i class="fas fa-image"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Send documents to Clark</div>
                                <div class="desc">Lorem Ipsum is simply </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="../../assets/images/users/4.jpg"> </div>
                            <div class="sl-right">
                                <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span></div>
                                <div class="desc">Contrary to popular belief</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="../../assets/images/users/6.jpg"> </div>
                            <div class="sl-right">
                                <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span></div>
                                <div class="desc">Approve meeting with tiger</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tab 3 -->
            </div>
        </div>
    </aside>
    <div class="chat-windows"></div>
@endsection

<!-- ================== page-js ================== -->
@section('page-js')
    <!--This page plugins -->
    <script src="xtreme-admin/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="xtreme-admin/dist/js/pages/datatable/datatable-basic.init.js"></script>
@endsection
<!-- ================== /page-js ================== -->

<!-- ================== inline-js ================== -->
@section('inline-js')

    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var ajax_Table = "{{ url('web/'.implode( '/', $module ).'/getlist')}}";
        var url_dosave_show = "{{ url('web/'.implode( '/', $module ).'/dosaveshow')}}";
        var url_add = "{{ url('web/'.implode( '/', $module ).'/add')}}";
        var url_edit = "{{ url('web/'.implode( '/', $module ).'/edit')}}";
        var url_attributes = "{{ url('web/'.implode( '/', $module ).'/attributes')}}";
        var url_specification = "{{ url('web/'.implode( '/', $module ).'/specification')}}";
        var url_dodel = "{{ url('web/'.implode( '/', $module ).'/dodel')}}";
        var url_docopy = "{{ url('web/'.implode( '/', $module ).'/docopy')}}";
        var url_purchase = "{{ url('web/'.implode( '/', $module ).'/purchase')}}";
        var url_recommend = "{{ url('web/'.implode( '/', $module ).'/recommend')}}";
        var url_gifts = "{{ url('web/'.implode( '/', $module ).'/gifts')}}";
        var url_appraise = "{{ url('web/'.implode( '/', $module ).'/appraise')}}";
        $(document).ready(function () {
            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "serverSide": true,
                "stateSave": true,
                "scrollX": true,
                "scrollY": '60vh',
                "aoColumns": [
                    {
                        "sTitle": "ID",
                        "mData": "iId",
                        "width": "35px",
                        "sName": "iId",
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            return '<button class="btn btn-xs btn-default btn-copy" title="複製"><i class="fa fa-copy" aria-hidden="true"></i></button>' + data;
                        }
                    },
                    {
                        "sTitle": "IRank",
                        "mData": "iRank",
                        "sName": "iRank",
                        "bSearchable": false,
                        "width": "10px",
                        "mRender": function (data, type, row) {
                            return '<input style="width: 100%; text-align: right;" class="irank" size="1" type="text" value="' + data + '"></input>';
                        }
                    },
                    {
                        "sTitle": "上/下架",
                        "mData": "bShow",
                        "sName": "bShow",
                        "bSearchable": false,
                        "width": "45px",
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-danger btn-show">已上架</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-show">未上架</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {
                        "sTitle": "公開/隱藏",
                        "mData": "bOpen",
                        "sName": "bOpen",
                        "bSearchable": false,
                        "width": "50px",
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-danger btn-open">已公開</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-open">未公開</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {
                        "sTitle": "Action",
                        "width": "90px",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            btn = '<button class="btn btn-xs btn-default btn-edit" title="商品資料"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                            btn += '<button class="btn btn-xs btn-default btn-attributes" title="商品屬性"><i class="fa fa-book" aria-hidden="true"></i></button>';
                            btn += '<button class="btn btn-xs btn-default btn-spec" title="商品規格"><i class="fa fa-puzzle-piece" aria-hidden="true"></i></button>';
                            btn += '<button class="pull-right btn btn-xs btn-default btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            return btn;
                        }
                    },
                    // {
                    //     "sTitle": "加值功能",
                    //     "width": "40px",
                    //     "bSortable": false,
                    //     "bSearchable": false,
                    //     "mRender": function (data, type, row) {
                    //         current_data[row.iId] = row;
                    //         var btn = '';//"無功能";
                    //         // btn = '<button class="btn btn-xs btn-default btn-purchase" title="加購商品">加購商品</button><br>';
                    //         // btn += '<button class="btn btn-xs btn-default btn-gifts" title="加購商品">贈品</button><br>';
                    //         // btn += '<button class="btn btn-xs btn-default btn-recommend" title="推薦商品">推薦商品</button><br>';
                    //         btn += '<button class="btn btn-xs btn-default btn-appraise" title="商品評價">商品評價</button><br>';
                    //         return btn;
                    //     }
                    // },
                    {"sTitle": "商品類別", "mData": "vCategoryName", "width": "50px", "sName": "vCategoryName", "bSearchable": false},
                    {
                        "sTitle": "商品類號",
                        "mData": "vCategoryNum",
                        "width": "75px",
                        "sName": "vCategoryNum",
                        "bSortable": false,
                        "bSearchable": false
                    },
                    {
                        "sTitle": "商品圖片",
                        "mData": "vImages",
                        "width": "130px",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            var html_str = "";
                            for (var key in data) {
                                html_str += "<img width='75px' src=" + data[key] + " style='margin:5px;'>";
                            }
                            return html_str;
                        }
                    },
                    {"sTitle": "商品品牌", "mData": "vProductCompany", "width": "50px", "sName": "vProductCompany"},
                    {"sTitle": "商品型號", "mData": "vProductNum", "width": "80px", "sName": "vProductNum"},
                    {"sTitle": "商品名稱", "mData": "vProductName", "width": "70px", "sName": "vProductName"},
                    // {"sTitle": "商品成本", "mData": "iProductCost", "width": "50px", "sName": "iProductCost", "bSearchable": false},
                    // {"sTitle": "商品定價", "mData": "iProductPrice", "width": "50px", "sName": "iProductPrice", "bSearchable": false},
                    // {"sTitle": "商品售價", "mData": "iProductPromoPrice", "width": "50px", "sName": "iProductPromoPrice", "bSearchable": false},
                    {"sTitle": "購買數量", "mData": "iProductVolume", "width": "50px", "sName": "iProductVolume", "bSearchable": false},
                    // {"sTitle": "商品重量", "mData": "iProductWeight", "width": "50px", "sName": "iProductWeight", "bSearchable": false},
                    // {
                    //     "sTitle": "Delete",
                    //     "width": "50px",
                    //     "bSortable": false,
                    //     "bSearchable": false,
                    //     "mRender": function (data, type, row) {
                    //         current_data[row.iId] = row;
                    //         var btn = "無功能";
                    //         btn = '<button class="pull-right btn btn-xs btn-default btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    //         return btn;
                    //     }
                    // },
                ],
                "sAjaxSource": ajax_source,
                "ajax": ajax_Table,
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                }
            });
            /* END BASIC */
            //
            $("#dt_basic").on('change', '.irank', function () {
                var id = $(this).closest('tr').attr('id');
                var irank = $(this).val();
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.iRank = irank;
                $.ajax({
                    url: url_dosave_show,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
            //
            $("#dt_basic").on('click', '.btn-show', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.bShow = "change";
                $.ajax({
                    url: url_dosave_show,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            })
            //
            $("#dt_basic").on('click', '.btn-open', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.bOpen = "change";
                $.ajax({
                    url: url_dosave_show,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            })
            //
            $("#dt_basic").on('click', '.btn-del', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                swal({
                    title: "{{trans('_web_alert.del.title')}}",
                    text: "{{trans('_web_alert.del.note')}}",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "{{trans('_web_alert.cancel')}}",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{trans('_web_alert.ok')}}",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: url_dodel,
                        data: data,
                        type: "POST",
                        //async: false,
                        success: function (rtndata) {
                            if (rtndata.status) {
                                //toastr.success(rtndata.message,"{{trans('_web_alert.notice')}}")
                                swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                                setTimeout(function () {
                                    table.api().ajax.reload(null, false);
                                }, 100);

                            } else {
                                swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                            }
                        }
                    });
                });
            });
            //
            $(".btn-add").click(function () {
                location.href = url_add;
            });
            //
            $("#dt_basic").on('click', '.btn-edit', function () {
                var id = $(this).closest('tr').attr('id');
                location.href = url_edit + '/' + id;
            });
            //
            $("#dt_basic").on('click', '.btn-attributes', function () {
                var id = $(this).closest('tr').attr('id');
                location.href = url_attributes + '/' + id;
            });
            //
            $("#dt_basic").on('click', '.btn-spec', function () {
                var id = $(this).closest('tr').attr('id');
                location.href = url_specification + '/' + id;
            });
            //
            $("#dt_basic").on('click', '.btn-purchase', function () {
                var id = $(this).closest('tr').attr('id');
                location.href = url_purchase + '/' + id;
            });
            //
            $("#dt_basic").on('click', '.btn-recommend', function () {
                var id = $(this).closest('tr').attr('id');
                location.href = url_recommend + '/' + id;
            });
            //
            $("#dt_basic").on('click', '.btn-gifts', function () {
                var id = $(this).closest('tr').attr('id');
                location.href = url_gifts + '/' + id;
            });
            //
            $("#dt_basic").on('click', '.btn-appraise', function () {
                var id = $(this).closest('tr').attr('id');
                location.href = url_appraise + '/' + id;
            });
            //
            $("#dt_basic").on('click', '.btn-copy', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                swal({
                    title: "複製",
                    text: "複製",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "{{trans('_web_alert.cancel')}}",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{trans('_web_alert.ok')}}",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: url_docopy,
                        data: data,
                        type: "POST",
                        //async: false,
                        success: function (rtndata) {
                            if (rtndata.status) {
                                //toastr.success(rtndata.message,"{{trans('_web_alert.notice')}}")
                                swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                                setTimeout(function () {
                                    table.api().ajax.reload(null, false);
                                }, 100);

                            } else {
                                swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->