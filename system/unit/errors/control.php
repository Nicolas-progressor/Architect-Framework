<?php
namespace errors;

class unit_Errors{
  
    public static function get($code) {
            self::appError($code);
    }

    public static function custom($type, $title, $text) {
        $pattern = \core\architect::module('pattern');
        
        if($pattern->getModule('errors')){
        $setup = array(
            'module' => 'errors',
            'type' => 'widget',
            'controller' => 'custom',
            'action' => $type,
            'parameters' => array('title' => $title, 'text' => $text)
        );
            $pattern->loadControllerArray($setup); 
        } else {
            if(file_exists('html/custom.php')){
                include 'html/custom.php';   
            }
        }
    }
    
    public static function appError($code){
        $pattern = \core\architect::module('pattern');
                    
       if($pattern->getModule('errors')){
            $setup = array(
                'module' => 'errors',
                'type' => 'widget',
                'controller' => 'error',
                'action' => 'error',
                'parameters' => array('code' => $code)
            );            
            $pattern->loadControllerArray($setup); 
        } else {            
            if(file_exists(__DIR__.'/html/'. $code .'.php')){
                include __DIR__.'/html/'. $code .'.php';   
            }
        }
    }
}
