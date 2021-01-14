<?php
namespace plugins;

class arc_redplugins{
    
    private static $instance = NULL;
    
    public static function &get_instance()
    {
	return self::$instance;
    }
    
    public $plugin;
    
    public function __construct() {                
        $this->plugin = new \plugin;
        
        self::$instance =& $this;
    }
    
    public static function load() {
        require_once __DIR__.'/instruments.php';        
        require_once __DIR__.'/plugin.php';
        
        return new self();
    }
}