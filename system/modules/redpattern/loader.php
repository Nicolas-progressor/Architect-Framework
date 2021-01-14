<?php
namespace pattern;

class arc_redpattern{
    
    private static $instance = NULL;
    
    public static function &get_instance()
    {
	return self::$instance;
    }
    
    private $router;


    public function __construct() {     
        $this->router = \core\architect::module('router');
        new \redpattern_rte_rules();      
        self::$instance =& $this;
    }
    
    public static function load() {
        require_once __DIR__.'/rte_rules.php';
        require_once __DIR__.'/module.php';
        require_once __DIR__.'/controller.php';
        require_once __DIR__.'/model.php';
        require_once __DIR__.'/view.php';
        
        return new self();
    }
            
    public function loadControllerArray($setup){  
        $type = 'controller';
        $register_rc = array();
        if (isset($setup['module'])) {
            if(!isset($this->{$setup['module']})){
                $this->addModule($setup['module']);                
            }            
            $register_rc['module'] = $setup['module'];
        }
        if(isset($setup['type'])){
            $type = $setup['type'];            
        }
        if(isset($setup['controller']) && !empty($register_rc['module'])){
            if(!isset($this->{$register_rc['module']}->{$setup['controller']})){
                $this->{$register_rc['module']}->addController($setup['controller'], $type);
                $register_rc['controller'] =  $setup['controller'];
            }                     
        }       
        if(!isset($setup['action'])){
            $setup['action'] = 'index';
        }
        if(isset($setup['action']) && !empty($register_rc['controller'])){  
            if(isset($setup['parameters'])){
                $this->{$register_rc['module']}->{$register_rc['controller']}->setActionParameters($setup['action'], $setup['parameters']);    
            }
            if(method_exists($this->{$register_rc['module']}->{$register_rc['controller']}, "addActionStates")){
                $this->{$register_rc['module']}->{$register_rc['controller']}->addActionStates($setup['action']);        
                $register_rc['action'] = $setup['action'];
            } else {
                return FALSE;
                //TODO прикрутить к дебагеру
            } 
        }  
        if(isset($setup['element']) && !empty($register_rc['module']) && !empty($register_rc['controller'])){            
            $this->{$register_rc['module']}->{$register_rc['controller']}->element = $setup['element'];
        }
        return $register_rc;
    }
    
    public function getModule($name) {
        if(isset($this->{$name})){
            return $this->{$name};
        } else {
            $this->addModule($name);
            return $this->{$name};
        }
    }
    
    public function addModule($name) {
        $this->{$name} = new \pattern\module($name);              
    }
}
