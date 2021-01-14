<?php
namespace language;

class arc_redlang{
    
    private static $instance = NULL;
      
    public static function &get_instance()
    {
	return self::$instance;
    }
    
    public $lang;

    public function __construct() {           
        new \redlang_rte_rules();
        $this->lang = new \language();  
        
        self::$instance =& $this;
    }
    
    public static function load() {
        require_once __DIR__.'/rte_rules.php';
        require_once __DIR__.'/redlang.php';
           
        return new self();
    }      
    
    public function file($name = FALSE, $class = FALSE){        
        if (!$name) { return FALSE; }
        if($class){            
            if(is_object($class)){                
                if (file_exists($class->modulePath . 'lang/'.$name)){
                    $langDir = $class->modulePath . 'lang/'.$name;                       
                }
            } elseif (is_string($class)) {                  
                if (file_exists(\core\architect::$APP_DIR . 'modules/' . $class . '/lang/' . $name)){                
                    $langDir = \core\architect::$APP_DIR . 'modules/' . $class . '/lang/' . $name;                
                } elseif (file_exists(APP_DIR . 'modules/' . $class . '/lang/' . $name)) {
                     $langDir = APP_DIR . 'modules/' . $class . '/lang/' . $name;                   
                }
            }
        } elseif (file_exists(\core\architect::$APP_DIR . 'lang/' . $name)) {
            $langDir = \core\architect::$APP_DIR . 'lang/' . $name;   
        } elseif (file_exists(APP_DIR . 'lang/' . $name)) {
            $langDir = APP_DIR . 'lang/' . $name;   
        } else {
            return FALSE;
        }             
        $this->lang->loader($langDir);
    }
}