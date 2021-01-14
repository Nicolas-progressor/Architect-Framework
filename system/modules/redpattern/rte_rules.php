<?php

class redpattern_rte_rules{
    private $router;
    
    public function __construct() {
        $this->router = \core\architect::module('router');
        
        \core\architect::statement()->register('core_init', $this, 'module_rules');
        \core\architect::statement()->register('core_init', $this, 'controller_rules');
        \core\architect::statement()->register('core_init', $this, 'RouteFile');
        \core\architect::statement()->register('core_init', $this, 'query_rules');
    }
    
    public function module_rules() {
        $config = \core\core_Config::getInstance('router');
        if(empty($this->router->url->segments[0]) || $this->router->url->segments[0] == 'index'){
            $this->router->url->segments[0] = $config->default->route;
        }
        
        $this->router->rules->addRule(array(
            'id' => 0,
            'rule' => 'module'
        ));
        
    }
    
    public function controller_rules() {
        if(empty($this->router->url->segments[1])){
            $this->router->url->segments[1] = 'index';
        }
        if(empty($this->router->url->segments[2])){
            $this->router->url->segments[2] = 'index';
        }        
        $this->router->rules->addRule(array(
            'id' => 1,
            'rule' => 'controller'
        ));
        $this->router->rules->addRule(array(
            'id' => 2,
            'rule' => 'action'
        ));
    }
    
    public function RouteFile($filename = NULL){
        if(!$filename){
            $filename = $this->router->rules->module;
        }
        $rte_file = \core\architect::$APP_DIR  . 'routes/' . $filename . '.json';

        if (file_exists($rte_file)){
            $jdata = file_get_contents($rte_file);
            $data = json_decode($jdata);            
            $fileAction = $this->router->rules->controller;
            $this->router->rules->tl_seg = 0;
            if($data->toDefault == TRUE && isset($data->default)){   
                $fileAction = $data->default;                   
                if(isset($data->routes->{$data->default}->module)){
                    $this->router->rules->module = $data->routes->{$data->default}->module;
                } 
                if(isset($data->routes->{$data->default}->controller)){
                    $this->router->rules->controller = $data->routes->{$data->default}->controller;
                } 
                if(isset($data->routes->{$data->default}->action)){
                    $this->router->rules->action = $data->routes->{$data->default}->action;
                }   
                if(isset($data->routes->{$data->default}->NoTempload) && $data->routes->{$data->default}->NoTempload == TRUE){
                    $this->router->rules->NoTempload = 'true';
                }
            } else {               
                if(property_exists($data->routes, $fileAction)){      
                   $this->router->rules->tl_seg = 1;                   
                } else {                    
                    if(isset($data->default)){
                        $fileAction = $data->default;
                    } else {                        
                         \errors\unit_Errors::get('404');      
                    }
                }                                    
                if(isset($data->routes->{$fileAction}->module)){
                    $this->router->rules->module = $data->routes->{$fileAction}->module;
                } 
                if(isset($data->routes->{$fileAction}->controller)){                        
                    $this->router->rules->controller = $data->routes->{$fileAction}->controller;
                } 
                if(isset($data->routes->{$fileAction}->action)){
                    $this->router->rules->action = $data->routes->{$fileAction}->action;
                }   
                if(isset($data->routes->{$fileAction}->NoTempload) && $data->routes->{$fileAction}->NoTempload == TRUE){
                    $this->router->rules->NoTempload = 'true';
                }
            }            
            if(isset($data->routes->{$fileAction}->var_remap) && $data->routes->{$fileAction}->var_remap){
               $this->router->rules->last_seg = $this->router->rules->tl_seg;             
            }           
        }
    }
    
    public function query_rules() {
        $config = \core\core_Config::getInstance('query');
        if($config->cpu == TRUE){
            
            $this->router->rules->segVar = array_slice($this->router->url->segUrl, $this->router->rules->last_seg + $this->router->rules->seg_steps + 1);
        } 
    }
}
