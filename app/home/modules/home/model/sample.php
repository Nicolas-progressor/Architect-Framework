<?php

/* 
 *                      ARCHITECT FRAMEWORK
 *                   пример использования модели
 */

namespace home\model;

class sample{
    
    public function getIndex(){
//        // создаем подключение к БД
//         $DB = arcConnect::load();
//         
//         // выбираем данные из БД, по умолчанию используется MEDOO, документация на сайте MEDOO
//         $resp = $DB->get("rawinfo", "Value", ["StringName" => $StringName ]);
//          if ($resp){        
//                    return $resp;        
//                }
//                else {        
//                    return 'EmptyErr';    
//                }   
        
        // сюда добавить пример использования мультиязычной бд
        
        
        // Имитация ответа бд
                
        $resp_ru = array(
            'text' => '<p>О сколько нам открытий чудных<br>
                        Готовят просвещенья дух<br>
                        И опыт, сын ошибок трудных,<br>
                        И гений, парадоксов друг,<br>
                        И случай, бог изобретатель...</p>'            
        );
        $resp_en = array(
            'text' => "<p>So many wonders to discover <br>
                        Are yet with the enlightenment spirit, <br>
                        Experience, the son of painful errors, <br>
                        And genius, the paradoxes' friend, <br>
                        And accident, inventive god...</p>"
        );
        
        $resp = ${'resp_'.  ARC_LANG};
        
        return $resp;
    }
    
    public function getRow() {
        $resp_ru = array(
            '1' => array(
                'header' => 'О системе',
                'text' => 'Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.',
                'url' => 'about'
            ),
            '2' => array(
                'header' => 'Потенциал',
                'text' => 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.',
            ),
            '3' => array(
                'header' => 'Контакты',
                'text' => 'Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
                'url' => 'contact'
            )
        );
        
        $resp_en = array(
            '1' => array(
                'header' => 'About system',
                'text' => 'Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.',
                'url' => 'about'
            ),
            '2' => array(
                'header' => 'Potential',
                'text' => 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.',
            ),
            '3' => array(
                'header' => 'Contact',
                'text' => 'Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
                'url' => 'contact'
            )
        );
        
        $resp = ${'resp_'.  ARC_LANG};
        
        return $resp;
    }
}