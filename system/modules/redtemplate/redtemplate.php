<?php

class template{
    private $config;
    private $router;
    private $pattern;

    private $name;
    private $template_path;
    
    private $routeController;
    private $elements;
    
    public $template_selected;
    
    public $echoes;

    public function __construct() {                
        \core\architect::statement()->register('core_load', $this, 'bootstrap');
        \core\architect::statement()->register('render', $this, 'render');
    }
    
    function bootstrap(){
        $this->config = \core\core_Config::getInstance('template');
        $this->router = \core\architect::module('router');
        $this->pattern = \core\architect::module('pattern');
        if(!empty($this->template_selected)){ 
            $this->name = $this->template_selected;
        } elseif (isset($this->router->rules->selectTemplate) && !empty($this->router->rules->selectTemplate)) {
            $this->name = $this->router->rules->selectTemplate;
        }else {
            $this->name = $this->config->template;
        }
        if(isset($this->router->rules->NoTempload) && $this->router->rules->NoTempload == 'true'){
            $this->routeController = $this->routeController();   
            
        } else {
            $this->template_path = $this->getTemplatePatch();
            $this->loadElements();              
            $this->pattern->template = $this->name;
            $this->routeController = $this->routeController();          
        }
    }
    
    public function element($name){
        if(isset($this->elements[$name])){
            $element = $this->elements[$name];
            if(isset($this->pattern->{$element['register_rc']['module']}->{$element['register_rc']['controller']})) {
                if(!empty($this->pattern->{$element['register_rc']['module']}->{$element['register_rc']['controller']}->view->filename)) {
                    $this->pattern->{$element['register_rc']['module']}->{$element['register_rc']['controller']}->view->capture();            
                }
            }
        }
    }

    public function getContent() {
        if(isset($this->echoes['top'])){
            foreach ($this->echoes['top'] as $echo){
                if(!empty($this->pattern->{$echo['module']}->{$echo['controller']}->view->filename)) {
                    $this->pattern->{$echo['module']}->{$echo['controller']}->view->capture();  
                }
            }
        }    
        
        $register_rc = $this->routeController;
        if(!empty($this->pattern->{$register_rc['module']}->{$register_rc['controller']})){
            if(!empty($this->pattern->{$register_rc['module']}->{$register_rc['controller']}->view->filename)) {
                $this->pattern->{$register_rc['module']}->{$register_rc['controller']}->view->capture();  
            }           
        }  
        
        if(isset($this->echoes['bottom'])){
            foreach ($this->echoes['bottom'] as $echo){
                if(isset($this->pattern->{$echo['module']}->{$echo['controller']}->view->filename)) {
                    $this->pattern->{$echo['module']}->{$echo['controller']}->view->capture();  
                }
            }
        }    
    }
    
    public function addEcho($setup) {
        $position = 'top';
        if(isset($setup['position'])){
            $position = $setup['position'];
        }
        if(isset($setup['module']) && isset($setup['controller'])){
            $this->echoes[$position][] = $setup;
        }
    }
    
    function getTemplatePatch(){

        $assets_url = ASSETS_URL . 'template/' . $this->name  . '/';  
        if(file_exists(APP_DIR . 'template/' . $this->name  . '/')){            
            $this->path = APP_DIR . 'template/' . $this->name  . '/';  
        }
        if(file_exists(\core\architect::$APP_DIR . 'template/' . $this->name  . '/')){            
            $this->path = \core\architect::$APP_DIR . 'template/' . $this->name . '/';                   
        }
        
        define('TEMP_URL', $assets_url);
        define('TEMP_DIR', $this->path);
                
        $tempPatch = TEMP_DIR.'template.php'; 
        return $tempPatch;     
    }
     
    function loadElements() {
        $main_elements_file = TEMP_DIR . 'elements.php';      
        if (file_exists($main_elements_file)){
           $elements = include $main_elements_file;      
        } else {
           $elements = false;    
        }    
        $route_elements_file = TEMP_DIR . 'elements' . '/' . $this->router->rules->module . '.php';
        if (file_exists($route_elements_file)){                    
            $route_elements = include $route_elements_file;            
            if(isset($route_elements['all'])){$elements = array_merge($elements, $route_elements['all']);}
            if(isset($route_elements[$this->router->rules->controller])){
                if(isset($route_elements[$this->router->rules->controller]['all'])){
                    $elements = array_merge($elements, $route_elements[$this->router->rules->controller]['all']);                    
                }         
                if(isset($route_elements[$this->router->rules->controller][$this->router->rules->action])){
                    $elements = array_merge($elements, $route_elements[$this->router->rules->controller][$this->router->rules->action]);
                }
            }            
        }        
        $this->elements = $elements;
        $this->CreateElementControllers();
    }
    
    public function routeController() {        
        $setup['module'] = $this->router->rules->module;
        $setup['controller'] = $this->router->rules->controller;
        $setup['action'] = $this->router->rules->action;
        $setup['element'] = 'content';        
        if(isset($this->router->rules->controllerType)){
            $setup['type'] = $this->router->rules->controllerType;
        }
        if(isset($this->router->rules->controllerParameters)){
            $setup['parameters'] = $this->router->rules->controllerParameters;
        }
        return $this->pattern->loadControllerArray($setup);
    }
    
    function CreateElementControllers(){
        if($this->elements){
            foreach ($this->elements as $key => $element){      
                    if(isset($element['module'])){$setup['module'] = $element['module'];} else { $setup['module'] = NULL; }
                    if(isset($element['type'])){$setup['type'] = $element['type'];} else { $setup['type'] = NULL; }
                    if(isset($element['controller'])){$setup['controller'] = $element['controller'];} else { $setup['controller'] = NULL; }
                    if(isset($element['action'])){$setup['action'] = $element['action'];} else { $setup['action'] = NULL; }
                    $setup['element'] = $key;
                    
                    $register_rc = $this->pattern->loadControllerArray($setup);
                    $this->elements[$key]['register_rc'] = $register_rc;
            }       
        }
    }
    
    public function render(){
        if (file_exists($this->template_path)){     
            include_once $this->template_path; 
        } else {
            if(!isset($this->router->rules->NoTempload) && $this->router->rules->NoTempload != 'true'){
                echo 'Template rendering error';
            } 
        }
    }
}