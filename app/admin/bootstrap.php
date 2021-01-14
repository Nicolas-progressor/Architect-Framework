<?php

namespace app;

class app_bootstrap {
    
    public function __construct() {
        \core\architect::statement()->register('core_init', $this, 'autorisation');
    }
    
    function autorisation(){
        $auth = \unit_redAuth::getInstance();    
        $router = \core\architect::module('router');
        if(!$auth->islogin()){            
            $router->rules->module = 'autorisation';
            $router->rules->controller = 'login';
            $router->rules->action = 'index';
            $router->rules->selectTemplate = 'blank';
        } else {
            if(!$auth->getAccess(array(0))){
                $router->rules->module = 'errors';
                $router->rules->controller = 'error';
                $router->rules->action = 'error';
                $router->rules->controllerType = 'widget';
                $router->rules->controllerParameters = array('code' => 403);
                $router->rules->selectTemplate = 'blank';
            }
        }
    }
    
}
