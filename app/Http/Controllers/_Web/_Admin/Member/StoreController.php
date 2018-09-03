<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Member;

class StoreController extends _MemberController
{
    public $module = [ 'admin', 'member', 'store' ];
    public $iGroupType = 4;
    public $iAcType = 41;
}
