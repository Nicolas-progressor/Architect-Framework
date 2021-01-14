<?php
namespace query;

class unit_Query{
    
    private $router;
    private $args;

    public function __construct() {      
        $this->router = \core\architect::module('router');
    }
    
    public function __get($name) {        
        return $this->args[$name];
    }
    
    public function getArgs() {
        $getArr = array();
        if(isset($_POST)){
            $getArr = array_merge($getArr, $_POST);
        }
        if(isset($_GET)){
            $getArr = array_merge($getArr, $_GET);
        }
        if(isset($this->router->rules->segVar)){
            $cpu = array();
            foreach ($this->router->rules->segVar as $key => $val){
                $cpu['cpu' . $key] = $val;
            }
            $getArr = array_merge($getArr, $cpu);
        }
        $this->args = $getArr;
        return $getArr;
    }

    public function get($name) {
        if(isset($_GET[$name])){
            return $_GET[$name];
        } else { return FALSE; }
    }
    
    public function post($name) {
        if(isset($_POST[$name])){
            return $_POST[$name];
        } else { return FALSE; }
    }
        
    public function cpu($number) {   
        if(isset($this->router->rules->segVar[$number])){
            return $this->router->rules->segVar[$number];
        } else { return FALSE; }
    }
}
