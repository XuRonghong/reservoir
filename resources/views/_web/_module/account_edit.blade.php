<!-- Modal -->
<div class="modal fade" id="edit-modal-account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">{{trans('web.admin.member.edit')}}</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.admin.group.type')}}</label>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <select class="form-control iGroupId" id="iGroupId">
                                <option value="0">--請選擇部門--</option>
                                @foreach($group as $key => $var)
                                    <option value="{{$var->iId}}">{{$var->vGroupName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.admin.member.username')}}</label>
                        <div class="col-md-10">
                            <input class="form-control vUserName" placeholder="{{trans('web.admin.member.username')}}" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.admin.member.username_en')}}</label>
                        <div class="col-md-10">
                            <input class="form-control vUserNameE" placeholder="{{trans('web.admin.member.username_en')}}" type="text">
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-2 control-label">{{trans('web.admin.member.user_title')}}</label>--}}
                        {{--<div class="col-md-10">--}}
                            {{--<input class="form-control vUserTitle" placeholder="{{trans('web.admin.member.user_title')}}" type="text">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-2 control-label">{{trans('web.admin.member.user_id')}}</label>--}}
                        {{--<div class="col-md-10">--}}
                            {{--<input class="form-control vUserID" placeholder="{{trans('web.admin.member.user_id')}}" type="text">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-2 control-label">{{trans('web.admin.member.user_birthday')}}</label>--}}
                        {{--<div class="col-md-10">--}}
                            {{--<input class="form-control datepicker iUserBirthday" data-dateformat="yy/mm/dd"--}}
                                   {{--placeholder="{{trans('web.admin.member.user_birthday')}}" type="text">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.admin.member.user_email')}}</label>
                        <div class="col-md-10">
                            <input class="form-control vUserEmail" placeholder="{{trans('web.admin.member.user_email')}}" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.admin.member.user_contact')}}</label>
                        <div class="col-md-10">
                            <input class="form-control vUserContact" placeholder="{{trans('web.admin.member.user_contact')}}" type="text">
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-2 control-label">{{trans('web.admin.member.user_zipcode')}}</label>--}}
                        {{--<div class="col-md-10">--}}
                            {{--<input class="form-control vUserZipCode" placeholder="{{trans('web.admin.member.user_zipcode')}}" type="text">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-2 control-label">{{trans('web.admin.member.user_city')}}</label>--}}
                        {{--<div class="col-md-10">--}}
                            {{--<input class="form-control vUserCity" placeholder="{{trans('web.admin.member.user_city')}}" type="text">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-2 control-label">{{trans('web.admin.member.user_area')}}</label>--}}
                        {{--<div class="col-md-10">--}}
                            {{--<input class="form-control vUserArea" placeholder="{{trans('web.admin.member.user_area')}}" type="text">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('web.admin.member.user_address')}}</label>
                        <div class="col-md-10">
                            <input class="form-control vUserAddress" placeholder="{{trans('web.admin.member.user_address')}}" type="text">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                <button type="button" class="btn btn-primary btn-dosave-account">{{trans('web.dosave')}}</button>
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
        var modal = $("#edit-modal-account");
        //
        $("#dt_basic").on('click', '.btn-edit-account', function () {
            var id = $(this).closest('tr').attr('id');
            modal.data('id', id);
            modal.find(".iGroupId").val(current_data[id].group[0].iGroupId);
            modal.find(".vUserName").val(current_data[id].vUserName);
            modal.find(".vUserNameE").val(current_data[id].vUserNameE);
            modal.find(".vUserTitle").val(current_data[id].vUserTitle);
            modal.find(".vUserID").val(current_data[id].vUserID);
            modal.find(".iUserBirthday").val(current_data[id].iUserBirthday);
            modal.find(".vUserEmail").val(current_data[id].vUserEmail);
            modal.find(".vUserContact").val(current_data[id].vUserContact);
            modal.find(".vUserZipCode").val(current_data[id].vUserZipCode);
            modal.find(".vUserCity").val(current_data[id].vUserCity);
            modal.find(".vUserArea").val(current_data[id].vUserArea);
            modal.find(".vUserAddress").val(current_data[id].vUserAddress);
            modal.modal();
        })
        //
        $(".btn-dosave-account").click(function () {
            var data = {"_token": "{{ csrf_token() }}"};
            data.iId = modal.data('id');
            data.iGroupId = modal.find('.iGroupId').val();
            data.vUserName = modal.find('.vUserName').val();
            data.vUserNameE = modal.find('.vUserNameE').val();
            data.vUserTitle = modal.find('.vUserTitle').val();
            data.vUserID = modal.find('.vUserID').val();
            data.iUserBirthday = modal.find('.iUserBirthday').val();
            data.vUserEmail = modal.find('.vUserEmail').val();
            data.vUserContact = modal.find('.vUserContact').val();
            data.vUserZipCode = modal.find('.vUserZipCode').val();
            data.vUserCity = modal.find('.vUserCity').val();
            data.vUserArea = modal.find('.vUserArea').val();
            data.vUserAddress = modal.find('.vUserAddress').val();
            $.ajax({
                url: url_dosave,
                type: "POST",
                data: data,
                resetForm: true,
                success: function (rtndata) {
                    if (rtndata.status) {
                        modal.modal('toggle');
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                        setTimeout(function () {
                            $('#dt_basic').dataTable().api().ajax.reload(null, false);
                        }, 1000)
                    } else {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                    }
                }
            });
        });
    });
</script>