<?php
// debugbar()->meta($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Member;

class SupplierController extends _MemberController
{
    public $module = [ 'admin', 'member', 'supplier' ];
    public $iGroupType = 6;
    public $iAcType = 61;
}
