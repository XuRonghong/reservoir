@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style>
        <!--
        .image-box>img {
            max-height: 300px;
        }
        -->
    </style>
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!--  -->
    <div id="content">
    <!-- Widget ID (each widget will need unique ID)-->

            <div  class="col-lg-12 col-md-12 col-sm-12">
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false"
                     data-widget-fullscreenbutton="false">
                    <!-- widget div-->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i></span>
                        <h2>{{trans('_menu.'.implode( '.', $module ).'.title')}}</h2>
                        <a class="btn btn-default btn-sm pull-left btn-add" style="margin-left:10px"><i class="fa fa-create"></i>{{trans('web.add')}}</a>
                    </header>
                    @foreach($banner as $key => $var)
                    <div data-id="{{$var->iId}}" class="banner-box">
                        <!-- widget content -->
                        <div class="widget-body">
                            <form>
                                <div class="form-group">
                                    <div>
                                        <input type="text" class="form-control vTitle" id="vTitle{{$key}}" placeholder="文字" value="{{$var->vTitle}}"/>
                                    </div>
                                </div>
                                <div class="form-group" style="min-height:300px;max-width:100%;">
                                    <label class="control-label col-md-1">PC</label>
                                    <div class="btn-image-modal col-md-5 vImages" data-modal="image-form"
                                         data-id="{{$var->vImages}}">
                                        @forelse($var->images as $key => $image)
                                            <div class="image-box">
                                                <img src="{{$image}}" id="Image">
                                            </div>
                                        @empty
                                            <div class="image-box">
                                                <img src="{{asset('images/empty.jpg')}}" id="Image">
                                            </div>
                                        @endforelse
                                    </div>
                                    <label class="control-label col-md-1">MOBILE</label>
                                    <div class="btn-image-mobile-modal col-md-5 vImagesMobile" data-modal="image-mobile-form"
                                         data-id="{{$var->vImagesMobile}}">
                                        @forelse($var->imagesMobile as $key => $image)
                                            <div class="image-box">
                                                <img src="{{$image}}" id="Image">
                                            </div>
                                        @empty
                                            <div class="image-box">
                                                <img src="{{asset('images/empty.jpg')}}" id="Image">
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </form>
                            <div class="widget-footer">
                                <button class="btn btn-sm btn-primary btn-save" type="button">
                                    Save
                                </button>
                                <button class="btn btn-sm btn-danger btn-del" type="button">
                                    Delete
                                </button>
                            </div>
                        </div>

                        <!-- end widget content -->
                    </div>
                    @endforeach
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </div>
    </div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!-- Public Crop_Image -->
    @include('_template_web._js.crop_image_single_modal_10001000')
    @include('_template_web._js.crop_image_single_modal_mobile_375x667')
    <!-- end -->
    <!--  -->
    <script>
        var url_doadd = "{{ url('web/'.implode( '/', $module ).'/doadd')}}";
        var url_dosave = "{{ url('web/'.implode( '/', $module ).'/dosave')}}";
        var url_dodel = "{{ url('web/'.implode( '/', $module ).'/dodel')}}";
        $(document).ready(function () {
            //
            $(".btn-image-modal .image-box").click(function () {
                current_modal = $(this);
            });
            //
            $(".btn-image-mobile-modal .image-box").click(function () {
                current_modal_mobile = $(this);
            });
            //
            // $("#setDrag").click(function () {
            //     // $("#Image").attr('id', "");
            //     // $("#Image-Mobile").attr('id', "");
            // });
            //
            $(".btn-add").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                $.ajax({
                    url: url_doadd,
                    type: "POST",
                    data: data,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            location.reload();
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
            //
            $(".btn-save").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                var obj = $(this).closest(".banner-box");
                data.iId = obj.data('id');
                data.vTitle = obj.find(".vTitle").val();
                data.vImages = obj.find(".vImages").data('id');
                obj.find('.vImages img').each(function () {
                    if ($(this).attr('id') != "Image" && $(this).attr('id')) {
                        data.vImages = /*data.vImages +*/ $(this).attr('id') + ";";
                    }
                });
                data.vImagesMobile = obj.find(".vImagesMobile").data('id');
                obj.find('.vImagesMobile img').each(function () {
                    if ($(this).attr('id') != "Image" && $(this).attr('id')) {
                        data.vImagesMobile = /*data.vImagesMobile*/ + $(this).attr('id') + ";";
                    }
                });
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
            //
            $(".btn-del").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                var obj = $(this).closest(".banner-box");
                data.iId = obj.data('id');
                $.ajax({
                    url: url_dodel,
                    type: "POST",
                    data: data,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            location.reload();
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });

        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
