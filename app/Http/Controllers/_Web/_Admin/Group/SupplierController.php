<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Group;


class SupplierController extends _GroupController
{
    public $module = [ 'admin', 'group', 'supplier' ];
    public $iGroupType = 6;
    public $iAcType = 61;
}