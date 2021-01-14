<?php

namespace errors\widget;

class custom extends \pattern\controller {

    public function error_app_data($title, $text) {
        $this->extArray =  array('title' => $title, 'text' => $text);
    }
    
    public function error_app_output(){
       
        $this->view->render('error', $this->extArray);  
    }
    
    public function warning_app_data($title, $text) {
        $this->extArray =  array('title' => $title, 'text' => $text);
    }
    
    public function warning_app_output() {
        $this->view->render('warning', $this->extArray ); 
    }
}