<?php

class unit_redAuth{
    
    private static $Instance;
    
    public static function getInstance(){
       if (self::$Instance === null){
           self::$Instance = new self;
       }
       return self::$Instance;       
    }  
    
    private $db;
    private $auth = false;
    private $pass_id;

    public function __construct() {
        $this->db = \core\core_Connect::add();
    }
    
    public function userRegister($email, $login = false, $password = false) {
        $user = array();  
        
        if(!$login){
            $login = $email;
        }
        
        $user['login'] = $login;
        $user['mail'] = $email;
            
        if(!empty($password)){
            $user['salt'] = md5(uniqid(rand(),1).time());        
            $user['password'] = md5(md5($user['salt']) . "_" . md5($password));        
        }
        
        $user['timezone'] =  date_default_timezone_get();
        
        if($this->db->select('red_passport', 'login', ['login' => $user['login']])){
            return FALSE;
        } else {     
            return $this->db->insert('red_passport', $user);
        }
    }
    
    public function getUserByEmail($email) {
        $user = $this->db->get('red_passport', ['id', 'login', 'mail', 'auth_groups', 'date_reg', 'date_login', 'date_group', 'status', 'timezone'], ['mail' => $email]);
        if(!empty($user)){
            return $user;
        } else {
            return FALSE;
        }
    }
    
    public function getUserByLogin($login) {
        $user = $this->db->get('red_passport', ['id', 'login', 'mail', 'auth_groups', 'date_reg', 'date_login', 'date_group', 'status', 'timezone'], ['login' => $login]);
        if(!empty($user)){
            return $user;
        } else {
            return FALSE;
        }
    }
    
    
    public function login($login, $password) {
        $user = $this->db->get('red_passport', "*", ['login' => $login]);
        if($user['password'] == md5(md5($user['salt']) . "_" . md5($password))){
            $this->createLogin($user);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function createLogin($user) {
        if(!empty($user)){
            $tokeniser = uniqid(rand(),1);
            $pass_id = md5($user['id']);
            $uip = $this->getUIP();
            $uagent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5($tokeniser . "_" . $pass_id . "_" . $uip . "_" . $uagent);
            $_SESSION['user']['uid'] = $pass_id;
            $_SESSION['user']['tokeniser'] = $tokeniser;
            $_SESSION['user']['token'] = $token;


            if(isset($_COOKIE['tokeniser'])){ $_COOKIE['tokeniser'] = $tokeniser; }
                setcookie('tokeniser', $tokeniser, time()+7*24*60*60,'/'); 
            if(isset($_COOKIE['uid'])){ $_COOKIE['uid'] = $pass_id; }                
                setcookie('uid', $pass_id, time()+7*24*60*60,'/');


            $date = new DateTime();
            if($user['timezone']){date_timezone_set($date, timezone_open($user['timezone']));}
            $this->db->update('red_passport', ['date_login' => $date->format('Y-m-d H:i:s'), 'pass_id' => $pass_id], ['login' => $user['login']]);

            $this->db->insert('red_passport_session', ['pass_id' => $pass_id, 'ip'=>$uip, 'token' => $token, 'user_id' => $user['id'], 'tokeniser' => $tokeniser]);          

            $this->auth = TRUE;
            $this->pass_id = $user['id'];
        } else {
            return FALSE;
        }
    }
    
    public function isLogin() {  
        $uip = $this->getUIP();
        $uagent = $_SERVER['HTTP_USER_AGENT'];
        if($this->auth == TRUE){
            return TRUE;
        }
        
        if(isset($_SESSION['user'])){
            $pass_id = NULL; $tokeniser = NULL; $token = NULL;
            if(isset($_SESSION['user']['uid']) && isset($_SESSION['user']['tokeniser']) && isset($_SESSION['user']['token'])){
                $pass_id = $_SESSION['user']['uid'];
                $tokeniser = $_SESSION['user']['tokeniser'];
                $token = $_SESSION['user']['token'];
            } else { return FALSE;}                           
            if($token == md5($tokeniser . "_" . $pass_id . "_" . $uip . "_" . $uagent)){  
                $this->pass_id = $pass_id;
                $this->auth = TRUE;
                return TRUE;
            } else {
                return FALSE;
            }            
        } else { 
            return $this->getLogin();                  
        }      
    }
     
    private function getLogin(){
        if(isset($_COOKIE['tokeniser']) && isset($_COOKIE['uid'])){
            $token = NULL;
            $tokeniser = $_COOKIE['tokeniser'];
            $pass_id = $_COOKIE['uid'];
            $uip = $this->getUIP();
            $uagent = $_SERVER['HTTP_USER_AGENT'];
            
            $u_session = $this->db->get('red_passport_session', "*", ['pass_id' => $pass_id, 'ip'=>$uip, 'tokeniser'=>$tokeniser]);
            if(isset($u_session['token'])){
                $token = $u_session['token'];
            } else { return FALSE; }
            
            if($token == md5($tokeniser . "_" . $pass_id . "_" . $uip . "_" . $uagent)){        
                
                $_SESSION['user']['uid'] = $pass_id;
                $_SESSION['user']['tokeniser'] = $tokeniser;
                $_SESSION['user']['token'] = $token;
                
                $this->auth = TRUE;
                $this->pass_id = md5($u_session['user_id']);
                return TRUE;
            } else { 
                return FALSE;                  
            }
        } else {
            return FALSE;
        }
    }

    public function logout() {
        if($this->isLogin() == TRUE){
            $pass_id = NULL; $tokeniser = NULL;
            $uip = $this->getUIP();
            
            if(isset($_SESSION['user']['uid']) && isset($_SESSION['user']['tokeniser']) && isset($_SESSION['user']['token'])){
                $pass_id = $_SESSION['user']['uid'];
                $tokeniser = $_SESSION['user']['tokeniser'];
                $token = $_SESSION['user']['token'];
            }
            
            $u_session = $this->db->get('red_passport_session', "*", ['pass_id' => $pass_id, 'ip'=>$uip, 'token'=>$token, 'tokeniser'=>$tokeniser]);
            if(isset($u_session['token'])){
                $this->db->delete('red_passport_session', ['pass_id' => $pass_id, 'ip'=>$uip, 'token'=>$token, 'tokeniser'=>$tokeniser]);
            }
            
            if(isset($_COOKIE['uid']) && $_COOKIE['uid']){ $pass_id = $_COOKIE['uid']; unset($_COOKIE['uid']); setcookie ("uid","",time()-3600,"/"); }
            if(isset($_COOKIE['tokeniser']) && $_COOKIE['tokeniser']){ $t_hash = $_COOKIE['tokeniser']; unset($_COOKIE['tokeniser']); setcookie ("tokeniser","",time()-3600,"/");}        
            session_destroy();
            session_start();        
            if($this->auth){ $this->pass_id = NULL; $this->auth = FALSE;}     
        }    
    }
          
    public function checkPassword($login, $password) {
         $user = $this->db->get('red_passport', "*", ['login' => $login]);
         if($user['password'] == md5(md5($user['salt']) . "_" . md5($password))){
             return TRUE;
         } else { return FALSE; }
    }
    
    public function setPassword($login, $oldPass, $newPass) {
        if($this->checkPassword($login, $oldPass) == TRUE){
            $user = array();  
            $user['salt'] = md5(uniqid(rand(),1).time());
            $user['password'] = md5(md5($user['salt']) . "_" . md5($newPass));
            $retPdo =  $this->db->update('red_passport', $user, ['login' => $login]);
            return $retPdo->rowCount();
        } else {
            return FALSE;
        }
    }
    
    public function setPassport($id, $data) {
        if(!empty($data)){
            $this->db->update('red_passport', $data, ['id' => $id]);         
        }
    }
    
    public function getLoginName($id) {
        return $this->db->get('auth', 'login', ['id' => $id]);
    }
        
    public function getMyPassport() {    
        if($this->isLogin()){
            $passport = $this->db->get('red_passport', ['id', 'timezone', 'status', 'date_reg', 'auth_groups', 'login', 'mail'], ['pass_id' => $this->pass_id]);
            return $passport;             
        } 
    }
    
    private function getUIP(){
        return $_SERVER['REMOTE_ADDR'];
    }   
    
    public function getAccess($codesArr){      
        if(is_array($codesArr) && $this->isLogin()){    
            if(!in_array(0, $codesArr)){
                $codesArr[] = 0;
            }
            $uaccess = $this->db->get('red_passport', 'auth_groups', ['pass_id' => $this->pass_id]);
            $uaccessArr = str_split($uaccess);
            $granted = FALSE;
            foreach ($uaccessArr as $accessCode){
                if(in_array($accessCode, $codesArr)){
                    $granted = TRUE;
                }
            }
            if($granted == TRUE){
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}