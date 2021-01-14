<?php

/* 
 *                  ARCHITECT RED FRAMEWORK
 *        Hierarchical architectured framework.
 *                     alpha build
 */

// Define debug
define('DEBUG', true);

// Define root dirs
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('SYS_ROOT_DIR', realpath(dirname(__FILE__)."/../") . '/');
define('SYS_DIR', realpath(dirname(__FILE__)."/../") . '/system/');
define('APP_DIR', SYS_ROOT_DIR .'app/');
define('SUB_DIR', basename(__DIR__));
define('ASSETS_PATH', ROOT_DIR .  'assets/');

// Define root urls
define('SCRIPT_URL', $_SERVER['PHP_SELF']);
define('ROOT_URL', '//'.$_SERVER['HTTP_HOST'].'/');
define('ASSETS_URL', '//'.$_SERVER['HTTP_HOST'].'/' . 'assets/');

// system variables for log etc
$start = microtime(true);
$memoryLimit = ini_get("memory_limit");

// set encoding
mb_internal_encoding('UTF-8');

// start session
session_start();

// composer
if(file_exists(SYS_ROOT_DIR.'vendor/autoload.php')){
    require_once SYS_ROOT_DIR.'vendor/autoload.php';
}

// autoloader
require_once SYS_DIR . 'core/autoloader.php';

// architect core
require_once SYS_DIR . 'architect/core.php';

// if debug is true, init log system
if(DEBUG){
//    $log = core_logger::getInstance();

//    $log->info('start');
//    $log->info('memory_limit: ' . $memoryLimit);
}
// bootstrap
$core = new core\architect();

$core->load_core_modules();
$core->load_statements();

// if debug is true, out log
if(DEBUG){
//    $log->info('memory usage in peak: '.round(memory_get_peak_usage() / 1024));
//    $log->info('total script time: '.round(microtime(true) - $start, 4).'sec.');
}