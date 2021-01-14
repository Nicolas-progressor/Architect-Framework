<?php

class redapps{
    
    private $config;
    
    public $app;
    public $appsdata;
    public $appdir;
    public $appBootstrap;
    public $appDefault;

    public function __construct() {        
        \core\architect::statement()->register('core_preinit', $this, 'getApp');
        \core\architect::statement()->register('core_preinit', $this, 'appLoader');
    }
    
    function getApp(){
        $this->config = \core\core_Config::getInstance('apps');
        $router = \core\architect::module('router');
        $this->appDefault = $this->config->default;
        if($this->config->apps){  
            foreach ($this->config->apps as $key => $app){
                $this->appsdata[$key]['name'] = $key;
                $this->appsdata[$key]['folder'] = $app;
                if(file_exists(APP_DIR . $app)){
                    $this->appsdata[$key]['path'] = APP_DIR . $app;
                }
            }
            
            if($this->config->app_routing){                
                if(isset($router->url->segments[0]) && property_exists($this->config->apps, $router->url->segments[0])){                      
                    $appseg = $router->url->segments[0];
                    \core\architect::$APP_DIR = APP_DIR.$this->config->apps->{$appseg} . '/';     
                    $this->app = $appseg;
                    $router->rules->addRule(array(
                        'id' => 0,
                        'rule' => 'app',
                        'remap' => TRUE
                    ));
                } else {
                    \core\architect::$APP_DIR = APP_DIR.$this->config->default . '/';
                }
            }
        } else {            
            \core\architect::$APP_DIR = APP_DIR.$this->config->default . '/';
        }
        $this->appdir = \core\architect::$APP_DIR;
    }
    
    function appLoader(){
        if(file_exists($this->appdir . 'bootstrap.php')){
            require_once $this->appdir . 'bootstrap.php';
            $this->appBootstrap = new \app\app_bootstrap();
        }
    }
    
   
}