<?php

/* 
 *                      ARCHITECT FRAMEWORK
 *               пример использования контроллера
 */

namespace home\controller;

// название контроллера, должно соответсвтовать названия файла и папки контроллера
class contacts extends \pattern\controller{
    
    // название действия, вызывается через роутер, по умолчанию срабатывает index
    public function index_app_data(){
       
        $sampleModel = $this->model->load('contacts');    
        $contacts = $sampleModel->getText();
        
        \breadcrumbs\unit_Breadcrumbs::add('architect', \unit_Html::href('index'));
        \breadcrumbs\unit_Breadcrumbs::add($contacts['title'], NULL, TRUE);
        
        // пример передачи данных в представление
        $this->extArray = array(        
            'contacts' => $contacts
        );                 
    }
    
    public function index_app_output() {
        $this->view->render('contacts', $this->extArray);  
    }
}