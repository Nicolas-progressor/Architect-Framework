<?php
namespace router;

class arc_redrouter{
        
    private static $instance = NULL;
    
    public static function &get_instance()
    {
	return self::$instance;
    }
    
    public $url;
    public $rules;

    public function __construct() {
               
        $this->url = new \red_url();
        $this->rules = new \red_rules();

        self::$instance =& $this;
    }
            
    public static function load() {
        require_once __DIR__.'/red_url.php';
        require_once __DIR__.'/red_rules.php';
        
        return new self();
    }

}