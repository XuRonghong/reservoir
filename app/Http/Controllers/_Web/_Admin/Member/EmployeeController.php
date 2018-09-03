<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Member;

class EmployeeController extends _MemberController
{
    public $module = [ 'admin', 'member', 'employee' ];
    public $iGroupType = 3;
    public $iAcType = 31;
}
