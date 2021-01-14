<?php
namespace core;

class core_Connect{
        
    private $dbConfig;
    
    public $DB;

    public function __construct($dbname = FALSE, $dbengine = FALSE) {
        $this->dbConfig = $this->getConfig($dbname);
        $this->DB = $this->getEngine($dbengine);
        unset($this->dbConfig); 
    }

    public static function add($dbname = FALSE, $dbengine = FALSE) {
        $master = new self($dbname, $dbengine);
        return $master->DB;
    }
    
    function getConfig($dbname = FALSE) {
        $config = core_Config::getInstance();
        
        if(!$dbname){
            $dbname = $config->database->default->database;
        }
        $dbname = 'db_' . $dbname;        
        if(isset($config->{$dbname})){
            return $config->{$dbname};            
        } else {
            echo 'connection error: db config not defined';
        }
    }
    
    function getEngine($dbengine = FALSE){
        $config = core_Config::getInstance();
        
        if(!$dbengine){
            if(isset($this->dbConfig->engine)){
                $dbengine = $this->dbConfig->engine;
            } else {
                $config->database->default->engine;
            }
        }
        
        $engine = 'lib_' . $dbengine;        
        
        if($engine::$type == 'DB'){
            return $engine::db($this->dbConfig);
        } else {
            echo 'db engine error: lib is not db engine';
        }
           
    }
        
}