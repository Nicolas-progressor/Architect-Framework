<?php

namespace breadcrumbs\widget;

class breadcrumbs extends \pattern\controller{
    
    public $crumbs;


    public function create_app_data(){
        $this->crumbs = array(); 
    }
    
    public function create_app_output() {
        $this->view->render('breadcrumbs', array('crumbs' => $this->crumbs)); 
    }
}