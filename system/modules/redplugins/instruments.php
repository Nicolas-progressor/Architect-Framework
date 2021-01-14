<?php

class plugin_instruments{           
    
    public function content_str_replace($str, $where) {
        $classes = \core\architect::module('pattern')->controller->classes;
        if($classes){
            foreach ($classes as $class){
                $data = \core\architect::module('pattern')->controller->{$class}->view->data;
                if($data){
                    foreach ($data as $key => $value){
                        $data[$key]  = $this->str_replace_deep($where, $str, $value);
                    }  
                    \core\architect::module('pattern')->controller->{$class}->view->data = $data;
                }
            }
        }
    }
    
    function str_replace_json($search, $replace, $subject){ 
        return json_decode(str_replace($search, $replace,  json_encode($subject))); 

   } 
    
    function str_replace_deep($search, $replace, $subject) { 
        if (is_array($subject)) 
        { 
            foreach($subject as &$oneSubject) 
                $oneSubject = $this->str_replace_deep($search, $replace, $oneSubject); 
            unset($oneSubject); 
            return $subject; 
        } else { 
            return str_ireplace($search, $replace, $subject); 
        } 
    } 
}