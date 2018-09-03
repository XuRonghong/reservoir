<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Member;

class BloggerController extends _MemberController
{
    public $module = [ 'admin', 'member', 'blogger' ];
    public $iGroupType = 5;
    public $iAcType = 51;
}
