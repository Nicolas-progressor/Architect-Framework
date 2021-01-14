<?php

class lib_microMVC{
    
    private static $folder = NULL;
    
    private static $name = NULL;

    public function get($folder, $name, $action = NULL, $var = array()) {
        if(file_exists($folder . '/mvc/' . $name . '/') && file_exists($folder . '/mvc/' . $name . '/' . 'controller.php')){
            self::$folder = $folder . '/mvc/' . $name . '/';
            self::$name = $name;
            $controller = self::controller($folder . '/mvc/' . $name . '/' . 'controller.php', $name);
            if($action == NULL){
                return $controller;
            } else {
                self::start($controller, $action, $var);
            }
        }        
    }
    
    public function controller($filename){
        include_once $filename;
        $class_name = 'mvc_ctrl_' . self::$name;
        $controller = new $class_name;     
        self::model($controller);     
        self::view($controller);
        return $controller;
    }
    
    function model($controller) {
        if (file_exists(self::$folder . 'model.php')){
            include_once self::$folder . 'model.php';
            $model_name = 'mvc_mdl_' . self::$name;
            $controller->model = new $model_name;
        }
    }
    
    function view($controller){  
            $controller->view = new microMVC_view(self::$folder);               
    }
    
    public function start($controller, $action, $var = array()){
        call_user_func_array(array($controller, $action), $var);  
    }
}

class microMVC_view{
    
    private $filename;
    
    private $folder;
    private $data = NULL;
    public $resDir;
    
    
    public function __construct($folder) {
        
        $filename = $folder . 'view.php';
        $this->folder = $folder;
        $this->filename = $filename;
        $this->resDir = $folder . '/resources/';
    }
    
    public function render($data = NULL){
        $this->data = $data;
        $this->capture();
    }
    
    public function renderTo($filename, $data = NULL) {
        $this->filename = $this->folder . '/view/' . $filename . '.php';
        $this->data = $data;
        $this->capture();
    }
    
    protected function capture()
    {
        if (isset($this->data)){
            extract($this->data, EXTR_SKIP);
        }
            
	ob_start();
	try
	{		
            if (file_exists($this->filename)){
		include $this->filename;
            } else { echo ' View render error '; }
        }
            catch (Exception $e)
	{			
            ob_end_clean();
			
            throw $e;
	}

        echo ob_get_clean();
    }
}