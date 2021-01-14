<?php

class unit_Html{
    
    public static function href($path){       
        $router = \core\architect::module('router');
        if(!strpos($path, '.')){
            if(isset($router->rules->app)){
                return ROOT_URL.$router->rules->app.'/'.$path;
            }
            return ROOT_URL.$path;
        } elseif (strpos($path, '/..main/')) {
            return ROOT_URL.$path;
        } else {
            if(strpos($path, '//')){
                return $path;
            } else {
                return '//'.$path;
            }
        }
    }
    
    public static function active($path){
        $router = \core\architect::module('router');
        if($router->url->request_url == $path){           
            return "active";
        } else {            
            return false;
        }     
    }
}