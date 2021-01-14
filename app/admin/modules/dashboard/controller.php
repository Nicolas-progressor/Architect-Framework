<?php

namespace dashboard\controller;

class index extends \pattern\controller{
    
    private $extArray;

    public function index_app_data(){     
        \core\architect::module('language')->file('dashboard', $this);
        \unit_Title::getInstance()->Add(" - " . LANG_ADMIN_DASHBOARD_TITLE);
    }
    
    public function index_app_output() {
        $this->view->render('index', $this->extArray);  
    }
}