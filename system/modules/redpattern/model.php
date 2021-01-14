<?php

class model{
    
    public $module;
    public $modulePath;

    public function __construct($module) {
        $this->module = $module;
    }
    
    public function load($name)
    {        
        $name = strtolower($name);                   
        $filename = self::setFilename($name);                   
        if (file_exists($filename)){ require_once($filename); } 
        else { echo 'Error loading model file, check filename.'; }
        $className = '\\'.  $this->module->name . '\\model\\' . $name;        
        
        if (class_exists($className)){
            if (!isset($this->{$name})){ $this->{$name} = new $className; }
                $this->{$name}->modulePath = $this->modulePath;
                return $this->{$name};
        } else {return 'error'; }                     
    }        
    
    function setFilename($filename) {   
        
        if (file_exists($this->module->app_path . 'model/'.$filename.'.php')){
            $this->modulePath = $this->module->app_path;
            return $this->module->app_path . 'model/'.$filename.'.php';         
        } elseif(file_exists($this->module->path . 'model/'.$filename.'.php')) { 
            $this->modulePath = $this->module->path;
            return $this->module->path . 'model/'.$filename.'.php';   
        }  
    }   
    
}