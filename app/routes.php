<?php

foreach (Module::getModules() as $module) {
    $module->registerPublicRoute();
}

Route::get('/', 'HomeController:welcome');