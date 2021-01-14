<?php

namespace autorisation\controller;

class reg extends \pattern\controller{

    private $state;
    private $ext = array();


    public function index_app_data(){        
        $auth = \unit_redAuth::getInstance();
        \core\architect::module('language')->file('login', $this);
        if($auth->islogin()){ $this->state = 'logged'; }
        
        $query = new \query\unit_Query();
        $login = $query->get('login'); 
        $password = $query->get('password'); 
        $email = $query->get('email');
        
        if(!empty($login) && !empty($password) && !empty($email)){
            $master = $auth->userRegister($email, $login, $password);
            if(!$master){
                $this->ext['state'] = 'error';
            }
        }

    }
    
    public function index_app_output() {

    }
}