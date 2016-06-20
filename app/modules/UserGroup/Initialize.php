<?php
namespace UserGroup;
use \App;
use \Menu;
use \Route;
use \SlaxFramework\Module\Initializer;

class Initialize extends Initializer{
    public function getModuleName(){
        return 'UserGroup';
    }
    public function getModuleAccessor(){
        return 'usergroup';
    }
    public function registerPublicRoute()
    {
        Route::get('/user', 'UserGroup\Controllers\UserController:index');
    }
}