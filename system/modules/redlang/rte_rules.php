<?php

class redlang_rte_rules{
    
    private $config;
    private $router;
    
    public function __construct() {
        $this->config = \core\core_Config::getInstance('lang');
        $this->router = \core\architect::module('router');
        
        \core\architect::statement()->register('core_preinit', $this, 'language_rules');
    }
    
    public function language_rules() {              
        if(isset($this->router->url->segments[0]) && 
            $this->config->routing->enable_lang_routing == TRUE &&
            property_exists($this->config->all_langs, $this->router->url->segments[0])){            
            if($this->config->redirect->enabled){       
                if(isset($this->router->rules->last_seg)){                    
                    $this->router->rules->seg_steps++;
                }
                $lang_redirect = $this->langRedirect($this->router->url->segments[0]);
                if($lang_redirect){
                    $this->router->url->segments[0] = $lang_redirect;
                }               
            }   
            $this->router->rules->addRule(array(
                'id' => 0,
                'rule' => 'lang',
                'remap' => TRUE
            ));           
        }
       
        if(isset($_COOKIE['arcLang']) && isset($this->router->rules->lang) && $this->router->rules->lang != $_COOKIE['arcLang']){            
            $_COOKIE['arcLang'] = $this->router->rules->lang;
            if ($this->config->cookies->setup_cookie == TRUE && $this->config->cookies->routing_cookie == TRUE){
                setcookie('arcLang', $this->router->rules->lang, $this->config->cookies->cookie_lifetime, '/');
            } 
        }
    }
    
    function langRedirect($lang) {
        foreach ($this->config->redirect->rules as $key => $rule){              
            if(array_search($lang, (array)$rule) !== FALSE){
                return $key;
            }
        }        
    }
}