<?php

namespace autorisation\controller;

class login extends \pattern\controller{

    private $state;
    private $ext = array();


    public function index_app_data(){        
        $auth = \unit_redAuth::getInstance();
        \core\architect::module('language')->file('login', $this);
        
        if(isset($_POST['login']) && isset($_POST['password'])){
            $master = $auth->login($_POST['login'], $_POST['password']);
            if(!$master){
                $this->ext['state'] = 'error';
            }
        }
        
        if($auth->islogin()){ $this->state = 'logged'; }
    }
    
    public function index_app_output() {
       if($this->state == 'logged'){
           header( 'Location: ' . \unit_Html::href("") );
       } else {
            $this->view->render('login', $this->ext);  
       }
    }
}