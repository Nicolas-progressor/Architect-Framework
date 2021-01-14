<?php

class plugin{
    
    public function __construct() {
        \core\architect::statement()->register('core_post_load', $this, 'getFiles');
    }
    
    public function load() {
        return new self;
    }
        
    public function getFiles() {
        if(file_exists(\core\architect::$APP_DIR  . "plugs/")){
            $files = scandir(\core\architect::$APP_DIR  . "plugs/");
            if($files){
                $files = array_slice($files, 2);
                foreach ($files as $file){
                    $this->loadFile($file);
                }
            }           
        }
    }
    
    function loadFile($file){
        $filename = \core\architect::$APP_DIR  . 'plugs/' . $file;
        if(file_exists($filename)){            
            $file_data = include_once $filename;
            if(isset($file_data['module']) && isset($file_data['plugin']) && isset($file_data['action'])){                    
                $this->load_class($file_data);
            }
        }
    }
    
    function load_class($file_data){
         $class_file = \core\architect::$APP_DIR  . 'modules/' . $file_data['module'] . '/plugin/' . $file_data['plugin'] .  '/plugin.php';
         if(file_exists($class_file)){             
            include_once $class_file;
            $class_name = 'plugin_' . $file_data['plugin'];
            $this->{$class_name} = new $class_name;
            $this->{$class_name}->instruments = new plugin_instruments();
             \core\architect::statement()->register('app_data', $this->{$class_name}, $file_data['action']);
             \core\architect::statement()->register('app_output', $this->{$class_name}, $file_data['action'].'_output');
         }
    }
    
}