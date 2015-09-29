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
        $this->connect = mysqli_connect('localhost', 'root', 'balls', 'smarthome');
        $this->getSQLError();
        
    }
    
    protected function getSQLError(){
        if (mysqli_connect_errno()){
            echo "<span style = 'background-color:red;'> Failed to connect to MySQL: " . mysqli_connect_error() . "</span>";
        }
    }
    
}
