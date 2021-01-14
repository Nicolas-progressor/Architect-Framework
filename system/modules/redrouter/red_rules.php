<?php

class red_rules{
    
    public $last_seg = 2;
    public $seg_steps = 0;
    public $NoTempload;

    public function addRule($setup = NULL) {
        $redrouter = \core\architect::module('router');
        $id = NULL; $remap = FALSE; $rule = NULL;  
        $get = NULL; $noTempLoad = NULL;        
        if (isset($setup['id'])){ $id = $setup['id']; }
        if (isset($setup['remap'])){ $remap = $setup['remap']; }
        if (isset($setup['rule'])) { $rule = $setup['rule']; }
        if (isset($setup['noTempLoad'])){ $noTempLoad = $setup['noTempLoad']; }
        
        if ($id !== NULL && $rule !== NULL){             
            $this->{$rule} = $redrouter->url->segments[$id];
            if ($remap){ 
                unset($redrouter->url->segments[$id]); 
                $redrouter->url->segments = array_values($redrouter->url->segments);   
            }
            $this->last_seg = $id;            
        }
        
        if (isset($noTempLoad) && $noTempLoad == TRUE){
            $this->NoTempload = TRUE;
        }        
    }
    
}