<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Group;

class CustomerController extends _GroupController
{
    public $module = [ 'admin', 'group', 'customer' ];
    public $iGroupType = 999;
    public $iAcType = 999;
}