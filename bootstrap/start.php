<?php

session_cache_limiter(false);
session_start();

define('ROOT_PATH', __DIR__.'/../');
define('VENDOR_PATH', __DIR__.'/../vendor/');
define('APP_PATH', __DIR__.'/../app/');
define('MODULE_PATH', __DIR__.'/../app/modules/');
define('PUBLIC_PATH', __DIR__.'/../public/');
define('BOOTSTRAP_PATH', __DIR__.'/../bootstrap/');
define('STORAGE_PATH', __DIR__.'/../storage/');

require VENDOR_PATH.'autoload.php';

/**
 * Load Configuration
 */
$config = array(
    'path.root'      => ROOT_PATH,
    'path.public'    => PUBLIC_PATH,
    'path.app'       => APP_PATH,
    'path.module'    => MODULE_PATH,
    'path.bootstrap' => BOOTSTRAP_PATH,
);

foreach(glob(APP_PATH.'config/*.php') as $file){
    require $file;
}

/**
 * Merge cookies config to slim config
 */
if(isset($config["cookies"])){
    foreach($config["cookies"] as $key => $val){
        $config["slim"]["cookies.".$key] = $val;
    }
}

/**
 * Initialize Slim
 */
$app = new \Slim\Slim($config["slim"]);

/**
 * Initialize Framework
 */
$framework = new \SlaxFramework\Framework\Framework($app);
$framework->setConfig($config);

$framework->boot();

foreach(glob(MODULE_PATH.'*') as $module)
{
    $className = basename($module);
    $moduleBootstrap = "\\$className\\Initialize";

    $app->module->register(new $moduleBootstrap);
}
$app->module->boot();

require APP_PATH.'routes.php';

return $framework;