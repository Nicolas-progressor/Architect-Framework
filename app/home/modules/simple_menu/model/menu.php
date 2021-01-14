<?php

namespace simple_menu\model;

class menu{
    
    public function getMenu(){
            
        $menu = array(
            'about' => array(
                'id' => 1,
                'url' => 'about',
                'name' => LANG_MENU_ABOUT,
                'position' => 2,
                'parent' => ''
            ),
            'home' => array(
                'id' => 2,
                'url' => 'index',
                'name' => LANG_MENU_HOME,
                'position' => 1,
                'parent' => ''
            ),
            'contact' => array(
                'id' => 3,
                'url' => 'contact',
                'name' => LANG_MENU_CONTACT,
                'position' => 3,
                'parent' => ''
            )
        );
        
        $data_year=array();
        foreach($menu as $key=>$arr){
            $data_year[$key]=$arr['position'];
        }        
        array_multisort($data_year, $menu);

        return $menu;
    }
    
}