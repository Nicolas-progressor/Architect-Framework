<?php

/* 
 *                      ARCHITECT FRAMEWORK
 *                   пример использования модели
 */

namespace home\model;

class about{
    
    public function getAbout(){
        // сюда добавить пример использования мультиязычной бд
                
        // Имитация ответа бд
                
        $resp_ru = array(
            'title' => 'О Системе',
            'text' => '<p>О сколько нам открытий чудных<br>
                        Готовят просвещенья дух<br>
                        И опыт, сын ошибок трудных,<br>
                        И гений, парадоксов друг,<br>
                        И случай, бог изобретатель...</p>'            
        );
        $resp_en = array(
            'title' => 'about',
            'text' => "<p>So many wonders to discover <br>
                        Are yet with the enlightenment spirit, <br>
                        Experience, the son of painful errors, <br>
                        And genius, the paradoxes' friend, <br>
                        And accident, inventive god...</p>"
        );
        
        $resp = ${'resp_'.  ARC_LANG};
        
        return $resp;
    }
    
}