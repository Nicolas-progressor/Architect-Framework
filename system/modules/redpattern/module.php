<?php
namespace pattern;

class module{
    
    public $name;
    public $path;
    public $app_path;   
    public $assets_url;
    public $moduleBootstrap;

    public function __construct($name) {
        $this->name = mb_strtolower($name);        
        $this->getModulePath();
        $this->moduleBootstrap();
    }
        
    public function getModulePath() {              
        $this->assets_url = ASSETS_URL . 'modules/' . $this->name . '/';  
        $this->assets_path = ASSETS_PATH . 'modules/' . $this->name . '/';
        if(file_exists(APP_DIR . 'modules/' . $this->name . '/')){            
            $this->path = APP_DIR . 'modules/' . $this->name . '/';  
        }
        if(file_exists(\core\architect::$APP_DIR . 'modules/' . $this->name . '/')){            
            $this->app_path = \core\architect::$APP_DIR . 'modules/' . $this->name . '/';                   
        }
    }
    
    
    
    public function getControllerPath($name, $type) {
        $file_path = NULL;
        if($type == 'controller' && $name == 'index'){
            $file_path = 'controller.php';
        } else {
            $file_path = $type . '/' . $name . '.php';
        }          
        $module_path = NULL;
        if(!empty($this->app_path)){
            if(file_exists($this->app_path)){
                $module_path = $this->app_path;
            } elseif (file_exists($this->path)) {
                $module_path = $this->path;
            }
        } else {
            if(file_exists($this->path)){
                $module_path = $this->path;
            }
        }           
        $class_pathes['module_path'] = $module_path;
        $class_pathes['full_path'] = $module_path . $file_path;
        if(!empty($file_path)){
            return $class_pathes;
        } else {
            return false;
        }
    }
    
    public function addController($name, $type) {
        $pathes = $this->getControllerPath($name, $type);     
        if(file_exists($pathes['full_path'])){
            include_once $pathes['full_path'];   
            $className = '\\' . $this->name . '\\' . $type . '\\' . $name;            
            $this->{$name} = new $className($this, $className, $name, $pathes); 
        } else {
            \errors\unit_Errors::get('404');          
        }        
    }    
    
    function moduleBootstrap(){
        $path = NULL;
        if(!empty($this->app_path)){
            $path = $this->app_path;
        } elseif(!empty($this->path)){
            $path = $this->path;
        }
        if(!empty($path) && file_exists($path . 'bootstrap.php')){
            require_once $path . 'bootstrap.php';
            $this->moduleBootstrap = new \app\app_bootstrap();
        }
    }
}
