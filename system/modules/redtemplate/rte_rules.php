<?php

class redtemplate_rte_rules{
    
    private $config;
    private $router;
    
    public function __construct() {        
        \core\architect::statement()->register('core_init', $this, 'template_rules');
    }
    
    function template_rules(){
        $this->config = \core\core_Config::getInstance('template');
        $this->router = \core\architect::module('router');
        
        if(isset($_GET['arc_notemplate']) && $_GET['arc_notemplate'] == 'true' && $this->config->notemp_get){
            $this->router->rules->addRule(array(
                'noTempLoad' => TRUE
            ));
        }            
        
    }
    
}
