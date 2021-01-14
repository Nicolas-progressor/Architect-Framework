<?php

namespace simple_menu\widget;

class menu extends \pattern\controller{
  
    public function index_app_data() {
        \core\architect::module('language')->file('ent', $this);
                
        $menuModel = $this->model->load('menu');    
        $menu = $menuModel->getMenu();
        
        $this->extArray = array(        
        'site_name' => 'Architect RED Framework',  
        'menu' => $menu
        );        
                   
    }
    
    public function index_app_output() {
        $this->view->render('menu', $this->extArray);  
    }
    
}