<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shell
 *
 * @author Brody
 */
include_once("php/database.class.php");
include_once("php/authentication.class.php");
echo "<link rel='stylesheet' href='css/index.css' type='text/css'>";

//$db = new Database();

/**
 * displays info for server
 */
function displayServerInfo(){
    
        echo $_SERVER['SERVER_NAME'];
        foreach($_SERVER as $key => $value){
            echo $key . " : " . $value . "<br>";
        }
        
    }
