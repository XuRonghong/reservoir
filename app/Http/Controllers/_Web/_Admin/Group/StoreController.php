<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Group;


class StoreController extends _GroupController
{
    public $module = [ 'admin', 'group', 'store' ];
    public $iGroupType = 4;
    public $iAcType = 41;
}