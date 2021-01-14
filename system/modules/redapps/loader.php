<?php
namespace apps;

class arc_redapps{
    
    private static $instance = NULL;
      
    public static function &get_instance()
    {
	return self::$instance;
    }
    
    public $apps;

    public function __construct() {           
        $this->apps = new \redapps();  
        
        self::$instance =& $this;
    }
    
    public static function load() {
        require_once __DIR__.'/redapps.php';
           
        return new self();
    }      
    
    public function get_apps() {
        return $this->apps->appsdata;
    }
    
    public function get_default() {
        return $this->apps->appDefault;
    }
    
    public function get_app($app) {
        return $this->apps->appsdata[$app];        
    }
}