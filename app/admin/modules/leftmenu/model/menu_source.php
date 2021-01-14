<?php

namespace leftmenu\model;

class menu_source{
    
    public function get_menu(){
        
        $adl_sources = array();
        if(file_exists(\core\architect::$APP_DIR . "modules/")){
            $files = scandir(\core\architect::$APP_DIR . "modules/");
            if($files){
                $files = array_slice($files, 2);
                foreach ($files as $file){
                    $adlfile = \core\architect::$APP_DIR . "modules/" . $file . '/adlmenu.php';
                    if(file_exists($adlfile)){
                        $adl = include $adlfile;
                        if(is_array($adl)){
                            foreach ($adl as $adl_name => $adl_line){      
                                if($adl_line['pos'] == 'top'){
                                    $adl_sources['top'][] = $adl_line;
                                } elseif ($adl_line['pos'] == 'bottom') {
                                    $adl_sources['bottom'][] = $adl_line;
                                } elseif ($adl_line['pos'] == 'main') {
                                    $adl_sources['main'][] = $adl_line;
                                }
                            }
                        }
                    } 
                }
            } else {
                return FALSE;
            }
        }
        $sources = array();
        if(isset($adl_sources['top'])){
            foreach ($adl_sources['top'] as $source){                    
                $sources[] = $source;                
            }
        }
        if(isset($adl_sources['main'])){
            foreach ($adl_sources['main'] as $source){           
                $sources[] = $source;
            }
        }
        if(isset($adl_sources['bottom'])){
            foreach ($adl_sources['bottom'] as $source){           
                $sources[] = $source;               
            }
        }
        unset($adl_sources);
        
        return $sources;
    }
    
}