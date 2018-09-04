<script>
    var url_cancel = "{{ url('payservice/spgateway/cancel_service')}}";         //取消授權
    var url_paymoney = "{{ url('payservice/spgateway/request_pay_service')}}";  //請款
    var url_refunds = "{{ url('payservice/spgateway/refunds_service')}}";       //刷退退款
    //
    var url_invoice = "{{ url('payservice/pay2go/invoice_service')}}";          //電子發票

    //取消信用卡授權
    $("#dt_basic").on('click', '.btn-cancel', function () {
        var id = $(this).closest('tr').attr('id');
        var data = {
            "_token": "{{ csrf_token() }}"
        };
        swal({
            title: "進行取消授權",
            text: "只限信用卡付款方式",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "{{trans('_web_alert.cancel')}}",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{{trans('_web_alert.ok')}}",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: url_cancel + "/" + id,
                data: data,
                type: "POST",
                //async: false,
                success: function (rtndata) {
                    if (rtndata.status) {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                        setTimeout(function () {
                            table.api().ajax.reload();
                        }, 100);

                    } else {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                    }
                }
            });
        });
    })
    //信用卡請款，自動請款不用此功能
    $("#dt_basic").on('click', '.btn-paymoney', function () {
        var id = $(this).closest('tr').attr('id');
        var data = {
            "_token": "{{ csrf_token() }}"
        };
        swal({
            title: "進行請款",
            text: "進行請款",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "{{trans('_web_alert.cancel')}}",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{{trans('_web_alert.ok')}}",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: url_paymoney + "/" + id,
                data: data,
                type: "POST",
                //async: false,
                success: function (rtndata) {
                    if (rtndata.status) {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                        setTimeout(function () {
                            table.api().ajax.reload();
                        }, 100);

                    } else {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                    }
                }
            });
        });
    });
    //信用卡退款，刷退
    $("#dt_basic").on('click', '.btn-refunds', function () {
        var id = $(this).closest('tr').attr('id');
        var data = {
            "_token": "{{ csrf_token() }}"
        };
        swal({
            title: "進行退款",
            text: "進行退款",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "{{trans('_web_alert.cancel')}}",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{{trans('_web_alert.ok')}}",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: url_refunds + "/" + id,
                data: data,
                type: "POST",
                //async: false,
                success: function (rtndata) {
                    if (rtndata.status) {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                        setTimeout(function () {
                            table.api().ajax.reload();
                        }, 100);

                    } else {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                    }
                }
            });
        });
    })

</script>