<?php

/* 
 *                      ARCHITECT FRAMEWORK
 *               пример использования контроллера
 */

namespace home\controller;

// название контроллера, должно соответсвтовать названия файла и папки контроллера
class index extends \pattern\controller{
    
    public $extArray;


    // название действия, вызывается через роутер, по умолчанию срабатывает index
    public function index_app_data(){   
        \core\architect::module('language')->file('sample', $this);
       
        $sampleModel = $this->model->load('sample');    
        $sample = $sampleModel->getRow();
                
        $this->extArray =  array('rows' => $sample);      
        
    }
    
    public function index_app_output() {
        $this->view->render('welcome', $this->extArray);  
    }
}