<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author Brody
 */
class Database {
    protected $connect;
    
    public function __construct() {
        
    }
    
    public static function server(){
        echo $_SERVER['SERVER_NAME'];
        foreach($_SERVER as $key => $value){
            echo $key . " : " . $value . "<br>";
        }
        
    }
}
