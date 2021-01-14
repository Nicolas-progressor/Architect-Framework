<?php
/* 
 *             Medoo loader for Architect Framework
 */
use Medoo\Medoo;

class lib_medoo{
    
    public static $type = 'DB';
    
    public static function db($dbConfig) {   
             
        $DB = new Medoo([
       // required
       'database_type' => $dbConfig->db_type,
       'database_name' => $dbConfig->db_name,
       'server' => $dbConfig->db_host,
       'username' => $dbConfig->db_user,
       'password' => $dbConfig->db_pass,
       'charset' => $dbConfig->db_charset,
         
        // [optional]
        'port' => $dbConfig->port,
         
        // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
        'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
        ]
        ]);
        return $DB;
    }      
}