<?php
// debugbar()->meta($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Group;

class BloggerController extends _GroupController
{
    public $module = [ 'admin', 'group', 'blogger' ];
    public $iGroupType = 5;
    public $iAcType = 51;
}
