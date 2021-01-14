<?php
namespace template;

class arc_redtemplate{
    
    private static $instance = NULL;
    
    public static function &get_instance()
    {
	return self::$instance;
    }
    
    public function __construct() {           
        new \redtemplate_rte_rules();
        $this->template = new \template;
        
        self::$instance =& $this;
    }
    
    public static function load() {
        require_once __DIR__.'/rte_rules.php';
        require_once __DIR__.'/redtemplate.php';
        
        return new self();
    }
    
    public function selectTemplate($name) {
        $this->template->template_selected = $name;
    }
        
}

