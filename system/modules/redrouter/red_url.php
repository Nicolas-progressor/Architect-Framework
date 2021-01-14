<?php

class red_url{
    
    public $segments;
    public $request_url;


    public function __construct() {
        \core\architect::statement()->register('core_preinit', $this, 'getUrl');
    }
        
    function getUrl(){  
        $script_url = SCRIPT_URL;              
        $request_url = $_SERVER['REQUEST_URI'];         
             
        if ($script_url == $request_url) {$request_url = substr($request_url,0,strpos($request_url,'.'));}          
        
        $request_url = trim(
                preg_replace('/'. 
                        str_replace('/', '\/', str_replace('index.php', '', $script_url)) 
                        .'/', '', $request_url, 1), '/');
        
        $request_url = parse_url($request_url, PHP_URL_PATH);  
        $request_url = preg_replace('/\/$/', '', $request_url);
        $this->request_url = $request_url; 
              
        if($request_url){            
            $segments = explode('/', $request_url);        
        } else {
            $segments = array();
        }     
        
        $this->segments = $segments;
        $this->segUrl = $segments;
    }
    
}
