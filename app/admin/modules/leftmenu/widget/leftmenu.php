<?php

namespace leftmenu\widget;

class leftmenu extends \pattern\controller{
  
    private $extArray;

    public function index_app_data() {
        \core\architect::module('language')->file('ent', $this);
        
        $source = $this->model->load('menu_source');
        $menu = $source->get_menu();
        
        foreach ($menu as $key => $val){
            if(isset($val['t_lang'])){
                $m_t_lang = explode('/', $val['t_lang']);
                \core\architect::module('language')->file($m_t_lang[0], $m_t_lang[1]);
            }
            if(!empty($val['text'])){
                $m_text_arr = explode('/', $val['text']);
                if($m_text_arr[0] == 'const'){
                    $menu[$key]['m_text'] = constant($m_text_arr[1]);
                }
                if($m_text_arr[0] == 'text'){
                    $menu[$key]['m_text'] = $m_text_arr[1];
                }
            }
        }
              
        $this->extArray = array(   
            'source' => $menu
        );        
                   
    }
    
    public function index_app_output() {
        $this->view->render('menu', $this->extArray);  
    }
    
}