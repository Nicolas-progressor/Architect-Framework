<?php

/* 
 *                      ARCHITECT FRAMEWORK
 *                        Core Autoloader
 */

spl_autoload_register('CoreLoader');

Function CoreLoader($class_name){
    
     if ($lastNsPos = strrpos($class_name, '\\')) {
        $namespace = substr($class_name, 0, $lastNsPos);
        $class_name = substr($class_name, $lastNsPos + 1);
    }
    
    $class_name = mb_strtolower($class_name);
    $class_file = false;
   
    // core autoloader
    if ( mb_substr($class_name, 0, 5) == 'core_' ) {
        $class_name = mb_substr($class_name, 5);
        $class_file = SYS_DIR . 'core/' . $class_name . '/core.php';
    }
    
    // modules autoloader
    if ( mb_substr($class_name, 0, 4) == 'arc_' ) {
        $class_name = mb_substr($class_name, 4);
        $class_file = SYS_DIR . 'modules/' . $class_name . '/loader.php';
    }
    
    // unit autoloader
    if ( mb_substr($class_name, 0, 5) == 'unit_' ) {
        $class_name = mb_substr($class_name, 5);
        $class_file = SYS_DIR . 'unit/' . $class_name . '/control.php';
    }
        
    // Library autoloader
    if ( mb_substr($class_name, 0, 4) == 'lib_' ) {
        $class_name = mb_substr($class_name, 4);
        $class_file = SYS_DIR . 'library/' . $class_name . '/control.php';
    }
     
    if (!$class_file){ return false; }
    
    include_once $class_file;

    return true;    
}