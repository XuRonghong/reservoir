<script type="text/javascript">
    @if(Session::has('check_empty.message'))
        swal("{{trans('_web_alert.notice')}}", "{{Session::pull('check_empty.message')}}", "error");
    @if(Session::has('check_empty.url'))
        setTimeout(function () {
        location.href = "{{Session::pull('check_empty.url')}}";
    }, 1000);
    @endif
@endif
    $(document).ready(function () {
        //登出
        $(".logout").click(function () {
            swal({
                title: "{{trans('_web_alert.logout.title')}}",
                text: "{{trans('_web_alert.logout.note')}}",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "{{trans('_web_alert.logout.cancel')}}",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{trans('_web_alert.logout.ok')}}",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "{{url('doLogout')}}",
                    data: {"_token": "{{ csrf_token() }}"},
                    type: "POST",
                    async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.logout.success')}}", rtndata.message, "success");
                            setTimeout(function () {
                                location.href = "{{ url('')}}";
                            }, 1000);
                        } else {
                            swal("{{trans('_web_alert.logout.success')}}", rtndata.message, "error");
                        }
                    }
                });
            });
        });
        //logo
        $("#logo").click(function () {
            location.href = "{{url('')}}";
        });
        $(".logo_box").click(function () {
            location.href = "{{url('')}}";
        });
        //Search
        $(".btn-allsearch").click(function () {
            var keyword = $(".allkeyword").val();
            location.href = "{{url('search')}}?keyword=" + decodeURI(keyword);
        });
        //
        $(".btn-mem-cart").click(function () {
            location.href = "{{url('member_center/cart')}}";
        })
    });

    /* alert message */
    //modal_show({title: 'title', content: 'content'});
    function modal_show(obj) {
        var modal = $('#modal_alert');
        modal.find('#modal-title').html(obj.title);
        modal.find('#modal-content').html(obj.content);
        modal.modal('show');
    }

    //千分號
    function number_format(n) {
        n += "";
        var arr = n.split(".");
        var re = /(\d{1,3})(?=(\d{3})+$)/g;
        return arr[0].replace(re, "$1,") + (arr.length == 2 ? "." + arr[1] : "");
    }

    //全館搜尋
    function all_store_search() {
        var keyword = $("#keyword").val();
        location.href = "{{url('search')}}?kw=" + decodeURI(keyword);
    }
    //
    function website_share(type) {
        var url = location.href;
        switch (type) {
            case 'fb':
                window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                break;
            case 'gplus':
                window.open('https://plus.google.com/share?url=' + url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                break;
        }
    }
</script>