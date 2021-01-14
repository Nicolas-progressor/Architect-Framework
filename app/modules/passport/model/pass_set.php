<?php

namespace passport\model;

class pass_set{
    
    public function set_passport() {
        $err = array();
        $statement = array();
        $mauth = \unit_redAuth::getInstance();            
        $pass = $mauth->getMyPassport();
        
        if(empty($_POST['password'])){
            $err[] = LANG_PASSPORT_SAVE_PASSWORD_EMPTY_ERROR;
        } else {
            if(!$mauth->checkPassword($pass['login'], $_POST['password'])){
                $err[] = LANG_PASSPORT_SAVE_PASSWORD_VALID_ERROR;
            }
        }

        if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['timezone']) && !$err){         
            $login_exists = $mauth->getUserByLogin($_POST['login']);
            $mail_exists = $mauth->getUserByEmail($_POST['email']);
            $newarr = array();

            if (empty ($_POST['email'])) {
                $err[] = LANG_PASSPORT_SAVE_EMAIL_EMPTY_ERROR;
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $err[] = LANG_PASSPORT_SAVE_EMAIL_VALID_ERROR;                
            }
            
            if(empty($_POST['login'])){
                $err[] = LANG_PASSPORT_SAVE_LOGIN_EMPTY_ERROR;
            }
            
            if($_POST['login'] != $pass['login']){
                if($login_exists && $login_exists['login'] != $pass['login']){ $err[] = LANG_PASSPORT_SAVE_LOGIN_ERROR; } else {
                    $newarr['login'] = $_POST['login'];
                }                
            }
            
            if($_POST['email'] != $pass['mail']){
                if($mail_exists  && $mail_exists['mail'] != $pass['mail']){ $err[] = LANG_PASSPORT_SAVE_MAIL_ERROR; } else {
                    $newarr['mail'] = $_POST['email'];
                }                
            }
            if($_POST['timezone'] != $pass['timezone']){
                $newarr['timezone'] = $_POST['timezone'];
            }        
            if(!empty($newarr) && !$err){     
                $mauth->setPassport($pass['id'], $newarr);
            }
        }
        
        if(!empty($_POST['PasswordSetCheck']) && $_POST['PasswordSetCheck'] == 'Yes' && !$err){
            if(!empty($_POST['password_new']) && !empty($_POST['ReEnterPassword']) && $_POST['password_new'] == $_POST['ReEnterPassword']) {
                if($mauth->setPassword($pass['login'], $_POST['password'], $_POST['password_new'])){
                    $statement['PassChange'] = TRUE;
                } else {
                    $err = LANG_PASSPORT_SAVE_SET_PASSWORD_ERROR;
                }
            } else {
                $err[] = LANG_PASSPORT_SAVE_SET_PASSWORD_VALID_ERROR;
            }
        } 
        
        if($err){
            $statement['state'] = 'ERR';
            $statement['errors'] = $err;        
        } else {
            $statement['state'] = 'OK';
        }
        
        return $statement;
    }
    
}

