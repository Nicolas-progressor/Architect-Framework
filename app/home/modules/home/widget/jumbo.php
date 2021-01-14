<?php

/* 
 *                      ARCHITECT FRAMEWORK
 *               пример использования контроллера
 */

namespace home\widget;

// название контроллера, должно соответсвтовать названия файла и папки контроллера
class jumbo extends \pattern\controller{
    
    // название действия, вызывается через роутер, по умолчанию срабатывает index
    public function index_app_data(){  
       
        $sampleModel = $this->model->load('sample');    
        $sample = $sampleModel->getIndex();
        
        // пример передачи данных в представление
        $this->extArray = array(        
        'index_text' => $sample['text']
        );        
    }
    
    public function index_app_output() {
        \core\architect::module('language')->file('jumbo', $this);
        $this->view->render('jumbo', $this->extArray); 
    }
}