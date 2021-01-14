<?php
namespace pattern;

class controller{
    
    public $module;
    public $className;
    public $name;
    public $classPath;
    public $modulePath;
    public $actionParameters = array();
    public $element;

    public $model;
    public $view;


    public function __construct($module, $className, $name, $classPathes) {     
        $this->module = $module;
        $this->className = $className;
        $this->name = $name;
        $this->classPath = $classPathes['full_path'];
        $this->modulePath = $classPathes['module_path'];
        $this->model = new \model($module);
        $this->view = new \view($this, $module);        
    }
    
    public function setModule($module) {
        $this->module = $module;
    }
    
    public function setModuleFromName($name) {
        $pattern = \core\architect::module('pattern');
        $this->module = $pattern->{$name};       
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function setClassPath($path) {
        $this->classPath = $path;
    }
    
    public function setActionParameters($action, $parameters) {        
        $this->actionParameters[$action] = $parameters;
    }
    
    public function addActionStates($name) {
        $parameters = array();  
        if(isset($this->actionParameters[$name])){            
            $parameters = $this->actionParameters[$name];
        }        
        $statements = \core\architect::get_instance()->statements;
        foreach ($statements as $state) {     
            $fname = $name.'_'.$state;
            if(method_exists($this, $fname)){
                 \core\architect::statement()->register($state, $this, $fname, $parameters);
            }
        }
    }    
}