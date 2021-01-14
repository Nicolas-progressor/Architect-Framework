<?php

namespace footer\widget;

class footer extends \pattern\controller{

    public function index_app_output(){     
        $this->view->render('footer', array());  
    }
}