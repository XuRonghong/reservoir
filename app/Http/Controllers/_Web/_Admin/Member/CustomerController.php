<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Member;

class CustomerController extends _MemberController
{
    public $module = [ 'admin', 'member', 'customer' ];
    public $iGroupType = 999;
    public $iAcType = 999;

}
