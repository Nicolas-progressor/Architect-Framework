<?php

/* 
 *                      ARCHITECT FRAMEWORK
 *                       statement system
 *      system: core
 */

namespace core;

class core_Statement {

    private static $instance = NULL;
    
    public static function &get_instance()
    {
	return self::$instance;        
    }
    
    private $hook = array();

    public $statement;
    private $ended = array();


    public function __construct() {
        self::$instance =& $this;
    }

    public static function load() {
        return new self();
    }

    public function register($statement, $class, $hook, $var = array()){
      if(in_array($statement, $this->ended)){           
          if(method_exists ($class, $hook)){            
                  call_user_func_array(array( $class, $hook), $var);       
          }
      } else {         
          $this->hook[$statement][] = array('class' => $class, 'hook' => $hook, 'var' => $var);
      }
    }

    public function run_state($statement){
      if(array_key_exists($statement, $this->hook)){
          $this->statement = $statement;
          $this->ended[] = $statement;     
          foreach ($this->hook[$statement] as $hook){
              if(method_exists ($hook['class'], $hook['hook'])){
                  call_user_func_array(array( $hook['class'], $hook['hook']), $hook['var']);       
              }
          }          
      }
    }

    public function state($statement){
          $this->statement = $statement;
          $this->ended[] = $statement;
    }
}