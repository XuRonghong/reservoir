<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Group;

class EmployeeController extends _GroupController
{
    public $module = [ 'admin', 'group', 'employee' ];
    public $iGroupType = 3;
    public $iAcType = 31;
}
