<?php

namespace errors\model;

class error{
    
    public function error_404(){

        $resp_ru = array(
            'title' => 'Ошибка 404',
            'text' => 'Запрошенная страница не найдена.'            
        );
        $resp_en = array(
            'title' => 'Error 404',
            'text' => "Requested page doesn't exist."
        );
        
        $resp = ${'resp_'. ARC_LANG};
        
        return $resp;
    }
    
    public function error_403() {
        $resp_ru = array(
            'title' => 'Ошибка 403',
            'text' => 'Доступ запрещен.'            
        );
        $resp_en = array(
            'title' => 'Error 403',
            'text' => "Access forbidden."
        );
        
        $resp = ${'resp_'.  ARC_LANG};
        
        return $resp;
    }
    
        
    public function error_401() {
        $resp_ru = array(
            'title' => 'Ошибка 401',
            'text' => 'Необходима авторизация.'            
        );
        $resp_en = array(
            'title' => 'Error 401',
            'text' => "Unauthorized."
        );
        
        $resp = ${'resp_'.  ARC_LANG};
        
        return $resp;
    }
    
    public function error_400() {
        $resp_ru = array(
            'title' => 'Ошибка 400',
            'text' => 'Неверный запрос.'            
        );
        $resp_en = array(
            'title' => 'Error 400',
            'text' => "Bad Request."
        );
        
        $resp = ${'resp_'.  ARC_LANG};
        
        return $resp;
    }
}