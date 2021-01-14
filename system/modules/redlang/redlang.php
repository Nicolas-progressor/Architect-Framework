<?php

class language{
    
    private $config;
    private $router;
    private $pattern;
    
    private $lang;
    private $cookieSetted = false;


    public function __construct() {
        $this->config = \core\core_Config::getInstance('lang');
        $this->router = \core\architect::module('router');
        $this->pattern = \core\architect::module('pattern');
                
        \core\architect::statement()->register('core_preinit', $this, 'get');
    }
        
    public function get(){  
        if(!empty($this->lang)){
            $ret = $this->lang;            
        } else {
            $ret = $this->cookieGet();           
            $this->lang = $ret;
        }
        define('ARC_LANG', $ret);
    }
    
    function cookieGet() {
        if(!empty($_COOKIE['arcLang'])){
            $ret = $_COOKIE['arcLang'];            
        } else {
            $ret = $this->getPriority();
            $this->cookieSet($ret);
        }
        return $ret;
    }
            
    function cookieSet($lang){
        if(empty($_COOKIE['arcLang']) && $this->config->cookies->setup_cookie == TRUE && !$this->cookieSetted){
            setcookie('arcLang', $lang, $this->config->cookies->cookie_lifetime, '/');
            $this->cookieSetted = TRUE;
        } 
    }
            
    function loader($langDir) { 
        if(!empty($this->lang)){
            $ret = $this->loadLangFile($langDir, $this->lang);            
            if(!$ret){
                $lang = $this->getPriority($langDir);
                $ret = $this->loadLangFile($langDir, $lang);                
                if (!$ret){ return FALSE; }
            }
        } else {
            $lang = $this->getPriority($langDir);
            $ret = $this->loadLangFile($langDir, $lang);            
        }
    }
    
    function loadLangFile($langDir, $lang) {                  
        $langfile = $langDir . '/' . $lang . '.php';    
        if(file_exists($langfile)){                   
            require_once $langfile;
            return TRUE;
        } else { return FALSE; }
    }
                
    function getPriority($langDir = NULL){
        $language = array();     
        if($langDir){
            $langDirs = scandir($langDir);
            if($langDirs){ $langDirs = array_slice($langDirs, 2);            
            } else { return FALSE; }
        } else { $langDirs = (array)$this->config->defaults->system_langs; }
                
        if (($list = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']))) {
            if (preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', $list, $list)) {             
                $language = array_combine($list[1], $list[2]);               
                foreach ($language as $n => $v){ $language[$n] = $v ? $v : 1; }
                arsort($language, SORT_NUMERIC);   
            }        
        }
        $lang = array();
        foreach ($language as $l => $v){           
            if (array_search($l, $langDirs)!== FALSE){               
                $lang[] = $l;
                break;
            } 
        }           
               
        return $lang[0];
    }
    
}