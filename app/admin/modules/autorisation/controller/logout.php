<?php

namespace autorisation\controller;

class logout extends \pattern\controller{

    public function index_app_data(){
   
       $auth = \unit_redAuth::getInstance();
       $auth->logout();       
       header( 'Location: ' . ROOT_URL); 
       
    }
    
}