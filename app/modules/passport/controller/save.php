<?php

namespace passport\controller;

class save extends \pattern\controller{
    
    private $info;


    public function index_app_data() {    
        \core\architect::module('language')->file('passport', $this);        
        if(!\unit_redAuth::getInstance()->islogin()){ header( 'Location: ' . ROOT_URL ); } //TODO сделать перенаправление на 404
        
        $pm = $this->model->load('pass_set');
        $this->info = $pm->set_passport();
    }
    
    public function index_app_output() {
        $this->view->render('save', $this->info);
    }
    
}