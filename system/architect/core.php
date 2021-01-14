<?php
namespace core;
 
class architect{
        
    private static $instance = NULL;

    public static function &get_instance()
    {
	return self::$instance;
    }
    
    public $statements;
    public $modules;
       
    public static $APP_DIR = APP_DIR;

    public function __construct() {
        \core\core_Statement::load();       
        \core\core_Debug::load();
        
        self::$instance =& $this;
    }
    
    public function load_statements() {   
        $statements = include_once SYS_DIR . 'architect/statements.php';
        $this->statements = $statements;
        foreach ($statements as $statement) {
            $this->statement()->run_state($statement);
        }
    }
        
    public function load_core_modules() { 
        $this->modules = include SYS_DIR . 'architect/modules.php';      
        foreach ($this->modules as $module => $name){
            if(class_exists('\\' . $module . '\\' . $name)){
                call_user_func(array('\\' . $module . '\\' . $name, 'load'));
            } else {
                
            }
        }
    }
            
    public static function statement() {
        return \core\core_Statement::get_instance();
    }
    
    public static function module($name){
        if(class_exists('\\' . $name . '\\' . architect::get_instance()->modules[$name])){
            return call_user_func(array('\\' . $name . '\\' . architect::get_instance()->modules[$name], 'get_instance'));
        } else {
            return FALSE;
        }
    }
}
