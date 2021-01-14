<?php

class view{
    
    public $module;
    
    public $data = array();
    public $filename;
    public $resDir;
    public $call_class;

    public function __construct($class_name, $module) {
        $this->call_class = $class_name;
        $this->module = $module;
    }   
    
    //add data to array
    public function add_data($filename, $data = array()){
        $this->setFilename($filename);
        $this->data = array_merge($this->data, $data);
    }
    
    //standart render
    public function render($filename, $data = array()) {
        $this->data = $data;
        $this->setFilename($filename);
        $this->get_capture();
    }
    
    //render in this statement
    public function render_now($filename, $data = array()) {
        $this->setFilename($filename);
        $this->data = $data;
        $this->capture();
    }

    function setFilename($filename) {           
        $this->resDir =  $this->module->assets_url;
        $this->resPath = $this->module->assets_path;
        if (file_exists($this->module->app_path . 'view/'.$filename.'.php')){
            $this->filename = $this->module->app_path . 'view/'.$filename.'.php';         
        } elseif(file_exists($this->module->path . 'view/'.$filename.'.php')) { 
            $this->filename = $this->module->path . 'view/'.$filename.'.php';   
        }                    
    } 
    
    public function get_capture() {  
        $architect = \core\architect::get_instance();
        $pattern = \core\architect::module('pattern');

        if($architect->statement()->statement == 'render'){    
            $this->capture();
        } elseif (!isset($pattern->template)) {                        
            $this->capture();
        } elseif (isset ($pattern->template) && !isset($this->call_class->element)) {
            if($template = \core\architect::module('template')){
                $register_echo['module'] = $this->module->name;
                $register_echo['controller'] = $this->call_class->name;
                $template->template->addEcho($register_echo);
            }
        }
    }
    
    public function capture() {   
        
        if(is_array($this->data)){
            extract($this->data, EXTR_SKIP);
        } 

            
	ob_start();        
	try
	{	
            if (file_exists($this->filename)){
		include $this->filename;                
            } else { echo ' error loading view file '; }
        }
            catch (Exception $e)
	{			
            ob_end_clean();
			
            throw $e;
	}
            
        echo ob_get_clean();
    }

}