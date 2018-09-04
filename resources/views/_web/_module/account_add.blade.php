<!-- Modal -->
<div class="modal fade" id="add-modal-account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">{{trans('web.admin.member.add')}}</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.admin.group.type')}}</label>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <select class="form-control iGroupId" id="iGroupId">
                                <option value="0">--請選擇群組--</option>
                                @foreach($group as $key => $var)
                                    <option value="{{$var->iId}}">{{$var->vGroupName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.account')}}</label>
                        <div class="col-md-10">
                            <input class="form-control vAccount" placeholder="{{trans('web.account')}}" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.username')}}</label>
                        <div class="col-md-10">
                            <input class="form-control vUserName" placeholder="{{trans('web.admin.member.username')}}" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.password')}}</label>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <input class="form-control vPassword" placeholder="{{trans('web.password_input')}}" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.repassword')}}</label>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <input class="form-control vRePassword" placeholder="{{trans('web.repassword_input')}}" type="password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                <button type="button" class="btn btn-primary btn-doadd-account">{{trans('web.doadd')}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--  -->
<script type="text/javascript" src="/_assets/CryptoJS/rollups/md5.js"></script>
<script>
    $(document).ready(function () {
        var modal = $("#add-modal-account");
        //
        $(".btn-add-account").click(function () {
            modal.modal();
        });
        //
        modal.find(".btn-doadd-account").click(function () {
            $(this).prop('disabled', true);
            if (modal.find(".vAccount").val() == "") {
                $(this).prop('disabled', false);
                toastr.error("帳號不得為空", "{{trans('_web_alert.notice')}}")
                return false;
            }
            if (modal.find(".vUserName").val() == "") {
                $(this).prop('disabled', false);
                toastr.error("使用者名稱不得為空", "{{trans('_web_alert.notice')}}")
                return false;
            }
            if (modal.find(".vPassword").val() == "") {
                $(this).prop('disabled', false);
                toastr.error("密碼不得為空", "{{trans('_web_alert.notice')}}")
                return false;
            }
            var data = {"_token": "{{ csrf_token() }}"};
            data.iGroupId = modal.find(".iGroupId").val();
            data.vUserName = modal.find(".vUserName").val();
            data.vAccount = modal.find(".vAccount").val();
            //data.vPassword = CryptoJS.MD5(modal.find(".vPassword").val()).toString(CryptoJS.enc.Base64);
            // data.vRePassword = CryptoJS.MD5(modal.find(".vRePassword").val()).toString(CryptoJS.enc.Base64);
            data.vPassword = modal.find(".vPassword").val();
            data.vRePassword = modal.find(".vRePassword").val();
            if (data.vPassword != data.vRePassword) {
                $(this).prop('disabled', false);
                toastr.error("密碼不相符", "{{trans('_web_alert.notice')}}");
                return false;
            }
            $.ajax({
                url: url_doadd,
                type: "POST",
                data: data,
                success: function (rtndata) {
                    if (rtndata.status) {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                        setTimeout(function () {
                            location.href = rtndata.rtnurl;
                        }, 1000)
                    } else {
                        $(this).prop('disabled', false);
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                    }
                }
            });
        })
    });
</script>