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
error_reporting(E_ALL); 
ini_set('display_errors', '1');

getIncludes();

if(!isset($_POST['AJAX'])){
    echoJavaScript();
    echoCSS();
}

function getIncludes(){
    include_once("php/database.class.php");
    include_once("php/authentication.class.php");
    include_once("php/appliance.class.php");
    include_once("php/lightbulb.class.php");
    include_once("php/user.class.php");
    include_once("php/lights.class.php");  //test class
}

function echoJavaScript(){
    echo "<script src='js/jquery-2.1.4.min.js'></script>";
    echo "<script src='js/ajax.js'></script>";
}
function echoCSS(){
    echo "<link rel='stylesheet' href='css/index.css' type='text/css'>";
}

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
