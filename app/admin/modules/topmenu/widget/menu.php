<?php

namespace topmenu\widget;

class menu extends \pattern\controller{
  
    public function index_app_data() {
        \core\architect::module('language')->file('ent', $this);
        $auth = \unit_redAuth::getInstance();
       
        $this->extArray = array(        
            'passport' => $auth->getMyPassport()
        );        
    }
    
    public function index_app_output() {
        $this->view->render('menu', $this->extArray);  
    }
    
}