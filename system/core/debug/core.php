<?php

namespace core;

class core_Debug {
    
    private static $instance = NULL;
    private $config;


    public static function &get_instance(){
	return self::$instance;        
    }
    
    public function __construct() {
        $this->config = \core\core_Config::getInstance('debug');
        self::$instance =& $this;
    }
    
    public static function load() {
        return new self();
    }
    
    private $log = array();
    
    public function add($type, $message, $where = FALSE){        
        $types = array('info', 'error', 'warning', 'notification');
        if(in_array($type, $types)){
            if($where){
                $this->addLog($type, $message, $where);            
            } else {
                $this->addLog($type, $message, 'undefined');      
            }            
        } elseif ($type == 'log') {
            if($where){
                $this->addLog('LogMessage', $message, $where);
            } else {
                $this->addLog('LogMessage', $message, 'undefined');
            }           
        }
    }
    
    private function addLog($type, $message, $where){
        $this->log[$type][$where][] = array(
            "timestamp" => date("Y-m-d H:i:s"),
            "type" => $type,
            "message" => $message, 
            "where" => $where
        );
    }


    public function get($type, $where = FALSE){
        $types = array('info', 'error', 'warning', 'notification');
        if($type){
            if(in_array($type, $types)){
                if($where){    
                    return $this->log[$type][$where];
                } else {
                    $marr = array();
                    foreach ($this->log[$type] as $tkey => $tval){
                        foreach ($tval as $mval){
                            $mval['where'] = $tkey;
                            $marr[] = $mval;         
                        }
                    }
                    return $marr;
                }
            }
        }
    }
      
    
    //TODO: сделать ф-цию сохранения в файл. ф-цию автоматического сохранения в файл, если это задано в конфиг файле.
}