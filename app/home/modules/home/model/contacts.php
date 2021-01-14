<?php

/* 
 *                      ARCHITECT FRAMEWORK
 *                   пример использования модели
 */

namespace home\model;

class contacts{
    
    public function getText(){
        
        // Имитация ответа бд
                
        $resp_ru = array(
            'title' => 'Контакты',
            'text' => 'тут будут контакты'            
        );
        $resp_en = array(
            'title' => 'Contact',
            'text' => "there is contacts"
        );
        
        $resp = ${'resp_'.  ARC_LANG};
        
        return $resp;
    }
    
}