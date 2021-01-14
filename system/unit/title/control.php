<?php

class unit_Title{
    
    private static $Instance;
    
    public static function getInstance(){
       if (self::$Instance === null){
           self::$Instance = new self;
       }
       return self::$Instance;       
    }  
    
    private $title;
    
    public function __construct() {
        $config = \core\core_Config::getInstance('title');
        $this->title = $config->title;
    }
    
    public function rename($title) {
        $this->title = $title;
    }
    
    public function Add($title){       
        $this->title .= $title;
    }
    
    public function Get(){
        return $this->title;
    }
}