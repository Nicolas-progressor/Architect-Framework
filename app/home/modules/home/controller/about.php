<?php

/* 
 *                      ARCHITECT FRAMEWORK
 *               пример использования контроллера
 */

namespace home\controller;

// название контроллера, должно соответсвтовать названия файла и папки контроллера
class about extends \pattern\controller{
    
    // название действия, вызывается через роутер, по умолчанию срабатывает index
    public function index_app_data(){
       
        $sampleModel = $this->model->load('about');    
        $about = $sampleModel->getAbout();
                
        \breadcrumbs\unit_Breadcrumbs::add('architect', \unit_Html::href('index'));
        \breadcrumbs\unit_Breadcrumbs::add($about['title'], NULL, TRUE);
        
        // пример передачи данных в представление
        $this->extArray = array(
            'title' => $about['title'],
            'index_text' => $about['text']
        );                         
    }
    
    public function index_app_output() {
        $this->view->render('about', $this->extArray); 
    }
}