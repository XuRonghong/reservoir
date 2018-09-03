<?php

namespace App\Http\Controllers\_Portal\MemberCenter;

use App\Http\Controllers\_Portal\_PortalController;

class _MemberCenterController extends _PortalController
{
    protected $iId;     //key
    protected $iUserId;   //會員編號
    protected $vAccount;   //帳號名字
    protected $vUserName;    //會員姓名
    protected $vUserEmail;

    public function _set_member_data()
    {
        $this->iId = session( 'shop_member.iId' , 0 );
        $this->iUserId = session( 'shop_member.iUserId' , 0 );   //會員編號
        $this->vAccount = session( 'shop_member.vAccount' , '' );    //帳號名字
        $this->vUserName = session( 'shop_member.vUserName' , '無名氏' );    //會員姓名
        $this->vUserEmail = session( 'shop_member.info.vUserEmail' , '' );
    }
}
