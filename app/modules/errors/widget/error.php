<?php

namespace errors\widget;

class error extends \pattern\controller{

    public function error_app_data($code){
        $errorModel = $this->model->load('error');
        $error = $errorModel->{'error_'.  $code}();
        
        $this->extArray = array('title' => $error['title'], 'text' => $error['text']);        
    }
    
    public function error_app_output() {          
        $this->view->render('error', $this->extArray);  
    }
}