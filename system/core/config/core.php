<?php
 
/* 
 *                      ARCHITECT FRAMEWORK
 *                       statement system
 *      system: core
 */

namespace core;
 
class core_Config{

    private $data = array();
    private $name = null;

    private static $instances = array();
    
    public static function getInstance($key = 'config'){
        if (!isset(self::$instances[$key])) {            
            self::$instances[$key] = new self($key);            
        }        
        return self::$instances[$key];
    }

    public function __construct($cfg_file='config'){
        $this->data = $this->load($cfg_file);
        $this->name = $cfg_file;
    }

    public function __get($name) {
                if (!isset($this->data->{$name})){ return false; }
        return $this->data->{$name};
    }
    
    public function __isset($name) {
                return isset($this->data->{$name});                 
    }
    
    public function __set($name, $value) {
        $this->data->{$name} = $value;        
    }
        
    public function load($cfg_file = 'config'){
        $cfg_file = $this->getCfgFilename($cfg_file);  
        if(file_exists($cfg_file)){
            $jdata = file_get_contents($cfg_file);
            $data = json_decode($jdata);
            return $data;
        } else {
            return FALSE;
        }
    }
    
    public function save($to_app = false) {
        $cfg_file = APP_DIR . '/config/' . $this->name . '.json';
        $jdata = json_encode($this->data, JSON_PRETTY_PRINT);
        file_put_contents($cfg_file, $jdata);
    }
    
    public function getCfgFilename($name) {
        $filename = FALSE;
            if(file_exists(\core\architect::$APP_DIR . 'config/' . $name . '.json')) {                  
                $filename = \core\architect::$APP_DIR . 'config/'. $name . '.json';
            } elseif(file_exists( APP_DIR . 'config/' . $name . '.json')){                
                $filename = APP_DIR . 'config/' . $name . '.json';
            }           
        return $filename;
    }
}

?>