<?php

namespace passport\controller;

class login extends \pattern\controller{

    private $state;
    private $ext = array();


    public function index_app_data(){
        $reg = \unit_redAuth::getInstance();
        \core\architect::module('language')->file('login', $this);
        
        if(isset($_POST['login']) && isset($_POST['password'])){
            $master = $reg->login($_POST['login'], $_POST['password']);
            if(!$master){
                $this->ext['state'] = 'error';
            }
        }
        
        if($reg->islogin()){ $this->state = 'logged'; }
    }
    
    public function index_app_output() {
       if($this->state == 'logged'){
           header( 'Location: ' . '/passport/view' );
       } else {
            $this->view->render('login', $this->ext);  
       }
    }
}