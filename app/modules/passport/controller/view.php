<?php

namespace passport\controller;

class view extends \pattern\controller{

    public function index_app_data() {
        $mauth = \unit_redAuth::getInstance();
        \core\architect::module('language')->file('passport', $this);        
        $this->passport = $mauth->getMyPassport();
        
        if(!\unit_redAuth::getInstance()->islogin()){ header( 'Location: ' . ROOT_URL ); } //TODO сделать перенаправление на 404
        
        \breadcrumbs\unit_Breadcrumbs::add('architect', \unit_Html::href('index')); //TODO сделать первую кроху в название сайта
        \breadcrumbs\unit_Breadcrumbs::add(LANG_PASSPORT_SET_CLASSNAME, NULL, TRUE);
    }
    
    public function index_app_output() {
        $this->view->render('view', array('passport' => $this->passport));

    }
}