<?php
namespace breadcrumbs;

class unit_Breadcrumbs{
    
    public static $moduleName = "breadcrumbs";
    public static $widgetName = "breadcrumbs";
    
    public static function add($crumb, $href = NULL, $active = FALSE) {     
        $set_arr = array('text' => $crumb, 'href' => $href);
        if($active){$set_arr['active'] = TRUE;}
        
        $moduleName = self::$moduleName;
        $widgetName = self::$widgetName;
        
        \core\architect::module('pattern')->{$moduleName}->{$widgetName}->crumbs[] = $set_arr;
    }
    
}